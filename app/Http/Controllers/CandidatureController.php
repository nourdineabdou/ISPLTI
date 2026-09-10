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
use App\Models\ProjetRecherche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            return redirect()->route('candidature.intro')->with('error', __('candidature.session_expiree'));
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
            return redirect()->route('candidature.intro')->with('error', __('candidature.session_expiree'));
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
            return redirect()->route('candidature.intro')->with('error', __('candidature.session_expiree'));
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
            return redirect()->route('candidature.intro')->with('error', __('candidature.session_expiree'));
        }
        if ($candidature->statut !== 'brouillon') {
            return redirect()->route('candidature.espace')->with('error', __('candidature.deja_soumise_note'));
        }

        $piecesObligatoires = $candidature->master->piecesObligatoires;

        $request->validate([
            'situation_professionnelle' => 'nullable|string|max:100',
            'profession' => 'nullable|string|max:150',
            'organisme_employeur' => 'nullable|string|max:255',
            'experience_professionnelle' => 'nullable|string',
            'experience_recherche' => 'nullable|string',

            'diplomes' => 'nullable|array',
            'diplomes.*.type_diplome' => 'nullable|string|max:100',
            'diplomes.*.intitule' => 'nullable|string|max:255',
            'diplomes.*.domaine' => 'nullable|string|max:255',
            'diplomes.*.specialite' => 'nullable|string|max:255',
            'diplomes.*.etablissement' => 'nullable|string|max:255',
            'diplomes.*.pays' => 'nullable|string|max:100',
            'diplomes.*.annee_obtention' => 'nullable|integer|min:1950|max:2100',
            'diplomes.*.mention' => 'nullable|string|max:100',
            'diplomes.*.fichier_diplome' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'diplomes.*.fichier_releve' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

            'langues' => 'nullable|array',
            'langues.*.langue_id' => 'nullable|exists:langues,id',
            'langues.*.niveau' => 'nullable|string|max:10',
            'langues.*.type' => 'nullable|string|max:30',
            'langues.*.fichier_certificat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',

            'experiences' => 'nullable|array',
            'experiences.*.employeur' => 'nullable|string|max:255',
            'experiences.*.poste' => 'nullable|string|max:255',
            'experiences.*.date_debut' => 'nullable|date',
            'experiences.*.date_fin' => 'nullable|date',
            'experiences.*.description' => 'nullable|string',

            'formations' => 'nullable|array',
            'formations.*.intitule' => 'nullable|string|max:255',
            'formations.*.organisme' => 'nullable|string|max:255',
            'formations.*.date_debut' => 'nullable|date',
            'formations.*.date_fin' => 'nullable|date',

            'projet_titre' => 'required|string|max:500',
            'projet_discipline' => 'nullable|string|max:255',
            'projet_resume' => 'nullable|string',
            'projet_fichier' => 'nullable|file|mimes:pdf|max:10240',

            'lettre_contenu' => 'nullable|string',
            'lettre_fichier' => 'nullable|file|mimes:pdf|max:5120',

            'documents' => 'nullable|array',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $baseDir = "candidatures/{$candidature->id}";
        Storage::disk('local')->makeDirectory($baseDir);

        // informations professionnelles
        $candidature->fill($request->only(['situation_professionnelle', 'profession', 'organisme_employeur', 'experience_professionnelle', 'experience_recherche']));
        $candidature->save();

        // diplomes : on repart de zero a chaque enregistrement (le candidat peut revenir plusieurs fois via le lien)
        $candidature->diplomes()->delete();
        foreach ($request->input('diplomes', []) as $index => $diplome) {
            if (empty($diplome['intitule'])) {
                continue;
            }
            $ligne = CandidatureDiplome::create([
                'candidature_id' => $candidature->id,
                'type_diplome' => $diplome['type_diplome'] ?? '',
                'intitule' => $diplome['intitule'],
                'domaine' => $diplome['domaine'] ?? null,
                'specialite' => $diplome['specialite'] ?? null,
                'etablissement' => $diplome['etablissement'] ?? null,
                'pays' => $diplome['pays'] ?? null,
                'annee_obtention' => $diplome['annee_obtention'] ?? null,
                'mention' => $diplome['mention'] ?? null,
            ]);
            $this->enregistrerFichier($request, "diplomes.$index.fichier_diplome", "$baseDir/diplomes", $ligne, 'fichier_diplome');
            $this->enregistrerFichier($request, "diplomes.$index.fichier_releve", "$baseDir/diplomes", $ligne, 'fichier_releve');
        }

        // langues
        $candidature->langues()->delete();
        foreach ($request->input('langues', []) as $index => $langue) {
            if (empty($langue['langue_id']) || empty($langue['niveau'])) {
                continue;
            }
            $ligne = CandidatureLangue::create([
                'candidature_id' => $candidature->id,
                'langue_id' => $langue['langue_id'],
                'niveau' => $langue['niveau'],
                'type' => $langue['type'] ?? 'langue_travail',
            ]);
            $this->enregistrerFichier($request, "langues.$index.fichier_certificat", "$baseDir/langues", $ligne, 'fichier_certificat');
        }

        // experiences professionnelles structurees
        $candidature->experiencesProfessionnelles()->delete();
        foreach ($request->input('experiences', []) as $experience) {
            if (empty($experience['employeur'])) {
                continue;
            }
            ExperienceProfessionnelle::create([
                'candidature_id' => $candidature->id,
                'employeur' => $experience['employeur'],
                'poste' => $experience['poste'] ?? null,
                'date_debut' => $experience['date_debut'] ?? null,
                'date_fin' => $experience['date_fin'] ?? null,
                'description' => $experience['description'] ?? null,
            ]);
        }

        // formations complementaires
        $candidature->formations()->delete();
        foreach ($request->input('formations', []) as $formation) {
            if (empty($formation['intitule'])) {
                continue;
            }
            FormationCandidat::create([
                'candidature_id' => $candidature->id,
                'intitule' => $formation['intitule'],
                'organisme' => $formation['organisme'] ?? null,
                'date_debut' => $formation['date_debut'] ?? null,
                'date_fin' => $formation['date_fin'] ?? null,
            ]);
        }

        // projet de recherche
        $candidature->projetsRecherche()->delete();
        $projet = ProjetRecherche::create([
            'candidature_id' => $candidature->id,
            'titre' => $request->input('projet_titre'),
            'discipline' => $request->input('projet_discipline'),
            'resume' => $request->input('projet_resume'),
            'fichier_projet' => '',
            'date_depot' => now(),
        ]);
        $chemin = $this->enregistrerFichier($request, 'projet_fichier', "$baseDir/projet", $projet, 'fichier_projet');
        if (!$chemin && !$projet->fichier_projet) {
            $projet->update(['fichier_projet' => '']);
        }

        // lettre de motivation
        $lettre = LettreMotivation::updateOrCreate(
            ['candidature_id' => $candidature->id],
            ['contenu' => $request->input('lettre_contenu'), 'date_depot' => now()]
        );
        $this->enregistrerFichier($request, 'lettre_fichier', "$baseDir/lettre", $lettre, 'fichier');

        // pieces obligatoires / optionnelles du master
        // (le projet de recherche, la lettre de motivation, le diplome, le releve
        // et le certificat de langue ont deja leur propre champ dedie plus haut :
        // on ne les redemande pas ici)
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

        // verification des pieces obligatoires avant soumission finale
        $manquantes = [];
        foreach ($piecesObligatoires as $piece) {
            if (!$piece->obligatoire) {
                continue;
            }
            if ($piece->code_document === 'projet_recherche') {
                $existe = !empty($projet->fichier_projet);
            } elseif ($piece->code_document === 'lettre_motivation') {
                $existe = !empty($lettre->fichier);
            } elseif ($piece->code_document === 'diplome') {
                $existe = $candidature->diplomes()->whereNotNull('fichier_diplome')->where('fichier_diplome', '!=', '')->exists();
            } elseif ($piece->code_document === 'releve_notes') {
                $existe = $candidature->diplomes()->whereNotNull('fichier_releve')->where('fichier_releve', '!=', '')->exists();
            } elseif ($piece->code_document === 'certificat_langue') {
                $existe = $candidature->langues()->whereNotNull('fichier_certificat')->where('fichier_certificat', '!=', '')->exists();
            } else {
                $existe = $candidature->documents()->where('type_document', $piece->code_document)->exists();
            }
            if (!$existe) {
                $manquantes[] = $piece->libelle;
            }
        }
        if (!empty($manquantes)) {
            return back()->withErrors(['documents' => __('candidature.pieces_manquantes') . ' ' . implode(', ', $manquantes)])->withInput();
        }

        $candidature->statut = 'soumis';
        $candidature->date_soumission = now();
        $candidature->save();

        Session::forget('candidature_id');

        return view('pages_sites.candidature.confirmation', compact('candidature'));
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
