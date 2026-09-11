@extends('layouts_site.main')
@section('content')
    @php
        $statutStyles = [
            'brouillon' => ['bg' => '#6c757d', 'label' => __('candidature.statut_brouillon')],
            'soumis' => ['bg' => '#0dcaf0', 'label' => __('candidature.statut_soumis')],
            'en_cours' => ['bg' => '#ffc107', 'label' => __('candidature.statut_en_cours')],
            'accepte' => ['bg' => '#08915e', 'label' => __('candidature.statut_accepte')],
            'refuse' => ['bg' => '#dc3545', 'label' => __('candidature.statut_refuse')],
        ];
        $style = $statutStyles[$candidature->statut] ?? $statutStyles['brouillon'];
    @endphp
    <div class="page-title dark-background" style="background-image: url( {{ asset('isptli_apparences.png') }});">
      <div class="container position-relative">
        <h1>🗂️ @lang('candidature.espace_titre')</h1>
        <p>{{ $candidature->prenom }} {{ $candidature->nom }} — {{ $candidature->numero_candidature }}</p>
      </div>
    </div>

    <section class="posts">
      <div class="container" data-aos="fade-up">
        @if(session('error'))
            <div class="alert alert-warning">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            {{-- colonne photo / statut / actions --}}
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 rounded-4 p-4 text-center">
                    @if($photo)
                        <img src="{{ route('candidature.image', $candidature->id) }}" alt="{{ $candidature->prenom }}" class="rounded-circle mx-auto mb-3" style="width:130px;height:130px;object-fit:cover;border:4px solid #08915e;">
                    @else
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width:130px;height:130px;font-size:2.2rem;">
                            {{ strtoupper(substr($candidature->nom, 0, 1)) }}
                        </div>
                    @endif

                    <form action="{{ route('candidature.photo.update') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                        @csrf
                        <label class="btn btn-outline-secondary btn-sm mb-0" style="cursor:pointer;">
                            📷 @lang('candidature.changer_photo')
                            <input type="file" name="photo" accept="image/*" class="d-none" onchange="this.form.submit()">
                        </label>
                    </form>

                    <h4 class="mb-1">{{ $candidature->prenom }} {{ $candidature->nom }}</h4>
                    <p class="text-muted small mb-3">{{ $candidature->master->intituleLocalise() }}</p>

                    <span class="badge rounded-pill px-3 py-2 text-white mb-3" style="background:{{ $style['bg'] }};">{{ $style['label'] }}</span>

                    @if($candidature->statut === 'refuse' && $candidature->commentaire_admin)
                        <div class="alert alert-light border small text-start">
                            <strong>@lang('candidature.motif_refus') :</strong> {{ $candidature->commentaire_admin }}
                        </div>
                    @endif

                    @if($candidature->statut === 'brouillon')
                        <a href="{{ route('candidature.suite') }}" class="btn text-white fw-bold py-2 rounded-pill d-block mb-2" style="background:#08915e;">
                            @lang('candidature.completer_mon_dossier')
                        </a>
                    @endif

                    <a href="{{ route('candidature.deconnexion') }}" class="btn btn-outline-secondary btn-sm d-block">@lang('candidature.deconnexion')</a>
                </div>
            </div>

            {{-- colonne informations --}}
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0 rounded-4 p-4 mb-3">
                    <h5 class="mb-3">👤 @lang('candidature.step_identite')</h5>
                    <div class="row">
                        <div class="col-sm-6 mb-2"><strong>@lang('candidature.email') :</strong> {{ $candidature->email }}</div>
                        <div class="col-sm-6 mb-2"><strong>@lang('candidature.telephone') :</strong> {{ $candidature->telephone ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>@lang('candidature.whatsapp') :</strong> {{ $candidature->whatsapp ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>@lang('candidature.date_naissance') :</strong> {{ optional($candidature->date_naissance)->format('d/m/Y') ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>@lang('candidature.lieu_naissance') :</strong> {{ $candidature->lieu_naissance ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>@lang('candidature.nationalite') :</strong> {{ $candidature->nationalite ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>@lang('candidature.nni') :</strong> {{ $candidature->nni ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>@lang('candidature.adresse') :</strong> {{ $candidature->adresse ?? '-' }}</div>
                    </div>
                </div>

                @if($candidature->situation_professionnelle || $candidature->profession)
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-3">
                        <h5 class="mb-3">💼 @lang('candidature.situation_professionnelle_titre')</h5>
                        <div class="row">
                            <div class="col-sm-4 mb-2"><strong>@lang('candidature.situation_professionnelle') :</strong> {{ $candidature->situation_professionnelle ?? '-' }}</div>
                            <div class="col-sm-4 mb-2"><strong>@lang('candidature.profession') :</strong> {{ $candidature->profession ?? '-' }}</div>
                            <div class="col-sm-4 mb-2"><strong>@lang('candidature.organisme_employeur') :</strong> {{ $candidature->organisme_employeur ?? '-' }}</div>
                        </div>
                    </div>
                @endif

                @if($candidature->diplomes->count())
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-3">
                        <h5 class="mb-3">🎓 @lang('candidature.diplomes_titre')</h5>
                        @foreach($candidature->diplomes as $d)
                            <div class="mb-2 pb-2 border-bottom">
                                <strong>{{ $d->type_diplome }} — {{ $d->intitule }}</strong>
                                <div class="small text-muted">{{ $d->etablissement }} {{ $d->annee_obtention ? '('.$d->annee_obtention.')' : '' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($candidature->langues->count())
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-3">
                        <h5 class="mb-3">🗣️ @lang('candidature.langues_titre')</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($candidature->langues as $l)
                                <span class="badge rounded-pill border text-dark px-3 py-2">{{ optional($l->langue)->langue }} — {{ $l->niveau }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($candidature->experiencesProfessionnelles->count())
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-3">
                        <h5 class="mb-3">🧳 @lang('candidature.experiences_pro_titre')</h5>
                        @foreach($candidature->experiencesProfessionnelles as $exp)
                            <div class="mb-2 pb-2 border-bottom">
                                <strong>{{ $exp->poste ?? '-' }}</strong> — {{ $exp->employeur }}
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(optional($candidature->projetsRecherche->first())->titre)
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-3">
                        <h5 class="mb-3">🔬 @lang('candidature.projet_recherche_titre')</h5>
                        <strong>{{ $candidature->projetsRecherche->first()->titre }}</strong>
                        <p class="small text-muted mb-0">{{ $candidature->projetsRecherche->first()->resume }}</p>
                    </div>
                @endif

                @if($candidature->documents->count())
                    <div class="card shadow-sm border-0 rounded-4 p-4 mb-3">
                        <h5 class="mb-3">📎 @lang('candidature.photo_pieces_titre')</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($candidature->documents as $doc)
                                <span class="badge rounded-pill border text-dark px-3 py-2">✓ {{ $doc->type_document }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
      </div>
    </section>
@endsection
