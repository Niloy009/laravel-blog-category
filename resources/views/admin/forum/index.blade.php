@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Forum
                        <a href="{{route('forums.create')}}" class="btn btn-success btn-sm float-right">Add New</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table text-center" id="forums">
                            <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 15%">Title</th>
                                <th style="width: 20%">Body</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">image</th>
                                <th style="width: 10%">Category</th>
{{--                                <th style="width: 10%">Tag</th>--}}
                                <th style="width: 20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php($i = 1)
                            @foreach($forums as $forum)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$forum->title}}</td>
                                    <td>{{$forum->body}}</td>
                                    <td>
                                        <a href="{{route('forums.status.update', $forum->id)}}"
                                           onclick="return confirm('Are you sure to change!!!')">
                                            {{$forum->status == 1 ? 'Active' : 'Inactive'}}
                                        </a>
                                    </td>
                                    <td>
                                        <img src="{{asset('uploads/'. $forum->img)}}" class="card-img-top" alt="img">
                                        {{--                                        <img src="{{asset($forum->img)}}" class="card-img-top" alt="img">--}}
                                    </td>
                                    <td>{{$forum->category->name}}</td>
{{--                                    <td>--}}
{{--                                        @foreach($forum->tags as $tag)--}}
{{--                                            <span class="badge badge-success">{{$tag->name}}</span>--}}
{{--                                        @endforeach--}}
{{--                                    </td>--}}
                                    <td>
                                        <a href="{{route('forums.edit', $forum->id)}}"
                                           class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{route('forums.show', $forum->id)}}"
                                           class="btn btn-info btn-sm">View</a>

                                        {{Form::open(['route' => ['forums.destroy', $forum->id], 'method'=>'DELETE', 'class' => 'd-inline'])}}
                                        <button type="submit"
                                                title="Delete"
                                                onclick="return confirm('Are you sure to delete!!!')"
                                                class="btn btn-sm btn-danger">Delete
                                        </button>
                                        {{Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--    <script>--}}
    {{--    $(document).ready( function () {--}}
    {{--        $('#forums').DataTable();--}}
    {{--    } );--}}
    {{--    </script>--}}
    <script>
        $(document).ready(function () {
            $('#forums').DataTable({
                "columnDefs": [
                    {"orderable": false, "targets": [4, 6]}
                ]
            });
        });
    </script>
@endsection
