@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>⚠️ @lang('candidature.lien_invalide_titre')</h1>
      </div>
    </div>
    <section class="posts">
      <div class="container text-center" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                    <p>@lang('candidature.lien_invalide_texte')</p>
                    <a href="{{ route('candidature.intro') }}" class="btn text-white mx-auto mt-2" style="background:#08915e;width:fit-content;">@lang('candidature.recommencer_candidature')</a>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
