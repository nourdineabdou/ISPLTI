@php
    $photoUrl = route('etudiants.image', $etudiant->id);
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Convocation — {{ $etudiant->nom_fr ?? $etudiant->nom }}</title>
<style>
    * { box-sizing: border-box; }
    html, body { margin: 0; padding: 0; }
    body { font-family: "DejaVu Sans", Arial, sans-serif; color: #111; font-size: 9pt; line-height: 1.25; }
    @page { size: A4; margin: 12mm; }
    .brand { display:flex; align-items:flex-start; justify-content:space-between; border-bottom:2px solid #1a365d; padding-bottom:10px; margin-bottom:10px; }
    .logo { width:100px; height:100px; object-fit:contain; align-self:center; }
    .header-fr { flex:1; text-align:left; font-size:7pt; line-height:1.4; }
    .header-ar { flex:1; text-align:right; direction:rtl; font-family:"Arial Unicode MS", "Tahoma", sans-serif; font-size:7pt; line-height:1.4; }
    .republic { font-weight:700; color:#1a365d; margin-bottom:3px; }
    .motto { font-style:italic; color:#666; margin-bottom:6px; }
    .ministry { font-weight:600; color:#2d3748; margin-bottom:3px; }
    .institute { font-weight:700; color:#1a365d; margin-bottom:3px; }
    .service { color:#555; }
    h2 { text-align:center; font-size:14pt; margin:10px 0 6px; text-transform:uppercase; letter-spacing:1px; }
    .subtitle { text-align:center; color:#666; margin-bottom:6px; }
    .bloc { border:1px solid #e9e9e9; border-radius:4px; background:#fafafa; padding:6px; margin-top:4px; }
    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:4px 8px; }
    .grid-with-photo { display:grid; grid-template-columns:1fr 120px; gap:8px; align-items:start; }
    .student-photo { width:120px; height:150px; object-fit:cover; border:2px solid #e5e5e5; border-radius:8px; background:#f8f8f8; }
    .label{ color:#666; font-size:7pt; }
    .val{ font-weight:600; }
    table { width:100%; border-collapse:collapse; font-size:7pt; margin-top:4px; }
    th, td { border:1px solid #e5e5e5; padding:2px 4px; text-align:left; line-height:1.1; }
    th { background:#f5f5f5; font-weight:600; }
    .parag{ margin-top:6px; text-align:justify; }
    .footer{ display:flex; justify-content:space-between; align-items:flex-end; margin-top:10mm; }
    .line{ height:50px; border-bottom:1px dashed #bbb; margin-bottom:4px; }
    .who{ font-size:7pt; color:#555; }
    .muted{ color:#777; font-size:7pt; margin-top:4px; }
    .stamp{
        position: fixed; right: 40mm; bottom: 40mm;
        width: 120px; height: 120px; border: 2px dashed #d2d2d2; border-radius: 50%;
        display:flex; align-items:center; justify-content:center; color:#c0c0c0; font-size:8pt; transform:rotate(-12deg);
    }
</style>
</head>
<body>
    <header class="brand">
        {{-- En-tête en français (à gauche) --}}
        <div class="header-fr">
            <div class="republic">République Islamique de Mauritanie</div>
            <div class="motto">Honneur – Fraternité – Justice</div>
            <div class="ministry">Ministère de l'Enseignement Supérieur et de la Recherche Scientifique</div>
            <div class="institute">INSTITUT SUPÉRIEUR PROFESSIONNEL DE LANGUES, DE TRADUCTION & D'INTERPRÉTARIAT</div>
        </div>
        {{-- Logo au centre --}}
        @if(asset('logo-centre.png'))
            <img class="logo" src="{{ asset('logo-centre.png') }}" alt="Logo ISPLTI">
        @endif
        {{-- En-tête en arabe (à droite) --}}
        <div class="header-ar">
            <div class="republic">الجمهورية الإسلامية الموريتانية</div>
            <div class="motto">شرف – إخاء – عدل</div>
            <div class="ministry">وزارة التعليم العالي والبحث العلمي</div>
            <div class="institute">المعهد العالي المهني للغات وللترجمة والترجمة الفورية</div>
        </div>
    </header>
    <h2>Convocation</h2>
    <div class="subtitle">
        Année Académique {{ $annee_en_cours->libelle ?? '2025-2026' }}
        @php
            $semestre = \App\Models\Semestre::find(1);
        @endphp
        <div style="margin-top:2px; font-size:8pt; color:#444;">
            @if($semestre)
                @if($semestre->etat == 1)
                    Semestre Impaire
                @else
                    Semestre Paire
                @endif
            @endif
        </div>
    </div>
    <section class="bloc" style="position:relative;">
        <div style="position:absolute; top:8px; right:8px; text-align:center;">
            @if(!empty($etudiant->id))
                <img src="{{ $photoUrl }}" alt="Photo {{ $etudiant->nom_fr ?? $etudiant->nom }}" class="student-photo">
            @else
                <div class="student-photo" style="display:flex; align-items:center; justify-content:center; color:#999; font-size:9pt; text-align:center;">
                    Photo<br>étudiant
                </div>
            @endif
        </div>
        <div style="margin-right:130px;">
            <p class="parag" style="margin-bottom:4px;">
                L'étudiant(e) Mr(Mme): <strong>{{ $etudiant->nom_fr ?? $etudiant->nom }}</strong>, NNI <strong>{{ $etudiant->nni }}</strong>, Né(e) le <strong>{{ !empty($etudiant->date_naissance) ? \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') : '' }}</strong>
                à/en <strong>{{ $etudiant->lieu_naissance }}</strong><br>
                inscrit(e) administrativement sous le numéro <strong>{{ $etudiant->nodos }}</strong> en formation initiale <strong>{{ $formation }}</strong> niveau <strong>{{ $niveau ?? '1' }}</strong>{{ isset($etudiant->tronc_commun) ? ', ' . $etudiant->tronc_commun : '' }}<br>
                est convoqué(e) aux épreuves du contrôle final des éléments suivants :
            </p>
        </div>
    </section>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>N</th>
                    <th>Élément</th>
                    <th>Jour</th>
                    <th>Date</th>
                    <th>Horaire</th>
                    <th>Salle</th>
                    <th>Semestre</th>
                    <th>Taux de Présence</th>
                </tr>
            </thead>
            <tbody>
            @foreach($convecations as $i => $conv)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $conv->matiere }}</td>
                    <td>{{ $conv->jour }}</td>
                    <td>{{ $conv->date }}</td>
                    <td>{{ $conv->horaire }}</td>
                    <td>{{ $conv->nosalle }}</td>
                    <td>{{ $conv->semestre }}</td>
                    <td>{{ $conv->tauxpresecce }}%</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="footer" style="display: flex; justify-content: space-between; align-items: flex-end; margin-top: 20px;">
            <div style="text-align:left; flex:1;">
                Nouadhibou, le {{ date('d/m/Y') }}
            </div>
            <div style="text-align:center; flex:1;">
                @php
                    $profileUrl = route('etudiants.info', $etudiant->id ?? 1);
                    $encodedUrl = base64_encode($profileUrl);
                    $obfuscatedData = urlencode(base64_decode($encodedUrl));
                    $protocol = 'https://';
                    $domain = base64_decode('YXBpLnFyc2VydmVyLmNvbQ=='); // api.qrserver.com
                    $endpoint = base64_decode('L3YxL2NyZWF0ZS1xci1jb2RlLw=='); // /v1/create-qr-code/
                    $params = '?size=80x80&data=';
                    $qrApiUrl = $protocol . $domain . $endpoint . $params . $obfuscatedData;
                @endphp
                <img src="{{ $qrApiUrl }}"
                     alt="QR Code Profil Étudiant"
                     style="width:80px; height:80px; border:1px solid #ddd;">
            </div>
            <div class="signature" style="text-align:right; flex:1;">

            </div>
        </div>
        <div style="margin-top:12px; text-align:center; font-weight:bold; color:#111; font-size:10pt;">
            NB : L'étudiant(e) est tenu(e) de présenter cette convocation pour passer chaque épreuve du contrôle final.
        </div>
    </div>
</body>
</html>

