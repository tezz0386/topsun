@extends('layouts.admin-app')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        @isset($blog)
            {{ Form::open(['url'=>route('client.update',$blog->id),'files'=>true]) }}
            @method('put')
        @else
            {{ Form::open(['url'=>route('client.store'),'files'=>true]) }}
        @endisset
        <div class="row">
            <div class="col-md-8">
                <div class="card-body card card-top">
                    <div class="form-group">
                        {{ Form::label('category','Please Choose Category:') }}
                        {{ Form::select('category',@$categories->pluck('title','id'),[],['class'=>'form-control form-control-sm '.($errors->has('category') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true]) }}
                        @error('category')
                            <span class="text-danger"></span>
                        @enderror
                    </div>


                    <div class="form-group">
                        {{ Form::label('name','Client Name:') }}
                        {{ Form::text('name',@$blog->name,['class'=>'form-control form-control-sm '.($errors->has('name') ?'is-invalid':''),'placeholder'=>'Enter Client Name Here....','required'=>true]) }}
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('email','Client Email:') }}
                        {{ Form::email('email',@$blog->email,['class'=>'form-control '.($errors->has('email') ?'is-invalid':''),'placeholder'=>'Enter Client Email Here...','required'=>false]) }}
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('image','Choose Client Image:') }}
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
                        {{ Form::label('phone','Phone/Contact Num:') }}
                        {{ Form::text('phone',@$blog->phone,['class'=>'form-control '.($errors->has('phone') ?'is-invalid':''),'placeholder'=>'Enter Client Phone Number Here...','required'=>false]) }}
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('url','Client Url:') }}
                        {{ Form::url('url',@$blog->url,['class'=>'form-control '.($errors->has('phone') ?'is-invalid':''),'placeholder'=>'Enter Client Url Here...','required'=>false]) }}
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('address','address/Contact Num:') }}
                        {{ Form::textarea('address',@$blog->address,['class'=>'form-control '.($errors->has('address') ?'is-invalid':''),'placeholder'=>'Enter Client Address Here...','required'=>false,'rows'=>4,'style'=>'resize:none;']) }}
                        @error('address')
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
                            {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$blog->status,['class'=>'form-control form-control-sm '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true]) }}
                            @error('status')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            @isset($blog)
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

@push('js')

    <script>
        ClassicEditor
            .create(document.querySelector('.blog-editor'), {
                ckfinder: {
                    uploadUrl: '{{ asset("ckeditor/ckfinder/ckfinder/core/connector/php/connector.php") }}?command=QuickUpload&type=Files&responseType=json',
                },

                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'textPartLanguage',
                        'bold',
                        'italic',
                        'link',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'outdent',
                        'indent',
                        '|',
                        'imageUpload',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'undo',
                        'redo',
                        'alignment',
                        'fontColor',
                        'fontFamily',
                        'fontBackgroundColor',
                        'fontSize',
                        'highlight',
                        'CKFinder',
                        'findAndReplace'
                    ]
                },

                language: 'en',
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side',
                        'linkImage'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells'
                    ]
                },
                licenseKey: '',



            })
            .then(editor => {
                window.editor = editor;

            })
            .catch(error => {
                console.error('Oops, something went wrong!');
                console.error(
                    'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:'
                );
                console.warn('Build id: xssmfrzicipw-6don1y1odq75');
                console.error(error);
            });

    </script>
@endpush
