@extends('layouts_site.main')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background position-relative" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>@lang('system.Student_Life')</h1>
        <p>@lang('system.Student_Life_Desc')</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ route('home') }}">@lang('system.Home')</a></li>
            <li class="current">@lang('system.Student_Life')</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Students Life Section -->
    <section id="students-life" class="students-life section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Hero Banner -->
        <div class="students-life-banner" data-aos="zoom-in" data-aos-delay="200">
          <div class="banner-content" data-aos="fade-right" data-aos-delay="300">
            <h2>@lang('system.Experience_Campus_Life')</h2>
            <p>@lang('system.Experience_Campus_Life_Desc')</p>
          </div>
          <img src="{{ asset('assets-lib/img/education/showcase-2.webp') }}" alt="Campus Life" class="img-fluid">
        </div>

        <!-- Life Categories -->
        <div class="life-categories mt-5" data-aos="fade-up" data-aos-delay="200">
          <div class="row g-4">
            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
              <div class="category-card">
                <div class="icon-container">
                  <i class="bi bi-people-fill"></i>
                </div>
                <h4>@lang('system.Clubs')</h4>
                <p>@lang('system.Clubs_Organizations')</p>
              </div>
            </div>

            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
              <div class="category-card">
                <div class="icon-container">
                  <i class="bi bi-trophy-fill"></i>
                </div>
                <h4>@lang('system.Athletics')</h4>
                <p>@lang('system.Athletics_Teams')</p>
              </div>
            </div>

            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
              <div class="category-card">
                <div class="icon-container">
                  <i class="bi bi-calendar-event"></i>
                </div>
                <h4>@lang('system.Events')</h4>
                <p>@lang('system.Events_Annual')</p>
              </div>
            </div>

            <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="400">
              <div class="category-card">
                <div class="icon-container">
                  <i class="bi bi-house-door-fill"></i>
                </div>
                <h4>@lang('system.Housing')</h4>
                <p>@lang('system.Housing_Residence_Halls')</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabs Section -->
        <div class="students-life-tabs mt-5" data-aos="fade-up" data-aos-delay="200">
          <ul class="nav nav-pills mb-4 justify-content-center" id="studentLifeTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="clubs-tab" data-bs-toggle="pill" data-bs-target="#students-life-clubs" type="button" role="tab" aria-controls="clubs" aria-selected="true">
                <i class="bi bi-people"></i> @lang('system.Clubs_Organizations_Tab')
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="athletics-tab" data-bs-toggle="pill" data-bs-target="#students-life-athletics" type="button" role="tab" aria-controls="athletics" aria-selected="false">
                <i class="bi bi-trophy"></i> @lang('system.Athletics_Tab')
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="facilities-tab" data-bs-toggle="pill" data-bs-target="#students-life-facilities" type="button" role="tab" aria-controls="facilities" aria-selected="false">
                <i class="bi bi-building"></i> @lang('system.Campus_Facilities_Tab')
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="support-tab" data-bs-toggle="pill" data-bs-target="#students-life-support" type="button" role="tab" aria-controls="support" aria-selected="false">
                <i class="bi bi-shield-check"></i> @lang('system.Support_Services_Tab')
              </button>
            </li>
          </ul>

          <div class="tab-content" id="studentLifeTabsContent">
            <!-- Clubs & Organizations Tab -->
            <div class="tab-pane fade show active" id="students-life-clubs" role="tabpanel" aria-labelledby="clubs-tab">
              <div class="row g-4">
                <div class="col-lg-5" data-aos="fade-right" data-aos-delay="200">
                  <div class="tab-content-image">
                    <img src="{{ asset('assets-lib/img/education/students-2.webp') }}" alt="Student Clubs" class="img-fluid rounded">
                    <div class="stat-badge">
                      <span class="number">50+</span>
                      <span class="text">@lang('system.Active_Clubs')</span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-7" data-aos="fade-left" data-aos-delay="300">
                  <div class="tab-content-text">
                    <h3>@lang('system.Join_Community_Title')</h3>
                    <p>@lang('system.Join_Community_Desc')</p>

                    <div class="row g-3 mt-4">
                      <div class="col-md-6">
                        <div class="club-category">
                          <div class="icon-box">
                            <i class="bi bi-palette"></i>
                          </div>
                          <div class="content">
                            <h5>@lang('system.Arts_Culture')</h5>
                            <p>@lang('system.Arts_Culture_Organizations')</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="club-category">
                          <div class="icon-box">
                            <i class="bi bi-globe"></i>
                          </div>
                          <div class="content">
                            <h5>@lang('system.International')</h5>
                            <p>@lang('system.International_Organizations')</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="club-category">
                          <div class="icon-box">
                            <i class="bi bi-lightbulb"></i>
                          </div>
                          <div class="content">
                            <h5>@lang('system.Academic')</h5>
                            <p>@lang('system.Academic_Organizations')</p>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="club-category">
                          <div class="icon-box">
                            <i class="bi bi-music-note-beamed"></i>
                          </div>
                          <div class="content">
                            <h5>@lang('system.Music')</h5>
                            <p>@lang('system.Music_Organizations')</p>
                          </div>
                        </div>
                      </div>
                    </div>

                    <a href="#" class="btn btn-explore mt-4">@lang('system.Explore_All_Clubs') <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Athletics Tab -->
            <div class="tab-pane fade" id="students-life-athletics" role="tabpanel" aria-labelledby="athletics-tab">
              <div class="row g-4 mb-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                  <h3>@lang('system.Athletics_Recreation_Programs')</h3>
                  <p>@lang('system.Athletics_Recreation_Desc')</p>
                  <a href="#" class="btn btn-explore">@lang('system.View_Athletics_Calendar') <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                  <div class="stats-container">
                    <div class="stat-item">
                      <span class="number">15+</span>
                      <span class="label">@lang('system.Sports_Teams')</span>
                    </div>
                    <div class="stat-item">
                      <span class="number">20+</span>
                      <span class="label">@lang('system.Championships')</span>
                    </div>
                    <div class="stat-item">
                      <span class="number">300+</span>
                      <span class="label">@lang('system.Athletes')</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="athletic-programs-slider swiper init-swiper" data-aos="fade-up" data-aos-delay="400">
                <script type="application/json" class="swiper-config">
                  {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                      "delay": 5000
                    },
                    "slidesPerView": 1,
                    "spaceBetween": 30,
                    "pagination": {
                      "el": ".swiper-pagination",
                      "type": "bullets",
                      "clickable": true
                    },
                    "breakpoints": {
                      "576": {
                        "slidesPerView": 2
                      },
                      "992": {
                        "slidesPerView": 3
                      },
                      "1200": {
                        "slidesPerView": 4
                      }
                    }
                  }
                </script>
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="sport-card">
                      <img src="{{ asset('assets-lib/img/education/activities-2.webp') }}" class="img-fluid" loading="lazy" alt="Swimming">
                      <div class="sport-info">
                        <h5>@lang('system.Swimming')</h5>
                        <div class="badge">@lang('system.Varsity')</div>
                      </div>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="sport-card">
                      <img src="{{ asset('assets-lib/img/education/activities-4.webp') }}" class="img-fluid" loading="lazy" alt="Basketball">
                      <div class="sport-info">
                        <h5>@lang('system.Basketball')</h5>
                        <div class="badge">@lang('system.Varsity')</div>
                      </div>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="sport-card">
                      <img src="{{ asset('assets-lib/img/education/activities-6.webp') }}" class="img-fluid" loading="lazy" alt="Soccer">
                      <div class="sport-info">
                        <h5>@lang('system.Soccer')</h5>
                        <div class="badge">@lang('system.Varsity')</div>
                      </div>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="sport-card">
                      <img src="{{ asset('assets-lib/img/education/activities-8.webp') }}" class="img-fluid" loading="lazy" alt="Tennis">
                      <div class="sport-info">
                        <h5>@lang('system.Tennis')</h5>
                        <div class="badge">@lang('system.Varsity')</div>
                      </div>
                    </div>
                  </div>

                  <div class="swiper-slide">
                    <div class="sport-card">
                      <img src="{{ asset('assets-lib/img/education/activities-10.webp') }}" class="img-fluid" loading="lazy" alt="Volleyball">
                      <div class="sport-info">
                        <h5>@lang('system.Volleyball')</h5>
                        <div class="badge">@lang('system.Varsity')</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>

            <!-- Facilities Tab -->
            <div class="tab-pane fade" id="students-life-facilities" role="tabpanel" aria-labelledby="facilities-tab">
              <div class="row g-4">
                <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
                  <div class="facilities-gallery">
                    <div class="row g-3">
                      <div class="col-md-8">
                        <img src="{{ asset('assets/img/education/campus-4.webp') }}" alt="Housing" class="img-fluid rounded">
                      </div>
                      <div class="col-md-4">
                        <img src="{{ asset('assets/img/education/campus-5.webp') }}" alt="Dining" class="img-fluid rounded">
                      </div>
                      <div class="col-md-4">
                        <img src="{{ asset('assets/img/education/campus-6.webp') }}" alt="Library" class="img-fluid rounded">
                      </div>
                      <div class="col-md-8">
                        <img src="{{ asset('assets/img/education/campus-7.webp') }}" alt="Recreation" class="img-fluid rounded">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="300">
                  <div class="facilities-info">
                  <h3>@lang('system.Modern_Campus_Facilities')</h3>
                  <p>@lang('system.Modern_Campus_Facilities_Desc')</p>

                    <div class="facilities-list">
                      <div class="facility-item">
                        <i class="bi bi-house-door"></i>
                        <h5>@lang('system.Residence_Halls')</h5>
                        <p>@lang('system.Residence_Halls_Desc')</p>
                      </div>

                      <div class="facility-item">
                        <i class="bi bi-cup-hot"></i>
                        <h5>@lang('system.Dining_Options')</h5>
                        <p>@lang('system.Dining_Options_Desc')</p>
                      </div>

                      <div class="facility-item">
                        <i class="bi bi-book"></i>
                        <h5>@lang('system.Libraries')</h5>
                        <p>@lang('system.Libraries_Desc')</p>
                      </div>

                      <div class="facility-item">
                        <i class="bi bi-bicycle"></i>
                        <h5>@lang('system.Recreation_Center')</h5>
                        <p>@lang('system.Recreation_Center_Desc')</p>
                      </div>
                    </div>

                    <a href="#" class="btn btn-explore mt-3">@lang('system.Virtual_Campus_Tour') <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Support Services Tab -->
            <div class="tab-pane fade" id="students-life-support" role="tabpanel" aria-labelledby="support-tab">
              <div class="row g-4">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                  <div class="support-card">
                    <div class="icon">
                      <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h5>@lang('system.Health_Wellness')</h5>
                    <p>@lang('system.Health_Wellness_Desc')</p>
                    <a href="#" class="service-link">@lang('system.Learn_More') <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                  <div class="support-card">
                    <div class="icon">
                      <i class="bi bi-briefcase"></i>
                    </div>
                    <h5>@lang('system.Career_Services')</h5>
                    <p>@lang('system.Career_Services_Desc')</p>
                    <a href="#" class="service-link">@lang('system.Learn_More') <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                  <div class="support-card">
                    <div class="icon">
                      <i class="bi bi-universal-access"></i>
                    </div>
                    <h5>@lang('system.Accessibility')</h5>
                    <p>@lang('system.Accessibility_Desc')</p>
                    <a href="#" class="service-link">@lang('system.Learn_More') <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>

                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                  <div class="support-card">
                    <div class="icon">
                      <i class="bi bi-mortarboard"></i>
                    </div>
                    <h5>@lang('system.Academic_Support')</h5>
                    <p>@lang('system.Academic_Support_Desc')</p>
                    <a href="#" class="service-link">@lang('system.Learn_More') <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              <div class="row mt-5" data-aos="fade-up" data-aos-delay="500">
                <div class="col-md-6 offset-md-3 text-center">
                  <div class="contact-info-box">
                    <h4>@lang('system.Need_Assistance')</h4>
                    <p>@lang('system.Student_Support_Availability')</p>
                    <a href="#" class="btn btn-explore mt-2">@lang('system.Contact_Student_Services') <i class="bi bi-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Student Life Gallery -->
        <div class="students-life-gallery mt-5" data-aos="fade-up" data-aos-delay="200">
          <div class="section-header text-center">
            <h3>@lang('system.Life_on_Campus')</h3>
            <p>@lang('system.Life_on_Campus_Desc')</p>
          </div>

          <div class="row g-3">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
              <a href="{{asset('assets-lib/img/education/students-1.webp') }}" class="gallery-item glightbox">
                <img src="{{asset('assets-lib/img/education/students-1.webp') }}" class="img-fluid" loading="lazy" alt="Student Life">
                <div class="gallery-overlay">
                  <span>@lang('system.Campus_Events')</span>
                </div>
              </a>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
              <a href="{{asset('assets-lib/img/education/students-2.webp') }}" class="gallery-item glightbox">
                <img src="{{asset('assets-lib/img/education/students-2.webp') }}" class="img-fluid" loading="lazy" alt="Student Life">
                <div class="gallery-overlay">
                  <span>@lang('system.Student_Clubs')</span>
                </div>
              </a>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
              <a href="{{asset('assets-lib/img/education/students-3.webp') }}" class="gallery-item glightbox">
                <img src="{{asset('assets-lib/img/education/students-3.webp') }}" class="img-fluid" loading="lazy" alt="Student Life">
                <div class="gallery-overlay">
                  <span>@lang('system.Graduation_Day')</span>
                </div>
              </a>
            </div>

            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="400">
              <a href="{{ asset('assets-lib/img/education/students-4.webp') }}" class="gallery-item glightbox">
                <img src="{{ asset('assets-lib/img/education/students-4.webp') }}" class="img-fluid" loading="lazy" alt="Student Life">
                <div class="gallery-overlay">
                  <span>@lang('system.Study_Groups')</span>
                </div>
              </a>
            </div>

            <div class="col-md-6" data-aos="zoom-in" data-aos-delay="500">
              <a href="{{ asset('assets-lib/img/education/students-5.webp') }}" class="gallery-item glightbox">
                <img src="{{ asset('assets-lib/img/education/students-5.webp') }}" class="img-fluid" loading="lazy" alt="Student Life">
                <div class="gallery-overlay">
                  <span>@lang('system.Campus_Facilities')</span>
                </div>
              </a>
            </div>
          </div>
        </div>

        <!-- CTA -->
        <div class="cta-wrapper mt-5" data-aos="fade-up" data-aos-delay="200">
          <div class="cta-content">
            <div class="row align-items-center">
              <div class="col-lg-8" data-aos="fade-right" data-aos-delay="300">
                <h3>@lang('system.Ready_to_Join_Community')</h3>
                <p>@lang('system.Ready_to_Join_Community_Desc')</p>
              </div>
              <div class="col-lg-4" data-aos="fade-left" data-aos-delay="400">
                <div class="cta-buttons">
                  <a href="#" class="btn btn-primary">@lang('system.Schedule_a_Visit')</a>
                  <a href="#" class="btn btn-outline">@lang('system.Apply_Now')</a>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Students Life Section -->
@endsection
