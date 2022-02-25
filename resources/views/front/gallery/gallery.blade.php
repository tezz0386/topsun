@extends('front.front_layout')

@section('front-css')
<link rel="stylesheet" href="{{ asset('front/styles/gallery.css') }}">
@endsection

@section('content')
<section class="container-fluid">
    <div class="container py-3">
        <h1 class="text-center">Our Albums</h1>
        <div class="row">
            @isset($galleries)
                @foreach($galleries as $gallery)
                    <div class="col-4">
                        <a href="{{ route('gallery-list',$gallery->id)}}">
                            <div class="gallery-projectwise ">
                                <div class="test">
                                    <img style="height: 300px;" src="{{ asset('uploads/Gallery/'.$gallery->getImage[0]->image) }}" alt="" class="img-fluid">
                                    <h5 class="card-title overlay">
                                        {{ strtoupper($gallery->title)}}
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
    </div>
</section>
<!-- galler section ends -->
<div class="container-fluid break"></div>
@include('front.customers.customers')

@endsection





@section('front-js')
<script src="{{ asset('front/index.js') }}"></script>
@endsection