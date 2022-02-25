@extends('layouts.admin-app')
@section('content')



    @if (isset($about))
        <form action="{{ route('about.update', $about) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
        @else
            <form action="{{ route('about.store') }}" method="post" enctype="multipart/form-data">
    @endif
    @csrf
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
                        {{ Form::text('title',@$about->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'required'=>true])}}
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="file">Image:</label>
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
                        {{ Form::label('video_link','Video Link:')}}
                        {{ Form::text('video_link',@$about->video_link,['class'=>'form-control form-control-sm '.($errors->has('video_link') ?'is-invalid':''),'required'=>true])}}
                        @error('video_link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('summary','Summary:')}}
                        {{ Form::textarea('summary',@$about->summary,['class'=>'form-control '.($errors->has('summary') ?'is-invalid':''),'required'=>false,'rows'=>3,'style'=>'resize:none;'])}}
                        @error('summary')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('about_description','Description:')}}
                        {{ Form::textarea('about_description',@$about->about_description,['class'=>'form-control editor '.($errors->has('about_description') ?'is-invalid':''),'required'=>true,'rows'=>4,'style'=>'resize:none;'])}}
                        @error('about_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default collapsed-card card-top">
                <div class="card-header">
                  <h3 class="card-title">Content Section:</h3>
      
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    <div class="form-group">
                    {{ Form::label('our_mission','Our Mission:')}}
                    {{ Form::textarea('our_mission_summary',@$about->our_mission_summary,['class'=>'form-control '.($errors->has('our_mission_summary') ?'is-invalid':''),'required'=>true,'rows'=>3,'style'=>'resize:none;'])}}
                        @error('our_mission_summary')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                    {{ Form::label('our_vision','Our Vision:')}}
                    {{ Form::textarea('our_vision_summary',@$about->our_vision_summary,['class'=>'form-control '.($errors->has('our_vision_summary') ?'is-invalid':''),'required'=>true,'rows'=>3,'style'=>'resize:none;'])}}
                        @error('our_vision_summary')
                        <span class="text-danger"></span>
                        @enderror
                    </div>
                    <div class="form-group">
                    {{ Form::label('our_objectives','Our Objectives:')}}
                    {{ Form::textarea('our_objectives_summary',@$about->our_objectives_summary,['class'=>'form-control editor1 '.($errors->has('our_objectives_summary') ?'is-invalid':''),'required'=>true,'rows'=>3,'style'=>'resize:none;'])}}
                        @error('our_objectives_summary')
                        <span class="text-danger"></span>
                        @enderror
                    </div>
                </div>
            </div>

            

          

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
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form>
    @endsection
