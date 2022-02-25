@extends('layouts.admin-app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    @isset($up_comming)
                        Up-Comming
                    @endisset    
                    Blog Lists</h3>
                    <!-- /.card-header -->
                </div>
                <div class="card-body table-responsive p-0">
                    <form action="{{route('to-blog')}}" method="post" id="full-form">
                        <input type="text" hidden name="multiple_action" id="multiple_action">
                        @csrf
                        <table class="table table-hover text-nowrap imageTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>
                                        Video
                                    </th>

                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($videos) && count($videos) > 0)
                                    @foreach ($videos as $video)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td>{{ $video->title }}</td>
                                            <td>
                                                <a href="{{ asset('uploads/video/'.$video->video) }}"
                                                    target="_blank">
                                                    View
                                                </a>
                                            </td>

                                            <td>
                                                {{ $video->created_at->format('M') }}
                                                {{ $video->created_at->format('d') }}-{{ $video->created_at->format('Y') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('bannerVideo.edit', $video) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
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
                    @if($videos instanceof \Illuminate\Pagination\AbstractPaginator)
                    {{$videos->links()}}
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
