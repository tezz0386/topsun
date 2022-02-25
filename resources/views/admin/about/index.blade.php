@extends('layouts.admin-app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">About Us Page </h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 350px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Heading</th>
                            <th>Our Mission</th>
                            <th>Our Vision</th>
                            <th>Our Objectives</th>
                            <th>Action</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($abouts) && count($abouts)>0)
                        @foreach($abouts as $about)
                        <tr>
                            <td>{{$n++}}</td>
                            <td>{{$about->title}}</td>
                            <td>{{$about->our_mission}}</td>
                            <td>{{$about->our_vision}}</td>
                            <td>{{$about->our_objectives}}</td>
                            <td>
                                <a href="{{route('about.edit', $about)}}">
                                    <i class="fa fa-edit"></i>
                                </a>

                                
                            </td>
                            <td>
                                <a href="{{ route('feature.index') }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-eye"></i> View Features
                                </a>`
                            </td>
                            <!-- <td>
                                <form action="{{route('about.destroy', $about)}}" method="post">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-link"><i class="fa fa-trash"></i></button>
                                </form>
                            </td> -->
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