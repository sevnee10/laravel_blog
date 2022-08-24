<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function store(Request $request)
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
}
