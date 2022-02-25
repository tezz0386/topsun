@extends('layouts.admin-app')
@section('content')



    @if (isset($service))
        <form action="{{ route('service.update', $service) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
        @else
            <form action="{{ route('service.store') }}" method="post" enctype="multipart/form-data">
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
                        {{ Form::text('title',@$service->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'required'=>true])}}
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
                        {{ Form::label('status','Status:')}}
                        {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$service->status,['class'=>'form-control form-control-sm '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true])}}
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="card-body" style="display: block;">
                    <button type="submit" class="btn btn-primary float-right">
                        @isset($service)
                        <i class="fa fa-paper-plane"></i> Update
                        @else
                        <i class="fa fa-plus"></i> Add
                        @endisset
                    </button>
                </div>

                </div>
            </div>
        </div>
        </div>
    </div>
    <form>
    @endsection
