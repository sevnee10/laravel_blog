<?php
 namespace App\Http\ViewComposer;

use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;
use App\Models\LikeDislike;

 class PostComposer
 {
    /**
     * Bind data to the view.
     * Bind data vào view. $view->with('ten_key_se_dung_trong_view', $data);
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    { 
        $posts = Post::orderBy('id','asc')->paginate(8);
        $users = User::with('posts')->get();
        $view->with(compact('posts', 'users'));
    }
}