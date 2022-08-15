@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category
                        <a href="{{url('admin/category/create')}}">
                        <a href="{{url('admin/category')}}" class="btn btn-primary text-white btn-sm float-end">Back</a></a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/category')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Name</label>
                                <input type="text" name="name" err class="form-control"/>
                                @error('name')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control"/>
                            </div>
                            <div class="col-md-12  mb-3">
                                <label>Description</label>
                                <textarea type="text" name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <input type="checkbox" name="status" />
                            </div>
                            <div class="col-md-12">
                                <h4 style="color: lightseagreen">SEO TAGS</h4>
                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control"/>
                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Meta Keyword</label>
                                <input type="text" name="meta_keyword" class="form-control"/>
                            </div>
                            <div class="col-md-6  mb-3">
                                <label>Meta Description</label>
                                <input type="text" name="meta_description" class="form-control"/>
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