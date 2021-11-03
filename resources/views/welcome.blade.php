<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Page Title -->
  <title>{{ config('app.name') }}</title>
  <!-- / -->

  <!---Font Icon-->
  <link href="{{asset('landing_page/static/plugin/font-awesome/css/fontawesome-all.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/static/plugin/et-line/style.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/static/plugin/themify-icons/themify-icons.css')}}" rel="stylesheet">
  <!-- / -->

  <!-- Plugin CSS -->
  <link href="{{asset('landing_page/static/plugin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/static/plugin/owl-carousel/css/owl.carousel.min.css')}}" rel="stylesheet">
  <!-- / -->

  <!-- Theme Style -->
  <link href="{{asset('landing_page/static/css/styles.css')}}" rel="stylesheet">
  <link href="{{asset('landing_page/static/css/color/default.css')}}" rel="stylesheet" id="color_theme">
  <!-- / -->

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('dist/img/favicon.png')}}">
  <style type="text/css">
    body{
      background-color: #f8f9fc;
    }
  </style>
  <!-- / -->
</head>

<!-- Body Start -->
<body data-spy="scroll" data-target="#navbarHeader" data-offset="100">

  <!-- Loading -->
  <div id="loading" class="loader-wrapper theme-g-bg">
    <div class="center">
      <div class="d d1"></div>
      <div class="d d2"></div>
      <div class="d d3"></div> 
      <div class="d d4"></div>  
      <div class="d d5"></div>
    </div>
  </div>
  <!-- / -->

  <!-- Header -->
  <header class="header header-01">
    <div class="container">
      <nav class="navbar navbar-expand-lg">
        <!-- Brand -->
        <a class="navbar-brand" href="#"><img width="150px" src="{{asset('landing_page/static/img/coinleas.png')}}" title="" alt=""></a>
        <!-- / -->

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <!-- / -->

        <!-- Top Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarHeader">
          <ul class="navbar-nav ml-auto">
            <li><a class="nav-link active" href="#home-box">Home</a></li>
            <li><a class="nav-link" href="#features">About</a></li>
            {{-- <li><a class="nav-link" href="#solutions">Solutions</a></li> --}}
            <li><a class="nav-link" href="#pricing">Leasing</a></li>
            {{-- <li><a class="nav-link" href="#client">Clients</a></li> --}}
            
            <li><a class="nav-link-btn m-btn-white" href="{{route('login')}}" >Login</a></li>
          </ul>
        </div>
        <!-- / -->
      </nav> <!-- Navbar -->     
    </div>
  </header>
  <!-- Header End -->
  
  <!-- Main Start -->
  <main>

    <!-- Home Banner -->
    <section id="home-box" class="home-banner-01 theme-after-bg grey-bg">
      <div class="container">
        <div class="row full-screen align-items-center p-100px-tb">
          <div class="col-md-6">
            <div class="home-left">
              <h1 class="font-alt">Manage your <br>Dogecoin</h1>
              <p>Anyone can make doge coins up to between 10 and 30 percent per month just by leased doge coins to miners. We don't need to buy tens of millions of equipment to mine, just deposit it into the miner's wallet and wait for the profit.</p>
              {{-- <a class="m-btn-white" href="#">Learn More</a> --}}
            </div>
          </div>
          <div class="col-md-6">
            <img src="{{asset('landing_page/static/img/coinleasing.png')}}" title="" alt="">
          </div>
        </div>
      </div> <!-- container -->
    </section>
    <!-- / -->

    <!-- Features -->
    <section id="features" class="feature-section section p-50px-t sm-p-0px-t grey-bg">
      <div class="container">
        <div class="row justify-content-center title-section m-60px-b sm-m-40px-b">
          <div class="col-md-8 col-lg-5 text-center">
            <h2 class="font-alt">About</h2>
          </div> <!-- col -->
        </div> <!-- row -->

        <div class="row">
          <div class="col-md-12">
            <div class="feature-box-01 m-30px-b">
              <div class="f-icon"><i class="icon-documents"></i></div>
              <h4 class="font-alt">About Coin Leasing</h4>
              <p>You can lease your Doge coins to the our platform, which will mine and automatically distribute profits among users in proportion to their contribution. Therefore, you will receive a daily profit on your wallet with the possibility of instant withdrawal of funds. Coin Leasing is one way to get free coins without having to mine. This system was formed openly to protect the blockchain from being easily attacked by hackers.</p>
            </div>
          </div>
        </div>
      </div> <!-- container -->
    </section>
    <!-- / -->


    <!-- Feature Start -->
    {{-- <section id="solutions" class="section grey-bg border-top-grey">
      <div class="container">
        <div class="row justify-content-center title-section m-60px-b sm-m-40px-b">
          <div class="col-md-8 col-lg-5 text-center">
            <h2 class="font-alt">best solution ever</h2>
            <p>Orio – Landing Website Template is Software, Web Application & Startups Landing Page Template. This Template specially designs for who want to start their Software</p>
          </div> <!-- col -->
        </div>

        <div class="tab-style-1">
          <ul class="nav nav-fill" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="active" id="home-tab" data-toggle="tab" href="#homea" role="tab" aria-controls="homea" aria-selected="true">
                Displays
              </a>
            </li>
            <li class="nav-item">
              <a id="profile-tab" data-toggle="tab" href="#profilea" role="tab" aria-controls="profilea" aria-selected="false">
                Overview
              </a>
            </li>
            <li class="nav-item">
              <a id="contact-tab" data-toggle="tab" href="#contacta" role="tab" aria-controls="contacta" aria-selected="false">
                Content Explorer
              </a>
            </li>
            <li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane p-80px-t sm-p-40px-t fade show active" id="homea" role="tabpanel" aria-labelledby="home-tab">
                <div class="row align-items-center">
                  <div class="col-md-6 text-center">
                    <img class="img-shadow" src="{{asset('landing_page/static/img/550x500.jpg')}}" title="" alt="">
                  </div> <!-- col -->

                  <div class="col-md-6 sm-m-40px-t">
                    <div class="std-box p-50px-l md-p-0px-l">
                      <div class="title-section  m-20px-b">
                        <h2 class="font-alt left">Micor Overview</h2>
                      </div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>

                      <p class="m-30px-b">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                      <a href="#" class="m-btn-theme">More Feature</a>
                    </div> <!-- / -->
                  </div> <!-- col -->
                </div> <!-- row -->
            </div>

            <div class="tab-pane p-80px-t sm-p-40px-t fade" id="profilea" role="tabpanel" aria-labelledby="profile-tab">
              <div class="row align-items-center">
                <div class="col-md-6 sm-m-40px-b">
                  <div class="std-box p-50px-r md-p-0px-r">
                    <div class="title-section  m-20px-b">
                      <h2 class="font-alt left">Micor Overview</h2>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>

                    <p class="m-30px-b">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                    <a href="#" class="m-btn-theme">More Feature</a>
                  </div> <!-- / -->
                </div> <!-- col -->

                <div class="col-md-6">
                  <img class="img-shadow" src="{{asset('landing_page/static/img/550x500.jpg')}}" title="" alt="">
                </div> <!-- col -->
              </div> <!-- row -->
            </div>

            <div class="tab-pane p-80px-t sm-p-40px-t fade" id="contacta" role="tabpanel" aria-labelledby="contact-tab">
              <div class="row align-items-center">
                  <div class="col-md-6 text-center">
                    <img class="img-shadow" src="{{asset('landing_page/static/img/550x500.jpg')}}" title="" alt="">
                  </div> <!-- col -->

                  <div class="col-md-6 sm-p-40px-t">
                    <div class="std-box p-50px-l md-p-0px-l">
                      <div class="title-section  m-20px-b">
                        <h2 class="font-alt left">Micor Overview</h2>
                      </div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>

                      <p class="m-30px-b">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                      <a href="#" class="m-btn-theme">More Feature</a>
                    </div> <!-- / -->
                  </div> <!-- col -->
              </div> <!-- row -->
            </div>
          </div> <!-- Tab Content -->
        </div> <!-- Tab style -->    
      </div>
    </section> --}}
    <!--  -->

    <!-- pricing -->
    <section id="pricing" class="pricing-section section grey-bg border-top-grey">
      <div class="container">
        <div class="row justify-content-center title-section m-20px-b sm-m-40px-b">
          <div class="col-md-8 col-lg-5 text-center">
            <h2 class="font-alt">Leasing</h2>
          </div> <!-- col -->
        </div>

        <div class="row">
          <div class="col-md-4 sm-p-15px-tb" style="padding:15px;">
            <div class="price-table">
              <div class="price-table-head theme-after">
                <h2>Starting</h2>
                <div class="pricing">10.000 DOGE</div>
              </div>

              <div class="price-table-body">
                <ul>
                  <li>Profit UP TO 1%/Day in 30 Days</li>
                  <li>Affiliate UP TO 5%</li>
                </ul>
                <a href="{{route('register')}}" class="m-btn-theme">Get Started</a>
              </div>
            </div> <!-- Price table -->
          </div> <!-- col -->

          <div class="col-md-4 sm-p-15px-tb" style="padding:15px;">
            <div class="price-table">
              <div class="price-table-head theme-after">
                <h2>Starting</h2>
                <div class="pricing">25.000 DOGE</div>
              </div>

              <div class="price-table-body">
                <ul>
                  <li>Profit UP TO 1%/Day in 30 Days</li>
                  <li>Affiliate UP TO 5%</li>
                </ul>
                <a href="{{route('register')}}" class="m-btn-theme">Get Started</a>
              </div>
            </div> <!-- Price table -->
          </div> <!-- col -->

          <div class="col-md-4 sm-p-15px-tb" style="padding:15px;">
            <div class="price-table">
              <div class="price-table-head theme-after">
                <h2>Starting</h2>
                <div class="pricing">50.000 DOGE</div>
              </div>

              <div class="price-table-body">
                <ul>
                  <li>Profit UP TO 1%/Day in 30 Days</li>
                  <li>Affiliate UP TO 5%</li>
                </ul>
                <a href="{{route('register')}}" class="m-btn-theme">Get Started</a>
              </div>
            </div> <!-- Price table -->
          </div> <!-- col -->

          <div class="col-md-4 sm-p-15px-tb" style="padding:15px;">
            <div class="price-table">
              <div class="price-table-head theme-after">
                <h2>Starting</h2>
                <div class="pricing">100.000 DOGE</div>
              </div>

              <div class="price-table-body">
                <ul>
                  <li>Profit UP TO 1%/Day in 30 Days</li>
                  <li>Affiliate UP TO 5%</li>
                </ul>
                <a href="{{route('register')}}" class="m-btn-theme">Get Started</a>
              </div>
            </div> <!-- Price table -->
          </div> <!-- col -->

          <div class="col-md-4 sm-p-15px-tb" style="padding:15px;">
            <div class="price-table">
              <div class="price-table-head theme-after">
                <h2>Starting</h2>
                <div class="pricing">500.000 DOGE</div>
              </div>

              <div class="price-table-body">
                <ul>
                  <li>Profit UP TO 1%/Day in 30 Days</li>
                  <li>Affiliate UP TO 5%</li>
                </ul>
                <a href="{{route('register')}}" class="m-btn-theme">Get Started</a>
              </div>
            </div> <!-- Price table -->
          </div> <!-- col -->
        </div> <!-- row -->
      </div> <!-- container -->
    </section>
    <!-- / -->

    <!-- Clients -->
    {{-- <section id="client" class="section-clients section grey-bg border-top-grey">
      <div class="container">
        <div class="row justify-content-center title-section m-60px-b sm-m-40px-b">
          <div class="col-md-8 col-lg-5 text-center">
            <h2 class="font-alt">We Are Serving Over 10000 Happy Users.</h2>
            <p>Orio – Landing Website Template is Software, Web Application & Startups Landing Page Template. This Template specially designs for who want to start their Software</p>
          </div> <!-- col -->
        </div>

        <div class="clients-list clients-border clients-col-3">
          <ul>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
            <li>
              <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="" title="">
            </li>
          </ul>
        </div>

      </div> <!-- container -->
    </section> --}}
    <!-- / -->

    <!-- Testimonial -->
    {{-- <section id="testimonial" class="section testimonial-section grey-bg border-top-grey">
      <div class="container">

        <div class="row justify-content-center title-section m-60px-b sm-m-40px-b">
          <div class="col-md-8 col-lg-5 text-center">
            <h2 class="font-alt">What Our Awsome Customers Say About Us?</h2>
            <p>Orio – Landing Website Template is Software, Web Application & Startups Landing Page Template. This Template specially designs for who want to start their Software</p>
          </div> <!-- col -->
        </div>

        <div class="row justify-content-center">
          <div class="col-md-12">
              <div id="client-slider-single" class="owl-carousel">
                <div class="testimonial-col theme-after">
                    <div class="avtar-box">
                      <span class="avtar">
                        <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="Shark" title="Shark" />
                      </span>
                      <h6><label>Corey Anderson</label><span>Sr. Developer</span></h6>
                    </div>
                    <div class="speac">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div> <!-- col -->  

                <div class="testimonial-col theme-after">
                    <div class="avtar-box">
                      <span class="avtar">
                        <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="Shark" title="Shark" />
                      </span>
                      <h6><label>Corey Anderson</label><span>Sr. Developer</span></h6>
                    </div>
                    <div class="speac">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div> <!-- col -->  

                <div class="testimonial-col theme-after">
                    <div class="avtar-box">
                      <span class="avtar">
                        <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="Shark" title="Shark" />
                      </span>
                      <h6><label>Corey Anderson</label><span>Sr. Developer</span></h6>
                    </div>
                    <div class="speac">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div> <!-- col -->  

                <div class="testimonial-col theme-after">
                    <div class="avtar-box">
                      <span class="avtar">
                        <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="Shark" title="Shark" />
                      </span>
                      <h6><label>Corey Anderson</label><span>Sr. Developer</span></h6>
                    </div>
                    <div class="speac">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div> <!-- col -->  

                <div class="testimonial-col theme-after">
                    <div class="avtar-box">
                      <span class="avtar">
                        <img src="{{asset('landing_page/static/img/100x100.jpg')}}" alt="Shark" title="Shark" />
                      </span>
                      <h6><label>Corey Anderson</label><span>Sr. Developer</span></h6>
                    </div>
                    <div class="speac">
                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    </div>
                </div> <!-- col -->  


 

              </div> <!-- owl -->
          </div> <!-- col -->
        </div> <!-- row -->
      </div> <!-- container -->
    </section> --}}
    <!--  Testimonial End  -->


    <!-- Subscribe -->
    {{-- <section id="freetrial" class="section subscribe-section grey-bg border-top-grey">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 col-lg-7 text-center">
            <div class="subscribe-form">
              <div class="title-section m-60px-b">
                <h2 class="font-alt">Want To Get Started?</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>  
              </div>
              
              <div class="sf-form">
                <input type="email" class="input-control" placeholder="Add Your Email Id" name="Email" />
                <button class="m-btn-theme">Get Started for Free</button>
              </div>
            </div>
          </div> <!-- col -->
        </div> <!-- row -->
      </div> <!-- container -->
    </section> --}}
    <!-- / -->


  </main>
  <!-- Main End -->

    

  <!-- Footer -->
  <footer class="footer theme-g-bg">
    <section class="footer-section">
      <div class="container">
        {{-- <div class="row">
          <div class="col-md-4 col-lg-5 sm-m-15px-tb">
            <h4 class="font-alt">About Us</h4>
            <p class="footer-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation</p>
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
              <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
              <li><a class="google" href="#"><i class="fab fa-google-plus-g"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
          </div> <!-- col -->

          <div class="col-md-5 col-lg-4 sm-m-15px-tb">
            <h4 class="font-alt">Helpful Links</h4>
            <div class="d-flex justify-content-around">
              <ul class="fot-link">
                <li><a href="#">Gym Training</a></li>
                <li><a href="#">Crossfit</a></li>
                <li><a href="#">Cardio</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Blog</a></li>
              </ul>
              <ul class="fot-link">
                <li><a href="#">About</a></li>
                <li><a href="#">Trainings</a></li>
                <li><a href="#">Coaches</a></li>
                <li><a href="#">Club cards</a></li>
              </ul>
            </div>
          </div> <!-- col -->

          <div class="col-md-3 col-lg-3 sm-m-15px-tb">
            <h4 class="font-alt">Get in touch</h4>
            <p>12345 Little Lonsdale St, Melbourne</p>
            <p><span>E-Mail:</span> info@example.com </p>
            <p><span>Phone:</span> (123) 123-456</p>
          </div> <!-- col -->

        </div> --}}
        
        <div class="footer-copy">
          <div class="row">
            <div class="col-12">
              <p>Copyright © {{date('Y')}} {{ config('app.name') }}. All rights reserved. </p>
            </div><!-- col -->
          </div> <!-- row -->
        </div> <!-- footer-copy -->

      </div> <!-- container -->   
    </section>
  </footer>
  <!-- / -->

  <!-- jQuery -->
  <script src="{{asset('landing_page/static/js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('landing_page/static/js/jquery-migrate-3.0.0.min.js')}}"></script>

  <!-- Plugins -->
  <script src="{{asset('landing_page/static/plugin/bootstrap/js/popper.min.js')}}"></script>
  <script src="{{asset('landing_page/static/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('landing_page/static/plugin/owl-carousel/js/owl.carousel.min.js')}}"></script>
  <!-- custom -->
  <script src="{{asset('landing_page/static/js/custom.js')}}"></script>

</body>
<!-- Body End -->

</html>