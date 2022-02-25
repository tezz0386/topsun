@extends('layouts.admin-app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gallery Lists</h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 350px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                         <a href="{{route('gallery.create')}}" class="btn btn-primary btn-sm ml-5"><i class="fa fa-plus"> Create</i></a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap imageTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($gallerys) && count($gallerys)>0)
                        @foreach($gallerys as $gallery)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$gallery->title}}</td>
                            <td>
                                {{$gallery->created_at->format('M')}} {{$gallery->created_at->format('d')}}-{{$gallery->created_at->format('Y')}}
                            </td>
                            <td>
                                @if($gallery->status=='active')
                                <span class="bg-success active-status">{{$gallery->status}}</span>
                                @else
                                <span class="bg-warning inactive-status">{{$gallery->status}}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('gallery.edit', $gallery)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{route('gallery.destroy', $gallery)}}" method="post">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-link"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7">
                                <center>No Record Found</center>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
