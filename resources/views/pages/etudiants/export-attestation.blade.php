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
            {{--
            <div class="service">SERVICE DES AFFAIRES ÉTUDIANTINES</div>
            --}}
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
            {{-- <div class="service">مصلحة الشؤون الطلابية</div> --}}
        </div>
    </header>
    <h2>Attestation d'inscription</h2>
    <div class="subtitle">Année universitaire {{ $annee ?? '2025-2026' }}</div>

    <section class="bloc" style="position:relative;">
        {{-- Photo de l'étudiant positionnée en haut à droite --}}
        <div style="position:absolute; top:8px; right:8px; text-align:center;">

            @if(!empty($etudiant['id']))
                <img src="{{ route('etudiants.image', $etudiant['id']) }}" alt="Photo {{ $etudiant['nom'] }}" class="student-photo">
            @else
                <div class="student-photo" style="display:flex; align-items:center; justify-content:center; color:#999; font-size:9pt; text-align:center;">
                    Photo<br>étudiant
                </div>
            @endif
        </div>
        {{-- Contenu principal avec marge pour éviter la superposition avec la photo --}}
        <div style="margin-right:130px;">
            <p class="parag" style="margin-bottom:4px;">
                La Directrice de l'Institut Supérieur Professionnel de Langues, de Traduction et d'Interprétariat,<br>
                <strong>atteste que l'étudiant(e) :</strong>
            </p>
            <div style="margin-bottom:2px;">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:6px 12px; margin-bottom:6px;">
                    <div>
                        <span class="label">Mr (Mme) :</span> <span class="val">{{ $etudiant['nom']  }}</span>
                    </div>
                    <div>
                        <span class="label">Né(e) le :</span>
                        <span class="val">{{  \Carbon\Carbon::parse($etudiant['date_naissance'])->format('d/m/Y') }} à {{ $etudiant['lieu_naissance']  }}</span>
                    </div>
                </div>
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:6px 12px;">
                    <div>
                        <span class="label">NNI :</span> <span class="val">{{ $etudiant['nni']  }}</span>
                    </div>
                    <div>
                        <span class="label">Numéro d'inscription :</span> <span class="val">{{ $etudiant['numero_inscription'] ?? '24-25/1099' }}</span>
                    </div>
                </div>
            </div>
            <p class="parag" style="margin-top:2px; line-height:1.4;">
                est inscrit administrativement
                en formation initiale <strong>{{ $etudiant['formation']  }}</strong>
                niveau <strong>{{ $etudiant['niveau'] ?? '1' }}</strong>,
                <strong>{{ $etudiant['tronc_commun'] ?? 'Tronc commun Langues' }}</strong> et pédagogiquement aux semestres, modules et éléments ci-dessous,

            </p>
        </div>
        {{-- Numéro de référence en bas à droite
        <div style="text-align:right; margin-top:20px; font-size:14pt; font-weight:700; color:#1a365d;">
            {{ $etudiant['id'] ?? '1099' }}
        </div>
        --}}
    </section>

    <section class="bloc">
        {{-- Totaux en haut --}}
        @if(!empty($programme) && is_array($programme))
            <div style="display:flex; justify-content:flex-end; gap:20px; margin-bottom:6px; padding:4px 8px; background:#f0f8ff; border-radius:4px; font-size:8pt; font-weight:600; color:#1a365d;">
                <div>Volume horaire : <strong>{{ $volumeHoraireNumeric }} h</strong></div>
                <div>Crédits : <strong>{{ $creditsNumeric }}</strong></div>
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th style="text-align:center; width:12%;">Sem.</th>
                    <th style="text-align:center; width:35%;">Module</th>
                    <th style="text-align:center; width:38%;">Éléments</th>
                    <th style="text-align:center; width:8%;">Vol. H</th>
                    <th style="text-align:center; width:7%;">Crédits</th>
                </tr>
            </thead>
            <tbody>
                {{-- Boucle sur les semestres et leurs éléments --}}
                @if(!empty($programme) && is_array($programme))
                    @foreach($programme as $semestre)
                        @php
                            $semestreName = $semestre['semestre'];
                            $elements = $semestre['elements'];
                            $elementCount = count($elements);
                        @endphp

                                                @foreach($elements as $index => $element)
                            <tr>
                                @if($index === 0)
                                    <td style="text-align:center; vertical-align:top; font-weight:600; border-right:2px solid #1a365d; font-size:6pt; padding:1px 3px;" rowspan="{{ $elementCount }}">
                                        {{ $semestreName }}
                                    </td>
                                @endif
                                <td style="font-size:6pt; padding:1px 3px;">{{ $element['module'] ?? '' }}</td>
                                <td style="font-size:6pt; padding:1px 3px;">{{ $element['element']  }} {{  $element['matiere'] }} </td>
                                <td style="text-align:center; font-size:6pt; padding:1px 3px;">{{ $element['volume_horaire']  }}</td>
                                <td style="text-align:center; font-size:6pt; padding:1px 3px;">{{ $element['credits']  }}</td>
                                {{-- cumuler le volume horaire numeric --}}

                            </tr>
                        @endforeach
                    @endforeach
                @endif
            </tbody>
        </table>
        {{--
        <div class="muted">* Programme conforme au référentiel de formation de l'établissement.</div>
        --}}
    </section>

    {{--
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
    --}}

    <div class="footer">
        {{-- QR Code au centre --}}
        <div style="text-align:center; width:100%;">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ urlencode(route('etudiants.info', $etudiant['id'] ?? 1)) }}"
                 alt="QR Code Profil Étudiant"
                 style="width:80px; height:80px; border:1px solid #ddd;">
        </div>

        {{-- Cachet totalement à droite
        <div style="text-align:right;">
            @if(file_exists(public_path('cacher.jpeg')))
                <img src="{{ asset('cacher.jpeg') }}" alt="Cachet officiel"
                     style="width:80px; height:80px; object-fit:contain; mix-blend-mode:multiply; opacity:0.8; background:transparent;">
            @endif
        --}}
            {{--
            @if(file_exists(public_path('signatur.jpeg')))
                <img src="{{ asset('signatur.jpeg') }}" alt="Signature"
                     style="width:80px; height:60px; object-fit:contain; mix-blend-mode:multiply; opacity:0.9; background:transparent; filter:contrast(1.2);">
            @endif
            --}}
        </div>

    </div>

    {{-- Texte officiel en dernier --}}
    <div style="font-size:8pt; color:#555; margin-top:15px; line-height:1.3; right:0;">
        Cette attestation lui est délivrée pour servir et valoir ce que de droit
    </div>

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
