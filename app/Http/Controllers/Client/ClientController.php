<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AjaxLoginRequest;
use Illuminate\Support\Facades\Validator;

use App\Models\Comment;
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
        $comments = Comment::where(['post_id'=>$post_id,'reply_id'=>0])->orderBy('id','desc')->get();
        return view('client.posts.index')->with(compact('post_id','comments'));
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
        return  view('client.posts.search',compact('search_post'));
        // $keyword = $request->search;
        // if($request->ajax()) {

        //     $output = '';

        //     $search_post = Post::where('title','like','%'.$keyword.'%')->get();

        //     if($search_post) {

        //         foreach($search_post as $search) {

        //             $output .=
        //             ' 
    
        //                 <div class="entry__thumb">
        //                     <a href="' .url('/posts/'.$search->id).'" class="thumb-link">
        //                         <img src="/assets/thumbnails/{{'.$search->ima.'}}" alt="{{'.$search->title.'}}">
        //                     </a>
        //                 </div> <!-- end entry__thumb -->
    
        //                 <div class="entry__text">
        //                     <div class="entry__header">
        //                         <h1 class="entry__title"><a href="'.url('/posts/'.$search->id).'">{{'.$search->title.'}}</a></h1>
                                
        //                         <div class="entry__meta">
        //                             <span class="byline">By:
                                        
        //                             </span>
        //                         </div>
        //                     </div>
        //                     <div class="entry__excerpt">
        //                         <p>{!!  Str::words($search->content,40) !!}</p>
        //                     </div>
        //                     <a class="entry__more-link" href="'.url('/posts/'.$search->id).'">Learn More</a>
        //                 </div> <!-- end entry__text -->
                    

        //           ';

        //         }

        //         return response()->json($output);

        //     }

        // }

        // return  view('client.posts.search');
        // $data = [];
        // if($request->filled('q')){
        //     $search = $request->q;
        //     $data =Post::select("id", "title")
        //             ->where('title','like','%'.$search.'%')
        //             ->get();
        // }
        // return response()->json($data);
    }
    function save_liked(Request $request){
        $post = Post::find($request->post_id);
        if($post->likes->contains('user_id',auth()->id())){
            $post->likes()->where('user_id',auth()->id())->delete();
        }else{
            $post->likes()->create(['user_id'=>auth()->id()]);
        }
        return response()->json(['likes'=>$post->likes()->count()]);  
    }
    public function ajax_login(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Opps, Your should enter email',
            'email.email' => 'Hey there, what a bad email :(',
            'password.required' => 'Opps, Your should enter password'
        ]);
        if($validate->passes()){
            $data = $request->only('email','password');
            $check_login = Auth::attempt($data);
            if($check_login){
                if(!Auth::user()){
                    Auth::logout();
                    return response()->json(['error'=>['Your account not exists']]);
                }
                return response()->json(['data'=>Auth::user()]);
            }
        }
        return response()->json(['error'=>$validate->errors()->all()]);
    }
    public function ajax_comment(Request $request,$post_id)
    {
        $validate = Validator::make($request->all(),[
            'message' => 'required'
        ],[
            'message.required' => 'Opps, Your should enter message'
        ]);
        if($validate->passes()){
            $data = [
                'post_id' => $post_id,
                'user_id' => Auth::id(),
                'message' => $request->message,
                'reply_id' => $request->reply_id ? $request->reply_id : 0
            ];
            if(Comment::create($data)){
                $comments = Comment::where(['post_id'=>$post_id,'reply_id'=>0])->orderBy('id','desc')->get();
                return view('client.posts.comments',compact('comments'));
            }
        }
        return response()->json(['error'=>$validate->errors()->first()]);
    }
}
