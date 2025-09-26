<footer id="footer" class="bg-dark text-white py-5 @if(app()->getLocale() == 'ar') text-end @endif">
  <div class="container">
    <div class="row gy-4 align-items-start @if(app()->getLocale() == 'ar') flex-row-reverse @endif">

      <div class="col-lg-3 col-md-6">
        <a href="{{ url('/') }}" class="d-flex align-items-center mb-3">
          @if(file_exists(public_path('logo.jpeg')))
            <img src="{{ asset('logo.jpeg') }}" alt="ISPLTI" style="height:64px; object-fit:contain;">
          @else
            <span class="h4 mb-0">ISPLTI</span>
          @endif
        </a>
        <p class="muted small">@lang('system.Description_courte', ['name' => 'ISPLTI'])</p>

        <div class="d-flex gap-3 mt-3">
          <a href="#" class="text-white"><i class="bi bi-linkedin fs-4"></i></a>
          <a href="#" class="text-white"><i class="bi bi-twitter fs-4"></i></a>
          <a href="#" class="text-white"><i class="bi bi-facebook fs-4"></i></a>
          <a href="#" class="text-white"><i class="bi bi-rss fs-4"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <h6 class="fw-semibold">@lang('system.Administrations')</h6>
        <ul class="list-unstyled mt-3">
          <li class="py-1"> <a href="{{ route('pages.directeur') }}" class="text-white">@lang('system.Directeur')</a> </li>
          <li class="py-1">@lang('system.Secretaire_general')</li>
          <li class="py-1">@lang('system.Services')</li>
          <li class="py-1">@lang('system.Service_financier')</li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <h6 class="fw-semibold">@lang('system.Textes_legaux')</h6>
        <ul class="list-unstyled mt-3">
          <li class="py-1"><a href="#" class="text-white">@lang('system.Reglements')</a></li>
          <li class="py-1"><a href="#" class="text-white">@lang('system.Politique_confidentialite')</a></li>
          <li class="py-1"><a href="#" class="text-white">@lang('system.Documents_officiels')</a></li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6">
        <h6 class="fw-semibold">@lang('system.Contact')</h6>
        <p class="small muted mb-1">@lang('system.Adresse') : </p>
        <p class="small muted mb-1">@lang('system.Telephone') : </p>
        <p class="small muted mb-1">Email : <a href="mailto:istisplti16@gmail.com" class="text-white">istisplti16@gmail.com</a></p>
      </div>

    </div>

    <div class="row mt-4">
      <div class="col-12 text-center small muted">
        <p class="mb-1">© @lang('system.Droits_auteur') <strong class="px-1">ISPLTI</strong> @lang('system.Tous_droits_reserves')</p>
        <p class="mb-0">@lang('system.Conception_par') <a href="https://nourdine.dev" class="text-white">SPF-SARL</a></p>
      </div>
    </div>

</footer>
