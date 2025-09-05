@extends('layouts_site.main')
    @section('content')<!-- Section Héros -->
            <section id="hero" class="hero section dark-background">
                <div class="hero-container">
                    <video autoplay muted loop playsinline class="video-background">
                    <source src="assets-lib/img/education/video-2.mp4" type="video/mp4">
                    </video>
                    <div class="overlay"></div>
                    <div class="container">
                <div class="row align-items-center @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                        <div class="col-lg-7 @if(app()->getLocale() == 'ar') order-2 @endif" data-aos="zoom-out" data-aos-delay="100">
                         
                        <div class="hero-content">
                           <h1>
                          
                              
                                 @if(app()->getLocale() == 'ar')
                                 <marquee direction="right" scrollamount="5" bgcolor="yellow" style="color: white; padding: 10px;" dir="rtl">
                                         {{ $news->lib_etab_ar }}
                                    </marquee>
                                 @else
                                    <marquee style="background-color: yellow; color: white; padding: 10px;">
                                        {{ $news->lib_etab_fr }}
                                     </marquee>
                                 @endif
                               
                            </h1>
                            <p>@lang('system.Institut_slogan')</p>
                            <div class="cta-buttons">
                            <a href="#" class="btn-primary">@lang('system.Cta_commencez_parcours')</a>
                            <a href="#" class="btn-secondary">@lang('system.Cta_decouvrir_programmes')</a>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-5 @if(app()->getLocale() == 'ar') order-1 @endif" data-aos="zoom-out" data-aos-delay="200">
                        <div class="stats-card">
                            <div class="stats-header">
                            <h3>@lang('system.Pourquoi_nous_choisir')</h3>
                            <div class="decoration-line"></div>
                            </div>
                            <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-icon">
                                <i class="bi bi-trophy-fill"></i>
                                </div>
                                <div class="stat-content">
                                <h4>71%</h4>
                                <p>@lang('system.Emploi_diplomes')</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                <i class="bi bi-globe"></i>
                                </div>
                                <div class="stat-content">
                                <h4>2+</h4>
                                <p>@lang('system.Partenaires_internationaux')</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                <i class="bi bi-mortarboard"></i>
                                </div>
                                <div class="stat-content">
                                <h4>185</h4>
                                <p>@lang('system.Ratio_etudiants_enseignants')</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                <i class="bi bi-building"></i>
                                </div>
                                <div class="stat-content">
                                <h4>9+</h4>
                                <p>@lang('system.Programmes_diplomants')</p>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>                </div>

                <div class="event-ticker">
                    <div class="container">
                    <div class="row gy-4">
                        <div class="col-md-6 col-xl-4 col-12 ticker-item">
                        <span class="date">15 NOV</span>
                        <span class="title">@lang('system.Journee_portes_ouvertes')</span>
                        <a href="#" class="btn-register">@lang('system.S_inscrire')</a>
                        </div>
                        <div class="col-md-6 col-12 col-xl-4  ticker-item">
                        <span class="date">5 DÉC</span>
                        <span class="title">@lang('system.Atelier_candidature')</span>
                        <a href="#" class="btn-register">@lang('system.S_inscrire')</a>
                        </div>
                        <div class="col-md-6 col-12 col-xl-4 ticker-item">
                        <span class="date">10 JAN</span>
                        <span class="title">@lang('system.Orientation_etudiants_internationaux')</span>
                        <a href="#" class="btn-register">@lang('system.S_inscrire')</a>
                        </div>
                    </div>
                    </div>
                </div>
            </section><!-- /Section Héros -->

            <!-- Section À propos -->
            <section id="about" class="about section">

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    {{-- start --}}
                    <div class="row mb-5 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                    <div class="col-lg-6 pe-lg-5 @if(app()->getLocale() == 'ar') order-2 @endif" data-aos="fade-right" data-aos-delay="200">
                        <h2 class="display-6 fw-bold mb-4">@lang('system.Eveiller_les_esprits'), <span>@lang('system.Façonner_les_avenirs')</span></h2>
                        <p class="lead mb-4">@lang('system.Institut_engagement')</p>
                            <!-- Présentation de l'institut (RTL pour arabe, LTR autrement) -->
                            @if(app()->getLocale() == 'ar')
                                <div class="col-md-12 mt-4" dir="rtl" lang="ar" style="font-family: 'Cairo', 'Tajawal', Arial, sans-serif;">
                            @else
                                <div class="col-md-12 mt-4" lang="{{ app()->getLocale() }}" style="font-family: 'Cairo', 'Tajawal', Arial, sans-serif;">
                            @endif
                                <p>@lang('system.Institut_description')</p>
                                <h5 class="fw-bold mt-3 mb-2">@lang('system.Training_Offers_Title')</h5>
                                <ul>
                                    <li>@lang('system.Training_Offer_1')</li>
                                    <li>@lang('system.Training_Offer_2')</li>
                                    <li>@lang('system.Training_Offer_3')</li>
                                </ul>
                                <h5 class="fw-bold mt-3 mb-2">@lang('system.Employment_Opportunities_Title')</h5>
                                <ul>
                                    <li>@lang('system.Employment_Opportunity_1')</li>
                                    <li>@lang('system.Employment_Opportunity_2')</li>
                                    <li>@lang('system.Employment_Opportunity_3')</li>
                                    <li>@lang('system.Employment_Opportunity_4')</li>
                                    <li>@lang('system.Employment_Opportunity_5')</li>
                                    <li>@lang('system.Employment_Opportunity_6')</li>
                                    <li>@lang('system.Employment_Opportunity_7')</li>
                                    <li>@lang('system.Employment_Opportunity_8')</li>
                                </ul>
                            </div>
                        <div class="d-flex flex-wrap gap-4 mb-4">
                        <div class="stat-box">
                            <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="9" data-purecounter-duration="1" class="purecounter"></span>+</span>
                            <span class="stat-label">@lang('system.Années')</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="1222" data-purecounter-duration="1" class="purecounter"></span>+</span>
                            <span class="stat-label">@lang('system.Étudiants')</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-number"><span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>+</span>
                            <span class="stat-label">@lang('system.Enseignants')</span>
                        </div>
                        </div>
                        <div class="d-flex align-items-center mt-4 signature-block">
                        <img src="assets-lib/img/misc/signature-1.webp" alt="Principal's Signature" width="120">
                        <div class="ms-3">
                            <p class="mb-0 fw-bold">Dr. Safia Oumoulmouminine Amar</p>
                            <p class="mb-0 text-muted">Directrice</p>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6 @if(app()->getLocale() == 'ar') order-1 @endif" data-aos="fade-left" data-aos-delay="300">
                        <div class="image-stack">
                        <div class="image-stack-item image-stack-item-top" data-aos="zoom-in" data-aos-delay="400">
                            <img src="assets-lib/img/lisp/lisp1.webp" alt="Campus Life" class="img-fluid rounded-4 shadow-lg">
                        </div>
                        <div class="image-stack-item image-stack-item-bottom" data-aos="zoom-in" data-aos-delay="500">
                            <img src="assets-lib/img/lisp/info_2.webp" alt="Students" class="img-fluid rounded-4 shadow-lg">
                        </div>
                        </div>
                    </div>
                    </div>

                    <div class="row mission-vision-row g-4 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi bi-rocket-takeoff"></i>
                            </div>
                            <h3>@lang('system.Notre_mission')</h3>
                            <p>@lang('system.Notre_mission_desc')</p>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi bi-eye"></i>
                            </div>
                            <h3>@lang('system.Notre_vision')</h3>
                            <p>@lang('system.Notre_vision_desc')</p>
                            </div>
                        </div>
                        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="value-card h-100">
                            <div class="card-icon">
                                <i class="bi bi-star"></i>
                            </div>
                            <h3>@lang('system.Nos_valeurs')</h3>
                            <p>@lang('system.Nos_valeurs_desc')</p>
                            </div>
                        </div>
                    </div>
                     {{-- end --}}
                </div>

            </section><!-- /About Section -->

            <!-- Section Programmes phares -->
            <section id="featured-programs" class="featured-programs section">

                <!-- Section Title -->
                <div class="container section-title @if(app()->getLocale() == 'ar') text-end @endif" data-aos="fade-up">
                    <h2>@lang('system.Programmes_phares')   </h2>
                    <p>@lang('system.Programmes_phares_desc')</p>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">

                    <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <ul class="program-filters isotope-filters @if(app()->getLocale() == 'ar') justify-content-end @endif" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">@lang('system.Tous_les_programmes')</li>
                        <li data-filter=".filter-bachelor">@lang('system.Licence')</li>
                        <li data-filter=".filter-master">@lang('system.Master')</li>
                        <li data-filter=".filter-certificate">@lang('system.Certificats')</li>
                    </ul>

                    <div class="row g-4 isotope-container @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                        <div class="col-lg-6 isotope-item filter-bachelor" data-aos="zoom-in" data-aos-delay="100">
                        <div class="program-item">
                            <div class="program-badge">@lang('system.Licence')</div>
                            <div class="row g-0">
                            <div class="col-md-4">
                                <div class="program-image-wrapper">
                                <img src="assets-lib/img/education/education-1.webp" class="img-fluid" alt="Program">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="program-content">
                                <h3>@lang('system.Langue_ang_ar')</h3>
                                <div class="program-highlights">
                                <span><i class="bi bi-clock"></i> 3 سنوات  </span>
                                <span><i class="bi bi-people-fill"></i> الأرصدة 180 </span>
                                <span><i class="bi bi-calendar3"></i> اكتوبر &amp; يونيو</span>
                                </div>
                                <p>@lang('system.Formation_langues')</p>
                                <a href="#" class="program-btn"><span>@lang('system.En_savoir_plus')</span> <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-bachelor" data-aos="zoom-in" data-aos-delay="200">
                        <div class="program-item">
                            <div class="program-badge">@lang('system.Licence')</div>
                            <div class="row g-0">
                            <div class="col-md-4">
                                <div class="program-image-wrapper">
                                <img src="assets-lib/img/education/education-3.webp" class="img-fluid" alt="Program">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="program-content">
                                <h3>@lang('system.Langue_ang_fr')</h3>
                                <div class="program-highlights">
                                <span><i class="bi bi-clock"></i> 3 سنوات  </span>
                                <span><i class="bi bi-people-fill"></i> الأرصدة 180 </span>
                                <span><i class="bi bi-calendar3"></i> اكتوبر &amp; يونيو</span>
                                </div>
                                <p>@lang('system.Formation_langues')</p>
                                <a href="#" class="program-btn"><span>@lang('system.En_savoir_plus')</span> <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-bachelor" data-aos="zoom-in" data-aos-delay="300">
                        <div class="program-item">
                            <div class="program-badge">@lang('system.Licence')</div>
                            <div class="row g-0">
                            <div class="col-md-4">
                                <div class="program-image-wrapper">
                                <img src="assets-lib/img/education/education-5.webp" class="img-fluid" alt="Program">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="program-content">
                                <h3>@lang('system.Langue_ar_fr')</h3>
                                <div class="program-highlights">
                                <span><i class="bi bi-clock"></i> 3 سنوات  </span>
                                <span><i class="bi bi-people-fill"></i> الأرصدة 180 </span>
                                <span><i class="bi bi-calendar3"></i> اكتوبر &amp; يونيو</span>
                                </div>
                                <p>@lang('system.Formation_langues')</p>
                                <a href="#" class="program-btn"><span>@lang('system.En_savoir_plus')</span> <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-master" data-aos="zoom-in" data-aos-delay="100">
                        <div class="program-item">
                            <div class="program-badge">@lang('system.Master')</div>
                            <div class="row g-0">
                            <div class="col-md-4">
                                <div class="program-image-wrapper">
                                <img src="assets-lib/img/education/education-7.webp" class="img-fluid" alt="Program">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="program-content">
                                <h3>@lang('system.master_ang_ar')</h3>
                                <div class="program-highlights">
                                <span><i class="bi bi-clock"></i> سنتين</span>
                                <span><i class="bi bi-people-fill"></i> 120 رصيد </span>
                                <span><i class="bi bi-calendar3"></i>  اكتوبر &amp; يونيو</span>
                                </div>
                                <p>@lang('system.Formation_langues')</p>
                                <a href="#" class="program-btn"><span>@lang('system.En_savoir_plus')</span> <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div><!-- End Program Item -->

                        <div class="col-lg-6 isotope-item filter-master" data-aos="zoom-in" data-aos-delay="200">
                        <div class="program-item">
                            <div class="program-badge">@lang('system.Formation_continue')</div>
                            <div class="row g-0">
                            <div class="col-md-4">
                                <div class="program-image-wrapper">
                                <img src="assets-lib/img/education/education-9.webp" class="img-fluid" alt="Program">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="program-content">
                                <h3>@lang('system.Formation_continue')</h3>
                                <div class="program-highlights">
                                <span><i class="bi bi-clock"></i> </span>
                                <span><i class="bi bi-people-fill"></i>50 ساعة</span>
                                <span><i class="bi bi-calendar3"></i> </span>
                                </div>
                                <p>@lang('system.Formation_mecanique')</p>
                                <a href="#" class="program-btn"><span>@lang('system.En_savoir_plus')</span> <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div><!-- End Program Item -->

                       <!-- End Program Item -->

                    </div>
                    </div>

                </div>

            </section><!-- /Featured Programs Section -->

            <!-- Section Vie étudiante -->
            <section id="students-life-block" class="students-life-block section">

            <!-- Section Title -->
            <div class="container section-title @if(app()->getLocale() == 'ar') text-end @endif" data-aos="fade-up">
                <h2>@lang('system.Vie_Etudiante')</h2>
                <p>@lang('system.Vie_etudiante_description')</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center gy-4 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                <div class="col-lg-6 @if(app()->getLocale() == 'ar') order-2 @endif" data-aos="fade-right" data-aos-delay="200">
                    <div class="students-life-img position-relative">
                    <img src="assets-lib/img/education/education-square-11.webp" class="img-fluid rounded-4 shadow-sm" alt="Students Life">
                    <div class="img-overlay">
                        <h3>@lang('system.Decouvrez_vie_campus')</h3>
                        <a href="students-life.html" class="explore-btn">@lang('system.En_savoir_plus') <i class="bi bi-arrow-right"></i></a>
                    </div>
                    </div>
                </div>

                <div class="col-lg-6 @if(app()->getLocale() == 'ar') order-1 @endif" data-aos="fade-left" data-aos-delay="300">
                    <div class="students-life-content">

                    <div class="row g-4 mb-4 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="student-activity-item">
                            <div class="icon-box">
                            <i class="bi bi-people"></i>
                            </div>
                            <h4>@lang('system.Clubs_etudiants')</h4>
                            <p>@lang('system.Clubs_etudiants_desc')</p>
                        </div>
                        </div>

                        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="300">
                        <div class="student-activity-item">
                            <div class="icon-box">
                            <i class="bi bi-trophy"></i>
                            </div>
                            <h4>@lang('system.Evenements_sportifs')</h4>
                            <p>@lang('system.Evenements_sportifs_desc')</p>
                        </div>
                        </div>

                        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="400">
                        <div class="student-activity-item">
                            <div class="icon-box">
                            <i class="bi bi-music-note-beamed"></i>
                            </div>
                            <h4>@lang('system.Arts_Culture')</h4>
                            <p>@lang('system.Arts_Culture_desc')</p>
                        </div>
                        </div>

                        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="500">
                        <div class="student-activity-item">
                            <div class="icon-box">
                            <i class="bi bi-globe-americas"></i>
                            </div>
                            <h4>@lang('system.Experiences_internationales')</h4>
                            <p>@lang('system.Experiences_internationales_desc')</p>
                        </div>
                        </div>
                    </div>

                    <div class="students-life-cta" data-aos="fade-up" data-aos-delay="600">
                        <a href="students-life.html" class="btn btn-primary">@lang('system.Voir_activites_etudiantes')</a>
                    </div>
                    </div>
                </div>
                </div>

            </div>

            </section><!-- /Students Life Block Section -->

            <!-- Section Témoignages -->
            <section id="testimonials" class="testimonials section">

            <!-- Section Title -->
            <div class="container section-title @if(app()->getLocale() == 'ar') text-end @endif" data-aos="fade-up">
                <h2>@lang('system.Temoignages')</h2>
                <p>@lang('system.Temoignages_desc')</p>
            </div><!-- End Section Title -->

            <div class="container @if(app()->getLocale() == 'ar') text-end @endif">

                <div class="testimonial-masonry @if(app()->getLocale() == 'ar') text-end @endif">

                <div class="testimonial-item" data-aos="fade-up">
                    <div class="testimonial-content">
                    <div class="quote-pattern">
                        <i class="bi bi-quote"></i>
                    </div>
                    <p>@lang('system.Temoignage_1')</p>
                    <div class="client-info">
                        <div class="client-image">
                        <img src="assets-lib/img/person/person-f-7.webp" alt="Client">
                        </div>
                        <div class="client-details">
                        <h3>Rachel Bennett</h3>
                        <span class="position">Strategy Director</span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-content">
                    <div class="quote-pattern">
                        <i class="bi bi-quote"></i>
                    </div>
                    <p>@lang('system.Temoignage_2')</p>
                    <div class="client-info">
                        <div class="client-image">
                        <img src="assets-lib/img/person/person-m-7.webp" alt="Client">
                        </div>
                        <div class="client-details">
                        <h3>Daniel Morgan</h3>
                        <span class="position">Chief Innovation Officer</span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-content">
                    <div class="quote-pattern">
                        <i class="bi bi-quote"></i>
                    </div>
                    <p>@lang('system.Temoignage_3')</p>
                    <div class="client-info">
                        <div class="client-image">
                        <img src="assets-lib/img/person/person-f-8.webp" alt="Client">
                        </div>
                        <div class="client-details">
                        <h3>Emma Thompson</h3>
                        <span class="position">Digital Lead</span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-content">
                    <div class="quote-pattern">
                        <i class="bi bi-quote"></i>
                    </div>
                    <p>@lang('system.Temoignage_4')</p>
                    <div class="client-info">
                        <div class="client-image">
                        <img src="assets-lib/img/person/person-m-8.webp" alt="Client">
                        </div>
                        <div class="client-details">
                        <h3>Christopher Lee</h3>
                        <span class="position">Technical Director</span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="testimonial-item highlight" data-aos="fade-up" data-aos-delay="400">
                    <div class="testimonial-content">
                    <div class="quote-pattern">
                        <i class="bi bi-quote"></i>
                    </div>
                    <p>@lang('system.Temoignage_5')</p>
                    <div class="client-info">
                        <div class="client-image">
                        <img src="assets-lib/img/person/person-f-9.webp" alt="Client">
                        </div>
                        <div class="client-details">
                        <h3>Olivia Carter</h3>
                        <span class="position">Product Manager</span>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="testimonial-item" data-aos="fade-up" data-aos-delay="500">
                    <div class="testimonial-content">
                    <div class="quote-pattern">
                        <i class="bi bi-quote"></i>
                    </div>
                    <p>@lang('system.Temoignage_6')</p>
                    <div class="client-info">
                        <div class="client-image">
                        <img src="assets-lib/img/person/person-m-13.webp" alt="Client">
                        </div>
                        <div class="client-details">
                        <h3>Nathan Brooks</h3>
                        <span class="position">UX Director</span>
                        </div>
                    </div>
                    </div>
                </div>

                </div>

            </div>

            </section><!-- /Testimonials Section -->

            <!-- Section Statistiques -->
            <section id="stats" class="stats section">

            <div class="container @if(app()->getLocale() == 'ar') text-end @endif" data-aos="fade-up" data-aos-delay="100">

                <div class="row @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                <div class="col-lg-6 @if(app()->getLocale() == 'ar') order-2 @endif">
                    <div class="stats-overview" data-aos="fade-right" data-aos-delay="200">
                    <h2 class="stats-title">@lang('system.Excellence_educative')</h2>
                    <p class="stats-description">@lang('system.Stats_description')</p>
                    <div class="stats-cta">
                        <a href="#" class="btn btn-primary">@lang('system.En_savoir_plus')</a>
                        <a href="#" class="btn btn-outline">@lang('system.Visite_virtuelle')</a>
                    </div>
                    </div>
                </div>
                <div class="col-lg-6 @if(app()->getLocale() == 'ar') order-1 @endif">
                    <div class="row g-4 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                    <div class="col-md-6">
                        <div class="stats-card" data-aos="zoom-in" data-aos-delay="300">
                        <div class="stats-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stats-number">
                            <span data-purecounter-start="0" data-purecounter-end="94" data-purecounter-duration="1" class="purecounter"></span>%
                        </div>
                        <div class="stats-label">@lang('system.Taux_reussite')</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stats-card" data-aos="zoom-in" data-aos-delay="400">
                        <div class="stats-icon">
                            <i class="bi bi-person-workspace"></i>
                        </div>
                        <div class="stats-number">
                            <span data-purecounter-start="0" data-purecounter-end="185" data-purecounter-duration="1" class="purecounter"></span>
                        </div>
                        <div class="stats-label">@lang('system.Ratio_etudiants_enseignants')</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stats-card" data-aos="zoom-in" data-aos-delay="500">
                        <div class="stats-icon">
                            <i class="bi bi-award"></i>
                        </div>
                        <div class="stats-number">
                            <span data-purecounter-start="0" data-purecounter-end="1" data-purecounter-duration="1" class="purecounter"></span>+
                        </div>
                        <div class="stats-label">@lang('system.Programmes_academiques')</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stats-card" data-aos="zoom-in" data-aos-delay="600">
                        <div class="stats-icon">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div class="stats-number"><span data-purecounter-start="0" data-purecounter-end="" data-purecounter-duration="1" class="purecounter"></span>
                        </div>
                        <div class="stats-label">@lang('system.Financement_recherche')</div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <div class="row mt-5 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                <div class="col-lg-12">
                    <div class="achievements-gallery" data-aos="fade-up" data-aos-delay="700">
                    <div class="row g-4 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                        <div class="col-md-4">
                        <div class="achievement-item">
                            <img src="assets-lib/img/education/education-1.webp" alt="Achievement" class="img-fluid">
                            <div class="achievement-content">
                            <h4>@lang('system.Programmes_excellence')</h4>
                            <p>@lang('system.Programmes_excellence_desc')</p>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="achievement-item">
                            <img src="assets-lib/img/education/education-2.webp" alt="Achievement" class="img-fluid">
                            <div class="achievement-content">
                            <h4>@lang('system.Installations_modernes')</h4>
                            <p>@lang('system.Installations_modernes_desc')</p>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="achievement-item">
                            <img src="assets-lib/img/education/education-3.webp" alt="Achievement" class="img-fluid">
                            <div class="achievement-content">
                            <h4>@lang('system.Reseau_anciens_international')</h4>
                            <p>@lang('system.Reseau_anciens_international_desc')</p>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

            </div>

            </section><!-- /Stats Section -->

            <!-- Section Actualités -->
            <section id="recent-news" class="recent-news section">

            <!-- Section Title -->
            <div class="container section-title @if(app()->getLocale() == 'ar') text-end @endif" data-aos="fade-up">
                <h2>@lang('system.Actualites')</h2>
                <p>@lang('system.Actualites_desc')</p>
            </div><!-- End Section Title -->

            <div class="container @if(app()->getLocale() == 'ar') text-end @endif">

                <div class="row gy-4 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <article>

                    <div class="post-img">
                        <img src="assets-lib/img/blog/blog-post-1.webp" alt="" class="img-fluid">
                    </div>

                    <p class="post-category">Politique</p>

                    <h2 class="title">
                        <a href="blog-details.html">Dolorum optio tempore voluptas dignissimos</a>
                    </h2>

                    <div class="d-flex align-items-center">
                        <img src="assets-lib/img/person/person-f-12.webp" alt="" class="img-fluid post-author-img flex-shrink-0">
                        <div class="post-meta">
                        <p class="post-author">Maria Doe</p>
                        <p class="post-date">
                            <time datetime="2022-01-01">1 Janv. 2022</time>
                        </p>
                        </div>
                    </div>

                    </article>
                </div><!-- End post list item -->

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <article>

                    <div class="post-img">
                        <img src="assets-lib/img/blog/blog-post-2.webp" alt="" class="img-fluid">
                    </div>

                    <p class="post-category">Sports</p>

                    <h2 class="title">
                        <a href="blog-details.html">Nisi magni odit consequatur autem nulla dolorem</a>
                    </h2>

                    <div class="d-flex align-items-center">
                        <img src="assets-lib/img/person/person-f-13.webp" alt="" class="img-fluid post-author-img flex-shrink-0">
                        <div class="post-meta">
                        <p class="post-author">Allisa Mayer</p>
                        <p class="post-date">
                            <time datetime="2022-01-01">5 Juin 2022</time>
                        </p>
                        </div>
                    </div>

                    </article>
                </div><!-- End post list item -->

                <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <article>

                    <div class="post-img">
                        <img src="assets-lib/img/blog/blog-post-3.webp" alt="" class="img-fluid">
                    </div>

                    <p class="post-category">Divertissement</p>

                    <h2 class="title">
                        <a href="blog-details.html">Possimus soluta ut id suscipit ea ut in quo quia et soluta</a>
                    </h2>

                    <div class="d-flex align-items-center">
                        <img src="assets-lib/img/person/person-m-10.webp" alt="" class="img-fluid post-author-img flex-shrink-0">
                        <div class="post-meta">
                        <p class="post-author">Mark Dower</p>
                        <p class="post-date">
                            <time datetime="2022-01-01">22 Juin 2022</time>
                        </p>
                        </div>
                    </div>

                    </article>
                </div><!-- End post list item -->

                </div><!-- End recent posts list -->

            </div>

            </section><!-- /Recent News Section -->

            <!-- Section Événements -->
            <section id="events" class="events section">

            <!-- Section Title -->
            <div class="container section-title @if(app()->getLocale() == 'ar') text-end @endif" data-aos="fade-up">
                <h2>@lang('system.Evenements')</h2>
                <p>@lang('system.Evenements_desc')</p>
            </div><!-- End Section Title -->

            <div class="container @if(app()->getLocale() == 'ar') text-end @endif" data-aos="fade-up" data-aos-delay="100">

                <div class="event-filters mb-4 @if(app()->getLocale() == 'ar') text-end @endif">
                <div class="row justify-content-center g-3 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
                    <div class="col-md-4">
                    <select class="form-select">
                        <option selected="">@lang('system.Tous_les_mois')</option>
                        <option>@lang('system.Janvier')</option>
                        <option>@lang('system.Fevrier')</option>
                        <option>@lang('system.Mars')</option>
                        <option>@lang('system.Avril')</option>
                        <option>@lang('system.Mai')</option>
                        <option>@lang('system.Juin')</option>
                    </select>
                    </div>
                    <div class="col-md-4">
                    <select class="form-select">
                        <option selected="">@lang('system.Toutes_les_categories')</option>
                        <option>@lang('system.Academique')</option>
                        <option>@lang('system.Arts')</option>
                        <option>@lang('system.Sports')</option>
                        <option>@lang('system.Communaute')</option>
                    </select>
                    </div>
                </div>
                </div>

                <div class="row g-4 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">

                <div class="col-lg-6">
                    <div class="event-card">
                    <div class="event-date">
                        <span class="month">FEB</span>
                        <span class="day">15</span>
                        <span class="year">2025</span>
                    </div>
                    <div class="event-content">
                        <div class="event-tag academic">@lang('system.Academique')</div>
                        <h3>@lang('system.Exposition_scientifique')</h3>
                        <p>@lang('system.Exposition_scientifique_desc')</p>
                        <div class="event-meta">
                        <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>09:00 AM - 03:00 PM</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Main Auditorium</span>
                        </div>
                        </div>
                        <div class="event-actions">
                        <a href="#" class="btn-learn-more">Learn More</a>
                        <a href="#" class="btn-calendar"><i class="bi bi-calendar-plus"></i> Add to Calendar</a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="event-card">
                    <div class="event-date">
                        <span class="month">MAR</span>
                        <span class="day">10</span>
                        <span class="year">2025</span>
                    </div>
                    <div class="event-content">
                        <div class="event-tag sports">@lang('system.Sports')</div>
                        <h3>@lang('system.Journee_sportive_annuelle')</h3>
                        <p>@lang('system.Journee_sportive_annuelle_desc')</p>
                        <div class="event-meta">
                        <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>08:30 AM - 05:00 PM</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>School Playground</span>
                        </div>
                        </div>
                        <div class="event-actions">
                        <a href="#" class="btn-learn-more">Learn More</a>
                        <a href="#" class="btn-calendar"><i class="bi bi-calendar-plus"></i> Add to Calendar</a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="event-card">
                    <div class="event-date">
                        <span class="month">APR</span>
                        <span class="day">22</span>
                        <span class="year">2025</span>
                    </div>
                    <div class="event-content">
                        <div class="event-tag arts">@lang('system.Arts')</div>
                        <h3>@lang('system.Concert_printemps')</h3>
                        <p>@lang('system.Concert_printemps_desc')</p>
                        <div class="event-meta">
                        <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>06:30 PM - 08:30 PM</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Performing Arts Center</span>
                        </div>
                        </div>
                        <div class="event-actions">
                        <a href="#" class="btn-learn-more">Learn More</a>
                        <a href="#" class="btn-calendar"><i class="bi bi-calendar-plus"></i> Add to Calendar</a>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="event-card">
                    <div class="event-date">
                        <span class="month">MAY</span>
                        <span class="day">8</span>
                        <span class="year">2025</span>
                    </div>
                    <div class="event-content">
                        <div class="event-tag community">@lang('system.Communaute')</div>
                        <h3>@lang('system.Rencontre_parents_professeurs')</h3>
                        <p>@lang('system.Rencontre_parents_professeurs_desc')</p>
                        <div class="event-meta">
                        <div class="meta-item">
                            <i class="bi bi-clock"></i>
                            <span>01:00 PM - 07:00 PM</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-geo-alt"></i>
                            <span>Various Classrooms</span>
                        </div>
                        </div>
                        <div class="event-actions">
                        <a href="#" class="btn-learn-more">Learn More</a>
                        <a href="#" class="btn-calendar"><i class="bi bi-calendar-plus"></i> Add to Calendar</a>
                        </div>
                    </div>
                    </div>
                </div>

                </div>

                <div class="text-center mt-5 @if(app()->getLocale() == 'ar') text-end @endif">
                <a href="#" class="btn-view-all">@lang('system.Voir_tous_evenements')</a>
                </div>

            </div>

            </section><!-- /Events Section -->
@endsection
