<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','asc')->paginate(5);
        return view('admincp.post.index',compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admincp.post.create',compact('categories'));
    }
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admincp.post.edit',compact('post','categories'));
    }
    public function store(PostFormRequest $request)
    {
        $validateData = $request->validated();
        $post = new Post;
        $post->title = $validateData['title'];
        $post->category_id = $request->category_id;
        $post->content = $validateData['content'];
        $post->status = $request->status == true ? '0':'1';
        $post->user_id = Auth::user()->id;

        $post->save();
        return redirect('admin/post')->with('message','Post Added Successfully');
    }
    public function update(PostFormRequest $request, $post)
    {   
        $validateData = $request->validated();
        $post = Post::findOrFail($post);
        $post->title = $validateData['title'];
        $post->category_id = $request->category_id;
        $post->content = $validateData['content'];
        $post->status = $request->status == true ? '0':'1';
        $post->user_id = Auth::user()->id;

        $post->update();
        return redirect('admin/post')->with('message','Post Updated Successfully');
    }
    public function destroy(int $post_id)
    {
        $post = Post::findOrFail($post_id);
        // dd($post->delete());
        $post->delete();
        return redirect('admin/post')->with('message','Post Deleted Successfully');
    }
}
