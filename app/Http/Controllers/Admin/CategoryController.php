<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return view('livewire.admin.category.table_category');
        }
        return view('admincp.category.index');
    }
    
    public function create()
    {
        return view('admincp.category.create');
    }
    
    public function store(CategoryFormRequest $request)
    {
        
        $validateData = $request->validated();
        $category = new Category;
        $category->name = $validateData['name'];
        $category->slug = Str::slug($validateData['slug']);
        $category->description = $validateData['description'];
        $category->meta_title = $validateData['meta_title'];
        $category->meta_keyword = $validateData['meta_keyword'];
        $category->meta_description = $validateData['meta_description'];
        $category->status = $request->status == true ? '1':'0';
        $category->user_id = Auth::user()->id;
        $category->save();
        return redirect('admin/category')->with('message','Category Added Successfully');
    }

    public function edit(Category $category)
    {
        return view('admincp.category.edit',compact('category'));
    }
    
    public function update(CategoryFormRequest $request, $category)
    {   
        $validateData = $request->validated();
        
        $category = Category::findOrFail($category);
        $category->name = $validateData['name'];
        $category->slug = Str::slug($validateData['slug']);
        $category->description = $validateData['description'];
        $category->meta_title = $validateData['meta_title'];
        $category->meta_keyword = $validateData['meta_keyword'];
        $category->meta_description = $validateData['meta_description'];
        $category->status = $request->status == true ? '1':'0';
        $category->user_id = Auth::user()->id;

        $category->update();
        return redirect('admin/category')->with('message','Category Updated Successfully');
    }
}
