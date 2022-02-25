@extends('layouts.admin-app')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        @isset($team)
            {{ Form::open(['url'=>route('team.update',$team->id),'files'=>true]) }}
            @method('put')
        @else
            {{ Form::open(['url'=>route('team.store'),'files'=>true]) }}
        @endisset
        <div class="row">
            <div class="col-md-8">
                <div class="card-body card card-top">
                    <div class="form-group">
                        {{ Form::label('name','Name:') }}
                        {{ Form::text('name',@$team->name,['class'=>'form-control form-control-sm '.($errors->has('name') ?'is-invalid':''),'placeholder'=>'Enter Name  Here....','required'=>true]) }}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('designation','Designation:') }}
                        {{ Form::text('designation',@$team->designation,['class'=>'form-control form-control-sm '.($errors->has('designation') ?'is-invalid':''),'placeholder'=>'Enter Designation  Here....','required'=>true]) }}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('level','Level:') }}
                        {{ Form::select('level',['first'=>'First Level','second'=>'Second level','third'=>'Third level'],@$team->level,['class'=>'form-control form-control-sm '.($errors->has('level') ?'is-invalid':''),'placeholder'=>'----Select At Least One----','required'=>true]) }}
                        @error('level')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('image','Choose Image:') }}
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('contact_num','Contact Num:') }}
                        {{ Form::tel('contact_num',@$team->contact_num,['class'=>'form-control form-control-sm '.($errors->has('contact_num') ?'is-invalid':''),'placeholder'=>'Enter Contact Number....','required'=>false]) }}
                        @error('contact_num')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        {{ Form::label('address','Address:') }}
                        {{ Form::textarea('address',@$team->address,['class'=>'form-control '.($errors->has('address') ?'is-invalid':''),'placeholder'=>'Enter Address Here...','required'=>false,'rows'=>3,'style'=>'resize:none;']) }}
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('detail','Details:') }}
                        {{ Form::textarea('detail',@$team->detail,['class'=>'form-control '.($errors->has('detail') ?'is-invalid':''),'placeholder'=>'Enter Details Here...','required'=>false,'rows'=>3,'style'=>'resize:none;']) }}
                        @error('detail')
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
                            {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$team->status,['class'=>'form-control form-control-sm '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true]) }}
                            @error('status')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            @isset($team)
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

