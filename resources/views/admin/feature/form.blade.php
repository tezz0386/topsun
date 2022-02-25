@extends('layouts.admin-app')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        @isset($features)
            {{ Form::open(['url'=>route('feature.update',$features->id),'files'=>true]) }}
            @method('put')
        @else
            {{ Form::open(['url'=>route('feature.store'),'files'=>true]) }}
        @endisset
        <div class="row">
            <div class="col-md-8">
                <div class="card-body card card-top">
                    <div class="form-group">
                        {{ Form::label('title','Title:') }}
                        {{ Form::text('title',@$features->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter Title Here....','required'=>true]) }}
                        @error('title')
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
                        {{ Form::label('summary','Summary:') }}
                        {{ Form::textarea('summary',@$features->summary,['class'=>'form-control form-control-sm '.($errors->has('summary') ?'is-invalid':''),'placeholder'=>'Enter Summary Here....','required'=>true,'rows'=>3,'style'=>'resize:none;']) }}
                        @error('summary')
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
                            {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$features->status,['class'=>'form-control form-control-sm '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true]) }}
                            @error('status')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            @isset($features)
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
