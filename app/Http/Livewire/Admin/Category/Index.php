<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public $cate_id;

    public function deleteCategory($cate_id)
    {
        $this->cate_id = $cate_id;
    }
    public function destroyCategory()
    {
        $category = Category::find($this->cate_id);
        $category->delete();
        session()->flash('message','Category Deleted!');
        $this->dispatchBrowserEvent('close-modal');
    }
        public function render()
    {
        $categories = Category::orderBy('id','asc')->paginate(10);
        return view('livewire.admin.category.index',['categories'=>$categories]);
    }
}
