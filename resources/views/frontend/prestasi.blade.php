@extends('layout.landing')
@section('content')
<div class="breadcrumbs">
    <div class="container">
      <h2>PRESTASI</h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
</div>
<section id="trainers" class="trainers">
    <div class="container" data-aos="fade-up">
      <div class="row" data-aos="zoom-in" data-aos-delay="100">
        <div class="col-lg-12 col-md-12 d-flex align-items-stretch">
            <section id="popular-courses" class="courses">
                <div class="container" data-aos="fade-up">



                  <div class="row" data-aos="zoom-in" data-aos-delay="100">

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                      <div class="course-item">
                        <img src="{{asset('assets')}}/img/course-1.jpg" class="img-fluid" alt="...">
                        <div class="course-content">
                          <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Web Development</h4>
                            <p class="price">$169</p>
                          </div>

                          <h3><a href="course-details.html">Website Design</a></h3>
                          <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
                        </div>
                      </div>
                    </div> <!-- End Course Item-->

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                      <div class="course-item">
                        <img src="{{asset('assets')}}/img/course-2.jpg" class="img-fluid" alt="...">
                        <div class="course-content">
                          <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Marketing</h4>
                            <p class="price">$250</p>
                          </div>

                          <h3><a href="course-details.html">Search Engine Optimization</a></h3>
                          <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>
                        </div>
                      </div>
                    </div> <!-- End Course Item-->

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
                      <div class="course-item">
                        <img src="{{asset('assets')}}/img/course-3.jpg" class="img-fluid" alt="...">
                        <div class="course-content">
                          <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4>Content</h4>
                            <p class="price">$180</p>
                          </div>

                          <h3><a href="course-details.html">Copywriting</a></h3>
                          <p>Et architecto provident deleniti facere repellat nobis iste. Id facere quia quae dolores dolorem tempore.</p>

                        </div>
                      </div>
                    </div> <!-- End Course Item-->

                  </div>

                </div>
              </section><!-- End Popular Courses Section -->

        </div>
      </div>
    </div>
  </section>
@endsection
