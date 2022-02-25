@extends('front.front_layout')

@section('front-css')

  <!-- lightweight carousel -->

  <link type="text/css"href="{{ asset('front/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/examples/css/styles.css') }}" rel="stylesheet" />

  
@endsection

@section('content')

  <!-- Main body -->
  @isset($first_item)
  <div class="container py-3 position-relative">
    <div class="card mb-3">
        <div id="project-details" class="row justify-content-between  g-0">
            <div class="col-md-7">
                <div class="card-body">
                    <h1 class="card-title">{{ ucfirst($first_item->title)}}</h1>
                    <h5  style="text-decoration: underline; color: #c75c1a;">Product Description</h5>
                   
                    <p class="card-text text-success">{!! $first_item->description !!}</p>
                </div>
            </div>
            <div class="col-md-5">
                <img src="{{ asset('uploads/products/thumbnail/'.$first_item->image) }}" class="img-fluid rounded-start" alt="...">
               
            </div>
        </div>
    </div>
  
</div>
@endisset


<div class="container-fluid bg-success py-1">
    <div class="container  text-start ">
        <h3 style="color: #f26f1f;">More Products</h3>
    </div>
</div>

<section class="container fluid">
    <div class="container py-1">

<!-- Carousel -->  
@isset($products) 
    <div id="carousel" class='container px-5 outerWrapper outerWrapper2'>
        @foreach($products as $product)
        <div  class="item carousel-item-container position-relative col-12">
            <div class="text-white carousel-div p-2">
                <img class="img-fluid" src="{{ asset('uploads/products/thumbnail/'.$product->image) }}" alt="">
                <div class="p-3">
                    <h3 style=" color: #ff6200;font-size: 20px; ">{{ ucfirst($product->title)}}</h3>
                        <a href="{{ route('product',$product->id)}}"><span  class=" p-1 " > View Details</span></a>
                </div>
            </div>
        </div> 
        @endforeach
      
    </div>
@endisset
</div>
</section>

<div class="container-fluid break"></div>
@include('front.customers.customers')


@endsection

@section('front-js')
 
<script src="{{ asset('front/carousel.js') }}"></script>
<script type="text/javascript"src="{{ asset('front/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/Lightweight-jQuery-Any-Html-Elements-Carousel-Plugin-WaltzerJS/waltzerjs.js') }}"></script>

@endsection