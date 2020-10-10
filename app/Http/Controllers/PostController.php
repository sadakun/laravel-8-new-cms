<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    #Home Post
    public function show(Post $post)
    {
        return view('blog-post', ['post'=>$post]);
    }

    ##Admin Post
    #Show All Post
    public function index()
    {
        $posts = auth()->user()->posts()->paginate(1);
        return view('admin.posts.index', ['posts'=>$posts]);
    }

    ##Create
    #Show create page
    public function create()
    {
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    #Create a new data post
    public function store()
    {
        $this->authorize('create', Post::class);

        // Validating data form
        $inputs=request()->validate([
            'title'=> 'required|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

        // Condition to move save image file to folder images
        if(request('post_image'))
        {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        // Condition to create, it must authetication user
        auth()->user()->posts()->create($inputs);

        // Alert that shows after submit data
        session()->flash('post-created', $inputs['title']. ' '. 'post was created');
        return redirect()->route('post.index');
        // dd(request()->all());
    }

    ##Edit
    #Show edit page
    public function edit(Post $post)
    {
        #another way to use policies
        /*if(auth()->user()->can('view', $post))
        {
            return view('admin.posts.edit', ['post'=>$post]);
        }*/
        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post'=>$post]);
    }

    #Update edited post data
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

        $this->authorize('update', $post);
        $post->save();

        session()->flash('post-updated', $post['title']. ' '. 'was updated');

        return redirect()->route('post.index');
    }

    #option 1 to display alert using session
    /*public function delete(Post $post)
    {
        $post->delete();
        Session::flash('message', 'Post was deleted');
        return back();
    }*/

    #option 2 using Request
    #Delete specific post

    ##Delete
    #Deleting the post
    public function delete(Post $post, Request $request)
    {
        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('post-deleted', $post['title']. ' '. 'post was deleted');
        return back();
    }

    
}
