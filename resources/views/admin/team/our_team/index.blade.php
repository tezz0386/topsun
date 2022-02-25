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

                                    </th>

                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($ourteams) && count($ourteams) > 0)
                                    @foreach ($ourteams as $ourteam)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td>{{ $ourteam->title }}</td>
                                            <td>
                                                <a href="{{ asset('uploads/teams/thumbnail/' . $ourteam->image) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('uploads/teams/thumbnail/' . $ourteam->image) }}"
                                                        alt="project image" height="100" width="150">
                                                </a>
                                            </td>

                                            <td>
                                                {{ $ourteam->created_at->format('M') }}
                                                {{ $ourteam->created_at->format('d') }}-{{ $ourteam->created_at->format('Y') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('ourTeam.edit', $ourteam) }}">
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
                    @if($ourteams instanceof \Illuminate\Pagination\AbstractPaginator)
                    {{$ourteams->links()}}
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
