@extends('layouts.admin')
@section('content')
    
<div class="row">
    <div class="col-md-12">
        @if(session('message'))    
        <div class="alert alert-success">{{session('message')}}!</div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3>Post
                    <a href="{{ url('admin/post/create') }}" class="btn btn-primary btn-sm float-end">Add Post</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="loaddata_post">
                    @include('admincp.post.table_post')
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection
