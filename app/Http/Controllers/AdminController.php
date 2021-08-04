<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $post_cnt = Post::count();
        $category_cnt = Category::count();
        $user_cnt = User::count();
        $monthly_posts = Post::monthly_posts();
        $categories = [];
        foreach (Category::pluck('name') as $name) {
            $categories[] = $name;
        }
        $categories_cnt = [];
        foreach (Category::all() as $category) {
            array_push($categories_cnt , count($category->posts));
        }
        if (!auth()->user()->hasPermission('view-admin-dashboard')) {
            return redirect(url(route('users.show',auth()->user())));
        }
        return view('admin.index',compact('post_cnt','category_cnt','user_cnt','monthly_posts','categories','categories_cnt'));
    }
}
