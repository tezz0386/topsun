@extends('layouts.admin-app')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        @isset($clientCategory)
            {{ Form::open(['url'=>route('client-category.update', $clientCategory),'files'=>true]) }}
            @method('PATCH')
        @else
            {{ Form::open(['url'=>route('client-category.store'),'files'=>true]) }}
        @endisset
        <div class="row">
            <div class="col-md-8">
                <div class="card-body card card-top">
                    <div class="form-group">
                        {{ Form::label('title','Client Name:') }}
                        {{ Form::text('title',@$clientCategory->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter clientCategory Title....','required'=>true]) }}
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                        <div class="form-group">
                            {{ Form::label('status','Client Status:') }}
                            {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$clientCategory->status,['class'=>'form-control form-control-sm '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true]) }}
                            @error('status')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            @isset($clientCategory)
                                Update
                            @else
                                Save
                            @endisset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
</div>
@endsection