/**
* Template Name: NiceSchool
* Template URL: https://bootstrapmade.com/nice-school-bootstrap-education-template/
* Updated: May 10 2025 with Bootstrap v5.3.6
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/

(function() {
  "use strict";

  /**
   * Apply .scrolled class to the body as the page is scrolled down
   */
  function toggleScrolled() {
    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');
    if (!selectHeader.classList.contains('scroll-up-sticky') && !selectHeader.classList.contains('sticky-top') && !selectHeader.classList.contains('fixed-top')) return;
    window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
  }

  document.addEventListener('scroll', toggleScrolled);
  window.addEventListener('load', toggleScrolled);

  /**
   * Mobile nav toggle
   */
  const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

  function mobileNavToogle() {
    document.querySelector('body').classList.toggle('mobile-nav-active');
    mobileNavToggleBtn.classList.toggle('bi-list');
    mobileNavToggleBtn.classList.toggle('bi-x');
  }
  if (mobileNavToggleBtn) {
    mobileNavToggleBtn.addEventListener('click', mobileNavToogle);
  }

  /**
   * Hide mobile nav on same-page/hash links
   */
  document.querySelectorAll('#navmenu a').forEach(navmenu => {
    navmenu.addEventListener('click', () => {
      if (document.querySelector('.mobile-nav-active')) {
        mobileNavToogle();
      }
    });

  });

  /**
   * Toggle mobile nav dropdowns
   */
  document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
    navmenu.addEventListener('click', function(e) {
      e.preventDefault();
      this.parentNode.classList.toggle('active');
      this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
      e.stopImmediatePropagation();
    });
  });

  /**
   * Preloader
   */
  const preloader = document.querySelector('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove();
    });
  }

  /**
   * Scroll top button
   */
  let scrollTop = document.querySelector('.scroll-top');

  function toggleScrollTop() {
    if (scrollTop) {
      window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
    }
  }
  scrollTop.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });

  window.addEventListener('load', toggleScrollTop);
  document.addEventListener('scroll', toggleScrollTop);

  /**
   * Animation on scroll function and init
   */
  function aosInit() {
    AOS.init({
      duration: 600,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  }
  window.addEventListener('load', aosInit);

  /**
   * Initiate Pure Counter
   */
  new PureCounter();

  /**
   * Init isotope layout and filters
   */
  document.querySelectorAll('.isotope-layout').forEach(function(isotopeItem) {
    let layout = isotopeItem.getAttribute('data-layout') ?? 'masonry';
    let filter = isotopeItem.getAttribute('data-default-filter') ?? '*';
    let sort = isotopeItem.getAttribute('data-sort') ?? 'original-order';

    let initIsotope;
    imagesLoaded(isotopeItem.querySelector('.isotope-container'), function() {
      initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
        itemSelector: '.isotope-item',
        layoutMode: layout,
        filter: filter,
        sortBy: sort
      });
    });

    isotopeItem.querySelectorAll('.isotope-filters li').forEach(function(filters) {
      filters.addEventListener('click', function() {
        isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
        this.classList.add('filter-active');
        initIsotope.arrange({
          filter: this.getAttribute('data-filter')
        });
        if (typeof aosInit === 'function') {
          aosInit();
        }
      }, false);
    });

  });

  /**
   * Init swiper sliders
   */
  function initSwiper() {
    document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
      let config = JSON.parse(
        swiperElement.querySelector(".swiper-config").innerHTML.trim()
      );

      if (swiperElement.classList.contains("swiper-tab")) {
        initSwiperWithCustomPagination(swiperElement, config);
      } else {
        new Swiper(swiperElement, config);
      }
    });
  }

  window.addEventListener("load", initSwiper);

  /**
   * Initiate glightbox
   */
  const glightbox = GLightbox({
    selector: '.glightbox'
  });

  /**
   * Marquer en rouge (Bootstrap .is-invalid) tout champ invalide des qu'on
   * tente de valider/soumettre le formulaire qui le contient, et retirer
   * ce marquage des que le champ redevient valide.
   */
  document.addEventListener('invalid', function (e) {
    if (e.target && e.target.classList) {
      e.target.classList.add('is-invalid');
    }
  }, true); // phase de capture : l'evenement "invalid" ne remonte pas (bubbles: false)

  ['input', 'change'].forEach(function (eventName) {
    document.addEventListener(eventName, function (e) {
      const field = e.target;
      if (field && field.classList && field.classList.contains('is-invalid') && typeof field.checkValidity === 'function' && field.checkValidity()) {
        field.classList.remove('is-invalid');
      }
    });
  });

  /**
   * Desactiver le bouton d'envoi et afficher un spinner "en traitement"
   * des qu'un formulaire est reellement soumis (evite le double-clic).
   * Ne se declenche que si le formulaire est valide (l'evenement submit
   * n'est pas emis par le navigateur tant qu'il reste des champs invalides).
   */
  document.addEventListener('submit', function (e) {
    const form = e.target;
    if (!(form instanceof HTMLFormElement)) return;
    const btn = form.querySelector('button[type="submit"]:not([data-no-spinner])');
    if (!btn || btn.disabled) return;
    btn.dataset.originalHtml = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + (btn.dataset.loadingText || 'Traitement en cours...');
  });

  /**
   * Sur une page en arabe (RTL), un champ texte/textarea contenant une
   * valeur en français/latin s'affichait coupe/inverse (le navigateur
   * alignait le texte a droite comme le reste de la page). On force
   * dir="auto" sur les champs de saisie pour que chacun s'aligne selon
   * sa propre langue detectee, y compris les lignes ajoutees dynamiquement
   * (repeteurs diplomes/langues/experiences...).
   */
  function applyAutoDirection(el) {
    if (el.hasAttribute && !el.hasAttribute('dir')) {
      const tag = el.tagName;
      const type = (el.getAttribute('type') || 'text').toLowerCase();
      const textLikeTypes = ['text', 'email', 'tel', 'search', 'url'];
      if (tag === 'TEXTAREA' || (tag === 'INPUT' && textLikeTypes.includes(type))) {
        el.setAttribute('dir', 'auto');
      }
    }
  }

  document.querySelectorAll('input, textarea').forEach(applyAutoDirection);

  new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      mutation.addedNodes.forEach(function (node) {
        if (node.nodeType !== 1) return;
        applyAutoDirection(node);
        if (node.querySelectorAll) {
          node.querySelectorAll('input, textarea').forEach(applyAutoDirection);
        }
      });
    });
  }).observe(document.body, { childList: true, subtree: true });

})();