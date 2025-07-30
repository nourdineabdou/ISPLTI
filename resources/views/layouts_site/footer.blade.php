<footer id="footer" class="footer position-relative dark-background @if(app()->getLocale() == 'ar') text-end @endif">
    <div class="container footer-top">
      <div class="row gy-4 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">ISPLTI</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Rue 108 Adam</p>
            <p>Dakar, Sénégal</p>
            <p class="mt-3"><strong>Téléphone :</strong> <span>+221 33 123 45 67</span></p>
            <p><strong>Email :</strong> <span>contact@isplti.sn</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>@lang('system.Liens_utiles')</h4>
          <ul>
            <li><a href="#">@lang('system.Accueil')</a></li>
            <li><a href="#">@lang('system.A_propos')</a></li>
            <li><a href="#">@lang('system.Services')</a></li>
            <li><a href="#">@lang('system.Conditions_utilisation')</a></li>
            <li><a href="#">@lang('system.Politique_confidentialite')</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>@lang('system.Nos_services')</h4>
          <ul>
            <li><a href="#">@lang('system.Conception_web')</a></li>
            <li><a href="#">@lang('system.Developpement_web')</a></li>
            <li><a href="#">@lang('system.Gestion_projet')</a></li>
            <li><a href="#">@lang('system.Marketing')</a></li>
            <li><a href="#">@lang('system.Design_graphique')</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>@lang('system.Ressources')</h4>
          <ul>
            <li><a href="#">@lang('system.Documents_officiels')</a></li>
            <li><a href="#">@lang('system.Dignites')</a></li>
            <li><a href="#">@lang('system.Distinctions')</a></li>
            <li><a href="#">@lang('system.Evenements')</a></li>
            <li><a href="#">@lang('system.Contact')</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>@lang('system.Informations')</h4>
          <ul>
            <li><a href="#">@lang('system.Infos_pratiques')</a></li>
            <li><a href="#">@lang('system.Reunions')</a></li>
            <li><a href="#">@lang('system.Diner_annuel')</a></li>
            <li><a href="#">@lang('system.Conferences')</a></li>
            <li><a href="#">@lang('system.Flexibilite')</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>@lang('system.Droits_auteur')</span> <strong class="px-1 sitename">ISPLTI</strong> <span>@lang('system.Tous_droits_reserves')</span></p>
      <div class="credits">
        <!-- Tous les liens du pied de page doivent rester intacts. -->
        <!-- Vous pouvez supprimer les liens uniquement si vous avez acheté la version pro. -->
        <!-- Informations sur la licence : https://bootstrapmade.com/license/ -->
        <!-- Achetez la version pro avec formulaire de contact PHP/AJAX fonctionnel : [buy-url] -->
        @lang('system.Conception_par')
        <a href="https://bootstrapmade.com/">Nourdine</a>
      </div>
    </div>

</footer>
