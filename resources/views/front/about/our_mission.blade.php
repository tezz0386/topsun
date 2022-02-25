@extends('front.front_layout')

@section('front-css')
<link rel="stylesheet" href="{{ asset('front/styles/mission.css') }}">
@endsection

@section('content')

<div style="overflow-x: hidden;">
    @isset($about)
    <div class="mission-div smaller-div">
        <div class="mission-content">
                <h3 class="header">{{ strtoupper($about->our_mission)}}</h3>
                <div class="mission-para">
                    <p>{!! $about->our_mission_summary !!}</p>
                </div>
               
        </div>
        <div class="image-div mission-img-div">
            <img class="mission-image" src="{{ asset('uploads/abouts/thumbnail/'.$about->image) }}" class="img-fluid rounded-start" alt="...">
        </div>

    </div>
  {{-- <div class="d-flex vision-title">
    <div style="width: 50%"></div>
    <div style="width: 50%;padding-left:4%">
      
        <h3 class="header">{{ strtoupper($about->our_vision)}}</h3>
      </div>
  </div> --}}
    <div class="vission-div smaller-div">
     
       
        <div style="z-index: 1" class="image-div vission-img-div">
            <img  class="mission-image vission-image" src="{{ asset('uploads/abouts/thumbnail/'.$about->image) }}" class="img-fluid rounded-end" alt="...">
        </div>
        <div class="vission-content">
                <h3 class="header ">{{ strtoupper($about->our_vision)}}</h3>
                <div class="mission-para">
                    <p>{!! $about->our_vision_summary !!}</p>
                            
                </div>
        </div>
        <div class="border-vision">
            
        </div>
    </div>
    <div class="objectives-div  smaller-div">
        <div class="objective-content">
                <h3 class="header">{{ strtoupper($about->our_objectives)}}</h3>
                <div class="mission-para">
                    <p>{!! $about->our_objectives_summary !!}</p>
            </div>
    
        </div>
        <div class="objectives-img-div image-div">
            <img class="mission-image objectives-image" src="{{ asset('uploads/abouts/thumbnail/'.$about->image) }}" class="img-fluid rounded-end" alt="...">
        </div>
        <div class="border-objective">
    
        </div>
    </div>
    @endisset
 </div>

    <div class="container-fluid break mt-2"></div>
    @include('front.customers.customers')

@endsection



@section('front-js')
<script src="{{ asset('front/index.js') }}"></script>
@endsection