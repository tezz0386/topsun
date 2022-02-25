@extends('front.front_layout')

@section('front-css')

<style>
    .project-div:hover {
        border-radius: 20px !important;
        box-shadow: 5px 5px 5px 5px #888888;
    }
    .project-div:hover img {
        /* border-top-left-radius: 20px;
       
        border-top-right-radius:20px; */
        border-radius: 20px 20px 0px 0px !important;
       
    }
</style>
@endsection

@section('content')


@isset($projects)
<section class="container-fluid">
    <div class="container py-3">
       <div class="card-body">
        <h1 class="text-center ">Our Projects</h1>
        <div class="row gx-2">
             @foreach($projects as $project)
                 <div class="col-md-3">
                   <div class="">
                     <a href="{{ route('project',$project->slug)}}">
                       <div class="project-div p-1">
                   <img style="width: 300px ; height: 200px;" class="img-fluid" src="{{ asset('uploads/projects/thumbnail/'.$project->image) }}" alt="">
                   <p>{{ ucfirst($project->title)}}</p>
                   </div>
                   </a>
                   </div>
                 </div>
             @endforeach
        </div> 
       </div>
</div>

</section>
<div class="container-fluid break"></div>
@include('front.customers.customers')
@endisset

@endsection




@section('front-js')
<script src="{{ asset('front/index.js') }}"></script>
@endsection