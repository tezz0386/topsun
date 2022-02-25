@extends('layouts.admin-app')
@section('content')



<div class="col-md-12 col-lg-12">
        @isset($organization)
            {{ Form::open(['url'=>route('organization.update',$organization->id),'files'=>true]) }}
            @method('put')
        @else
            {{ Form::open(['url'=>route('organization.store'),'files'=>true]) }}
        @endisset
        <div class="row">
            <div class="col-md-8">
                <div class="card-body card card-top">
                    <div class="form-group">
                        {{ Form::label('title','Title:') }}
                        {{ Form::text('title',@$organization->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter Organization Title Here....','required'=>true]) }}
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('portfolio_id','Organization List Of:') }}
                        {{ Form::select('portfolio_id',@$sector_list->pluck('title','id'),@$organization->portfolio_id,['class'=>'form-control form-control-sm '.($errors->has('portfolio_id') ?'is-invalid':''),'placeholder'=>'----Select At Least One----','required'=>true]) }}
                        @error('portfolio_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        {{ Form::label('pdf','Choose  File:') }}
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile"  name="pdf">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('pdf')
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
                            {{ Form::label('status','Status:') }}
                            {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$organization->status,['class'=>'form-control form-control-sm '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true]) }}
                            @error('status')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            @isset($organization)
                            <i class="fa fa-paper-plane"></i>
                                 Update
                            @else
                            <i class="fa fa-plus"></i>
                                 Add
                            @endisset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
