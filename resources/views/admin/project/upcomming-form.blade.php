@extends('layouts.admin-app')
@section('content')
{{ Form::open(['url'=>route('set-upcomming',$project->id)])}}
    @method('put')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default card-top">
                <div class="card-header">
                    <h3 class="card-title">Set Up-Comming Schedule: </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                    </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="upcomming_status">Up-Comming Project:</label>
                        {{ Form::select('upcomming_status',['yes'=>'Yes','no'=>'No'],@$project->upcomming_status,['class'=>'form-control form-control-sm ','placeholder'=>'------Select Any One-----'])}}
                        
                        </div>

                        <div class="form-group">
                            <label for="started_at">Upcomming- At:</label>
                            <input type="date" class="form-control form-control-sm" name="started_at" value="{{date("Y-m-d",strtotime(@$project->started_at))}}">
                            @error('upcomming_date')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">
                            Update
                        </button>
                            </div>
                        </div>
                        </div>
                    </div>
                    

                    
                </div>
                <div class="card-body" style="display: block;">
                    
                </div>
            </div>
        </div>
    </div>
    {{ Form::close()}}
@endsection
    @push('js')
        <script>
            $(document).ready(function() {
                $('.delete-item').on('click', function(e) {
                    e.preventDefault();
                    var url = "{{ route('project.destroy', ':id') }}";
                    var id = $(this).data('id');
                    url = url.replace(':id', id);
                    $('#delete-form').attr('action', url);
                    if (confirm("Are you sure want to delete...?")) {
                        $('#delete-form').submit();
                    }
                });

                $('#selectall').click(function() {
                    $('input:checkbox').prop('checked', this.checked);
                });

                $('.to-perform').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });


            });
        </script>
    @endpush
