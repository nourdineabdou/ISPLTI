@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('isptli_apparences.png') }});">
      <div class="container position-relative">
        <h1>🎓 @lang('candidature.etape1_titre')</h1>
        <p>@lang('candidature.etape1_sous_titre')</p>
      </div>
    </div>

    <section class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- indicateur d'etapes --}}
                <div class="d-flex justify-content-center gap-3 mb-4">
                    <span class="badge rounded-pill px-3 py-2" style="background:#08915e;">1. @lang('candidature.step_identite')</span>
                    <span class="badge rounded-pill px-3 py-2 bg-secondary">2. @lang('candidature.step_parcours')</span>
                    <span class="badge rounded-pill px-3 py-2 bg-secondary">3. @lang('candidature.step_documents')</span>
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

                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                    <form method="POST" action="{{ route('candidature.etape1.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">@lang('candidature.master_vise') *</label>
                                <select name="master_id" class="form-select" required>
                                    @foreach($masters as $master)
                                        <option value="{{ $master->id }}" {{ old('master_id') == $master->id ? 'selected' : '' }}>{{ $master->intituleLocalise() }} ({{ $master->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('candidature.nom') *</label>
                                <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">@lang('candidature.prenom') *</label>
                                <input type="text" name="prenom" class="form-control" value="{{ old('prenom') }}" required maxlength="100">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.sexe')</label>
                                <select name="sexe" class="form-select">
                                    <option value="">--</option>
                                    <option value="Masculin" {{ old('sexe') == 'Masculin' ? 'selected' : '' }}>@lang('candidature.masculin')</option>
                                    <option value="Féminin" {{ old('sexe') == 'Féminin' ? 'selected' : '' }}>@lang('candidature.feminin')</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.date_naissance')</label>
                                <input type="date" name="date_naissance" class="form-control" value="{{ old('date_naissance') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.lieu_naissance')</label>
                                <input type="text" name="lieu_naissance" class="form-control" value="{{ old('lieu_naissance') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.nni') *</label>
                                <input type="text" name="nni" class="form-control" value="{{ old('nni') }}" required maxlength="50">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.telephone')</label>
                                <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.whatsapp')</label>
                                <input type="text" name="whatsapp" class="form-control" value="{{ old('whatsapp') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">@lang('candidature.email') *</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required maxlength="150">
                            </div>
                            <div class="col-12">
                                <label class="form-label">@lang('candidature.adresse')</label>
                                <textarea name="adresse" class="form-control" rows="2">{{ old('adresse') }}</textarea>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn text-white fw-bold px-5 py-3 rounded-pill" style="background:#08915e;" data-loading-text="@lang('candidature.traitement_en_cours')">
                                @lang('candidature.continuer_recevoir_lien') →
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
