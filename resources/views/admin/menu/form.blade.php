@extends('layouts.admin-app')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        @isset($menu)
            {{ Form::open(['url'=>route('menu.update',$menu->id),'files'=>true]) }}
            @method('put')
        @else
            {{ Form::open(['url'=>route('menu.store'),'files'=>true]) }}
        @endisset
        <div class="row">
            <div class="col-md-8">
                <div class="card-body card card-top">
                    <div class="form-group">
                        {{ Form::label('title','Menu Title:') }}
                        {{ Form::text('title',@$menu->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'placeholder'=>'Enter Menu Title Here....','required'=>true]) }}
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {{ Form::label('menu_type','Menu Type:') }}
                        {{ Form::select('menu_type',['url'=>'URL','route'=>'ROUTE','page'=>'PAGE'],@$menu->menu_type,['class'=>'form-control form-control-sm '.($errors->has('menu_type') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true]) }}
                        @error('menu_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                            {{ Form::label('status','Menu Status:') }}
                            {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$menu->status,['class'=>'form-control form-control-sm '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'----Select Any One----','required'=>true]) }}
                            @error('status')
                                <span class="text-danger"></span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-right">
                            @isset($menu)
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
