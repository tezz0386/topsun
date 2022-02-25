@extends('front.front_layout')

@section('front-css')

<link rel="stylesheet" href="{{ asset('front/styles/gallery.css') }}">
@endsection

@section('content')

<section class="container-fluid gallery-container">
    <div class="container py-3 card-body">
        <nav aria-label="breadcrumb p-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('gallery')}}">Gallery</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($gallery->title)}}</li>
            </ol>
        </nav>
    </div>

  <div class="container card-body ">
    <div class="content row gx-0">
        @foreach($galleries as $gallery)
       <div class="col-lg-3 col-md-4 col-6 img-container">
        <a class="elem  " href="{{ asset('uploads/Gallery/'.$gallery->image)}}" data-lcl-thumb="{{ asset('uploads/Gallery/'.$gallery->image)}}">
            {{-- <span style="background-image: url({{ asset('uploads/Gallery/'.$gallery->image)}});"></span> --}}
          <img class="img-fluid" style="height: 200px" src="{{ asset('uploads/Gallery/'.$gallery->image)}}" alt="" srcset="">
        </a>
        {{-- <p class="img-overlay">{{$gallery->title}}</p> --}}
       </div>
       @endforeach
       
    </div>
  </div>
</section>
<!-- galler section ends -->
<div class="container-fluid break"></div>
@include('front.customers.customers')
@endsection



@section('front-js')
<script src="{{ asset('front/index.js') }}"></script>
<!-- gallery plugin -->
  <!--     <script src="lib/jquery.js" type="text/javascript"></script> -->

  <script src="{{ asset('front/plugins/LC-Lightbox-LITE-master/js/lc_lightbox.lite.js') }}" type="text/javascript"></script>
  <link rel="stylesheet" href="{{ asset('front/plugins/LC-Lightbox-LITE-master/css/lc_lightbox.css') }}" />
  <!-- SKINS -->
  <link rel="stylesheet" href="{{ asset('front/plugins/LC-Lightbox-LITE-master/skins/minimal.css') }}" />
  <!-- ASSETS -->
  <script src="{{ asset('front/plugins/LC-Lightbox-LITE-master/lib/AlloyFinger/alloy_finger.min.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
      $(document).ready(function (e) {

          // live handler
          lc_lightbox('.elem', {
              wrap_class: 'lcl_fade_oc',
              gallery: true,
              thumb_attr: 'data-lcl-thumb',

              skin: 'minimal',
              radius: 0,
              padding: 0,
              border_w: 0,
          });

      });
  </script>
@endsection