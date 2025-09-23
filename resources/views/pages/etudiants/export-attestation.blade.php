{{-- resources/views/attestations/print.blade.php --}}
@php
    $now = \Carbon\Carbon::now()->locale('fr')->translatedFormat('d F Y');
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Attestation d’inscription — {{ $etudiant['nom'] }}</title>
<style>
    * { box-sizing: border-box; }
    html, body { margin: 0; padding: 0; }
    body { font-family: "DejaVu Sans", Arial, sans-serif; color: #111; font-size: 12pt; line-height: 1.35; }
    @page { size: A4; margin: 16mm; }
    .brand { display:flex; align-items:center; gap:12px; border-bottom:2px solid #f1f1f1; padding-bottom:8px; }
    .logo { width:70px; height:70px; object-fit:contain; }
    h1 { margin:0; font-size:18pt; }
    .meta { margin-top:4px; font-size:10pt; color:#555; }
    h2 { text-align:center; font-size:20pt; margin:16px 0 8px; text-transform:uppercase; letter-spacing:1px; }
    .subtitle { text-align:center; color:#666; margin-bottom:10px; }
    .bloc { border:1px solid #e9e9e9; border-radius:8px; background:#fafafa; padding:12px; margin-top:12px; }
    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:10px 18px; }
    .label{ color:#666; font-size:10pt; }
    .val{ font-weight:600; }
    table { width:100%; border-collapse:collapse; font-size:11pt; margin-top:6px; }
    th, td { border:1px solid #e5e5e5; padding:8px 10px; text-align:left; }
    th { background:#f5f5f5; }
    .parag{ margin-top:12px; text-align:justify; }
    .footer{ display:flex; justify-content:space-between; align-items:flex-end; margin-top:22mm; }
    .line{ height:60px; border-bottom:1px dashed #bbb; margin-bottom:6px; }
    .who{ font-size:10pt; color:#555; }
    .muted{ color:#777; font-size:10pt; margin-top:6px; }
    .stamp{
        position: fixed; right: 40mm; bottom: 40mm;
        width: 120px; height: 120px; border: 2px dashed #d2d2d2; border-radius: 50%;
        display:flex; align-items:center; justify-content:center; color:#c0c0c0; font-size:10pt; transform:rotate(-12deg);
    }
</style>
</head>
<body>
    <header class="brand">
        @if(!empty($institution['logo_base64']))
            <img class="logo" src="{{ $institution['logo_base64'] }}" alt="Logo">
        @endif
        <div>
            <h1>{{ $institution['nom'] }}</h1>
            <div class="meta">{{ $institution['adresse'] }} — Tél: {{ $institution['telephone'] }} — Email: {{ $institution['email'] }}</div>
        </div>
    </header>

    <h2>Attestation d’inscription</h2>
    <div class="subtitle">Année universitaire {{ $annee }}</div>

    <section class="bloc">
        <div class="grid-2">
            <div>
                <div class="label">Nom & Prénom</div>
                <div class="val">{{ $etudiant['nom'] }}</div>
            </div>
            <div>
                <div class="label">Matricule</div>
                <div class="val">{{ $etudiant['matricule'] }}</div>
            </div>
            <div>
                <div class="label">Date & lieu de naissance</div>
                <div class="val">
                    {{ \Carbon\Carbon::parse($etudiant['date_naissance'])->format('d/m/Y') }}
                    à {{ $etudiant['lieu_naissance'] }}
                </div>
            </div>
            <div>
                <div class="label">Filière / Niveau</div>
                <div class="val">{{ $etudiant['filiere'] }} — {{ $etudiant['niveau'] }}</div>
            </div>
        </div>

        <p class="parag">
            Nous soussignés, {{ $institution['nom'] }}, certifions que l’étudiant(e)
            <strong>{{ $etudiant['nom'] }}</strong> (matricule <strong>{{ $etudiant['matricule'] }}</strong>)
            est régulièrement inscrit(e) pour l’année universitaire <strong>{{ $annee }}</strong>, en
            <strong>{{ $etudiant['filiere'] }}</strong> (niveau <strong>{{ $etudiant['niveau'] }}</strong>).
            La présente attestation est délivrée pour servir et valoir ce que de droit.
        </p>
    </section>

    <section class="bloc">
        <div class="label" style="margin-bottom:6px;">Indicateurs académiques (à titre informatif)</div>
        <table>
            <tbody>
            <tr><th>ECTS acquis</th><td>{{ $stats['ects_acquis'] }}</td></tr>
            <tr><th>Moyenne générale</th><td>{{ $stats['moyenne_generale'] }}</td></tr>
            <tr><th>Rang</th><td>{{ $stats['rang'] }}</td></tr>
            <tr><th>Taux de présence</th><td>{{ $stats['taux_presence'] }}</td></tr>
            <tr><th>UE validées</th><td>{{ $stats['ue_validees'] }}</td></tr>
            </tbody>
        </table>
        <div class="muted">* Ces données sont indicatives et ne remplacent pas un relevé officiel.</div>
    </section>

    <section class="bloc">
        <div class="grid-2">
            <div>
                <div class="label">Fait à</div>
                <div class="val">Nouakchott</div>
            </div>
            <div>
                <div class="label">Le</div>
                <div class="val">{{ $now }}</div>
            </div>
        </div>
    </section>

    <div class="footer">
        <div style="width:52%;">
            <div class="line"></div>
            <div class="who">Le/La Directeur·trice / Service de la Scolarité</div>
        </div>
        <div style="width:46%; text-align:right;">
            {{-- QR éventuel ici --}}
        </div>
    </div>

    <div class="stamp">Cachet officiel</div>

    {{-- Auto-ouvrir la boîte d’impression (optionnel) --}}
    <script>
        // Ouvrir la boîte d’impression au chargement.
        // Commentez si vous préférez le faire manuellement.
        window.addEventListener('load', () => {
            window.print();
        });
    </script>
</body>
</html>
