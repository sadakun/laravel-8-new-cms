<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        session()->flash('post-created', $inputs['title']. ' '. 'post was created');
        return redirect()->route('post.index');
        // dd(request()->all());
    }

    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts'=>$posts]);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post'=>$post]);
    }

    #option 1 to display alert using session
    /*public function delete(Post $post)
    {
        $post->delete();
        Session::flash('message', 'Post was deleted');
        return back();
    }*/

    #option 2 using Request
    public function delete(Post $post, Request $request)
    {
        $post->delete();
        $request->session()->flash('post-deleted', $post['title']. ' '. 'post was deleted');
        return back();
    }

    public function update(Post $post)
    {
        $inputs=request()->validate([
            'title'=> 'required|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

        if(request('post_image'))
        {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        auth()->user()->posts()->save($post);
        session()->flash('post-updated', $post['title']. ' '. 'was updated');

        return redirect()->route('post.index');
    }
}
