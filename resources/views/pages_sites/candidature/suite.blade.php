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

        {{-- indicateur d'etapes (cliquables pour naviguer librement) --}}
        <div class="d-flex justify-content-center gap-3 mb-4" id="candidature-progress">
            <span class="badge rounded-pill px-3 py-2 step-badge bg-secondary" data-step-badge="1" data-label="1. @lang('candidature.step_identite')" role="button">1. @lang('candidature.step_identite')</span>
            <span class="badge rounded-pill px-3 py-2 step-badge {{ $errors->any() ? 'bg-secondary' : '' }}" data-step-badge="2" data-label="2. @lang('candidature.step_parcours')" role="button" @unless($errors->any()) style="background:#08915e;" @endunless>2. @lang('candidature.step_parcours')</span>
            <span class="badge rounded-pill px-3 py-2 step-badge {{ $errors->any() ? '' : 'bg-secondary' }}" data-step-badge="3" data-label="3. @lang('candidature.step_documents')" role="button" @if($errors->any()) style="background:#08915e;" @endif>3. @lang('candidature.step_documents')</span>
        </div>
        <p class="text-center small text-muted mb-4" id="candidature-save-status"></p>

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

                    {{-- ================= ETAPE 1 : IDENTITE ================= --}}
                    <div class="wizard-step card shadow-sm border-0 rounded-4 p-4 p-md-5 mb-3" data-step="1" hidden>
                        <h3 class="h5 mb-3">🪪 @lang('candidature.step_identite')</h3>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">@lang('candidature.master_vise')</label>
                                <input type="text" class="form-control" value="{{ $candidature->master->intituleLocalise() }} ({{ $candidature->master->code }})" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('candidature.nom') *</label>
                                <input type="text" name="nom" class="form-control" value="{{ old('nom', $candidature->nom) }}" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('candidature.prenom') *</label>
                                <input type="text" name="prenom" class="form-control" value="{{ old('prenom', $candidature->prenom) }}" required maxlength="100">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.sexe')</label>
                                <select name="sexe" class="form-select">
                                    <option value="">--</option>
                                    <option value="Masculin" {{ old('sexe', $candidature->sexe) == 'Masculin' ? 'selected' : '' }}>@lang('candidature.masculin')</option>
                                    <option value="Féminin" {{ old('sexe', $candidature->sexe) == 'Féminin' ? 'selected' : '' }}>@lang('candidature.feminin')</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.date_naissance')</label>
                                <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance', optional($candidature->date_naissance)->format('Y-m-d')) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.lieu_naissance')</label>
                                <input type="text" name="lieu_naissance" class="form-control" value="{{ old('lieu_naissance', $candidature->lieu_naissance) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.nni') *</label>
                                <input type="text" name="nni" class="form-control" value="{{ old('nni', $candidature->nni) }}" required maxlength="50">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.telephone')</label>
                                <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $candidature->telephone) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.whatsapp')</label>
                                <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp', $candidature->whatsapp) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('candidature.email') *</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $candidature->email) }}" required maxlength="150">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('candidature.adresse')</label>
                                <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $candidature->adresse) }}">
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="button" class="btn text-white fw-bold px-4 py-2 rounded-pill js-next-step" data-next="2" style="background:#08915e;">@lang('candidature.suivant') →</button>
                        </div>
                    </div>

                    {{-- ================= ETAPE 2 : PARCOURS ================= --}}
                    <div class="wizard-step card shadow-sm border-0 rounded-4 p-4 p-md-5 mb-3" data-step="2" @if($errors->any()) hidden @endif>
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
                                        <div class="col-md-5">
                                            <label class="form-label small mb-0">@lang('candidature.certificat_optionnel')</label>
                                            <input type="file" name="langues[{{ $i }}][fichier_certificat]" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png">
                                            <div class="small text-muted">@lang('candidature.formats_acceptes_pdf_image')</div>
                                            @if($l->fichier_certificat)
                                                <div class="small text-success mt-1">📎 @lang('candidature.fichier_deja_envoye') : {{ basename($l->fichier_certificat) }}</div>
                                                <div class="small text-muted">@lang('candidature.fichier_conserver_note')</div>
                                            @endif
                                        </div>
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
                                        <div class="col-md-3">
                                            <select name="diplomes[{{ $i }}][type_diplome]" class="form-select" required>
                                                <option value="">@lang('candidature.type_diplome')</option>
                                                <option value="Licence" {{ $d->type_diplome == 'Licence' ? 'selected' : '' }}>@lang('candidature.type_diplome_licence')</option>
                                                <option value="Maitrise" {{ $d->type_diplome == 'Maitrise' ? 'selected' : '' }}>@lang('candidature.type_diplome_maitrise')</option>
                                                <option value="Autre" {{ $d->type_diplome == 'Autre' ? 'selected' : '' }}>@lang('candidature.type_diplome_autre')</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][intitule]" class="form-control" placeholder="@lang('candidature.intitule_requis')" value="{{ $d->intitule }}" required></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][etablissement]" class="form-control" placeholder="@lang('candidature.etablissement')" value="{{ $d->etablissement }}" required></div>
                                        <div class="col-md-3"><input type="number" name="diplomes[{{ $i }}][annee_obtention]" class="form-control" placeholder="@lang('candidature.annee')" value="{{ $d->annee_obtention }}"></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][domaine]" class="form-control" placeholder="@lang('candidature.domaine')" value="{{ $d->domaine }}"></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][pays]" class="form-control" placeholder="@lang('candidature.pays')" value="{{ $d->pays }}"></div>
                                        <div class="col-md-3"><input type="text" name="diplomes[{{ $i }}][mention]" class="form-control" placeholder="@lang('candidature.mention')" value="{{ $d->mention }}"></div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">@lang('candidature.fichier_diplome') <span class="text-danger">*</span></label>
                                            <input type="file" name="diplomes[{{ $i }}][fichier_diplome]" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png">
                                            <div class="small text-muted">@lang('candidature.formats_acceptes_pdf_image')</div>
                                            @if($d->fichier_diplome)
                                                <div class="small text-success mt-1">📎 @lang('candidature.fichier_deja_envoye') : {{ basename($d->fichier_diplome) }}</div>
                                                <div class="small text-muted">@lang('candidature.fichier_conserver_note')</div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label small mb-0">@lang('candidature.fichier_releve') <span class="text-danger">*</span></label>
                                            <input type="file" name="diplomes[{{ $i }}][fichier_releve]" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png">
                                            <div class="small text-muted">@lang('candidature.formats_acceptes_pdf_image')</div>
                                            @if($d->fichier_releve)
                                                <div class="small text-success mt-1">📎 @lang('candidature.fichier_deja_envoye') : {{ basename($d->fichier_releve) }}</div>
                                                <div class="small text-muted">@lang('candidature.fichier_conserver_note')</div>
                                            @endif
                                        </div>
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

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-pill js-prev-step" data-prev="1">← @lang('candidature.precedent')</button>
                            <button type="button" class="btn text-white fw-bold px-4 py-2 rounded-pill js-next-step" data-next="3" style="background:#08915e;">@lang('candidature.suivant') →</button>
                        </div>
                    </div>

                    {{-- ================= ETAPE 3 : PROJET, LETTRE, DOCUMENTS ================= --}}
                    <div class="wizard-step card shadow-sm border-0 rounded-4 p-4 p-md-5 mb-3" data-step="3" @unless($errors->any()) hidden @endunless>
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
                                @php $projetExistant = $candidature->projetsRecherche->first(); @endphp
                                <input type="file" name="projet_fichier" class="form-control @if(in_array('projet_recherche', session('codes_pieces_manquantes', []))) is-invalid @endif" accept=".pdf,application/pdf" {{ ((!$pieceProjet || $pieceProjet->obligatoire) && !optional($projetExistant)->fichier_projet) ? 'required' : '' }}>
                                <div class="small text-muted mt-1">@lang('candidature.formats_acceptes_pdf_seulement')</div>
                                @if(optional($projetExistant)->fichier_projet)
                                    <div class="small text-success mt-1">📎 @lang('candidature.fichier_deja_envoye') : {{ basename($projetExistant->fichier_projet) }}</div>
                                    <div class="small text-muted">@lang('candidature.fichier_conserver_note')</div>
                                @endif
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
                                <input type="file" name="lettre_fichier" class="form-control @if(in_array('lettre_motivation', session('codes_pieces_manquantes', []))) is-invalid @endif" accept=".pdf,application/pdf" {{ ((!$pieceLettre || $pieceLettre->obligatoire) && !optional($candidature->lettreMotivation)->fichier) ? 'required' : '' }}>
                                <div class="small text-muted mt-1">@lang('candidature.formats_acceptes_pdf_seulement')</div>
                                @if(optional($candidature->lettreMotivation)->fichier)
                                    <div class="small text-success mt-1">📎 @lang('candidature.fichier_deja_envoye') : {{ basename($candidature->lettreMotivation->fichier) }}</div>
                                    <div class="small text-muted">@lang('candidature.fichier_conserver_note')</div>
                                @endif
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
                                @php $documentExistant = $candidature->documents->firstWhere('type_document', $piece->code_document); @endphp
                                <div class="col-md-6">
                                    <label class="form-label">
                                        {{ $piece->libelle }}
                                        @if($piece->code_document === 'carte_identite')<span class="text-muted small">(@lang('candidature.sert_aussi_photo'))</span>@endif
                                        @if($piece->obligatoire)<span class="text-danger">*</span>@else <span class="text-muted small">@lang('candidature.optionnel')</span>@endif
                                    </label>
                                    <input type="file" name="documents[{{ $piece->code_document }}]" class="form-control @if(in_array($piece->code_document, session('codes_pieces_manquantes', []))) is-invalid @endif" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" {{ ($piece->obligatoire && !$documentExistant) ? 'required' : '' }}>
                                    <div class="small text-muted mt-1">@lang('candidature.formats_acceptes_pdf_image')</div>
                                    @if($documentExistant)
                                        <div class="small text-success mt-1">📎 @lang('candidature.fichier_deja_envoye') : {{ $documentExistant->nom_fichier }}</div>
                                        <div class="small text-muted">@lang('candidature.fichier_conserver_note')</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-pill js-prev-step" data-prev="2">← @lang('candidature.precedent')</button>
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
                <div class="col-md-3">
                    <select name="diplomes[__INDEX__][type_diplome]" class="form-select" required>
                        <option value="">@lang('candidature.type_diplome')</option>
                        <option value="Licence">@lang('candidature.type_diplome_licence')</option>
                        <option value="Maitrise">@lang('candidature.type_diplome_maitrise')</option>
                        <option value="Autre">@lang('candidature.type_diplome_autre')</option>
                    </select>
                </div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][intitule]" class="form-control" placeholder="@lang('candidature.intitule_requis')" required></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][etablissement]" class="form-control" placeholder="@lang('candidature.etablissement')" required></div>
                <div class="col-md-3"><input type="number" name="diplomes[__INDEX__][annee_obtention]" class="form-control" placeholder="@lang('candidature.annee')"></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][domaine]" class="form-control" placeholder="@lang('candidature.domaine')"></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][pays]" class="form-control" placeholder="@lang('candidature.pays')"></div>
                <div class="col-md-3"><input type="text" name="diplomes[__INDEX__][mention]" class="form-control" placeholder="@lang('candidature.mention')"></div>
                <div class="col-md-6"><label class="form-label small mb-0">@lang('candidature.fichier_diplome') <span class="text-danger">*</span></label><input type="file" name="diplomes[__INDEX__][fichier_diplome]" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"><div class="small text-muted">@lang('candidature.formats_acceptes_pdf_image')</div></div>
                <div class="col-md-6"><label class="form-label small mb-0">@lang('candidature.fichier_releve') <span class="text-danger">*</span></label><input type="file" name="diplomes[__INDEX__][fichier_releve]" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"><div class="small text-muted">@lang('candidature.formats_acceptes_pdf_image')</div></div>
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
                <div class="col-md-5"><label class="form-label small mb-0">@lang('candidature.certificat_optionnel')</label><input type="file" name="langues[__INDEX__][fichier_certificat]" class="form-control form-control-sm" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png"><div class="small text-muted">@lang('candidature.formats_acceptes_pdf_image')</div></div>
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

            // navigation libre entre les 3 etapes (identite / parcours / documents)
            var steps = document.querySelectorAll('.wizard-step');
            var badges = document.querySelectorAll('.step-badge');
            var form = document.getElementById('candidature-form');
            var saveStatus = document.getElementById('candidature-save-status');

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

            var texteEnregistrement = @json(__('candidature.enregistrement_en_cours'));
            var texteEnregistre = @json(__('candidature.enregistre'));
            var texteEchecEnregistrement = @json(__('candidature.echec_enregistrement'));

            function marquerEtapeValidee(stepNumber) {
                var badge = document.querySelector('.step-badge[data-step-badge="' + stepNumber + '"]');
                if (badge && badge.textContent.indexOf('✓') === -1) {
                    badge.textContent = badge.getAttribute('data-label') + ' ✓';
                }
            }

            function demarrerChargement(btn) {
                btn.dataset.originalHtml = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + texteEnregistrement;
            }

            function arreterChargement(btn) {
                btn.disabled = false;
                if (btn.dataset.originalHtml) {
                    btn.innerHTML = btn.dataset.originalHtml;
                }
            }

            // chaque etape a sa propre route de sauvegarde, independante des autres
            var urlsSauvegarde = {
                '1': '{{ route('candidature.suite.etape1') }}',
                '2': '{{ route('candidature.suite.etape2') }}',
                '3': '{{ route('candidature.suite.etape3') }}',
            };

            // renvoie une Promise<boolean> : true si la sauvegarde a reussi
            function sauvegarderProgression(stepNumber) {
                saveStatus.className = 'text-center small text-muted mb-4';
                saveStatus.textContent = texteEnregistrement;
                return fetch(urlsSauvegarde[String(stepNumber)], {
                    method: 'POST',
                    body: new FormData(form),
                    headers: { 'Accept': 'application/json' },
                }).then(function (response) {
                    // session expiree (401) : on redirige vers la connexion, pas la peine d'afficher une erreur generique
                    if (response.status === 401) {
                        window.location.href = '{{ route('candidature.connexion') }}';
                        return false;
                    }
                    if (response.status === 422) {
                        return response.json().then(function (data) {
                            var messageAffiche = data.message;
                            // format de validation standard Laravel : { errors: { champ: [messages] } }
                            if (data.errors) {
                                messageAffiche = Object.values(data.errors).flat().join(' ');
                            }
                            saveStatus.className = 'text-center small text-danger fw-bold mb-4';
                            saveStatus.textContent = messageAffiche || texteEchecEnregistrement;
                            return false;
                        });
                    }
                    saveStatus.textContent = response.ok ? texteEnregistre : texteEchecEnregistrement;
                    return response.ok;
                }).catch(function () {
                    saveStatus.textContent = texteEchecEnregistrement;
                    return false;
                });
            }

            document.querySelectorAll('.js-next-step').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var currentStepEl = btn.closest('.wizard-step');
                    // on ne valide que les champs de l'etape actuellement visible :
                    // form.reportValidity() verifierait aussi les champs obligatoires
                    // caches des autres etapes, qui bloqueraient sans rien afficher
                    var invalids = currentStepEl.querySelectorAll(':invalid');
                    if (invalids.length > 0) {
                        invalids.forEach(function (el) { el.classList.add('is-invalid'); });
                        invalids[0].reportValidity();
                        invalids[0].focus();
                        return;
                    }
                    var stepActuelle = currentStepEl.getAttribute('data-step');
                    var stepSuivante = btn.getAttribute('data-next');
                    demarrerChargement(btn);
                    // la sauvegarde doit reussir AVANT de passer a l'etape suivante
                    sauvegarderProgression(stepActuelle).then(function (succes) {
                        arreterChargement(btn);
                        if (succes) {
                            marquerEtapeValidee(stepActuelle);
                            goToStep(stepSuivante);
                        }
                    });
                });
            });
            document.querySelectorAll('.js-prev-step').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var stepActuelle = btn.closest('.wizard-step').getAttribute('data-step');
                    var stepCible = btn.getAttribute('data-prev');
                    demarrerChargement(btn);
                    // on attend la confirmation d'enregistrement avant de changer d'etape,
                    // sinon la requete peut etre annulee si l'utilisateur navigue trop vite
                    sauvegarderProgression(stepActuelle).then(function () {
                        arreterChargement(btn);
                        goToStep(stepCible);
                    });
                });
            });
            // les badges en haut permettent de sauter directement a n'importe quelle etape
            badges.forEach(function (badge) {
                badge.addEventListener('click', function () {
                    var stepActuelle = document.querySelector('.wizard-step:not([hidden])').getAttribute('data-step');
                    var stepCible = badge.getAttribute('data-step-badge');
                    sauvegarderProgression(stepActuelle).then(function () {
                        goToStep(stepCible);
                    });
                });
            });
        })();
    </script>
@endsection
