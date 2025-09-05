<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Attestation d'inscription - Étudiant</title>
    <style>
        @page { margin:40mm 24mm 36mm 24mm; }
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; color:#0f172a; }
        .pdf-header { position: fixed; top: 0; left: 0; right: 0; height: 40mm; padding:8px 24mm; }
        .pdf-footer { position: fixed; bottom: 0; left: 0; right: 0; height: 36mm; padding:8px 24mm; font-size:11px; color:#475569; }
        .page { width:210mm; min-height:297mm; margin:0; padding:0; box-sizing:border-box; }
        .content { border:1px solid #e6e9ef; padding:18px; border-radius:8px; margin-top:8px; }
        .logo { width:96px; height:96px; object-fit:contain; }
        .title { text-align:center; }
        h1 { font-size:20px; margin:0; }
        h2 { font-size:16px; margin:6px 0 12px 0; }
        .center { text-align:center; }
        .muted { color:#6b7280; }
        .field { margin:6px 0; }
        .field strong { display:inline-block; width:160px; }
        .stamp { margin-top:24px; display:flex; justify-content:space-between; align-items:center; page-break-inside:avoid; }
        .seal { border-radius:6px; padding:10px 16px; border:2px solid #0f172a; font-weight:700; }
        .pagenum:before { content: counter(page); }
        .page-break { page-break-after: always; }
        .avoid-break { page-break-inside: avoid; }
    </style>
</head>
<body>
@php
    $logoUrl = null;
    if(isset($etudiant->etablissement_logo) && $etudiant->etablissement_logo) {
        if(request()->has('web')) {
            $logoUrl = asset('storage/' . $etudiant->etablissement_logo);
        } else {
            $logoUrl = public_path('storage/' . $etudiant->etablissement_logo);
        }
    }
@endphp

<div class="pdf-header">
    <div style="display:flex;align-items:center;justify-content:space-between;">
        <div>
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="logo" class="logo">
            @else
                <div style="width:96px;height:96px;background:#eef2ff;display:flex;align-items:center;justify-content:center;border-radius:8px;font-weight:700;color:#1e293b;">LOGO</div>
            @endif
        </div>

        <div class="title">
            <h1>INSTITUT SUPERIEUR</h1>
            <h2>Attestation d'inscription - Étudiant</h2>
            <div class="muted">Réf : {{ $etudiant->nodos ?? ($etudiant->id ?? '-') }}</div>
        </div>

        <div style="width:96px; text-align:right;">
            <small class="muted">Date: {{ date('d/m/Y') }}</small>
        </div>
    </div>
</div>

<div class="pdf-footer">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <div>Institut - Adresse complète - Téléphone</div>
        <div>www.example.edu</div>
        <div>Page <span class="pagenum"></span></div>
    </div>
</div>

<div class="page">
    <div class="content">
        <p class="center" style="font-size:14px; margin-bottom:12px;">Nous attestons que l'étudiant(e) suivant(e) est inscrit(e) au sein de notre établissement :</p>

        <div style="max-width:640px;margin:0 auto;">
            <p class="field"><strong>Nom (FR) :</strong> {{ $etudiant->nom_fr ?? '-' }}</p>
            <p class="field"><strong>Date de naissance :</strong> {{ $etudiant->date_naissance ? date('d/m/Y', strtotime($etudiant->date_naissance)) : '-' }}</p>
            <p class="field"><strong>Lieu de naissance :</strong> {{ $etudiant->lieu_naissance_fr ?? $etudiant->lieu_naissance ?? '-' }}</p>
            <p class="field"><strong>Genre :</strong> {{ $etudiant->genre ?? '-' }}</p>
            <p class="field"><strong>Nationalité :</strong> {{ $etudiant->nationalite ?? '-' }}</p>
            <p class="field"><strong>Téléphone :</strong> {{ $etudiant->telephone ?? '-' }}</p>
            <p class="field"><strong>Email :</strong> {{ $etudiant->email ?? '-' }}</p>
            <p class="field"><strong>Adresse :</strong> {{ $etudiant->adresse ?? '-' }}</p>
            <p class="field"><strong>NNI :</strong> {{ $etudiant->nni ?? '-' }}</p>
            <p class="field"><strong>Numéro BAC :</strong> {{ $etudiant->num_bac ?? '-' }}</p>
            <p class="field"><strong>Année d'entrée :</strong> {{ $etudiant->annee_entree_etabliss ?? '-' }}</p>
            <p class="field"><strong>Établissement (ID) :</strong> {{ $etudiant->id_etablissement ?? '-' }}</p>
            <p class="field"><strong>Numéro dérogation :</strong> {{ $etudiant->num_derogation ?? '-' }}</p>
            <p class="field"><strong>Date dérogation :</strong> {{ $etudiant->date_derogation ? date('d/m/Y', strtotime($etudiant->date_derogation)) : '-' }}</p>
        </div>

        <p style="margin-top:14px;">La présente attestation est délivrée pour servir et valoir ce que de droit.</p>

        <div class="stamp">
            <div class="muted">
                <div><strong>N° dossier :</strong> {{ $etudiant->nodos ?? ($etudiant->id ?? '-') }}</div>
                <div><strong>État bourse :</strong> {{ isset($etudiant->etat_bourse) ? ($etudiant->etat_bourse ? 'Oui' : 'Non') : '-' }}</div>
            </div>

            <div style="text-align:right">
                <div class="seal">Cachet officiel</div>
                <div style="font-size:12px;margin-top:6px;">Signature du responsable</div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div style="display:flex;justify-content:space-between;">
            <div>Institut - Adresse complète - Téléphone</div>
            <div>www.example.edu</div>
        </div>
    </div>
</div>
</body>
</html>

@if(request()->has('print'))
    <script>
        window.addEventListener('load', function(){ setTimeout(function(){ window.print(); }, 200); });
    </script>
@endif
