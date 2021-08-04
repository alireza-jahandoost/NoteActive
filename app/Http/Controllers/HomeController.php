<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('home.index',compact('categories'));
    }
    public function show(Post $post)
    {
        return view('home.show',compact('post'));
    }
    public function category_posts(Category $category)
    {
        $posts = $category->posts()->paginate(16);
        return view('home.category_posts',compact('posts','category'));
    }
    public function user_posts(User $user)
    {
        $posts = $user->posts()->paginate(16);
        return view('home.user_posts',compact('posts','user'));
    }
}
