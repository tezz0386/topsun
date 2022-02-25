@extends('front.front_layout')

@section('front-css')
<link rel="stylesheet" href="{{ asset('front/styles/blogs.css') }}">
@endsection

@section('content')

@isset($blogs)
    <section class="container-fluid">
        <div class="container py-3">
          <div class="card-body">
            <h1 class="text-center  portfolio-header ">Blogs</h1>
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-md-3">
                        <a href="{{ route('blog-detail',$blog->slug)}}">
                            <div class="mb-3 project-div">
                                <img src="{{ asset('uploads/blogs/thumbnail/'.$blog->image) }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ ucfirst($blog->title)}}</h5>
                                    <p class="card-text limit-paragraph">{!! Str::limit($blog->description, 50)  !!}</p>
                                    <p class="card-text"><small class="text-muted"><i class="bi bi-calendar"></i> <span style="margin-left: 5px;">{{ date('Y/m/d',strtotime($blog->created_at))}}</span></small></p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
          </div>
        </div>
    </section>
@endisset




@endsection


@section('front-js')
<script src="{{ asset('front/index.js') }}"></script>
@endsection