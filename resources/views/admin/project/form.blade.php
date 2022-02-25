@extends('layouts.admin-app')
@section('content')



    @if (isset($project))
        <form action="{{ route('project.update', $project) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
        @else
            <form action="{{ route('project.store') }}" method="post" enctype="multipart/form-data">
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
                        <label>Title:</label>
                        <input type="text" name="title" class="form-control form-control-sm"
                            placeholder="Enter project Title" value="{{ old('title', @$project->title) }}">
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
                    <div class="row">
                        <div class="col-md-6">

                        <div class="form-group">
                            <label for="started_at">Start At:</label>
                            
                            <input type="date" class="form-control form-control-sm" name="started_at" value="{{date("Y-m-d",strtotime(@$project->started_at))}}">
                            @error('started_at')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="finished_at">Finished At:</label>
                                <input type="date" class="form-control form-control-sm" name="finished_at" value="{{ date("Y-m-d",strtotime(@$project->finished_at))}}">
                                @error('finished_at')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                        
                        <div class="form-group">
                        <label for="upcomming_status">Up-Comming Project:</label>
                        {{ Form::select('upcomming_status',['yes'=>'Yes','no'=>'No'],@$project->upcomming_status,['class'=>'form-control form-control-sm ','placeholder'=>'------Select Any One-----'])}}
                        
                        </div>
                        </div>

                        

                        

                        
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="content">Summary:</label>
                        <textarea name="summary" id="content" class="form-control" rows="3" name="content">{{old('summary', @$project->summary)}}</textarea>
                        @error('summary')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Description:</label>
                        <textarea name="description" id="content" class="form-control editor" rows="3" name="content">{{old('description', @$project->description)}}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default collapsed-card card-top">
                <div class="card-header">
                  <h3 class="card-title">SEO:</h3>
      
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: none;">
                    <div class="form-group">
                        <label for="title_tag">Title Tag:</label>
                        <input name="title_tag" type="text" class="form-control form-control-sm" value="{{old('title_tag', @$project->title_tag)}}">
                        @error('title_tag')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords:</label>
                        <textarea name="meta_keywords" id="meta_keywords" rows="3" class="form-control">{{old('meta_keywords', @$project->meta_keywords)}}</textarea>
                        @error('meta_keywords')
                        <span class="text-danger"></span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Keywords:</label>
                        <textarea name="meta_description" id="meta_description" rows="4" class="form-control">{{old('meta_description', @$project->meta_description)}}</textarea>
                        @error('meta_description')
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
                    <div class="form-group">
                        <label for="status">Status:</label>
                        {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$project->status,['class'=>'form-control form-control-sm','required'=>true])}}
                        
                    </div>
                    <button type="submit" class="btn btn-primary float-right">
                        @if (isset($project))
                            Update
                        @else
                            Save
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form>
    @endsection
