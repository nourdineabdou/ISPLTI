<?php

namespace App\Http\Controllers;

use App\Mail\CandidatureAccepteeMail;
use App\Mail\CandidatureRefuseeMail;
use App\Models\CandidatureMaster;
use App\Models\DocumentCandidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class CandidatureAdminController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(CandidatureMaster::with('master')->select([
                    'id', 'master_id', 'numero_candidature', 'nom', 'prenom', 'email', 'statut', 'created_at',
                ]))
                ->addColumn('master', fn($c) => $c->master->code ?? '-')
                ->addColumn('action', function ($c) {
                    $actions = [
                        [
                            'label' => 'Voir le dossier',
                            'onclick' => "window.location.href='" . route('candidatures.show', $c->id) . "'",
                            'permission' => true,
                        ],
                    ];
                    return view('components.buttons.action', compact('actions'));
                })
                ->editColumn('statut', function ($c) {
                    $badges = [
                        'brouillon' => 'secondary',
                        'soumis' => 'info',
                        'en_cours' => 'warning',
                        'accepte' => 'success',
                        'refuse' => 'danger',
                    ];
                    $couleur = $badges[$c->statut] ?? 'secondary';
                    return '<span class="badge badge-' . $couleur . '">' . ucfirst($c->statut) . '</span>';
                })
                ->rawColumns(['action', 'statut'])
                ->make(true);
        }

        return view('pages.candidatures.index', [
            'title' => 'Candidatures',
        ]);
    }

    public function show($id)
    {
        $candidature = CandidatureMaster::with([
            'master',
            'diplomes',
            'langues.langue',
            'experiencesProfessionnelles',
            'formations',
            'projetsRecherche',
            'lettreMotivation',
            'documents',
        ])->findOrFail($id);

        $photo = $candidature->documents->firstWhere('type_document', 'photo');

        return view('pages.candidatures.show', compact('candidature', 'photo'));
    }

    public function document($id, $documentId)
    {
        $document = DocumentCandidature::where('candidature_id', $id)->findOrFail($documentId);
        if (!Storage::disk('local')->exists($document->chemin_fichier)) {
            abort(404, 'Fichier introuvable');
        }
        return response(Storage::disk('local')->get($document->chemin_fichier), 200)
            ->header('Content-Type', Storage::disk('local')->mimeType($document->chemin_fichier))
            ->header('Content-Disposition', 'inline; filename="' . $document->nom_fichier . '"');
    }

    public function fichier($id, Request $request)
    {
        $path = $request->query('path');
        if (!$path || !str_starts_with($path, "candidatures/{$id}/")) {
            abort(403);
        }
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Fichier introuvable');
        }
        return response(Storage::disk('local')->get($path), 200)
            ->header('Content-Type', Storage::disk('local')->mimeType($path));
    }

    public function telechargerZip($id)
    {
        $candidature = CandidatureMaster::findOrFail($id);
        $folderPath = storage_path("app/candidatures/{$id}");
        if (!file_exists($folderPath)) {
            return back()->with('error', 'Aucun document trouvé pour cette candidature.');
        }

        $nomBase = Str::slug($candidature->nom . '-' . $candidature->prenom) . '-' . $candidature->numero_candidature;
        $zipFileName = "{$nomBase}.zip";
        $zipFilePath = storage_path("app/candidatures/{$zipFileName}");

        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($folderPath));
            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            $zip->close();
        } else {
            return back()->with('error', 'Impossible de créer le fichier ZIP.');
        }

        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    }

    public function changerStatut($id, $statut)
    {
        $statutsValides = ['brouillon', 'soumis', 'en_cours'];
        if (!in_array($statut, $statutsValides)) {
            abort(400, 'Statut invalide');
        }
        $candidature = CandidatureMaster::findOrFail($id);
        $candidature->update(['statut' => $statut]);

        return back()->with('success', 'Statut mis à jour avec succès.');
    }

    public function decision(Request $request, $id)
    {
        $request->validate([
            'decision' => 'required|in:accepte,refuse',
            'commentaire_admin' => 'nullable|string|max:2000',
        ]);

        $candidature = CandidatureMaster::with('master')->findOrFail($id);
        $candidature->statut = $request->input('decision');
        $candidature->commentaire_admin = $request->input('commentaire_admin');
        $candidature->save();

        if ($request->input('decision') === 'accepte') {
            Mail::to($candidature->email)->send(new CandidatureAccepteeMail($candidature));
        } else {
            Mail::to($candidature->email)->send(new CandidatureRefuseeMail($candidature));
        }

        return back()->with('success', 'Décision enregistrée et email envoyé au candidat.');
    }
}
