<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('front/bootstrap-5.1.3-dist/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('front/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link href="/path/to/dist/jquery.flipster.min.css" rel="stylesheet" />
  
  <!-- slick -->

  <link rel="stylesheet" href="{{ asset('front/plugins/slick-master/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('front/plugins//slick-master//slick//slick-theme.css') }} ">
  <link rel="stylesheet" href="{{ asset('front/slick.css') }}">
  
  @yield('front-css')
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="{{ asset('front/supported/supportcss.css') }}">

  


  <!-- lightweight carousel -->

  <link type="text/css"href="./Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/examples/css/styles.css"rel="stylesheet" />



  
  <title>Topsun</title>
</head>

<body>
  <!-- top header -->
  <!-- <video autoplay muted loop id="myVideo">
    <source src="{{ asset('front/Images/rain.mp4') }}" type="video/mp4">
    Your browser does not support HTML5 video.
  </video> -->

  <div class="bg-success container-fluid">
    <div class="container ">
      <div class="row ">
        <div class="timing col-4 top-header" style="margin-top: auto;margin-bottom:auto;"></i><i style="color: #f26f1f;" class="bi bi-clock-fill"></i> Opening
          Time Sun-Fri {{ date("g:i a", strtotime($setting->open_time))}} to {{ date("g:i a", strtotime($setting->close_time))}}
        </div>
        <div class="col-md-6">
          <div class="d-flex">
            <div>In the News</div>
            <div> @isset($news)
              <marquee width="100%" direction="" scrollamount="3" height="100%">
              @foreach($news as $new)
               <a href="{{ $new->url}}" style="color:white" class="marquee-anchorc me-3" target="_blank"> <span class="marquee-color">{{ ucfirst($new->title)}},</span></a>
              @endforeach
                </marquee>
            @endisset</div>
          </div>
         
        </div>
        <div class="socialMediaLink col-2  text-end ">
          <a target="_blank" href="{{ $setting->facebook_link}}"><i
              class="bi bi-facebook smicons"></i></a>
          <a target="_blank" href="{{ $setting->twitter_link}}"><i class="bi bi-twitter smicons"></i></a>
          <a target="_blank" href="{{ $setting->youtube_link}}"><i class="bi bi-youtube smicons"></i></a>
          <a target="_blank" href="{{ $setting->google_link}}"> <i class="bi bi-google smicons"></i></a>
        </div>
      
      </div>
    </div>
  </div>
  <div>
    <div class="container header-container">
      <div class="row align-items-center">
        <div class="col-sm-2 col-md-2 d-none d-md-inline-block">
          <a href="{{ route('homepage')}}">
          <img class=" img-thumbnail " style="border: none; width: 100px;" src="{{ asset('front/Images/logo.png') }}" alt="...">
          </a>
        </div>

        <div class="col-sm-3 col-md-3 align-items-center d-flex">
          <div class=" header-text text-center"><a href="tel:+977-1-4891268"> <i
                class="bi bi-telephone-fill headericons"></i></a>
          </div>
          <div class="d-flex flex-column ms-2">
            <a class="header-text" href="tel:+977-1-4891268">{{ $setting->contact_no}}</a>
            <a class="header-text" href="tel:+977-1-4891268">{{ $setting->contact_no_2}}</a>
          </div>
        </div>
        <div class="col-sm-3 col-md-3  d-flex ">

          <a class="header-text text-center" href="mailto:topsun@ntc.net.np"><i
              class="bi bi-envelope headericons"></i></a>
          <a class="header-text ms-2" href="mailto:{{ $setting->email}}">{{ $setting->email}}</a>
        </div>
        <div class="col-sm-4 col-md-4 d-flex  justify-content-end ">
          <div class="header-text text-center">
            <a href="https://goo.gl/maps/5qdUS2NVDZRnEqvHA"><i class="bi bi-geo-alt-fill headericons"></i></a>
          </div>
          <a href="https://goo.gl/maps/5qdUS2NVDZRnEqvHA" target="blank" class="ms-2"> {{ $setting->address}}</a>
        </div>

      </div>
    </div>
  </div>
<!-- navbar -->
  <nav class="navbar navbar-expand-md navbar-light sticky-top bg-success">
    <div class="container  text-white">
      <a class="navbar-brand d-md-none" href="#"><img style="border: none; width: 60px;background: transparent;"
          src="{{ asset('front/Images/logo.png') }}" alt="" srcset=""></a>
      <div class="nav-icons header-text d-flex ">
        <div class=" m-2 header-text text-center"><a href="tel:+977-1-4891268"> <i
              class="bi bi-telephone-fill headericons"></i></a>
        </div>
        <div class="header-text m-2  text-center"> <a href="mailto:topsun@ntc.net.np"><i
              class="bi bi-envelope headericons"></i></a></div>
        <div class="header-text m-2  text-center ">
          <a href="https://goo.gl/maps/5qdUS2NVDZRnEqvHA" target="blank"><i class="bi bi-geo-alt-fill headericons"></i></a>
        </div>
      </div>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse justify-content text-white navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto text-white mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active {{ request()->routeIs('homepage')?'active-nav':''}} text-white d-none d-md-inline-block " aria-current="page" href="{{ route('homepage')}}">Home</a>
          </li>
         
          <li class="nav-item">
            <div class="dropdown">
              <a class="nav-link active {{ request()->routeIs('our-story')?'active-nav':'' || request()->routeIs('our_mission')?'active-nav':'' || request()->routeIs('our-team')?'active-nav':''}} text-white" aria-current="page" dropbtn>About Us</a>
            
             <div class="dropdown-content">
              <div class="arrow-up">
                <i class="bi bi-caret-up-fill"></i>
              </div>
              <div class=" hover-display-div">
              
                <div class="row bg-success">
                  <a class="drop-down-link {{ request()->routeIs('our-story')?'active-nav':''}}" href="{{ route('our-story') }}"> <span>Our Story</span></a>
                  <a class="drop-down-link {{ request()->routeIs('our_mission')?'active-nav':''}}" href="{{ route('our_mission')}}"> <span>Mission/Vission/Objectives</span></a>
                  <a class="drop-down-link {{ request()->routeIs('our-team')?'active-nav':''}}" href="{{ route('our-team') }}"> <span>Our Team</span></a>
                  
                </div>

              </div>
             </div>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{ request()->routeIs('product*')?'active-nav':''}} text-white" aria-current="page" href="{{ route('product','all')}}">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active  {{ request()->routeIs('project*')?'active-nav':''}} text-white" aria-current="page" href="{{ route('project-list') }}">Projects</a>
          </li>
          <li class="nav-item">
          <a class="nav-link active {{ request()->routeIs('blog*')?'active-nav':''}} text-white" aria-current="page" href="{{ route('blog-list') }}">Blogs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{ request()->routeIs('gallery*')?'active-nav':''}}  text-white" aria-current="page" href="{{ route('gallery')}}">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{ request()->routeIs('portfolio*')?'active-nav':''}}  text-white" aria-current="page" href="{{ route('portfolio')}}">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active {{ request()->routeIs('contact*')?'active-nav':''}} text-white" aria-current="page" href="{{ route('contact')}}">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 
  @yield('content')

  @yield('customer')
 @yield('container')
  <!-- footer -->
<footer>
  <section style="width: 100%; border-top: 1.5px solid rgb(87, 85, 85);" class="container-fluid align-items-center">
    <div class="container">
      <div style="color: #f26f1f;" class=" text-center">
        <h1 class="mt-3">Topsun Energy Pvt. Ltd</h1>
        <p class="text-success"> <a class="text-success" href="{{ route('our-story') }}"><span class="p-2">About Us</span></a><a
            class="text-success" href="{{ route('project-list') }}"><span class="p-2">Projects</span></a><a class="text-success" href="{{ route('blog-list') }}"><span
              class="p-2">Blogs</span></a><a class="text-success" href="{{ route('contact') }}"><span class="p-2">Contact</span></a></p>

        <p class="footer-socialMediaLink text-center">

          <a href="{{ $setting->facebook_link}}" target="_blank"><i
              class="bi bi-facebook smicons"></i></a><a target="_blank"
            href="{{ $setting->youtube_link}}"><i class="bi bi-youtube smicons "></i></a><a
            target="_blank" href="{{ $setting->twitter_link}}"><i class="bi bi-twitter smicons"></i></a><a
            target="_blank" href="{{ $setting->google_link}}"><i class="bi bi-google smicons"></i></a>
        </p>
      </div>
    </div>
  </section>
  
  <div style=" line-height: 30px;" class="container-fluid bg-success footer-break">
    <p class="text-center"><span class="text-white">Topsun Nepal</span> ©2022 All rights reserved. Developed By <a href="https://onvirotech.com/" target="blank" ><span class="marquee-color">Onviro Tech Pvt. Ltd.</span></a></p>
  </div>

  

  
</footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ asset('front/bootstrap-5.1.3-dist/js/bootstrap.js') }}"></script>
  <script src="{{ asset('front/supported/jquery.js') }}"></script>
  @yield('front-js')

  <script src="/path/to/dist/jquery.flipster.min.js') }}"></script>

  <script src="{{ asset('front/supported/index.js') }}"></script>

 <!-- slick -->
 <script src="{{ asset('front/plugins/slick-master/slick/slick.js')}}" type="text/javascript" charset="utf-8"></script>
 <script src="{{ asset('front/slick.js')}}"></script>
    
  <script src="{{ asset('front/carousel.js')}}"></script>
  <script type="text/javascript"src="{{ asset('front/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/waltzerjs.js')}}"></script>
  
 
  

</body>

</html>