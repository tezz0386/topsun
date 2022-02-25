@extends('front.front_layout')

@section('front-css')
<link rel="stylesheet" href="{{ asset('front/styles/blogs.css') }}">
@endsection

@section('content')

<section class="container-fluid">
    <div class="container py-2">
        <!-- <h1 class="text-start pt-2 portfolio-header">Blogs</h1> -->
       <div class="card-body">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('homepage')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('blog-list')}}">Blogs</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($blog_detail->title)}}</li>
            </ol>
          </nav>
       </div>
        <div class="row card-body">
            @isset($blog_detail)
            <div class="col-md-8 ">
                    <div class="card mb-3 blog-post">
                        <img src="{{ asset('uploads/blogs/thumbnail/'.$blog_detail->image) }}" class="card-img-top" alt="...">
                        <div class="card-body blog-body">
                           <div style="border-bottom: 1px solid rgb(68, 67, 67);">
                            <h5 class="card-title blog-title">{{ ucfirst($blog_detail->title)}}</h5>
                            <p class="card-text"><small class="text-muted"><i class="bi bi-calendar"></i> <span style="margin-left: 5px;">{{ date('d/m/Y',strtotime($blog_detail->created_at))}}</span></small></p>
                           </div>
                           <p class="card-text paragraph">{!! $blog_detail->description!!}</p>
                          
                        </div>
                    </div>
            </div>
            @endisset

            <div class="col-md-4">
                @isset($recent_project)
                <div>
                    <h3 class="text-start pt-2 recent-posts">Recent Projects</h3>
                   @foreach($recent_project as $project)
                   <a href="{{ route('project',$project->slug)}}">
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

                @isset($recent_post)
                    <div>
                        <h3 class="text-start pt-2 recent-posts">Recent posts</h3>
                        @foreach($recent_post as $post)
                        <a href="{{ route('blog-detail',$post->slug)}}">
                        <div class="card mb-3 shadow">
                            <img src="{{ asset('uploads/blogs/thumbnail/'.$post->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                            <div >
                                <h5 class="card-title">{{ ucfirst($post->title) }}</h5>
                                <p class="card-text"><small class="text-muted"><i class="bi bi-calendar"></i> <span style="margin-left: 5px;">{{ date('d/m/Y',strtotime($post->created_at))}}</span></small></p>
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


@endsection


@section('front-js')
<script src="{{ asset('front/index.js') }}"></script>
@endsection