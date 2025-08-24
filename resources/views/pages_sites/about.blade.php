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
                        <h4>2015</h4>
                        <p>@lang('system.Timeline_2015')</p>
                    </div>
                    </div>

                    <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>2020</h4>
                        <p>@lang('system.Timeline_2020')</p>
                    </div>
                    </div>

                    <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>2022</h4>
                        <p>@lang('system.Timeline_2022')</p>
                    </div>
                    </div>

                    <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>2023</h4>
                        <p>@lang('system.Timeline_2023')</p>
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
            {{-- Core Values Section --}}
            <div class="row mt-5">

                <div class="col-lg-12">
                    <div class="core-values" data-aos="fade-up" data-aos-delay="500">
                        <h3 class="text-center mb-4">معطيات عن المعهد</h3>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" dir="rtl" lang="ar" style="font-family: 'Cairo', 'Tajawal', Arial, sans-serif;">
                            <div class="col">
                                <div class="value-card">
                                    <div class="value-icon"><i class="bi bi-people"></i></div>
                                    <h4>عدد الطلاب المسجلين من 2015 إلى 2024</h4>
                                    <p>1222</p>
                                    <h4>عدد الطلاب (2025-2024)</h4>
                                    <p>395</p>
                                    <h4>عدد الخريجين</h4>
                                    <p>185 توجوا بشهادة الليسانس مهنية مزدوجة في مجال اللغات والتواصل.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="value-card">
                                    <div class="value-icon"><i class="bi bi-person-badge"></i></div>
                                    <h4>عدد الأساتذة</h4>
                                    <p>18 بينهم 9 رسميون</p>
                                    <h4>عدد العمال</h4>
                                    <p>14</p>
                                    <h4>مدرج بسعة</h4>
                                    <p>240 مقعداً</p>
                                    <h4>14 قاعة للتدريس</h4>
                                    <p>قاعتان للمحاضرات</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="value-card">
                                    <div class="value-icon"><i class="bi bi-laptop"></i></div>
                                    <h4>مختبرات للغات</h4>
                                    <p>مجهزة بـ 60 جهاز كمبيوتر</p>
                                    <h4>أكشاك ترجمة فورية</h4>
                                    <p>4 أكشاك</p>
                                    <h4>قاعة مطالعة</h4>
                                    <p>الشراكات:</p>
                                    <p>المعهد العالي للتعليم التكنولوجي بروصو<br>معهد كوفشيوس</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="value-card">
                                    <div class="value-icon"><i class="bi bi-stars"></i></div>
                                    <h4>آفاق التوسع</h4>
                                    <p>شراكة بين المعهد ومدرسة فهد العليا للترجمة<br>شراكة بين المعهد وإيراسموس ابلاس<br>انطلاق التكوين المستمر</p>
                                    <h4>الميزات</h4>
                                    <p>يشكل المعهد فرصة لأبناء الولاية من أجل الاستمرار في الدراسات العليا بين ذويهم دون الحاجة إلى السفر خارج العاصمة الاقتصادية، مما سيحد من التسرب المدرسي، ويزيد من الكفاءات في مجال مهن اللغات. كما أنه لا يتأثر كثيراً بالمشاكل التي تعاني منها المدينة في مجال الماء والكهرباء، حيث يمتلك مولداً كهربائياً وخزانات مياه، يتم تسييرها بشكل محكم.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end Core Values Section --}}
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
