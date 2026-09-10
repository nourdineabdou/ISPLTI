@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>🎓 @lang('candidature.breadcrumb_candidature') — {{ $candidature->numero_candidature }}</h1>
        <p>{{ $candidature->prenom }} {{ $candidature->nom }} — {{ $candidature->master->intituleLocalise() }}</p>
      </div>
    </div>

    <section class="posts">
      <div class="container" data-aos="fade-up">

        {{-- indicateur d'etapes --}}
        <div class="d-flex justify-content-center gap-3 mb-4" id="candidature-progress">
            <span class="badge rounded-pill px-3 py-2 bg-secondary">✓ 1. @lang('candidature.step_identite')</span>
            <span class="badge rounded-pill px-3 py-2 step-badge active" data-step-badge="2" style="background:#08915e;">2. @lang('candidature.step_parcours')</span>
            <span class="badge rounded-pill px-3 py-2 step-badge bg-secondary" data-step-badge="3">3. @lang('candidature.step_documents')</span>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <form method="POST" action="{{ route('candidature.suite.store') }}" enctype="multipart/form-data" id="candidature-form">
                    @csrf

                    {{-- ================= ETAPE 2 : PARCOURS ================= --}}
                    <div class="wizard-step card shadow-sm border-0 rounded-4 p-4 p-md-5 mb-3" data-step="2">
                        <h3 class="h5 mb-3">🗣️ @lang('candidature.langues_titre')</h3>
                        <div id="repeater-langues">
                            @foreach($candidature->langues as $i => $l)
                                <div class="repeater-row border rounded-3 p-3 mb-2">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <select name="langues[{{ $i }}][langue_id]" class="form-select">
                                                <option value="">@lang('candidature.langue')</option>
                                                @foreach($langues as $langue)
                                                    <option value="{{ $langue->id }}" {{ $l->langue_id == $langue->id ? 'selected' : '' }}>{{ $langue->langue }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="langues[{{ $i }}][niveau]" class="form-select">
                                                <option value="">@lang('candidature.niveau')</option>
                                                @foreach(['A1','A2','B1','B2','C1','C2'] as $niveau)
                                                    <option value="{{ $niveau }}" {{ $l->niveau == $niveau ? 'selected' : '' }}>{{ $niveau }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-5"><label class="form-label small mb-0">@lang('candidature.certificat_optionnel')</label><input type="file" name="langues[{{ $i }}][fichier_certificat]" class="form-control form-control-sm"></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2 js-remove-row">✕ @lang('candidature.retirer')</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mb-4 js-add-row" data-target="repeater-langues" data-template="template-langue">+ @lang('candidature.ajouter_langue')</button>

                        <h3 class="h5 mb-1">🎓 @lang('candidature.diplomes_titre')</h3>
                        <p class="text-muted small mb-3">@lang('candidature.diplomes_note')</p>
                        <div id="repeater-diplomes">
                            @foreach($candidature->diplomes as $i => $d)
                                <div class="repeater-row border rounded-3 p-3 mb-2">
                                    <div class="row g-2">
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][type_diplome]" class="form-control" placeholder="@lang('candidature.type_diplome')" value="{{ $d->type_diplome }}"></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][intitule]" class="form-control" placeholder="@lang('candidature.intitule_requis')" value="{{ $d->intitule }}"></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][etablissement]" class="form-control" placeholder="@lang('candidature.etablissement')" value="{{ $d->etablissement }}"></div>
                                        <div class="col-md-3"><input type="number" name="diplomes[{{ $i }}][annee_obtention]" class="form-control" placeholder="@lang('candidature.annee')" value="{{ $d->annee_obtention }}"></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][domaine]" class="form-control" placeholder="@lang('candidature.domaine')" value="{{ $d->domaine }}"></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][pays]" class="form-control" placeholder="@lang('candidature.pays')" value="{{ $d->pays }}"></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][mention]" class="form-control" placeholder="@lang('candidature.mention')" value="{{ $d->mention }}"></div>
                                        <div class="col-md-6"><label class="form-label small mb-0">@lang('candidature.fichier_diplome') <span class="text-danger">*</span></label><input type="file" name="diplomes[{{ $i }}][fichier_diplome]" class="form-control form-control-sm"></div>
                                        <div class="col-md-6"><label class="form-label small mb-0">@lang('candidature.fichier_releve') <span class="text-danger">*</span></label><input type="file" name="diplomes[{{ $i }}][fichier_releve]" class="form-control form-control-sm"></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2 js-remove-row">✕ @lang('candidature.retirer')</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mb-4 js-add-row" data-target="repeater-diplomes" data-template="template-diplome">+ @lang('candidature.ajouter_diplome')</button>

                        <h3 class="h5 mb-3">📚 @lang('candidature.formations_titre') <span class="text-muted small">@lang('candidature.optionnel')</span></h3>
                        <div id="repeater-formations">
                            @foreach($candidature->formations as $i => $f)
                                <div class="repeater-row border rounded-3 p-3 mb-2">
                                    <div class="row g-2">
                                        <div class="col-md-5"><input type="text" name="formations[{{ $i }}][intitule]" class="form-control" placeholder="@lang('candidature.intitule')" value="{{ $f->intitule }}"></div>
                                        <div class="col-md-3"><input type="text" name="formations[{{ $i }}][organisme]" class="form-control" placeholder="@lang('candidature.organisme')" value="{{ $f->organisme }}"></div>
                                        <div class="col-md-2"><input type="date" name="formations[{{ $i }}][date_debut]" class="form-control" value="{{ $f->date_debut }}"></div>
                                        <div class="col-md-2"><input type="date" name="formations[{{ $i }}][date_fin]" class="form-control" value="{{ $f->date_fin }}"></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2 js-remove-row">✕ @lang('candidature.retirer')</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mb-4 js-add-row" data-target="repeater-formations" data-template="template-formation">+ @lang('candidature.ajouter_formation')</button>

                        <h3 class="h5 mb-3">🧳 @lang('candidature.experiences_pro_titre') <span class="text-muted small">@lang('candidature.optionnel')</span></h3>
                        <div id="repeater-experiences">
                            @foreach($candidature->experiencesProfessionnelles as $i => $exp)
                                <div class="repeater-row border rounded-3 p-3 mb-2">
                                    <div class="row g-2">
                                        <div class="col-md-4"><input type="text" name="experiences[{{ $i }}][employeur]" class="form-control" placeholder="@lang('candidature.employeur')" value="{{ $exp->employeur }}"></div>
                                        <div class="col-md-4"><input type="text" name="experiences[{{ $i }}][poste]" class="form-control" placeholder="@lang('candidature.poste')" value="{{ $exp->poste }}"></div>
                                        <div class="col-md-2"><input type="date" name="experiences[{{ $i }}][date_debut]" class="form-control" value="{{ $exp->date_debut }}"></div>
                                        <div class="col-md-2"><input type="date" name="experiences[{{ $i }}][date_fin]" class="form-control" value="{{ $exp->date_fin }}"></div>
                                        <div class="col-12"><textarea name="experiences[{{ $i }}][description]" class="form-control mt-1" placeholder="@lang('candidature.description')" rows="1">{{ $exp->description }}</textarea></div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2 js-remove-row">✕ @lang('candidature.retirer')</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mb-4 js-add-row" data-target="repeater-experiences" data-template="template-experience">+ @lang('candidature.ajouter_experience')</button>

                        <h3 class="h5 mb-3">💼 @lang('candidature.situation_professionnelle_titre') <span class="text-muted small">@lang('candidature.optionnel')</span></h3>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.situation_professionnelle')</label>
                                <input type="text" name="situation_professionnelle" class="form-control" value="{{ old('situation_professionnelle', $candidature->situation_professionnelle) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.profession')</label>
                                <input type="text" name="profession" class="form-control" value="{{ old('profession', $candidature->profession) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.organisme_employeur')</label>
                                <input type="text" name="organisme_employeur" class="form-control" value="{{ old('organisme_employeur', $candidature->organisme_employeur) }}">
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="button" class="btn text-white fw-bold px-4 py-2 rounded-pill js-next-step" style="background:#08915e;">@lang('candidature.suivant') →</button>
                        </div>
                    </div>

                    {{-- ================= ETAPE 3 : PROJET, LETTRE, DOCUMENTS ================= --}}
                    <div class="wizard-step card shadow-sm border-0 rounded-4 p-4 p-md-5 mb-3" data-step="3" hidden>
                        @php
                            $pieceProjet = $piecesObligatoires->firstWhere('code_document', 'projet_recherche');
                            $pieceLettre = $piecesObligatoires->firstWhere('code_document', 'lettre_motivation');
                        @endphp
                        <h3 class="h5 mb-3">🔬 @lang('candidature.projet_recherche_titre')</h3>
                        <div class="row g-3 mb-4">
                            <div class="col-md-8">
                                <label class="form-label">@lang('candidature.titre_projet')</label>
                                <input type="text" name="projet_titre" class="form-control" value="{{ old('projet_titre', optional($candidature->projetsRecherche->first())->titre) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.discipline')</label>
                                <input type="text" name="projet_discipline" class="form-control" value="{{ old('projet_discipline', optional($candidature->projetsRecherche->first())->discipline) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">@lang('candidature.resume_projet')</label>
                                <textarea name="projet_resume" class="form-control" rows="3">{{ old('projet_resume', optional($candidature->projetsRecherche->first())->resume) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('candidature.fichier_projet') @if(!$pieceProjet || $pieceProjet->obligatoire)<span class="text-danger">*</span>@endif</label>
                                <input type="file" name="projet_fichier" class="form-control" accept="application/pdf" {{ (!$pieceProjet || $pieceProjet->obligatoire) ? 'required' : '' }}>
                            </div>
                        </div>

                        <h3 class="h5 mb-3">✉️ @lang('candidature.lettre_motivation_titre')</h3>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label">@lang('candidature.contenu')</label>
                                <textarea name="lettre_contenu" class="form-control" rows="4">{{ old('lettre_contenu', optional($candidature->lettreMotivation)->contenu) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('candidature.lettre_signee') @if(!$pieceLettre || $pieceLettre->obligatoire)<span class="text-danger">*</span>@endif</label>
                                <input type="file" name="lettre_fichier" class="form-control" accept="application/pdf" {{ (!$pieceLettre || $pieceLettre->obligatoire) ? 'required' : '' }}>
                            </div>
                        </div>

                        <h3 class="h5 mb-1">📎 @lang('candidature.photo_pieces_titre')</h3>
                        <p class="text-muted small mb-3">@lang('candidature.piece_documents_note')</p>
                        <div class="row g-3 mb-3">
                            {{-- pas de champ "photo d'identite" separe : la copie de la carte d'identite
                                 (si c'est une image) sert aussi de photo de profil, pour eviter de demander
                                 deux fois la meme information --}}
                            {{-- le projet de recherche, la lettre de motivation, le diplome et le releve de notes
                                 ont deja leur propre champ plus haut (section Diplomes), et le certificat de langue
                                 est deja demande dans la section Langues (etape 2) : on ne les redemande pas ici --}}
                            @foreach($piecesObligatoires->whereNotIn('code_document', ['projet_recherche', 'lettre_motivation', 'diplome', 'releve_notes', 'certificat_langue']) as $piece)
                                <div class="col-md-6">
                                    <label class="form-label">
                                        {{ $piece->libelle }}
                                        @if($piece->code_document === 'carte_identite')<span class="text-muted small">(@lang('candidature.sert_aussi_photo'))</span>@endif
                                        @if($piece->obligatoire)<span class="text-danger">*</span>@else <span class="text-muted small">@lang('candidature.optionnel')</span>@endif
                                    </label>
                                    <input type="file" name="documents[{{ $piece->code_document }}]" class="form-control" @if($piece->code_document === 'carte_identite') accept="image/*,application/pdf" @endif {{ $piece->obligatoire ? 'required' : '' }}>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-pill js-prev-step">← @lang('candidature.precedent')</button>
                            <button type="submit" class="btn text-white fw-bold px-4 py-2 rounded-pill" style="background:#08915e;" data-loading-text="@lang('candidature.traitement_en_cours')">@lang('candidature.envoyer_candidature') ✅</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </section>

    {{-- modeles pour les nouvelles lignes ajoutees dynamiquement --}}
    <template id="template-experience">
        <div class="repeater-row border rounded-3 p-3 mb-2">
            <div class="row g-2">
                <div class="col-md-4"><input type="text" name="experiences[__INDEX__][employeur]" class="form-control" placeholder="@lang('candidature.employeur')"></div>
                <div class="col-md-4"><input type="text" name="experiences[__INDEX__][poste]" class="form-control" placeholder="@lang('candidature.poste')"></div>
                <div class="col-md-2"><input type="date" name="experiences[__INDEX__][date_debut]" class="form-control"></div>
                <div class="col-md-2"><input type="date" name="experiences[__INDEX__][date_fin]" class="form-control"></div>
                <div class="col-12"><textarea name="experiences[__INDEX__][description]" class="form-control mt-1" placeholder="@lang('candidature.description')" rows="1"></textarea></div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-2 js-remove-row">✕ @lang('candidature.retirer')</button>
        </div>
    </template>
    <template id="template-formation">
        <div class="repeater-row border rounded-3 p-3 mb-2">
            <div class="row g-2">
                <div class="col-md-5"><input type="text" name="formations[__INDEX__][intitule]" class="form-control" placeholder="@lang('candidature.intitule')"></div>
                <div class="col-md-3"><input type="text" name="formations[__INDEX__][organisme]" class="form-control" placeholder="@lang('candidature.organisme')"></div>
                <div class="col-md-2"><input type="date" name="formations[__INDEX__][date_debut]" class="form-control"></div>
                <div class="col-md-2"><input type="date" name="formations[__INDEX__][date_fin]" class="form-control"></div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-2 js-remove-row">✕ @lang('candidature.retirer')</button>
        </div>
    </template>
    <template id="template-diplome">
        <div class="repeater-row border rounded-3 p-3 mb-2">
            <div class="row g-2">
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][type_diplome]" class="form-control" placeholder="@lang('candidature.type_diplome')"></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][intitule]" class="form-control" placeholder="@lang('candidature.intitule_requis')"></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][etablissement]" class="form-control" placeholder="@lang('candidature.etablissement')"></div>
                <div class="col-md-3"><input type="number" name="diplomes[__INDEX__][annee_obtention]" class="form-control" placeholder="@lang('candidature.annee')"></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][domaine]" class="form-control" placeholder="@lang('candidature.domaine')"></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][pays]" class="form-control" placeholder="@lang('candidature.pays')"></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][mention]" class="form-control" placeholder="@lang('candidature.mention')"></div>
                <div class="col-md-6"><label class="form-label small mb-0">@lang('candidature.fichier_diplome') <span class="text-danger">*</span></label><input type="file" name="diplomes[__INDEX__][fichier_diplome]" class="form-control form-control-sm"></div>
                <div class="col-md-6"><label class="form-label small mb-0">@lang('candidature.fichier_releve') <span class="text-danger">*</span></label><input type="file" name="diplomes[__INDEX__][fichier_releve]" class="form-control form-control-sm"></div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-2 js-remove-row">✕ @lang('candidature.retirer')</button>
        </div>
    </template>
    <template id="template-langue">
        <div class="repeater-row border rounded-3 p-3 mb-2">
            <div class="row g-2">
                <div class="col-md-4">
                    <select name="langues[__INDEX__][langue_id]" class="form-select">
                        <option value="">@lang('candidature.langue')</option>
                        @foreach($langues as $langue)
                            <option value="{{ $langue->id }}">{{ $langue->langue }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="langues[__INDEX__][niveau]" class="form-select">
                        <option value="">@lang('candidature.niveau')</option>
                        @foreach(['A1','A2','B1','B2','C1','C2'] as $niveau)
                            <option value="{{ $niveau }}">{{ $niveau }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5"><label class="form-label small mb-0">@lang('candidature.certificat_optionnel')</label><input type="file" name="langues[__INDEX__][fichier_certificat]" class="form-control form-control-sm"></div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-2 js-remove-row">✕ @lang('candidature.retirer')</button>
        </div>
    </template>

    <script>
        (function () {
            var repeaterCounter = 100000; // au-dela des index deja rendus depuis la base

            function addRow(targetId, templateId) {
                var container = document.getElementById(targetId);
                var template = document.getElementById(templateId);
                if (!container || !template) return;
                var html = template.innerHTML.replace(/__INDEX__/g, repeaterCounter++);
                var wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                container.appendChild(wrapper.firstElementChild);
            }

            document.querySelectorAll('.js-add-row').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    addRow(btn.getAttribute('data-target'), btn.getAttribute('data-template'));
                });
            });

            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('js-remove-row')) {
                    e.target.closest('.repeater-row').remove();
                }
            });

            // navigation simple entre les 2 blocs (etape 2 / etape 3)
            var steps = document.querySelectorAll('.wizard-step');
            var badges = document.querySelectorAll('.step-badge');
            var form = document.getElementById('candidature-form');

            function goToStep(stepNumber) {
                steps.forEach(function (step) {
                    step.hidden = step.getAttribute('data-step') !== String(stepNumber);
                });
                badges.forEach(function (badge) {
                    var isActive = badge.getAttribute('data-step-badge') === String(stepNumber);
                    badge.style.background = isActive ? '#08915e' : '';
                    badge.classList.toggle('bg-secondary', !isActive);
                });
                window.scrollTo({ top: form.offsetTop - 100, behavior: 'smooth' });
            }

            document.querySelector('.js-next-step').addEventListener('click', function () {
                // on ne valide que les champs de l'etape actuellement visible :
                // form.reportValidity() verifierait aussi les champs obligatoires
                // caches de l'etape 3 (photo, pieces), qui bloqueraient sans rien afficher
                var currentStep = document.querySelector('.wizard-step[data-step="2"]');
                var invalids = currentStep.querySelectorAll(':invalid');
                if (invalids.length > 0) {
                    invalids.forEach(function (el) { el.classList.add('is-invalid'); });
                    invalids[0].reportValidity();
                    invalids[0].focus();
                    return;
                }
                goToStep(3);
            });
            document.querySelector('.js-prev-step').addEventListener('click', function () {
                goToStep(2);
            });
        })();
    </script>
@endsection
