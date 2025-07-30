@extends('layouts_site.main')
@section('content')
    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>@lang('system.Events_Title')</h1>
        <p>@lang('system.Events_Desc')</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">@lang('system.Home')</a></li>
            <li class="current">@lang('system.Events_Title')</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Events 2 Section -->
    <section id="events-2" class="events-2 section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">
          <div class="col-lg-8">
            <div class="events-list">
              <div class="event-item" data-aos="fade-up">
                <div class="event-date">
                  <span class="day">15</span>
                  <span class="month">@lang('system.June')</span>
                </div>
                <div class="event-content">
                  <h3>@lang('system.Annual_Science_Fair_Exhibition')</h3>
                  <div class="event-meta">
                    <p><i class="bi bi-clock"></i> @lang('system.Event_Time_1')</p>
                    <p><i class="bi bi-geo-alt"></i> @lang('system.Event_Location_1')</p>
                  </div>
                  <p>@lang('system.Annual_Science_Fair_Exhibition_Desc')</p>
                  <a href="#" class="btn-event">@lang('system.Learn_More') <i class="bi bi-arrow-right"></i></a>
                </div>
              </div><!-- End Event Item -->

              <div class="event-item" data-aos="fade-up" data-aos-delay="100">
                <div class="event-date">
                  <span class="day">22</span>
                  <span class="month">@lang('system.June')</span>
                </div>
                <div class="event-content">
                  <h3>@lang('system.Parent_Teacher_Conference')</h3>
                  <div class="event-meta">
                    <p><i class="bi bi-clock"></i> @lang('system.Event_Time_2')</p>
                    <p><i class="bi bi-geo-alt"></i> @lang('system.Event_Location_2')</p>
                  </div>
                  <p>@lang('system.Parent_Teacher_Conference_Desc')</p>
                  <a href="#" class="btn-event">@lang('system.Learn_More') <i class="bi bi-arrow-right"></i></a>
                </div>
              </div><!-- End Event Item -->

              <div class="event-item" data-aos="fade-up" data-aos-delay="200">
                <div class="event-date">
                  <span class="day">30</span>
                  <span class="month">@lang('system.June')</span>
                </div>
                <div class="event-content">
                  <h3>@lang('system.Summer_Sports_Tournament_Final')</h3>
                  <div class="event-meta">
                    <p><i class="bi bi-clock"></i> @lang('system.Event_Time_3')</p>
                    <p><i class="bi bi-geo-alt"></i> @lang('system.Event_Location_3')</p>
                  </div>
                  <p>@lang('system.Summer_Sports_Tournament_Final_Desc')</p>
                  <a href="#" class="btn-event">@lang('system.Learn_More') <i class="bi bi-arrow-right"></i></a>
                </div>
              </div><!-- End Event Item -->

              <div class="event-item" data-aos="fade-up" data-aos-delay="300">
                <div class="event-date">
                  <span class="day">05</span>
                  <span class="month">@lang('system.July')</span>
                </div>
                <div class="event-content">
                  <h3>@lang('system.Graduation_Ceremony_2023')</h3>
                  <div class="event-meta">
                    <p><i class="bi bi-clock"></i> @lang('system.Event_Time_4')</p>
                    <p><i class="bi bi-geo-alt"></i> @lang('system.Event_Location_4')</p>
                  </div>
                  <p>@lang('system.Graduation_Ceremony_2023_Desc')</p>
                  <a href="#" class="btn-event">@lang('system.Learn_More') <i class="bi bi-arrow-right"></i></a>
                </div>
              </div><!-- End Event Item -->
            </div>

            <div class="pagination-wrapper" data-aos="fade-up" data-aos-delay="400">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="bi bi-chevron-left"></i></a></li>
                <li class="page-item active"><a class="page-link" href="#">@lang('system.Page_1')</a></li>
                <li class="page-item"><a class="page-link" href="#">@lang('system.Page_2')</a></li>
                <li class="page-item"><a class="page-link" href="#">@lang('system.Page_3')</a></li>
                <li class="page-item"><a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a></li>
              </ul>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="sidebar">
              <div class="sidebar-item" data-aos="fade-up" data-aos-delay="100">
                <h3 class="sidebar-title">@lang('system.Upcoming_Events')</h3>
                <div class="event-calendar">
                  <div class="calendar-header">
                    <h4>@lang('system.June_2023')</h4>
                  </div>
                  <div class="calendar-body">
                    <div class="weekdays">
                      <div>@lang('system.Su')</div>
                      <div>@lang('system.Mo')</div>
                      <div>@lang('system.Tu')</div>
                      <div>@lang('system.We')</div>
                      <div>@lang('system.Th')</div>
                      <div>@lang('system.Fr')</div>
                      <div>@lang('system.Sa')</div>
                    </div>
                    <div class="days">
                      <div class="day other-month">28</div>
                      <div class="day other-month">29</div>
                      <div class="day other-month">30</div>
                      <div class="day other-month">31</div>
                      <div class="day">1</div>
                      <div class="day">2</div>
                      <div class="day">3</div>
                      <div class="day">4</div>
                      <div class="day">5</div>
                      <div class="day">6</div>
                      <div class="day">7</div>
                      <div class="day">8</div>
                      <div class="day">9</div>
                      <div class="day">10</div>
                      <div class="day">11</div>
                      <div class="day">12</div>
                      <div class="day">13</div>
                      <div class="day">14</div>
                      <div class="day has-event">15</div>
                      <div class="day">16</div>
                      <div class="day">17</div>
                      <div class="day">18</div>
                      <div class="day">19</div>
                      <div class="day">20</div>
                      <div class="day">21</div>
                      <div class="day has-event">22</div>
                      <div class="day">23</div>
                      <div class="day">24</div>
                      <div class="day">25</div>
                      <div class="day">26</div>
                      <div class="day">27</div>
                      <div class="day">28</div>
                      <div class="day">29</div>
                      <div class="day has-event">30</div>
                      <div class="day other-month">1</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="sidebar-item featured-event" data-aos="fade-up" data-aos-delay="200">
                <h3 class="sidebar-title">@lang('system.Featured_Event')</h3>
                <div class="featured-event-content">
                  <img src="{{ asset('assets-lib/img/education/events-5.webp') }}" alt="Featured Event" class="img-fluid">
                  <h4>@lang('system.Annual_Arts_Festival')</h4>
                  <p><i class="bi bi-calendar-event"></i> @lang('system.Annual_Arts_Festival_Date')</p>
                  <p>@lang('system.Annual_Arts_Festival_Desc')</p>
                  <a href="#" class="btn-register">@lang('system.Register_Now')</a>
                </div>
              </div>

              <div class="sidebar-item" data-aos="fade-up" data-aos-delay="300">
                <h3 class="sidebar-title">@lang('system.Event_Categories')</h3>
                <div class="categories">
                  <ul>
                    <li><a href="#">@lang('system.Academic') <span>(12)</span></a></li>
                    <li><a href="#">@lang('system.Sports') <span>(8)</span></a></li>
                    <li><a href="#">@lang('system.Cultural') <span>(6)</span></a></li>
                    <li><a href="#">@lang('system.Workshops') <span>(4)</span></a></li>
                    <li><a href="#">@lang('system.Conferences') <span>(3)</span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Events 2 Section -->
@endsection
