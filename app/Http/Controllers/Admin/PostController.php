<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return view('admincp.post.table_post');
        }
        return view('admincp.post.index');
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
        $request->validate([
            'ima_title' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $post = new Post;
        $post->title = $validateData['title'];

        $path_url = 'assets/storage';
        if ($request->file('ima_title')){ 
            $originName = $request->file('ima_title')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('ima_title')->getClientOriginalExtension();

            $fileName = Str::slug($fileName) .'.'. $extension;
            $img = Image::make($request->file('ima_title'))->resize(600, 400)->save(public_path('thumbnails/'.$fileName));

            $request->file('ima_title')->move(public_path($path_url), $fileName);
            $post->ima = $fileName;
        }else{
            $post->ima = '';
        }
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
        $request->validate([
            'ima_title' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $post = Post::findOrFail($post);
        $post->title = $validateData['title'];

        $path_url = 'assets/storage';

        if ($request->file('ima_title')){ 
            $originName = $request->file('ima_title')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('ima_title')->getClientOriginalExtension();

            $fileName = Str::slug($fileName) .'.'. $extension;
            $img = Image::make($request->file('ima_title'))->resize(600, 400)->save(public_path('thumbnails/'.$fileName));

            $request->file('ima_title')->move(public_path($path_url), $fileName);
            $post->ima = $fileName;
        }else{
            $post->ima = '';
        }
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
