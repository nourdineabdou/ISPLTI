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
          @foreach (\App\Models\Actualite::with(['images', 'videos', 'fichiers'])->where('statut', 'publie')->orderBy('created_at', 'desc')->get() as $actualite)
          @php
              $titre = app()->getLocale() == 'fr' ? $actualite->titre_fr : (app()->getLocale() == 'en' ? $actualite->titre_en : $actualite->titre_ar);
              $contenu = app()->getLocale() == 'fr' ? $actualite->contenu_fr : (app()->getLocale() == 'en' ? $actualite->contenu_en : $actualite->contenu_ar);
              $galleryKey = 'actualite-liste-' . $actualite->id;
              $mediaListe = $actualite->images->map(fn($i) => ['type' => 'image', 'url' => asset($i->chemin)])
                  ->concat($actualite->videos->map(fn($v) => ['type' => 'video', 'url' => asset($v->chemin)]));
          @endphp
          <div class="col-lg-6" style="min-width:0;" data-aos="fade-up" data-aos-delay="100">
            <article class="h-100 d-flex flex-column shadow-sm rounded-3 overflow-hidden bg-white" style="min-width:0;">
              <div class="post-img mb-0">
                <img src="{{ asset($actualite->image) }}" alt="{{ $titre }}" class="img-fluid">
              </div>
              <div class="p-3 d-flex flex-column flex-grow-1" style="min-width:0;">
                  {{-- titre est afficher selon la langue --}}
                  <p class="post-category mb-1 text-break">{{ $titre }}</p>
                  {{-- extrait du contenu riche selon la langue --}}
                  <h2 class="title h5 text-break"><a href="{{ route('pages.actualite.show', $actualite) }}">{{ \Illuminate\Support\Str::limit(strip_tags($contenu), 110) }}</a></h2>

                  <div class="d-flex align-items-center mb-3">
                    <div class="post-meta">
                      <p class="post-author-name mb-0">{{ $actualite->auteur }}</p>
                      {{-- format de date selon la langue --}}
                      <p class="post-date mb-0">{{ app()->getLocale() == 'fr' ? $actualite->created_at->format('d M Y') : (app()->getLocale() == 'en' ? $actualite->created_at->format('M d, Y') : $actualite->created_at->format('d M Y')) }}</p>
                    </div>
                  </div>

                  {{-- photos + videos : grille adaptative type Facebook --}}
                  <x-actualite.media-grid :media="$mediaListe" :galleryKey="$galleryKey" :max="4" />

                  {{-- fichiers telechargeables --}}
                  @if($actualite->fichiers->count())
                    <div class="d-flex flex-column gap-2 mb-3">
                        @foreach($actualite->fichiers as $fichier)
                            <a href="{{ asset($fichier->chemin) }}" target="_blank" class="download-card text-decoration-none shadow-sm rounded-3 d-flex align-items-center p-2">
                                <i class="bi {{ $fichier->iconClass() }} me-2" style="font-size:1.5rem;"></i>
                                <div class="text-truncate">
                                    <div class="small fw-bold text-truncate">{{ $fichier->nom(app()->getLocale()) }}</div>
                                    @if($fichier->description(app()->getLocale()))
                                        <div class="small text-muted text-truncate">{{ $fichier->description(app()->getLocale()) }}</div>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                  @endif

                  <a href="{{ route('pages.actualite.show', $actualite) }}" class="btn btn-sm btn-outline-primary mt-auto align-self-start">@lang('system.Lire_plus') &rarr;</a>
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
