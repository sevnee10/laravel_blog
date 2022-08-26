<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return view('client.posts.article');
        }
        return view('client.index');
    }
    public function details_post($post_id)
    {
        return view('client.posts.index')->with(compact('post_id'));
    }
    public function your_posts(Request $request)
    {
        return view('client.posts.your_posts');
    }
    public function create_your_post()
    {
        return view('client.posts.create_your_post');
    }
    public function save_post(Request $request)
    {
        $validateData = $request->validate([
            'ima_title' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => [
                'required',
                'string'
            ],
            'content' => [
                'required',
                'string'
            ],
        ]);
        $post = new Post;
        $post->title = $validateData['title'];

        $path_url = 'assets/storage';
        if ($request->file('ima_title')){ 
            $originName = $request->file('ima_title')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('ima_title')->getClientOriginalExtension();

            $fileName = Str::slug($fileName) .'.'. $extension;
            $img = Image::make($request->file('ima_title'))->resize(600, 400)->save(public_path('assets/thumbnails/'.$fileName));

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
        return redirect('/your-posts')->with('message','Post Added Successfully');
    }
    public function store_image(Request $request)
    {
        $path_url = 'assets/storage';

        if ($request->hasFile('upload')) {
           $originName = $request->file('upload')->getClientOriginalName();
           $fileName = pathinfo($originName, PATHINFO_FILENAME);
           $extension = $request->file('upload')->getClientOriginalExtension();
           
           $fileName = Str::slug($fileName) .'.'. $extension;
           $request->file('upload')->move(public_path($path_url), $fileName);
           $url = asset($path_url . '/' . $fileName);
        }
  
        return response()->json(['url' => $url]);
    }
    public function edit_your_post(Post $post)
    {
        return view('client.posts.edit_your_post',compact('post'));
    }
    public function update_your_post(Request $request,$post)
    {
        $validateData = $request->validate([
            'ima_title' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => [
                'required',
                'string'
            ],
            'content' => [
                'required',
                'string'
            ],
        ]);
        $post = Post::findOrFail($post);
        $post->title = $validateData['title'];

        $path_url = 'assets/storage';
        if ($request->file('ima_title')){ 
            $originName = $request->file('ima_title')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('ima_title')->getClientOriginalExtension();

            $fileName = Str::slug($fileName) .'.'. $extension;
            $img = Image::make($request->file('ima_title'))->resize(600, 400)->save(public_path('assets/thumbnails/'.$fileName));

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
        return redirect('/your-posts')->with('message','Post Added Successfully');
    }
    public function delete_your_post(int $post)
    {
        // $post_data = Post::findOrFail($post);
        // $post_data -> delete();
        // return redirect('your-posts')->with('message','Post Deleted Successfully'); 
        return "Your Post Deleted Successfully";
    }
    public function search(Request $request)
    {
        $keyword = $request->search;
        $search_post = Post::where('title','like','%'.$keyword.'%')->get();
        //dd($search_post);
        return  view('client.posts.search',compact('search_post'));
    }
}
