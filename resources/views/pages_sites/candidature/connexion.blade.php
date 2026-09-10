@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>🔑 @lang('candidature.connexion_titre')</h1>
      </div>
    </div>

    <section class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('candidature.connexion.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">@lang('candidature.identifiant') *</label>
                            <input type="text" name="identifiant" class="form-control" value="{{ old('identifiant') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('candidature.mot_de_passe') *</label>
                            <input type="password" name="mot_de_passe" class="form-control" required>
                        </div>
                        <button type="submit" class="btn w-100 text-white fw-bold py-3 rounded-pill" style="background:#08915e;" data-loading-text="@lang('candidature.traitement_en_cours')">
                            @lang('candidature.se_connecter')
                        </button>
                    </form>

                    <p class="text-center text-muted small mt-4 mb-0">
                        @lang('candidature.pas_encore_candidat')
                        <a href="{{ route('candidature.intro') }}" style="color:#08915e;">@lang('candidature.postuler_maintenant')</a>
                    </p>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
