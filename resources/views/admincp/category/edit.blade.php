@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category
                        <a href="{{url('admin/category')}}" class="btn btn-primary text-white btn-sm float-end">Back</a></a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/category/'.$category->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" value="{{$category->name}}" class="form-control"/>
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Slug</label>
                                <input type="text" name="slug" value="{{$category->slug}}" class="form-control"/>
                                @error('slug')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-12  mb-3">
                                <label>Description</label>
                                <textarea type="text" name="description" class="form-control" rows="5">{{$category->description}}</textarea>
                                @error('description')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <input type="checkbox" value="{{$category->status == '1' ? 'checked':''}}" name="status" />
                            </div>
                            <div class="col-md-12">
                                <h4 style="color: lightseagreen">SEO TAGS</h4>
                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control"/>
                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Meta Keyword</label>
                                <input type="text" name="meta_keyword" value="{{$category->meta_keyword}}" class="form-control"/>
                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Meta Description</label>
                                <input type="text" name="meta_description" value="{{$category->meta_description}}" class="form-control"/>
                            </div>
                            <div class="col-md-12  mb-3">
                                <button type="submit" class="btn btn-primary btn-info float-end">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection