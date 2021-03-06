@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Post Update
                        <a href="{{route('posts.index')}}" class="btn btn-info btn-sm float-right">Back</a>
                    </div>

                    <div class="card-body">
                        {{Form::open(['route' => ['posts.update',$post->id], 'method' => 'PUT' ,'enctype' => 'multipart/form-data'])}}
                        <div class="form-group">
                            <label for="name">Post title</label>
                            <input type="text" name="title" value="{{$post->title}}" class="form-control" id="name">
                            <span class="text-danger ">{{$errors->has('title') ? $errors->first('title') : ''}}</span>
                        </div>
                        <div class="form-group">
                            <label for="name">Post Body</label>
                            <input type="text" name="body" value="{{$post->body}}" class="form-control" id="body">
                        </div>
                        <div class="form-group custom-file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            <input type="file" name="img" value="{{$post->img}}" class="custom-file-input"
                                   id="inputGroupFile01"
                                   aria-describedby="inputGroupFileAddon01">
                        </div>
                        <div class="form-group">
                            <label for="category">Category Name</label>
                            <select class="custom-select" name="category_id">
                                @foreach($categories as $category)
                                    <option
                                        value="{{$category->id}}" {{$category->id == $post->category_id ? 'selected' : '' }}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tag">Tags</label>
                            <select multiple class="custom-select" name="tag_id[]">
                                @foreach($tags as $id => $tag)
                                    <option value="{{$id}}"
                                    @foreach($post->tags as $val)
                                        {{$val->id == $id ? 'selected': ''}}
                                    @endforeach >
                                        {{$tag->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Update Post</button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
