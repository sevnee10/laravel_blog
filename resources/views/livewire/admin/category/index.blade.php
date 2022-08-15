<div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent="destroyCategory">
                    <div class="modal-body">
                        <h6>Do you want to delete this category?</h6>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes. Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-12">
                @if(session('message'))    
                    <div class="alert alert-success">{{session('message')}}!</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Category
                            <a href="{{ url('admin/category/create') }}" class="btn btn-primary btn-sm float-end">Add Category</a>
                        </h3>
                    </div>
                    <div class="card-body">
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
                                @if($cate->user_id == Auth::user()->id)
                                <tr>
                                    <td>{{$cate->id}}</td>
                                    <td>{{$cate->name}}</td>
                                    <td>{{$cate->status == '1'? 'Hidden':'Visible'}}</td>
                                    <td>
                                        <a href="{{ url('admin/category/'.$cate->id.'/edit')}}" class="btn btn-success">Edit</a>
                                        <a href="#" wire:click="deleteCategory({{$cate->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                            @endforeach
                        </table>
                        <br>
                        <div>
                            {!! $categories->links() !!}
                        </div>
                    </div>
                </div>
            </div>        
        </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal',event => {
            $("#deleteModal").modal('hide');
        });
    </script>
@endpush