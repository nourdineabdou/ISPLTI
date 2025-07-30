@extends('layouts_site.main')
    @section('content')
        <!-- Page Title -->
        <div class="page-title dark-background" style="background-image: url(  {{asset('assets-lib/img/education/showcase-1.webp') }});">
        <div class="container position-relative">
            <h1>@lang('system.About_Title')</h1>
            <p>@lang('system.About_Desc')</p>
            <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">@lang('system.Home')</a></li>
                <li class="current">@lang('system.About_Title')</li>
            </ol>
            </nav>
        </div>
        </div><!-- End Page Title -->

        <!-- History Section -->
        <section id="history" class="history section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-content" data-aos="fade-up" data-aos-delay="200">
                <h3>@lang('system.Our_Story')</h3>
                <h2>@lang('system.Educating_Minds_Inspiring_Hearts')</h2>
                <p>@lang('system.Our_Story_Desc')</p>

                <div class="timeline">
                    <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>1965</h4>
                        <p>@lang('system.Timeline_1965')</p>
                    </div>
                    </div>

                    <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>1982</h4>
                        <p>@lang('system.Timeline_1982')</p>
                    </div>
                    </div>

                    <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>1998</h4>
                        <p>@lang('system.Timeline_1998')</p>
                    </div>
                    </div>

                    <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>2010</h4>
                        <p>@lang('system.Timeline_2010')</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="about-image" data-aos="zoom-in" data-aos-delay="300">
                <img src="{{ asset('assets-lib/img/education/campus-5.webp') }}" alt="Campus" class="img-fluid rounded">

                <div class="mission-vision" data-aos="fade-up" data-aos-delay="400">
                    <div class="mission">
                    <h3>@lang('system.Our_Mission')</h3>
                    <p>@lang('system.Our_Mission_Desc')</p>
                    </div>

                    <div class="vision">
                    <h3>@lang('system.Our_Vision')</h3>
                    <p>@lang('system.Our_Vision_Desc')</p>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <div class="row mt-5">
            <div class="col-lg-12">
                <div class="core-values" data-aos="fade-up" data-aos-delay="500">
                <h3 class="text-center mb-4">@lang('system.Core_Values')</h3>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col">
                    <div class="value-card">
                        <div class="value-icon">
                        <i class="bi bi-book"></i>
                        </div>
                        <h4>@lang('system.Academic_Excellence')</h4>
                        <p>@lang('system.Academic_Excellence_Desc')</p>
                    </div>
                    </div>

                    <div class="col">
                    <div class="value-card">
                        <div class="value-icon">
                        <i class="bi bi-people"></i>
                        </div>
                        <h4>@lang('system.Community_Engagement')</h4>
                        <p>@lang('system.Community_Engagement_Desc')</p>
                    </div>
                    </div>

                    <div class="col">
                    <div class="value-card">
                        <div class="value-icon">
                        <i class="bi bi-lightbulb"></i>
                        </div>
                        <h4>@lang('system.Innovation')</h4>
                        <p>@lang('system.Innovation_Desc')</p>
                    </div>
                    </div>

                    <div class="col">
                    <div class="value-card">
                        <div class="value-icon">
                        <i class="bi bi-globe"></i>
                        </div>
                        <h4>@lang('system.Global_Perspective')</h4>
                        <p>@lang('system.Global_Perspective_Desc')</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>

        </div>

        </section><!-- /History Section -->

        <!-- Leadership Section -->
        <section id="leadership" class="leadership section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row mb-5">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <h3 class="section-subtitle">@lang('system.Meet_Our_Leadership')</h3>
                <h2 class="section-heading">@lang('system.Dedicated_Administration')</h2>
                <p class="section-description">@lang('system.Leadership_Desc')</p>
                <div class="stats-container mt-4">
                <div class="row">
                    <div class="col-md-4 col-6">
                    <div class="stat-item">
                        <h3>25+</h3>
                        <p>@lang('system.Years_of_Excellence')</p>
                    </div>
                    </div>
                    <div class="col-md-4 col-6">
                    <div class="stat-item">
                        <h3>45+</h3>
                        <p>@lang('system.Faculty_Members')</p>
                    </div>
                    </div>
                    <div class="col-md-4 col-6">
                    <div class="stat-item">
                        <h3>98%</h3>
                        <p>@lang('system.Student_Success')</p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="about-image">
                <img src="{{ asset('assets-lib/img/education/teacher-1.webp') }}" alt="Our Leadership Team" class="img-fluid rounded">
                </div>
            </div>
            </div>

            <div class="leadership-team">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="leader-card">
                    <div class="leader-image">
                    <img src="{{ asset('assets-lib/img/person/person-m-2.webp') }}" alt="Principal" class="img-fluid">
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                    </div>
                    </div>
                    <div class="leader-info">
                    <h4>@lang('Nom1')</h4>
                    <p class="position">@lang('system.Principal')</p>
                    <p class="bio">@lang('system.Principal_Bio')</p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="leader-card">
                    <div class="leader-image">
                    <img src="{{ asset('assets-lib/img/person/person-f-3.webp') }}" alt="Vice Principal" class="img-fluid">
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                    </div>
                    </div>
                    <div class="leader-info">
                    <h4>@lang('Nom2')</h4>
                    <p class="position">@lang('system.Vice_Principal')</p>
                    <p class="bio">@lang('system.Vice_Principal_Bio')</p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="leader-card">
                    <div class="leader-image">
                    <img src="{{ asset('assets-lib/img/person/person-m-5.webp') }}" alt="Dean of Students" class="img-fluid">
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                    </div>
                    </div>
                    <div class="leader-info">
                    <h4>@lang('Nom2')</h4>
                    <p class="position">@lang('system.Dean_of_Students')</p>
                    <p class="bio">@lang('system.Dean_of_Students_Bio')</p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="leader-card">
                    <div class="leader-image">
                    <img src="{{ asset('assets-lib/img/person/person-f-8.webp') }}" alt="Academic Director" class="img-fluid">
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                    </div>
                    </div>
                    <div class="leader-info">
                    <h4>@lang('Nom1')</h4>
                    <p class="position">@lang('system.Academic_Director')</p>
                    <p class="bio">@lang('system.Academic_Director_Bio')</p>
                    </div>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="leader-card">
                    <div class="leader-image">
                    <img src="{{ asset('assets-lib/img/person/person-m-7.webp') }}" alt="Financial Director" class="img-fluid">
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                    </div>
                    </div>
                    <div class="leader-info">
                    <h4>@lang('Nom3')</h4>
                    <p class="position">@lang('system.Financial_Director')</p>
                    <p class="bio">@lang('system.Financial_Director_Bio')</p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="leader-card">
                    <div class="leader-image">
                    <img src="{{ asset('assets-lib/img/person/person-f-10.webp') }}" alt="Head of Admissions" class="img-fluid">
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                    </div>
                    </div>
                    <div class="leader-info">
                    <h4>@lang('Nom4')</h4>
                    <p class="position">@lang('system.Head_of_Admissions')</p>
                    <p class="bio">@lang('system.Head_of_Admissions_Bio')</p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="leader-card">
                    <div class="leader-image">
                    <img src="{{ asset('assets-lib/img/person/person-m-11.webp') }}" alt="IT Director" class="img-fluid">
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                    </div>
                    </div>
                    <div class="leader-info">
                    <h4>@lang('Nom5')</h4>
                    <p class="position">@lang('system.IT_Director')</p>
                    <p class="bio">@lang('system.IT_Director_Bio')</p>
                    </div>
                </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="leader-card">
                    <div class="leader-image">
                    <img src="{{ asset('assets-lib/img/person/person-f-12.webp') }}" alt="Student Welfare Officer" class="img-fluid">
                    <div class="social-links">
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-envelope"></i></a>
                    </div>
                    </div>
                    <div class="leader-info">
                    <h4>@lang('Nom6')</h4>
                    <p class="position">@lang('system.Student_Welfare_Officer')</p>
                    <p class="bio">@lang('system.Student_Welfare_Officer_Bio')</p>
                    </div>
                </div>
                </div>
            </div>
            </div>

        </div>

        </section><!-- /Leadership Section -->
    @endsection
