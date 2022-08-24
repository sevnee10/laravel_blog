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

{!! $posts->links() !!}
