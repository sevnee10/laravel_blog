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
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->content}}</td>
                            <td>{{$post->category_id}}</td>
                            <td>{{$post->status == 1 ? 'Hidden':'Visible'}}</td>
                            <td>
                                <a href="{{ url('admin/post/'.$post->id.'/edit')}}" class="btn btn-sm btn-success">Edit</a>
                                <a href="{{ url('admin/post/'.$post->id.'/delete')}}" onclick="return confirm('Are you sure delete this data?')" class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                <br>
                <div id="paginate">
                    {!! $posts->links() !!}
                </div>
            </div>
        </div>
    </div>        
</div>
@endsection