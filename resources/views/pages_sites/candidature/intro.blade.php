@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>🎓 @lang('candidature.titre_page')</h1>
        <p>@lang('candidature.sous_titre_intro')</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">@lang('system.Home')</a></li>
            <li class="current">@lang('candidature.breadcrumb_candidature')</li>
          </ol>
        </nav>
      </div>
    </div>

    <section class="posts">
      <div class="container" data-aos="fade-up">
        @if(session('error'))
            <div class="alert alert-warning">{{ session('error') }}</div>
        @endif

        @if($master)
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5 text-center">
                        <h2 class="h3 mb-3" style="color:#08915e;">{{ $master->intituleLocalise() }}</h2>
                        <p class="text-muted mb-1">
                            @lang('candidature.annee_universitaire') : {{ $master->annee_universitaire }}<br>
                            @lang('candidature.parcours_label') : {{ $master->intituleLocalise() }} ({{ $master->code }})<br>
                            @lang('candidature.campus') : {{ $master->campus }}
                        </p>
                        @if($master->descriptionLocalisee())
                            <p class="mt-3">{{ $master->descriptionLocalisee() }}</p>
                        @endif
                        <div class="d-flex justify-content-center gap-4 my-4 flex-wrap">
                            <div><i class="bi bi-calendar-event text-success"></i> @lang('candidature.periode_candidature', ['debut' => \Carbon\Carbon::parse($master->date_debut_candidature)->format('d/m/Y'), 'fin' => \Carbon\Carbon::parse($master->date_fin_candidature)->format('d/m/Y')])</div>
                        </div>
                        <a href="{{ route('candidature.etape1') }}" class="btn btn-lg text-white fw-bold px-5 py-3 rounded-pill mx-auto" style="background:#08915e;width:fit-content;">
                            ✍️ @lang('candidature.postuler_maintenant')
                        </a>
                        <p class="small text-muted mt-3 mb-0">@lang('candidature.info_3_etapes')</p>
                        <p class="small mt-3 mb-0">
                            <a href="{{ route('candidature.connexion') }}" style="color:#08915e;">🔑 @lang('candidature.deja_candidat')</a>
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center">@lang('candidature.aucun_master')</div>
        @endif
      </div>
    </section>
@endsection
