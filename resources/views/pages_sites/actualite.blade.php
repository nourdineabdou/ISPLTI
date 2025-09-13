@extends('layouts_site.main')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>@lang('system.News_Title')</h1>
        <p>@lang('system.News_Desc')</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">@lang('system.Home')</a></li>
            <li class="current">@lang('system.News_Title')</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
    {{-- actualite for news --}}
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          @foreach (\App\Models\Actualite::orderBy('created_at', 'desc')->get() as $actualite)
          <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <article>
              <div class="post-img">
                <img src="{{ asset($actualite->image) }}" alt="" class="img-fluid">
              </div>
              {{-- titre est afficher selon la langue --}}
              <p class="post-category">{{ app()->getLocale() == 'fr' ? $actualite->titre_fr : (app()->getLocale() == 'en' ? $actualite->titre_en : $actualite->titre_ar) }}</p>
              {{-- description est afficher selon la langue --}}
              <h2 class="title"><a href="#">{{ app()->getLocale() == 'fr' ? $actualite->description_fr : (app()->getLocale() == 'en' ? $actualite->description_en : $actualite->description_ar) }}</a></h2>
              <div class="d-flex align-items-center">

                <div class="post-meta">
                  <p class="post-author-name">{{ $actualite->auteur }}</p>
                  {{-- format de date selon la langue --}}
                  <p class="post-date">{{ app()->getLocale() == 'fr' ? $actualite->created_at->format('d M Y') : (app()->getLocale() == 'en' ? $actualite->created_at->format('M d, Y') : $actualite->created_at->format('d M Y')) }}</p>
                </div>
              </div>
            </article>
          </div><!-- End post list item -->
          @endforeach
        </div><!-- End .row -->
        <div class="mt-4 d-flex flex-column flex-md-row align-items-center justify-content-between">
          <div class="mb-2 mb-md-0">
            {{-- pagination is rendered below; the custom view already shows "Affichage x–y sur z résultats" --}}
          </div>
        </div>
      </div>
@endsection
<!-- END: Content-->
