
@extends('layouts_site.main')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>@lang('system.Contact_Title')</h1>
        <p>@lang('system.Contact_Desc')</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">@lang('system.Home')</a></li>
            <li class="current">@lang('system.Contact_Title')</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <!-- Contact Info Boxes -->
        <div class="row gy-4 mb-5">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-info-box">
              <div class="icon-box">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="info-content">
                <h4>@lang('system.Our_Address')</h4>
                <p>@lang('system.Address_Details')</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="contact-info-box">
              <div class="icon-box">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="info-content">
                <h4>@lang('system.Email_Address')</h4>
                <p>@lang('system.Email_1')</p>
                <p>@lang('system.Email_2')</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="contact-info-box">
              <div class="icon-box">
                <i class="bi bi-headset"></i>
              </div>
              <div class="info-content">
                <h4>@lang('system.Hours_of_Operation')</h4>
                <p>@lang('system.Hours_Weekdays')</p>
                <p>@lang('system.Hours_Saturday')</p>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Google Maps (Full Width) -->
      <div class="map-section" data-aos="fade-up" data-aos-delay="200">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13197.96496481309!2d-17.056603!3d20.933333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjDCsDU2JzAwLjAiTiAxN8KwMDMnMjMuOCJX!5e0!3m2!1sfr!2sma!4v1716820000000!5m2!1sfr!2sma" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>

      <!-- Contact Form Section (Overlapping) -->
      <div class="container form-container-overlap">
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-10">
            <div class="contact-form-wrapper">
              <h2 class="text-center mb-4">@lang('system.Get_in_Touch')</h2>

              <form action="forms/contact.php" method="post" class="php-email-form">
                <div class="row g-3">
                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-person"></i>
                        <input type="text" class="form-control" name="name" placeholder="@lang('system.First_Name')" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-envelope"></i>
                        <input type="email" class="form-control" name="email" placeholder="@lang('system.Email_Address_Placeholder')" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-text-left"></i>
                        <input type="text" class="form-control" name="sbject" placeholder="@lang('system.Subject')" required="">
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <div class="input-with-icon">
                        <i class="bi bi-chat-dots message-icon"></i>
                        <textarea class="form-control" name="message" placeholder="@lang('system.Write_Message')" style="height: 180px" required=""></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="loading">@lang('system.Loading')</div>
                    <div class="error-message"></div>
                    <div class="sent-message">@lang('system.Message_Sent')</div>
                  </div>

                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary btn-submit">@lang('system.Send_Message')</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Contact Section -->
@endsection
