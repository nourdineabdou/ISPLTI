@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>🔐 @lang('candidature.definir_mdp_titre')</h1>
      </div>
    </div>

    <section class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                    <p class="text-muted text-center mb-4">@lang('candidature.definir_mdp_texte')</p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('candidature.definirMotDePasse.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('candidature.mot_de_passe') *</label>
                            <input type="password" name="mot_de_passe" class="form-control" required minlength="6">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('candidature.confirmer_mot_de_passe') *</label>
                            <input type="password" name="mot_de_passe_confirmation" class="form-control" required minlength="6">
                        </div>
                        <button type="submit" class="btn w-100 text-white fw-bold py-3 rounded-pill" style="background:#08915e;" data-loading-text="@lang('candidature.traitement_en_cours')">
                            @lang('candidature.activer_mon_espace')
                        </button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
