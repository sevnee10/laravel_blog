@extends('layouts.app')
@section('title','Edit Your Post')
@section('content')
<section class="s-content s-content--no-top-padding">
    <div class="s-bricks">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="addpost">Edit Post</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{url('/your-post/'.$post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{$post->title}}" class="form-control"/>
                                    @error('title')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Image Title</label>
                                    <input type="file" name="ima_title" value="{{$post->ima}}" class="form-control"/>
                                    @error('ima_title')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Category name</label>
                                    <select name="category_id" class="form-select form-select-md mt-2" aria-label=".form-select-lg example">
                                        @foreach ($categories as $cate)
                                            <option {{$post->category_id == $cate->id  ? 'selected' : ''}} value="{{$cate->id}}">{{$cate->name}}</option>   
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-12  mb-3">
                                    <label>Content</label>
                                    <textarea type="text" name="content" class="form-control" id="content">{{$post->content}}</textarea>
                                    @error('content')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" value="{{ $post->status=="1"? 'checked':'' }}" name="status" />
                                </div>
                            </div>
                            <div class="col-md-12  mb-3">
                                <button type="submit" class="btn btn-primary btn-info float-end">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- end s-content -->    
@endsection