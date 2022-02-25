@extends('front.front_layout')

@section('front-css')

<link rel="stylesheet" href="{{ asset('front/styles/blogs.css') }}">
@endsection

@section('content')

<section class="container-fluid">
    <div class="container p-2">
        <!-- <h1 class="text-start pt-2 portfolio-header">Blogs</h1> -->
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('homepage')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($event->title)}}</li>
            </ol>
          </nav>
        <div class="row">
            <div class="col-md-8 ">
                    <div class="card mb-3 blog-post">
                        <img src="{{ asset('uploads/projects/thumbnail/'.$event->image) }}" class="card-img-top" alt="...">
                        <div class="card-body blog-body">
                           <div style="border-bottom: 1px solid rgb(68, 67, 67);">
                            <h5 class="card-title blog-title">{{ ucfirst($event->title)}}</h5>
                            <p class="card-text"><small class="text-muted"><i class="bi bi-calendar"></i> <span style="margin-left: 5px;">{{ date('d/m/Y',strtotime($event->created_at))}}</span></small></p>
                           </div>
                           <p class="card-text paragraph">{!! $event->description !!}<p> 
                        </div>
                    </div>
            </div>

            <div class="col-md-4">

                <div>
                    @isset($projects)
                    <h3 class="text-start pt-2 recent-posts">Recent Projects</h3>
                        @foreach($projects as $project)
                        <a href="{{route('project',$project->slug)}}">
                        <div class="card mb-3 shadow">
                            <img src="{{ asset('uploads/projects/thumbnail/'.$project->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                               <div >
                                <h5 class="card-title">{{ ucfirst($project->title)}}</h5>
                               </div>
                            </div>
                        </div>
                       </a>
                       @endforeach
                   </div>
                   @endisset

                @isset($blogs)
               <div>
                <h3 class="text-start pt-2 recent-posts">Recent Blogs</h3>
                @foreach($blogs as $blog)
               <a href="{{ route('blog-detail',$blog->slug)}}">
                <div class="card mb-3 shadow">
                    <img src="{{ asset('uploads/blogs/thumbnail/'.$blog->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                       <div >
                        <h5 class="card-title">{{ ucfirst($blog->title)}}</h5>
                        <p class="card-text"><small class="text-muted"><i class="bi bi-calendar"></i> <span style="margin-left: 5px;">{{ date('d/m/Y',strtotime($blog->created_at))}}</span></small></p>
                       </div>
                    </div>
                </div>
               </a>
               @endforeach
               </div>
               @endisset

            </div>
           
        </div>
    </div>
</section>
<div class="container-fluid break"></div>
@include('front.customers.customers')

@endsection



@section('front-js')

<script src="{{ asset('front/index.js') }}"></script>
@endsection