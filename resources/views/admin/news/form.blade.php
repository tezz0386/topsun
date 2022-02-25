@extends('layouts.admin-app')
@section('content')



    {{-- @if (isset($about))
        <form action="{{ route('about.update', $about) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
        @else
            <form action="{{ route('about.store') }}" method="post" enctype="multipart/form-data">
    @endif
    @csrf --}}

    @isset($new)
    {{ Form::open(['url'=>route('news.update',$new->id),'files'=>true])}}
    @method('put')
    @else
    {{ Form::open(['url'=>route('news.store'),'files'=>true])}}
    @endisset
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default card-top">
                <div class="card-header">
                    <h3 class="card-title">Details: </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <div class="form-group">
                        {{ Form::label('text','Title:')}}
                        {{ Form::text('title',@$new->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'required'=>true])}}
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('image')
                                <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    

                    <div class="form-group">
                        {{ Form::label('is_news','Is News :')}}
                        {{ Form::select('is_news',['yes'=>'Yes','no'=>'No'],@$new->is_news,['class'=>'form-control form-control-sm '.($errors->has('is_news') ?'is-invalid':''),'required'=>true,'placeholder'=>'----Select Any One----'])}}
                        @error('is_news')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('is_popup','Is Popup :')}}
                        {{ Form::select('is_popup',['yes'=>'Yes','no'=>'No'],@$new->is_popup,['class'=>'form-control form-control-sm '.($errors->has('is_popup') ?'is-invalid':''),'required'=>true,'placeholder'=>'----Select Any One----'])}}
                        @error('is_popup')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('url','News Url :')}}
                        {{ Form::url('url',@$new->url,['class'=>'form-control form-control-sm '.($errors->has('url') ?'is-invalid':''),'required'=>false])}}
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                   

                </div>
            </div>
        </div>
        <div class="col-md-4">
            

          

            <div class="card card-default card-top">

            
                <div class="card-header">
                    <h3 class="card-title">Action: </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <button type="submit" class="btn btn-primary float-right">
                        @isset($new)
                        Update
                        @else
                        Add
                        @endisset
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form>
    @endsection
