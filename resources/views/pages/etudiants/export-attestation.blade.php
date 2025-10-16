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
    .brand { display:flex; align-items:flex-start; gap:16px; border-bottom:3px solid #1a365d; padding-bottom:15px; margin-bottom:15px; }
    .logo { width:85px; height:85px; object-fit:contain; }
    .inst-info { flex:1; }
    .inst-name { margin:0; font-size:18pt; color:#1a365d; font-weight:700; text-align:center; }
    .inst-subtitle { font-size:14pt; color:#2d3748; margin:4px 0; font-weight:600; text-align:center; }
    .inst-meta { font-size:10pt; color:#555; line-height:1.5; text-align:center; }
    .header-fr { text-align:center; margin-bottom:8px; }
    .header-ar { text-align:center; direction:rtl; font-family:"Arial Unicode MS", "Tahoma", sans-serif; }
    .republic { font-weight:700; color:#1a365d; font-size:12pt; }
    .motto { font-style:italic; color:#666; margin:2px 0; }
    .ministry { font-weight:600; color:#2d3748; }
    .institute { font-weight:700; color:#1a365d; font-size:11pt; margin:3px 0; }
    .service { color:#555; font-size:10pt; }
    h2 { text-align:center; font-size:20pt; margin:16px 0 8px; text-transform:uppercase; letter-spacing:1px; }
    .subtitle { text-align:center; color:#666; margin-bottom:10px; }
    .bloc { border:1px solid #e9e9e9; border-radius:8px; background:#fafafa; padding:12px; margin-top:12px; }
    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:10px 18px; }
    .grid-with-photo { display:grid; grid-template-columns:1fr 120px; gap:15px; align-items:start; }
    .student-photo { width:120px; height:150px; object-fit:cover; border:2px solid #e5e5e5; border-radius:8px; background:#f8f8f8; }
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
        @if(asset('logo2.png'))
            <img class="logo" src="{{ asset('logo2.png') }}" alt="Logo ISPLTI">
        @endif
        <div class="inst-info">
            {{-- En-tête en français --}}
            <div class="header-fr">
                <div class="republic">République Islamique de Mauritanie</div>
                <div class="motto">Honneur – Fraternité – Justice</div>
                <div class="ministry">Ministère de l'Enseignement Supérieur et de la Recherche Scientifique</div>
                <div class="institute">INSTITUT SUPÉRIEUR PROFESSIONNEL DE LANGUES, DE TRADUCTION & D'INTERPRÉTARIAT</div>
                <div class="service">SERVICE DES AFFAIRES ÉTUDIANTINES</div>
            </div>

            {{-- En-tête en arabe --}}
            <div class="header-ar" style="margin-top:12px;">
                <div class="republic">الجمهورية الإسلامية الموريتانية</div>
                <div class="motto">شرف – إخاء – عدل</div>
                <div class="ministry">وزارة التعليم العالي والبحث العلمي</div>
                <div class="institute">المعهد العالي المهني للغات وللترجمة والترجمة الفورية</div>
                <div class="service">مصلحة الشؤون الطلابية</div>
            </div>
        </div>
    </header>

    <h2>Attestation d'inscription</h2>
    <div class="subtitle">Année universitaire {{ $annee ?? '2025-2026' }}</div>

    <section class="bloc">
        <p class="parag" style="margin-bottom:16px;">
            Le Directeur de l'Institut Supérieur Professionnel de Langues, de Traduction et d'Interprétariat,<br>
            <strong>atteste que l'étudiant(e) :</strong>
        </p>

        <div class="grid-with-photo" style="margin-bottom:16px;">
            <div>
                <div class="grid-2">
                    <div>
                        <div class="label">Mr (Mme)</div>
                        <div class="val">{{ $etudiant['nom']  }}</div>
                    </div>
                    <div>
                        <div class="label">NNI</div>
                        <div class="val">{{ $etudiant['nni']  }}</div>
                    </div>
                    <div>
                        <div class="label">Né(e) le</div>
                        <div class="val">
                            {{  \Carbon\Carbon::parse($etudiant['date_naissance'])->format('d/m/Y') }}
                            à {{ $etudiant['lieu_naissance']  }}
                        </div>
                    </div>
                    <div>
                        <div class="label">Numéro d'inscription</div>
                        <div class="val">{{ $etudiant['numero_inscription'] ?? '24-25/1099' }}</div>
                    </div>
                </div>
            </div>

            {{-- Photo de l'étudiant --}}
            <div style="text-align:center;">
                @if(!empty($etudiant['photo_url']))
                    <img src="{{ $etudiant['photo_url'] }}" alt="Photo {{ $etudiant['nom'] }}" class="student-photo">
                @elseif(!empty($etudiant['id']))
                    <img src="{{ route('etudiants.image', $etudiant['id']) }}" alt="Photo {{ $etudiant['nom'] }}" class="student-photo">
                @else
                    <div class="student-photo" style="display:flex; align-items:center; justify-content:center; color:#999; font-size:9pt; text-align:center;">
                        Photo<br>étudiant
                    </div>
                @endif
                <div style="font-size:8pt; color:#666; margin-top:4px;">Photo officielle</div>
            </div>
        </div>

        <p class="parag">
            est inscrit administrativement sous le numéro <strong>{{ $etudiant['matricule'] ?? '24-25/1099' }}</strong>
            en formation initiale <strong>{{ $etudiant['formation'] ?? 'licence professionnelle' }}</strong>
            niveau <strong>{{ $etudiant['niveau'] ?? 'L1' }}</strong>,<br>
            <strong>{{ $etudiant['tronc_commun'] ?? 'Tronc commun Langues' }}</strong> et pédagogiquement aux semestres, modules et éléments ci-dessous,<br>
            combinaison majeure : <strong>{{ $etudiant['combinaison_majeure'] ?? 'Anglais – Arabe' }}</strong>
        </p>

        {{-- Numéro de référence en bas à droite --}}
        <div style="text-align:right; margin-top:20px; font-size:14pt; font-weight:700; color:#1a365d;">
            {{ $etudiant['id'] ?? '1099' }}
        </div>
    </section>

    <section class="bloc">
        <div class="label" style="margin-bottom:10px; font-weight:700; color:#1a365d;">Programme d'enseignement</div>
        <table>
            <thead>
                <tr>
                    <th style="text-align:center;">Semestre</th>
                    <th style="text-align:center;">Module</th>
                    <th style="text-align:center;">Éléments</th>
                    <th style="text-align:center;">Volume horaire</th>
                    <th style="text-align:center;">Crédits</th>
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
                                    <td style="text-align:center; vertical-align:top; font-weight:600; border-right:2px solid #1a365d;" rowspan="{{ $elementCount }}">
                                        {{ $semestreName }}
                                    </td>
                                @endif
                                <td>{{ $element['module'] ?? '' }}</td>
                                <td>{{ $element['matiere'] ?? '' }}</td>
                                <td style="text-align:center;">{{ $element['volume_horaire'] ?? '' }}</td>
                                <td style="text-align:center;">{{ $element['credits'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @else
                    {{-- Exemple de données par défaut --}}
                    <tr>
                        <td style="text-align:center;">S1</td>
                        <td>Langue Anglaise I</td>
                        <td>Grammaire anglaise, Expression orale, Compréhension écrite</td>
                        <td style="text-align:center;">60h</td>
                        <td style="text-align:center;">6</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">S1</td>
                        <td>Langue Arabe I</td>
                        <td>Grammaire arabe, Expression écrite, Littérature</td>
                        <td style="text-align:center;">60h</td>
                        <td style="text-align:center;">6</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">S1</td>
                        <td>Méthodologie</td>
                        <td>Techniques de recherche, Rédaction académique</td>
                        <td style="text-align:center;">30h</td>
                        <td style="text-align:center;">3</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">S2</td>
                        <td>Langue Anglaise II</td>
                        <td>Phonétique, Syntaxe, Expression écrite</td>
                        <td style="text-align:center;">60h</td>
                        <td style="text-align:center;">6</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">S2</td>
                        <td>Langue Arabe II</td>
                        <td>Rhétorique, Poésie classique, Traduction</td>
                        <td style="text-align:center;">60h</td>
                        <td style="text-align:center;">6</td>
                    </tr>
                @endif
            </tbody>
            @if(!empty($programme) && is_array($programme))
                <tfoot>
                    <tr style="background:#f0f8ff; font-weight:700;">
                        <td colspan="3" style="text-align:right; padding-right:20px;">Total :</td>
                        <td style="text-align:center;">{{ collect($programme)->sum('volume_horaire_numeric') ?? '' }}h</td>
                        <td style="text-align:center;">{{ collect($programme)->sum('credits_numeric') ?? '' }}</td>
                    </tr>
                </tfoot>
            @endif
        </table>
        <div class="muted">* Programme conforme au référentiel de formation de l'établissement.</div>
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
