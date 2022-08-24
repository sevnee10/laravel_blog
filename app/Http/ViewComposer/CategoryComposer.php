<?php
 namespace App\Http\ViewComposer;

use App\Models\Category;
use Illuminate\View\View;

 class CategoryComposer
 {
    /**
     * Bind data to the view.
     * Bind data vào view. $view->with('ten_key_se_dung_trong_view', $data);
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    { 
        $categories = Category::orderBy('id','asc')->paginate(1);
        $view->with('categories', $categories);
    }
}