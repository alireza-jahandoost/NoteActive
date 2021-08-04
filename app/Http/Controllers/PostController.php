<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasPermission('view-posts-other')) {
            $title = 'View All Posts';
            $posts = Post::paginate(10);
        }else if(auth()->user()->hasPermission('view-posts-self')){
            $title = 'View My Posts';
            $posts = auth()->user()->posts()->paginate(10);
        }else abort(403);
        return view('posts.index',compact('posts','title'));
    }

    public function create()
    {
        $this->authorize('create',new Post);

        $categories = Category::all();
        $post = new Post;
        $pageTitle = 'Create A Post';
        return view('posts.form',compact('post','pageTitle','categories'));
    }

    public function store(CreatePostRequest $request)
    {
        $this->authorize('create',new Post);

        $data = $request->validated();
        //validate that this category exists or not
        Category::findOrFail($data['category_id']);
        $data['body'] = HelperController::escape_tags($data['body']);
        if ($image = $request->file('post_image')) {
            $data['post_image'] = $image->store('images');
        }
        auth()->user()->posts()->create($data);
        return back()->withMessage('The post has been created successfully');
    }


    public function edit(Post $post)
    {
        $this->authorize('update',$post);

        $categories = Category::all();
        $pageTitle = 'Edit Post';
        return view('posts.form',compact('post','pageTitle','categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update',$post);

        $data = $request->validated();
        //validate that this category exists or not
        Category::findOrFail($data['category_id']);
        if (isset($data['delete_image']) && Storage::exists($post->post_image)) {
            Storage::delete($post->post_image);
            $data['post_image'] = NULL;
        }
        $data['body'] = HelperController::escape_tags($data['body']);
        if ($image = $request->file('post_image')) {
            if (Storage::exists($post->post_image)) {
                Storage::delete($post->post_image);
            }
            $data['post_image'] = $image->store('images');
        }
        $post->update($data);
        return back()->withMessage('The Post has been updated Successfully');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);

        if (Storage::exists($post->post_image)) {
            Storage::delete($post->post_image);
        }
        $post->delete();
        return back()->with(['message' => 'The Post has been deleted successfully' , 'class' => 'danger' , 'title' => 'Successful']);
    }
}
