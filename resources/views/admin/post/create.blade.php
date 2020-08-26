@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Post Create
                        <a href="{{route('posts.index')}}" class="btn btn-success btn-sm float-right">Back</a>
                    </div>

                    <div class="card-body">
                        {{Form::open(['route' => 'posts.store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ])}}
                        <div class="form-group">
                            <label for="title">Post Title</label>
                            <input type="text" name="title" class="form-control" id="name">
                            <span class="text-danger ">{{$errors->has('title') ? $errors->first('title') : ''}}</span>
                        </div>
                        <div class="form-group">
                            <label for="body">Post Body</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
                            <span class="text-danger ">{{$errors->has('body') ? $errors->first('body') : ''}}</span>
                        </div>
                        <div class="form-group custom-file">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            <input type="file" name="img" class="custom-file-input" id="inputGroupFile01"
                                   aria-describedby="inputGroupFileAddon01"  accept="image/x-png">
                            <span class="text-danger ">{{$errors->has('img') ? $errors->first('img') : ''}}</span>

                        </div>

                        <div class="form-group">
                            <label for="category">Category Name</label>
                            <select  class="custom-select" name="category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Tags</label>
                            <select multiple class="custom-select" name="tag_id[]">
                                @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Create Post</button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
