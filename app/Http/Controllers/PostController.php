<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('blog-post', ['post'=>$post]);
    }
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $inputs=request()->validate([
            'title'=> 'required|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

        if(request('post_image'))
        {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);
        return back();
        // dd(request()->all());
    }
}
