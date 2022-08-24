<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $cate)
        <tr>
            <td>{{$cate->id}}</td>
            <td>{{$cate->name}}</td>
            <td>{{$cate->status == '1'? 'Hidden':'Visible'}}</td>
            <td>
                <a href="{{ url('admin/category/'.$cate->id.'/edit')}}" class="btn btn-success">Edit</a>
                <a href="#" wire:click="deleteCategory({{$cate->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
<br>

{!! $categories->links() !!}