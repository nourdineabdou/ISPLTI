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

    <!-- News Hero Section -->
    <section id="news-hero" class="news-hero section">

      <div class="container" data-aos="fade-up">

        <div class="row g-4">
          <!-- Left Side Posts -->
          <div class="col-lg-3">
            <div class="side-posts">
              <!-- Side Post 1 -->
              <article class="post-item side-post" data-aos="fade-right" data-aos-delay="100">
                <div class="post-img">
                  <img src="{{ asset('assets-lib/img/blog/blog-post-3.webp') }}" alt="Post Image" class="img-fluid" loading="lazy">
                  <span class="category entertainment">@lang('system.Entertainment')</span>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">@lang('system.Maecenas_tempus_tellus')</a>
                  </h3>
                  <div class="post-meta">
                  <span>@lang('system.March_15_2025')</span>
                    <span class="dot">•</span>
                  <span>@lang('system.Three_Comments')</span>
                  </div>
                </div>
              </article>

              <!-- Side Post 2 -->
              <article class="post-item side-post" data-aos="fade-right" data-aos-delay="200">
                <div class="post-img">
                  <img src="{{ asset('assets-lib/img/blog/blog-post-9.webp') }}" alt="Post Image" class="img-fluid" loading="lazy">
                  <span class="category technology">@lang('system.Technology')</span>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">@lang('Post1')</a>
                  </h3>
                  <div class="post-meta">
                  <span>@lang('system.March_14_2025')</span>
                    <span class="dot">•</span>
                  <span>@lang('system.Five_Comments')</span>
                  </div>
                </div>
              </article>
            </div>
          </div>

          <!-- Main Post -->
          <div class="col-lg-6">
            <article class="post-item main-post" data-aos="fade-up">
              <div class="post-img">
                <img src="{{ asset('assets-lib/img/blog/blog-post-7.webp') }}" alt="Post Image" class="img-fluid">
                <span class="category business">@lang('system.Business')</span>
              </div>
              <div class="post-content">
                <h2 class="post-title">
                  <a href="#">@lang('Post2')</a>
                </h2>
                <p class="post-excerpt">
                 @lang('post3')
                </p>
                <div class="post-meta">
                  <span>@lang('system.March_16_2025')</span>
                  <span class="dot">•</span>
                  <span>@lang('system.Eight_Comments')</span>
                </div>
              </div>
            </article>
          </div>

          <!-- Right Side Posts -->
          <div class="col-lg-3">
            <div class="side-posts">
              <!-- Side Post 3 -->
              <article class="post-item side-post" data-aos="fade-left" data-aos-delay="100">
                <div class="post-img">
                  <img src="{{ asset('assets-lib/img/blog/blog-post-6.webp') }}" alt="Post Image" class="img-fluid" loading="lazy">
                  <span class="category technology">@lang('system.Technology')</span>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">Aenean vulputate eleifend tellus aenean leo ligula porttitor</a>
                  </h3>
                  <div class="post-meta">
                  <span>@lang('system.March_13_2025')</span>
                    <span class="dot">•</span>
                  <span>@lang('system.Two_Comments')</span>
                  </div>
                </div>
              </article>

              <!-- Side Post 4 -->
              <article class="post-item side-post" data-aos="fade-left" data-aos-delay="200">
                <div class="post-img">
                  <img src="{{ asset('assets-lib/img/blog/blog-post-9.webp') }}" alt="Post Image" class="img-fluid" loading="lazy">
                  <span class="category lifestyle">@lang('system.Lifestyle')</span>
                </div>
                <div class="post-content">
                  <h3 class="post-title">
                    <a href="#">@lang('Post4')</a>
                  </h3>
                  <div class="post-meta">
                  <span>@lang('system.March_12_2025')</span>
                    <span class="dot">•</span>
                  <span>@lang('system.Four_Comments')</span>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /News Hero Section -->

    <!-- News Posts Section -->
    <section id="news-posts" class="news-posts section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

          <div class="col-lg-4">
            <article>

              <div class="post-img position-relative">
                <img src="{{ asset('assets/img/blog/blog-post-1.webp') }}" alt="" class="img-fluid" loading="lazy">
                <div class="post-content">
                  <p class="post-category">@lang('system.Politics')</p>
                  <h2 class="title">
                    <a href="blog-details.html">@lang('Post1')</a>
                  </h2>
                  <div class="post-meta">
                    <time datetime="2025-01-01">@lang('system.Jan_1_2025')</time>
                    <span class="px-2">•</span>
                    <span>@lang('system.No_Comments')</span>
                  </div>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-lg-4">
            <article>

              <div class="post-img position-relative">
                <img src="{{ asset('assets-lib/img/blog/blog-post-2.webp') }}" alt="" class="img-fluid" loading="lazy">
                <div class="post-content">
                  <p class="post-category">@lang('system.Sports')</p>
                  <h2 class="title">
                    <a href="blog-details.html">@lang('Post2')</a>
                  </h2>
                  <div class="post-meta">
                    <time datetime="2025-06-05">@lang('system.Jun_5_2025')</time>
                    <span class="px-2">•</span>
                    <span>@lang('system.No_Comments')</span>
                  </div>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-lg-4">
            <article>

              <div class="post-img position-relative">
                <img src="{{ asset('assets-lib/img/blog/blog-post-3.webp') }}" alt="" class="img-fluid" loading="lazy">
                <div class="post-content">
                  <p class="post-category">@lang('system.Entertainment')</p>
                  <h2 class="title">
                    <a href="blog-details.html">@lang('Post3')</a>
                  </h2>
                  <div class="post-meta">
                    <time datetime="2025-06-22">@lang('system.Jun_22_2025')</time>
                    <span class="px-2">•</span>
                    <span>@lang('system.No_Comments')</span>
                  </div>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-lg-4">
            <article>

              <div class="post-img position-relative">
                <img src="{{ asset('assets-lib/img/blog/blog-post-4.webp') }}" alt="" class="img-fluid" loading="lazy">
                <div class="post-content">
                  <p class="post-category">@lang('system.Sports')</p>
                  <h2 class="title">
                    <a href="blog-details.html">@lang('Post4')</a>
                  </h2>
                  <div class="post-meta">
                    <time datetime="2025-06-30">@lang('system.Jun_30_2025')</time>
                    <span class="px-2">•</span>
                    <span>@lang('system.No_Comments')</span>
                  </div>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-lg-4">
            <article>

              <div class="post-img position-relative">
                <img src="{{ asset('assets-lib/img/blog/blog-post-5.webp') }}" alt="" class="img-fluid" loading="lazy">
                <div class="post-content">
                  <p class="post-category">@lang('system.Politics')</p>
                  <h2 class="title">
                    <a href="blog-details.html">@lang('Post5')</a>
                  </h2>
                  <div class="post-meta">
                    <time datetime="2025-01-30">@lang('system.Jan_30_2025')</time>
                    <span class="px-2">•</span>
                    <span>@lang('system.No_Comments')</span>
                  </div>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

          <div class="col-lg-4">
            <article>

              <div class="post-img position-relative">
                <img src="{{ asset('assets-lib/img/blog/blog-post-6.webp') }}" alt="" class="img-fluid" loading="lazy">
                <div class="post-content">
                  <p class="post-category">@lang('system.Entertainment')</p>
                  <h2 class="title">
                    <a href="blog-details.html">@lang('Post6')</a>
                  </h2>
                  <div class="post-meta">
                    <time datetime="2025-02-14">@lang('system.Feb_14_2025')</time>
                    <span class="px-2">•</span>
                    <span>@lang('system.No_Comments')</span>
                  </div>
                </div>
              </div>

            </article>
          </div><!-- End post list item -->

        </div>
      </div>

    </section><!-- /News Posts Section -->

    <!-- Pagination 2 Section -->
    <section id="pagination-2" class="pagination-2 section">

      <div class="container">
        <nav class="d-flex justify-content-center" aria-label="Page navigation">
          <ul>
            <li>
              <a href="#" aria-label="Previous page">
                <i class="bi bi-arrow-left"></i>
                <span class="d-none d-sm-inline">@lang('system.Previous')</span>
              </a>
            </li>

                <li><a href="#" class="active">@lang('system.Page_1')</a></li>
                <li><a href="#">@lang('system.Page_2')</a></li>
                <li><a href="#">@lang('system.Page_3')</a></li>
                <li class="ellipsis">@lang('system.Ellipsis')</li>
                <li><a href="#">@lang('system.Page_8')</a></li>
                <li><a href="#">@lang('system.Page_9')</a></li>
                <li><a href="#">@lang('system.Page_10')</a></li>

            <li>
              <a href="#" aria-label="Next page">
                <span class="d-none d-sm-inline">@lang('system.Next')</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>

    </section><!-- /Pagination 2 Section -->

@endsection
<!-- END: Content-->
