@extends('layouts.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="container mb-2">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <a href="{{route('client-category.create')}}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Create
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <form action="#" method="post" id="full-form">
                        <input type="text" hidden name="multiple_action" id="multiple_action">
                        @csrf
                        <table class="table table-hover text-nowrap imageTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>
                                        Clients
                                    </th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($categories) && count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td>{{ $category->title }}</td>

                                            <td>
                                                <a href="{{route('getClientsWithCategory', $category)}}">
                                                    <i class="fa fa-users">
                                                        {{$category->clients->count()}}
                                                    </i>
                                                </a>
                                            </td>
                                            <td>
                                                {{ $category->created_at->format('M') }}
                                                {{ $category->created_at->format('d') }}-{{ $category->created_at->format('Y') }}
                                            </td>
                                            <td>
                                                @if ($category->status == 'active')
                                                    <span class="bg-success active-status">{{ ucfirst($category->status) }}</span>
                                                @else
                                                    <span
                                                        class="bg-warning inactive-status" >{{ ucfirst($category->status) }}</span>
                                                @endif
                                            </td>
                                            @isset($up_comming)
                                            <td>
                                                <a href="{{ route('category.set_upcomming', $category->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            @else
                                            <td>
                                                <a href="{{ route('client-category.edit', $category->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="delete-item" data-id="{{ $category->id }}"><i
                                                        class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            @endisset
                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">
                                            <center>No Record Found</center>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </form>
                    @if($categories instanceof \Illuminate\Pagination\AbstractPaginator)
                    {{$categories->links()}}
                    @endif
                </div>
                <!-- /.card-body -->
                <!-- /.card -->
            </div>
        </div>
        <form action="#" method="post" hidden id="delete-form">
            @csrf
            {{ method_field('DELETE') }}
        </form>
    @endsection
    @push('js')
        <script>
            $(document).ready(function() {
                $('.delete-item').on('click', function(e) {
                    e.preventDefault();
                    var url = "{{ route('client-category.destroy', ':id') }}";
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

                $('.to-perform-category').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });


            });
        </script>
    @endpush
