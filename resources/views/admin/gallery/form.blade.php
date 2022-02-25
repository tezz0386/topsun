@extends('layouts.admin-app')

@push('js')
<script>

    const base_url=$("meta[name='base_url']").attr('content');

    $(document).on('click','.delete-image',function(e){

    e.preventDefault();

    let image_id=$(this).data('imageid');
    const elem=$(this);

    $.ajax({
        
        url:base_url+"/delete-image",
        type:"get",
        data:{
            image_id:image_id
        },
        success:function(response)
        {
            $(elem).parent().remove();
        }
    });

    });
</script>
@endpush
@section('content')



    @if (isset($gallery))
    {{ Form::open(['url'=>route('gallery.update',$gallery->id),'files'=>true])}}
    @method('put')
        
        @else
        {{ Form::open(['url'=>route('gallery.store'),'files'=>true])}}
           
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
                        {{ Form::label('title','Title:')}}
                        {{ Form::text('title',@$gallery->title,['class'=>'form-control form-control-sm '.($errors->has('title') ?'is-invalid':''),'placehoder'=>'Enter Gallery Title','required'=>true])}}
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {{ Form::label('image','Gallery Image:')}}
                        {{ Form::file('image[]',['class'=>($errors->has('image') ?'is-invalid':''),'multiple','accept'=>'image/*'])}}
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @isset($gallery)
                    <div class="form-group col-md-12">
                        <div class="row">
                            @foreach($gallery->getImage as $image)
                                <div class="col-md-2">
                                    <img src="{{ asset('uploads/Gallery/'.$image->image) }}" alt="" class="img-fluid img-thumbnail">
                                    <a href="javascript:;" data-imageid="{{ $image->id}}" style="border-radius:50%" class="btn btn-sm btn-danger btn-style icon btn-rounded delete-image">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    
                    
                    @endisset
                    <div class="form-group">
                        {{ Form::label('content','Content:')}}
                        {{ Form::textarea('content',@$gallery->content,['class'=>'form-control '.($errors->has('content') ?'is-invalid':''),'placehoder'=>'Enter Gallery Content','required'=>false,'rows'=>3,'style'=>'resize:none;'])}}
                        @error('content')
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
                    <div class="form-group">
                        
                        {{ Form::label('status','Status:')}}
                        {{ Form::select('status',['active'=>'Active','inactive'=>'In-Active'],@$gallery->status,['class'=>'form-control form-control-sm '.($errors->has('status') ?'is-invalid':''),'placeholder'=>'----Select Any One','required'=>true])}}
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        
                    </div>
                    <button type="submit" class="btn btn-primary float-right">
                        @if (isset($gallery))
                            Update
                        @else
                            Save
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close()}}
    @endsection
    @push('js')
        <script type="text/javascript">
            $('#icon').on('change', function() {
                var file = $(this).get(0).files;
                var reader = new FileReader();
                reader.readAsDataURL(file[0]);
                reader.addEventListener("load", function(e) {
                    var image = e.target.result;
                    $("#iconThumbnail").attr('src', image);
                });
            });
        </script>

        
    @endpush
