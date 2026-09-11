<?php

namespace App\Http\Controllers;

use App\Mail\CandidatureLienMail;
use App\Models\CandidatureDiplome;
use App\Models\CandidatureLangue;
use App\Models\CandidatureMaster;
use App\Models\DocumentCandidature;
use App\Models\ExperienceProfessionnelle;
use App\Models\FormationCandidat;
use App\Models\Langue;
use App\Models\LettreMotivation;
use App\Models\Master;
use App\Models\PieceObligatoireMaster;
use App\Models\ProjetRecherche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CandidatureController extends Controller
{
    public function intro()
    {
        $master = Master::where('statut', true)->orderByDesc('id')->first();
        return view('pages_sites.candidature.intro', compact('master'));
    }

    public function etape1()
    {
        $masters = Master::where('statut', true)->get();
        if ($masters->isEmpty()) {
            return redirect()->route('candidature.intro')->with('error', __('candidature.aucun_master'));
        }
        return view('pages_sites.candidature.etape1', compact('masters'));
    }

    public function storeEtape1(Request $request)
    {
        // sur mobile la connexion est souvent moins stable : si le telephone perd
        // le reseau ou que l'utilisateur quitte la page juste apres avoir valide,
        // le script serait sinon interrompu avant l'envoi de l'email
        if ($this->estMobile($request)) {
            ignore_user_abort(true);
        }

        $validated = $request->validate([
            'master_id' => 'required|exists:masters,id',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'sexe' => 'nullable|string|max:20',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'nni' => 'required|string|max:50|unique:candidatures_master,nni',
            'telephone' => 'nullable|string|max:30|unique:candidatures_master,telephone',
            'whatsapp' => 'nullable|string|max:30',
            'email' => 'required|email|max:150|unique:candidatures_master,email',
            'adresse' => 'nullable|string',
        ], [
            'nni.unique' => __('candidature.nni_deja_utilise'),
            'telephone.unique' => __('candidature.telephone_deja_utilise'),
            'email.unique' => __('candidature.email_deja_utilise'),
        ]);

        $master = Master::findOrFail($validated['master_id']);

        $candidature = new CandidatureMaster();
        $candidature->fill($validated);
        $candidature->nationalite = 'Mauritanienne';
        $candidature->numero_candidature = $this->genererNumeroCandidature($master);
        $candidature->statut = 'brouillon';
        $candidature->token = Str::random(48);
        $candidature->token_expire_at = now()->addDays(7);
        $candidature->save();

        try {
            Mail::to($candidature->email)->send(new CandidatureLienMail($candidature));
        } catch (\Throwable $e) {
            Log::error('Echec envoi email candidature (lien)', [
                'candidature_id' => $candidature->id,
                'email' => $candidature->email,
                'erreur' => $e->getMessage(),
            ]);
        }

        return view('pages_sites.candidature.verifiez-email', compact('candidature'));
    }

    public function renvoyerLien(Request $request, string $token)
    {
        $candidature = CandidatureMaster::where('token', $token)->first();

        if (!$candidature || $candidature->statut !== 'brouillon') {
            return redirect()->route('candidature.intro')->with('error', __('candidature.session_expiree'));
        }

        // si le lien avait deja expire, on en profite pour le prolonger
        // pour que le nouvel email envoye soit bien utilisable
        if ($candidature->tokenEstExpire()) {
            $candidature->token = Str::random(48);
            $candidature->token_expire_at = now()->addDays(7);
            $candidature->save();
        }

        if ($this->estMobile($request)) {
            ignore_user_abort(true);
        }

        try {
            Mail::to($candidature->email)->send(new CandidatureLienMail($candidature));
            return back()->with('success', __('candidature.email_renvoye'));
        } catch (\Throwable $e) {
            Log::error('Echec renvoi email candidature (lien)', [
                'candidature_id' => $candidature->id,
                'email' => $candidature->email,
                'erreur' => $e->getMessage(),
            ]);
            return back()->with('error', __('candidature.email_non_renvoye'));
        }
    }

    private function genererNumeroCandidature(Master $master): string
    {
        $annee = now()->format('Y');
        $prefixe = $master->code . '-' . $annee . '-';
        $dernier = CandidatureMaster::where('numero_candidature', 'like', $prefixe . '%')
            ->orderByDesc('numero_candidature')
            ->value('numero_candidature');
        $prochain = $dernier ? ((int) substr($dernier, -4)) + 1 : 1;
        return $prefixe . str_pad((string) $prochain, 4, '0', STR_PAD_LEFT);
    }

    public function reprendre(string $token)
    {
        $candidature = CandidatureMaster::where('token', $token)->first();

        if (!$candidature) {
            return view('pages_sites.candidature.lien-invalide');
        }

        if ($candidature->statut !== 'brouillon') {
            return view('pages_sites.candidature.deja-soumise', compact('candidature'));
        }

        if ($candidature->tokenEstExpire()) {
            return view('pages_sites.candidature.lien-invalide');
        }

        Session::put('candidature_id', $candidature->id);

        if (!$candidature->estActivee()) {
            return redirect()->route('candidature.definirMotDePasse');
        }

        return redirect()->route('candidature.espace');
    }

    public function definirMotDePasse()
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return redirect()->route('candidature.connexion')->with('error', __('candidature.session_expiree'));
        }
        if ($candidature->estActivee()) {
            return redirect()->route('candidature.espace');
        }
        return view('pages_sites.candidature.definir-mot-de-passe', compact('candidature'));
    }

    public function definirMotDePasseStore(Request $request)
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return redirect()->route('candidature.connexion')->with('error', __('candidature.session_expiree'));
        }

        $request->validate([
            'mot_de_passe' => 'required|string|min:6|confirmed',
        ]);

        $candidature->mot_de_passe = $request->input('mot_de_passe');
        $candidature->save();

        return redirect()->route('candidature.espace');
    }

    public function connexion()
    {
        if ($this->candidatureDeSession()) {
            return redirect()->route('candidature.espace');
        }
        return view('pages_sites.candidature.connexion');
    }

    public function connexionStore(Request $request)
    {
        $request->validate([
            'identifiant' => 'required|string',
            'mot_de_passe' => 'required|string',
        ]);

        $candidature = CandidatureMaster::where('email', $request->input('identifiant'))
            ->orWhere('telephone', $request->input('identifiant'))
            ->first();

        if (!$candidature || !$candidature->mot_de_passe || !Hash::check($request->input('mot_de_passe'), $candidature->mot_de_passe)) {
            return back()->withErrors(['identifiant' => __('candidature.identifiants_invalides')])->withInput();
        }

        Session::put('candidature_id', $candidature->id);

        return redirect()->route('candidature.espace');
    }

    public function deconnexion()
    {
        Session::forget('candidature_id');
        return redirect()->route('candidature.intro');
    }

    public function espace()
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return redirect()->route('candidature.connexion');
        }

        $candidature->load(['master', 'diplomes', 'langues.langue', 'experiencesProfessionnelles', 'formations', 'projetsRecherche', 'lettreMotivation', 'documents']);
        $photo = $candidature->documents->firstWhere('type_document', 'photo');

        return view('pages_sites.candidature.espace', compact('candidature', 'photo'));
    }

    public function mettreAJourPhoto(Request $request)
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return redirect()->route('candidature.connexion');
        }

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $this->enregistrerDocument($request->file('photo'), $candidature, 'photo', "candidatures/{$candidature->id}/documents");

        return redirect()->route('candidature.espace')->with('success', __('candidature.photo_mise_a_jour'));
    }

    public function suite()
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return redirect()->route('candidature.connexion')->with('error', __('candidature.session_expiree'));
        }
        if ($candidature->statut !== 'brouillon') {
            return redirect()->route('candidature.espace')->with('error', __('candidature.deja_soumise_note'));
        }

        $candidature->load(['diplomes', 'langues.langue', 'experiencesProfessionnelles', 'formations', 'projetsRecherche', 'lettreMotivation', 'documents']);
        $langues = Langue::where('actif', true)->get();
        $piecesObligatoires = $candidature->master->piecesObligatoires;

        return view('pages_sites.candidature.suite', compact('candidature', 'langues', 'piecesObligatoires'));
    }

    public function storeSuite(Request $request)
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return redirect()->route('candidature.connexion')->with('error', __('candidature.session_expiree'));
        }
        if ($candidature->statut !== 'brouillon') {
            return redirect()->route('candidature.espace')->with('error', __('candidature.deja_soumise_note'));
        }

        $this->retirerFichiersVides($request);

        $request->validate($this->reglesEtape3(true), [], $this->attributsPiecesEtape3($candidature));

        [$piecesObligatoires, $projet, $lettre] = $this->enregistrerEtape3($request, $candidature);

        // verification des pieces obligatoires avant soumission finale
        $manquantes = [];
        $codesManquants = [];
        foreach ($piecesObligatoires as $piece) {
            if (!$piece->obligatoire) {
                continue;
            }
            if (!$this->pieceEstFournie($piece, $candidature, $projet, $lettre)) {
                $manquantes[] = $piece->libelle;
                $codesManquants[] = $piece->code_document;
            }
        }
        if (!empty($manquantes)) {
            return back()
                ->withErrors(['documents' => __('candidature.pieces_manquantes') . ' ' . implode(', ', $manquantes)])
                ->with('codes_pieces_manquantes', $codesManquants)
                ->withInput();
        }

        $candidature->statut = 'soumis';
        $candidature->date_soumission = now();
        $candidature->save();

        Session::forget('candidature_id');

        return view('pages_sites.candidature.confirmation', compact('candidature'));
    }

    /**
     * Sauvegarde en AJAX uniquement les champs de l'etape 1 (identite).
     * Independante des etapes 2 et 3 : ne touche a rien d'autre.
     */
    public function sauvegarderEtape1(Request $request)
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return response()->json(['success' => false], 401);
        }
        if ($candidature->statut !== 'brouillon') {
            return response()->json(['success' => false], 403);
        }

        $request->validate($this->reglesIdentite($candidature));

        $candidature->fill($request->only([
            'nom', 'prenom', 'sexe', 'date_naissance', 'lieu_naissance', 'nni', 'telephone', 'whatsapp', 'email', 'adresse',
        ]));
        $candidature->save();

        return response()->json(['success' => true]);
    }

    /**
     * Sauvegarde en AJAX uniquement les champs de l'etape 2 (parcours).
     * Independante des etapes 1 et 3 : ne touche a rien d'autre.
     */
    public function sauvegarderEtape2(Request $request)
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return response()->json(['success' => false], 401);
        }
        if ($candidature->statut !== 'brouillon') {
            return response()->json(['success' => false], 403);
        }

        $this->retirerFichiersVides($request);

        $request->validate($this->reglesEtape2($candidature), [], [
            'diplomes.*.fichier_diplome' => __('candidature.fichier_diplome'),
            'diplomes.*.fichier_releve' => __('candidature.fichier_releve'),
            'langues.*.fichier_certificat' => __('candidature.certificat_optionnel'),
        ]);

        $this->enregistrerEtape2($request, $candidature);

        // au moins 2 langues (avec langue + niveau) sont obligatoires
        if ($candidature->langues()->count() < 2) {
            return response()->json([
                'success' => false,
                'message' => __('candidature.minimum_deux_langues'),
            ], 422);
        }

        // diplome/releve : si obligatoires pour ce master, on indique precisement
        // quel(s) champ(s) manquent plutot qu'un message generique
        $pieceDiplome = $candidature->master->piecesObligatoires->firstWhere('code_document', 'diplome');
        $pieceReleve = $candidature->master->piecesObligatoires->firstWhere('code_document', 'releve_notes');
        if (optional($pieceDiplome)->obligatoire || optional($pieceReleve)->obligatoire) {
            $champsManquants = $this->champsDiplomeManquants($candidature);
            if (!empty($champsManquants)) {
                return response()->json([
                    'success' => false,
                    'message' => __('candidature.diplome_incomplet') . ' ' . implode(', ', $champsManquants),
                ], 422);
            }
        }

        // certificat de langue (facultatif par defaut, mais reste verifiable si un jour obligatoire)
        $pieceCertificatLangue = $candidature->master->piecesObligatoires->firstWhere('code_document', 'certificat_langue');
        if (optional($pieceCertificatLangue)->obligatoire && !$this->pieceEstFournie($pieceCertificatLangue, $candidature)) {
            return response()->json([
                'success' => false,
                'message' => __('candidature.pieces_manquantes') . ' ' . $pieceCertificatLangue->libelle,
            ], 422);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Verifie le premier diplome renseigne champ par champ, et renvoie la liste
     * des libelles des champs manquants (vide si tout est complet).
     */
    private function champsDiplomeManquants(CandidatureMaster $candidature): array
    {
        $diplome = $candidature->diplomes()->first();
        if (!$diplome) {
            return [
                __('candidature.type_diplome'),
                __('candidature.intitule_requis'),
                __('candidature.etablissement'),
                __('candidature.fichier_diplome'),
                __('candidature.fichier_releve'),
            ];
        }

        $manquants = [];
        if (empty($diplome->type_diplome)) {
            $manquants[] = __('candidature.type_diplome');
        }
        if (empty($diplome->intitule)) {
            $manquants[] = __('candidature.intitule_requis');
        }
        if (empty($diplome->etablissement)) {
            $manquants[] = __('candidature.etablissement');
        }
        if (empty($diplome->fichier_diplome)) {
            $manquants[] = __('candidature.fichier_diplome');
        }
        if (empty($diplome->fichier_releve)) {
            $manquants[] = __('candidature.fichier_releve');
        }
        return $manquants;
    }

    private function pieceEstFournie(PieceObligatoireMaster $piece, CandidatureMaster $candidature, ?ProjetRecherche $projet = null, ?LettreMotivation $lettre = null): bool
    {
        // pour un diplome, il ne suffit pas d'avoir le fichier : l'intitule et le type
        // doivent aussi etre renseignes pour que la ligne soit consideree complete
        $diplomeComplet = fn (string $colonneFichier) => $candidature->diplomes()
            ->whereNotNull($colonneFichier)->where($colonneFichier, '!=', '')
            ->where('intitule', '!=', '')->where('type_diplome', '!=', '')
            ->exists();

        return match ($piece->code_document) {
            'projet_recherche' => !empty(optional($projet)->fichier_projet),
            'lettre_motivation' => !empty(optional($lettre)->fichier),
            'diplome' => $diplomeComplet('fichier_diplome'),
            'releve_notes' => $diplomeComplet('fichier_releve'),
            'certificat_langue' => $candidature->langues()->whereNotNull('fichier_certificat')->where('fichier_certificat', '!=', '')->exists(),
            default => $candidature->documents()->where('type_document', $piece->code_document)->exists(),
        };
    }

    /**
     * Noms lisibles des champs "documents.*" pour des messages de validation
     * comprehensibles (ex: "Extrait d'acte de naissance" plutot que "documents.acte_naissance").
     */
    private function attributsPiecesEtape3(CandidatureMaster $candidature): array
    {
        $attributs = [
            'projet_fichier' => __('candidature.fichier_projet'),
            'lettre_fichier' => __('candidature.lettre_signee'),
        ];
        foreach ($candidature->master->piecesObligatoires as $piece) {
            $attributs["documents.{$piece->code_document}"] = $piece->libelle;
        }
        return $attributs;
    }

    /**
     * Sauvegarde en AJAX uniquement les champs de l'etape 3 (projet, lettre,
     * documents) sans exiger que tout soit complet ni changer le statut.
     * Utilisee pour ne rien perdre en quittant l'etape 3 (Precedent/badges) ;
     * la verification stricte des pieces obligatoires ne se fait qu'a la
     * soumission finale (storeSuite).
     */
    public function sauvegarderEtape3(Request $request)
    {
        $candidature = $this->candidatureDeSession();
        if (!$candidature) {
            return response()->json(['success' => false], 401);
        }
        if ($candidature->statut !== 'brouillon') {
            return response()->json(['success' => false], 403);
        }

        $this->retirerFichiersVides($request);

        $request->validate($this->reglesEtape3(false), [], $this->attributsPiecesEtape3($candidature));

        $this->enregistrerEtape3($request, $candidature);

        return response()->json(['success' => true]);
    }

    private function reglesIdentite(CandidatureMaster $candidature): array
    {
        return [
            'nom' => 'nullable|string|max:100',
            'prenom' => 'nullable|string|max:100',
            'sexe' => 'nullable|string|max:20',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string|max:255',
            'nni' => ['nullable', 'string', 'max:50', Rule::unique('candidatures_master', 'nni')->ignore($candidature->id)],
            'telephone' => ['nullable', 'string', 'max:30', Rule::unique('candidatures_master', 'telephone')->ignore($candidature->id)],
            'whatsapp' => 'nullable|string|max:30',
            'email' => ['nullable', 'email', 'max:150', Rule::unique('candidatures_master', 'email')->ignore($candidature->id)],
            'adresse' => 'nullable|string',
        ];
    }

    private function reglesEtape2(CandidatureMaster $candidature): array
    {
        return [
            'situation_professionnelle' => 'nullable|string|max:100',
            'profession' => 'nullable|string|max:150',
            'organisme_employeur' => 'nullable|string|max:255',
            'experience_professionnelle' => 'nullable|string',
            'experience_recherche' => 'nullable|string',

            'diplomes' => 'nullable|array',
            'diplomes.*.id' => ['nullable', Rule::exists('candidature_diplomes', 'id')->where('candidature_id', $candidature->id)],
            'diplomes.*.type_diplome' => 'nullable|string|max:100',
            'diplomes.*.intitule' => 'nullable|string|max:255',
            'diplomes.*.domaine' => 'nullable|string|max:255',
            'diplomes.*.specialite' => 'nullable|string|max:255',
            'diplomes.*.etablissement' => 'nullable|string|max:255',
            'diplomes.*.pays' => 'nullable|string|max:100',
            'diplomes.*.annee_obtention' => 'nullable|integer|min:1950|max:2100',
            'diplomes.*.mention' => 'nullable|string|max:100',
            'diplomes.*.fichier_diplome' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'diplomes.*.fichier_releve' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'diplomes_supprimes' => 'nullable|array',
            'diplomes_supprimes.*' => ['integer', Rule::exists('candidature_diplomes', 'id')->where('candidature_id', $candidature->id)],

            'langues' => 'nullable|array',
            'langues.*.id' => ['nullable', Rule::exists('candidature_langues', 'id')->where('candidature_id', $candidature->id)],
            'langues.*.langue_id' => 'nullable|exists:langues,id',
            'langues.*.niveau' => 'nullable|string|max:10',
            'langues.*.type' => 'nullable|string|max:30',
            'langues.*.fichier_certificat' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'langues_supprimes' => 'nullable|array',
            'langues_supprimes.*' => ['integer', Rule::exists('candidature_langues', 'id')->where('candidature_id', $candidature->id)],

            'experiences' => 'nullable|array',
            'experiences.*.id' => ['nullable', Rule::exists('experiences_professionnelles', 'id')->where('candidature_id', $candidature->id)],
            'experiences.*.employeur' => 'nullable|string|max:255',
            'experiences.*.poste' => 'nullable|string|max:255',
            'experiences.*.date_debut' => 'nullable|date',
            'experiences.*.date_fin' => 'nullable|date',
            'experiences.*.description' => 'nullable|string',
            'experiences_supprimes' => 'nullable|array',
            'experiences_supprimes.*' => ['integer', Rule::exists('experiences_professionnelles', 'id')->where('candidature_id', $candidature->id)],

            'formations' => 'nullable|array',
            'formations.*.id' => ['nullable', Rule::exists('formations_candidat', 'id')->where('candidature_id', $candidature->id)],
            'formations.*.intitule' => 'nullable|string|max:255',
            'formations.*.organisme' => 'nullable|string|max:255',
            'formations.*.date_debut' => 'nullable|date',
            'formations.*.date_fin' => 'nullable|date',
            'formations_supprimes' => 'nullable|array',
            'formations_supprimes.*' => ['integer', Rule::exists('formations_candidat', 'id')->where('candidature_id', $candidature->id)],
        ];
    }

    private function reglesEtape3(bool $projetRequis): array
    {
        return [
            'projet_titre' => $projetRequis ? 'required|string|max:500' : 'nullable|string|max:500',
            'projet_discipline' => 'nullable|string|max:255',
            'projet_resume' => 'nullable|string',
            'projet_fichier' => 'nullable|file|mimes:pdf|max:102400',

            'lettre_contenu' => 'nullable|string',
            'lettre_fichier' => 'nullable|file|mimes:pdf|max:102400',

            'documents' => 'nullable|array',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:102400',
        ];
    }

    /**
     * Enregistre uniquement les champs de l'etape 2 (situation pro, diplomes,
     * langues, experiences, formations). Independant des etapes 1 et 3.
     */
    private function enregistrerEtape2(Request $request, CandidatureMaster $candidature): void
    {
        $baseDir = "candidatures/{$candidature->id}";
        Storage::disk('local')->makeDirectory($baseDir);

        $candidature->fill($request->only([
            'situation_professionnelle', 'profession', 'organisme_employeur', 'experience_professionnelle', 'experience_recherche',
        ]));
        $candidature->save();

        // diplomes : on repart de zero a chaque enregistrement (le candidat peut revenir plusieurs fois),
        // mais on garde le fichier deja envoye si aucun nouveau n'est fourni cette fois-ci
        // (sinon un simple "Suivant" sans reselectionner de fichier effacerait le fichier deja envoye)
        //
        // NOTE IMPORTANTE : chaque ligne (diplome, langue, experience, formation) est identifiee
        // par son id (champ cache dans le formulaire). On ne supprime QUE les lignes explicitement
        // marquees comme retirees (via *_supprimes[]), et on met a jour les lignes existantes au
        // lieu de tout supprimer/recreer a chaque enregistrement. Cela evite que des informations
        // deja saisies disparaissent si une sauvegarde ne renvoie pas exactement le meme instantane
        // (ex: chevauchement de requetes, ligne pas encore rechargee cote client, etc.)

        // diplomes
        $candidature->diplomes()->whereIn('id', $request->input('diplomes_supprimes', []))->delete();
        foreach ($request->input('diplomes', []) as $index => $diplome) {
            $idExistant = $diplome['id'] ?? null;
            $ligneExistante = $idExistant ? $candidature->diplomes()->find($idExistant) : null;
            $aUnFichierMaintenant = $request->hasFile("diplomes.$index.fichier_diplome") || $request->hasFile("diplomes.$index.fichier_releve");
            // on ignore seulement une ligne vraiment vide (ni intitule, ni type, ni fichier, ni ligne existante) ;
            // sinon un fichier deja choisi serait perdu si l'intitule est reste vide
            if (empty($diplome['intitule']) && empty($diplome['type_diplome']) && !$aUnFichierMaintenant && !$ligneExistante) {
                continue;
            }
            $donnees = [
                'candidature_id' => $candidature->id,
                'type_diplome' => $diplome['type_diplome'] ?? '',
                'intitule' => $diplome['intitule'] ?? '',
                'domaine' => $diplome['domaine'] ?? null,
                'specialite' => $diplome['specialite'] ?? null,
                'etablissement' => $diplome['etablissement'] ?? null,
                'pays' => $diplome['pays'] ?? null,
                'annee_obtention' => $diplome['annee_obtention'] ?? null,
                'mention' => $diplome['mention'] ?? null,
            ];
            if ($ligneExistante) {
                $ligneExistante->update($donnees);
                $ligne = $ligneExistante;
            } else {
                $ligne = CandidatureDiplome::create($donnees);
            }
            $this->enregistrerFichier($request, "diplomes.$index.fichier_diplome", "$baseDir/diplomes", $ligne, 'fichier_diplome');
            $this->enregistrerFichier($request, "diplomes.$index.fichier_releve", "$baseDir/diplomes", $ligne, 'fichier_releve');
        }

        // langues
        $candidature->langues()->whereIn('id', $request->input('langues_supprimes', []))->delete();
        foreach ($request->input('langues', []) as $index => $langue) {
            if (empty($langue['langue_id']) || empty($langue['niveau'])) {
                continue;
            }
            $idExistant = $langue['id'] ?? null;
            $ligneExistante = $idExistant ? $candidature->langues()->find($idExistant) : null;
            $donnees = [
                'candidature_id' => $candidature->id,
                'langue_id' => $langue['langue_id'],
                'niveau' => $langue['niveau'],
                'type' => $langue['type'] ?? 'langue_travail',
            ];
            if ($ligneExistante) {
                $ligneExistante->update($donnees);
                $ligne = $ligneExistante;
            } else {
                $ligne = CandidatureLangue::create($donnees);
            }
            $this->enregistrerFichier($request, "langues.$index.fichier_certificat", "$baseDir/langues", $ligne, 'fichier_certificat');
        }

        // experiences professionnelles structurees
        $candidature->experiencesProfessionnelles()->whereIn('id', $request->input('experiences_supprimes', []))->delete();
        foreach ($request->input('experiences', []) as $experience) {
            if (empty($experience['employeur'])) {
                continue;
            }
            $idExistant = $experience['id'] ?? null;
            $donnees = [
                'candidature_id' => $candidature->id,
                'employeur' => $experience['employeur'],
                'poste' => $experience['poste'] ?? null,
                'date_debut' => $experience['date_debut'] ?? null,
                'date_fin' => $experience['date_fin'] ?? null,
                'description' => $experience['description'] ?? null,
            ];
            $ligneExistante = $idExistant ? $candidature->experiencesProfessionnelles()->find($idExistant) : null;
            if ($ligneExistante) {
                $ligneExistante->update($donnees);
            } else {
                ExperienceProfessionnelle::create($donnees);
            }
        }

        // formations complementaires
        $candidature->formations()->whereIn('id', $request->input('formations_supprimes', []))->delete();
        foreach ($request->input('formations', []) as $formation) {
            if (empty($formation['intitule'])) {
                continue;
            }
            $idExistant = $formation['id'] ?? null;
            $donnees = [
                'candidature_id' => $candidature->id,
                'intitule' => $formation['intitule'],
                'organisme' => $formation['organisme'] ?? null,
                'date_debut' => $formation['date_debut'] ?? null,
                'date_fin' => $formation['date_fin'] ?? null,
            ];
            $ligneExistante = $idExistant ? $candidature->formations()->find($idExistant) : null;
            if ($ligneExistante) {
                $ligneExistante->update($donnees);
            } else {
                FormationCandidat::create($donnees);
            }
        }
    }

    /**
     * Enregistre uniquement les champs de l'etape 3 (projet de recherche,
     * lettre de motivation, documents). Independant des etapes 1 et 2 :
     * suppose que le parcours (diplomes/langues) est deja enregistre via
     * l'etape 2 pour la verification finale des pieces obligatoires.
     *
     * @return array{0: \Illuminate\Support\Collection, 1: ProjetRecherche, 2: LettreMotivation}
     */
    private function enregistrerEtape3(Request $request, CandidatureMaster $candidature): array
    {
        $baseDir = "candidatures/{$candidature->id}";
        Storage::disk('local')->makeDirectory($baseDir);

        // projet de recherche (on garde le fichier deja envoye si aucun nouveau n'est fourni)
        $ancienProjet = $candidature->projetsRecherche()->first();
        $candidature->projetsRecherche()->delete();
        $projet = ProjetRecherche::create([
            'candidature_id' => $candidature->id,
            'titre' => $request->input('projet_titre') ?? '',
            'discipline' => $request->input('projet_discipline'),
            'resume' => $request->input('projet_resume'),
            'fichier_projet' => optional($ancienProjet)->fichier_projet ?? '',
            'date_depot' => now(),
        ]);
        $this->enregistrerFichier($request, 'projet_fichier', "$baseDir/projet", $projet, 'fichier_projet');

        // lettre de motivation
        $lettre = LettreMotivation::updateOrCreate(
            ['candidature_id' => $candidature->id],
            ['contenu' => $request->input('lettre_contenu'), 'date_depot' => now()]
        );
        $this->enregistrerFichier($request, 'lettre_fichier', "$baseDir/lettre", $lettre, 'fichier');

        // pieces obligatoires / optionnelles du master
        // (le projet de recherche, la lettre de motivation, le diplome, le releve
        // et le certificat de langue ont deja leur propre champ dedie ailleurs :
        // on ne les redemande pas ici)
        $piecesObligatoires = $candidature->master->piecesObligatoires;
        $codesDejaGeresAilleurs = ['projet_recherche', 'lettre_motivation', 'diplome', 'releve_notes', 'certificat_langue'];
        foreach ($piecesObligatoires as $piece) {
            if (in_array($piece->code_document, $codesDejaGeresAilleurs)) {
                continue;
            }
            if ($request->hasFile("documents.{$piece->code_document}")) {
                $file = $request->file("documents.{$piece->code_document}");
                $this->enregistrerDocument($file, $candidature, $piece->code_document, "$baseDir/documents");

                // la copie de la carte d'identite sert aussi de photo de profil
                // (pas de champ "photo" separe : on evite de demander deux fois la meme chose)
                if ($piece->code_document === 'carte_identite' && in_array(strtolower($file->getClientOriginalExtension()), ['jpg', 'jpeg', 'png'])) {
                    $this->enregistrerDocument($file, $candidature, 'photo', "$baseDir/documents");
                }
            }
        }

        return [$piecesObligatoires, $projet, $lettre];
    }

    /**
     * Retire du formulaire les champs "fichier" qui sont en realite vides
     * (input file laisse tel quel, sans nouveau fichier choisi). Sans ca,
     * Laravel les traite comme des fichiers invalides et bloque la validation
     * meme s'ils sont "nullable", puisqu'un input file vide n'est pas null.
     */
    private function retirerFichiersVides(Request $request): void
    {
        $request->files->replace($this->nettoyerFichiers($request->files->all()));
    }

    private function nettoyerFichiers(array $fichiers): array
    {
        $resultat = [];
        foreach ($fichiers as $cle => $valeur) {
            if (is_array($valeur)) {
                $sousTableau = $this->nettoyerFichiers($valeur);
                if (!empty($sousTableau)) {
                    $resultat[$cle] = $sousTableau;
                }
            } elseif ($valeur instanceof \Illuminate\Http\UploadedFile) {
                // on ne retire que les champs vraiment vides (aucun fichier choisi).
                // un fichier choisi mais rejete (trop volumineux, transfert incomplet...)
                // doit rester pour que Laravel affiche une vraie erreur, au lieu de
                // disparaitre silencieusement et faire croire qu'aucun fichier n'a ete envoye
                if ($valeur->getError() !== UPLOAD_ERR_NO_FILE) {
                    $resultat[$cle] = $valeur;
                }
            }
        }
        return $resultat;
    }

    private function estMobile(Request $request): bool
    {
        return (bool) preg_match(
            '/Mobi|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Windows Phone/i',
            $request->userAgent() ?? ''
        );
    }

    private function candidatureDeSession(): ?CandidatureMaster
    {
        $id = Session::get('candidature_id');
        if (!$id) {
            return null;
        }
        return CandidatureMaster::with('master')->find($id);
    }

    private function enregistrerFichier(Request $request, string $champ, string $dossier, $modele, string $colonne): ?string
    {
        if (!$request->hasFile($champ)) {
            return null;
        }
        $file = $request->file($champ);
        Storage::disk('local')->makeDirectory($dossier);
        $nomFichier = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($dossier, $nomFichier, 'local');
        $modele->update([$colonne => "$dossier/$nomFichier"]);
        return "$dossier/$nomFichier";
    }

    private function enregistrerDocument($file, CandidatureMaster $candidature, string $typeDocument, string $dossier): void
    {
        Storage::disk('local')->makeDirectory($dossier);
        $nomFichier = $typeDocument . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($dossier, $nomFichier, 'local');

        DocumentCandidature::updateOrCreate(
            ['candidature_id' => $candidature->id, 'type_document' => $typeDocument],
            [
                'nom_fichier' => $file->getClientOriginalName(),
                'chemin_fichier' => "$dossier/$nomFichier",
                'extension' => $file->getClientOriginalExtension(),
                'taille' => $file->getSize(),
                'uploaded_at' => now(),
            ]
        );
    }

    public function image($id)
    {
        $document = DocumentCandidature::where('candidature_id', $id)->where('type_document', 'photo')->first();
        if (!$document || !Storage::disk('local')->exists($document->chemin_fichier)) {
            abort(404, 'Photo introuvable');
        }
        return response(Storage::disk('local')->get($document->chemin_fichier), 200)
            ->header('Content-Type', Storage::disk('local')->mimeType($document->chemin_fichier));
    }
}
