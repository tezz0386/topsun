@extends('layouts.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">Status</button>
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="true">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('get-status-product', 'active')}}">
                                            <i class="fa fa-circle text-blue"></i>
                                            Active
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('get-status-product', 'inactive')}}">
                                            <i class="fa fa-circle text-red"></i>
                                            Inactive
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm">Showing</button>
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="true">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{route('product.index', 'all')}}">
                                            <i class="fa fa-circle text-red"></i>
                                            All
                                        </a>
                                    </li>
                                    @for($i=10; $i<=100; $i=$i+10)
                                    <li>
                                        <a href="{{route('product.index', $i)}}">
                                            <i class="fa fa-circle text-blue"></i>
                                            {{$i}}
                                        </a>
                                    </li>
                                    @endfor

                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <a href="{{route('product.create')}}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus"></i>
                                    Create
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm">Action</button>
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="true">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        
                                        <li>
                                            <a href="javascript:void(0);" class="to-perform-blog" data-multiple_action="active">
                                                <i class="fa fa-circle text-green"></i>
                                                Active
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="to-perform-blog" data-multiple_action="inactive">
                                                <i class="fa fa-circle text-blue"></i>
                                                Inactive
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="to-perform-blog" data-multiple_action="delete">
                                                <i class="fa fa-circle text-red"></i>
                                                Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <h3 class="card-title"> 
                    Products Lists</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 350px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                </div>
                <div class="card-body table-responsive p-0">
                    <form action="{{route('to-product')}}" method="post" id="full-form">
                        <input type="text" hidden name="multiple_action" id="multiple_action">
                        @csrf
                        <table class="table table-hover text-nowrap imageTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>

                                    </th>

                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th colspan="2">Action</th>
                                    <th>
                                        <input type="checkbox" name="selectall" id="selectall">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($products) && count($products) > 0)
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td>{{ $product->title }}</td>
                                            <td>
                                                <a href="{{ asset('uploads/product/thumbnail/' . $product->image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('uploads/products/thumbnail/' . $product->image) }}"
                                                        alt="project image" height="100" width="150">
                                                </a>
                                            </td>

                                            <td>
                                                {{ $product->created_at->format('M') }}
                                                {{ $product->created_at->format('d') }}-{{ $product->created_at->format('Y') }}
                                            </td>
                                            <td>
                                                @if ($product->status == 'active')
                                                    <span class="bg-success active-status">{{ ucfirst($product->status) }}</span>
                                                @else
                                                    <span
                                                        class="bg-warning inactive-status" >{{ ucfirst($product->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('product.edit', $product) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="delete-product" data-id="{{ $product->id }}"><i
                                                        class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="selects[]" class="select" value="{{$product->id}}">
                                            </td>
                                            
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
                    @if($products instanceof \Illuminate\Pagination\AbstractPaginator)
                    {{$products->links()}}
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
                $('.delete-product').on('click', function(e) {
                    e.preventDefault();
                    var url = "{{ route('product.destroy', ':id') }}";
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

                $('.to-perform-blog').on('click', function(e){
                    var performAction = $(this).data('multiple_action');
                    $('#multiple_action').val(performAction);
                    if(confirm('Are You sure want to '+performAction + '......?')){
                        $('#full-form').submit();
                    }
                });


            });
        </script>
    @endpush
