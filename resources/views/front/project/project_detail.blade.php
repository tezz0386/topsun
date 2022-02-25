@extends('front.front_layout')

@section('front-css')

<!-- lightweight carousel -->

<link type="text/css" href="{{ asset('front//Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/examples/css/styles.css') }}" rel="stylesheet" />
@endsection

@section('content')
 <!-- Main body -->
 @isset($project_detail)
 <div  class="container py-3">
   <div class="row">
    <div class="col-12">
       <div class="card-body">
        <nav aria-label="breadcrumb" >
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('homepage')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('project-list')}}">Projects</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($project_detail->title) }}</li>
            </ol>
          </nav>
       </div>
    </div>
   </div>
    <div class="card mb-3">
        <div id="project-details" class="row justify-content-between  g-0">
            <div class="col-md-7">
                <div class="card-body pe-2">
                    <h1 class="card-title">{{ ucfirst($project_detail->title) }}</h1>
                    <p class="card-text text-success pe-1">{!! $project_detail->description !!}</p>
                </div>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('uploads/projects/thumbnail/'.$project_detail->image)}}" class="img-fluid rounded-start" alt="...">
               
            </div>
        </div>
    </div>  
</div>
@endisset

<div class="container-fluid bg-success py-1">
    <div class="container  text-start ">
        <h3 style="color: #f26f1f;">More Projects</h3>
    </div>
</div>
<!-- Carousel -->
@isset($more_project)
<div class="container">
    <div id="carousel" class='container px-5 outerWrapper outerWrapper2'>
        @foreach($more_project as $project)
            <div  class="item carousel-item-container position-relative col-12">
                <div class="text-white carousel-div p-2">
                    <img class="img-fluid" src="{{ asset('uploads/projects/thumbnail/'.$project->image)}}" alt="">
                    <div class="p-3">
                        <h3 class="more-projects-h3" style=" color: #ff6200;font-size: 15px; ">{{ ucfirst($project->title) }}</h3>
                            <a href="{{ route('project',$project->slug)}}"><span  class=" p-1 " > View Details</span></a>
                    </div>
                </div>
            </div> 
        @endforeach
    </div>
</div>
@endisset

<div class="container-fluid break"></div>
@include('front.customers.customers')

@endsection

@section('front-js')


<script src="{{ asset('front/carousel.js') }}"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript"
    src="{{ asset('front/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/waltzerjs.js') }}"></script>
<script src="{{ asset('front/index.js') }}"></script>
@endsection