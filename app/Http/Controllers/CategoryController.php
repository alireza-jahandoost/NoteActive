<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',new Category);
        $categories = Category::paginate(10);
        return view('categories.index',compact('categories'));
    }

    public function posts(Category $category)
    {
        $this->authorize('viewCategoryPosts',$category);

        $title = "View Posts of Category \"$category->name\"";
        $posts = $category->posts()->paginate(10);
        return view('posts.index',compact('posts','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',new Category);

        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',new Category);

        $data = $request->validate(['name' => 'required|string|between:3,255|unique:categories']);
        Category::create(['name' => $data['name']]);
        $name = $data['name'];
        return back()->with([
            'title' => 'Success',
            'class' => 'success',
            'message' => "Category \"$name\" Has been created",
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('update' , $category);

        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update' , $category);

        $data = $request->validate(['name' => "required|string|between:3,255|unique:categories,name,$category->id"]);
        $category->update($data);
        $name = $data['name'];
        return back()->with([
            'title' => 'Success',
            'class' => 'success',
            'message' => "Category \"$name\" Has been updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete',$category);

        if (count($category->posts) > 0) {
            return back()->withErrors('Unable to delete this category Because this category has Posts. you have to delete them or change their categories to be able to delete this category.');
        }
        $category->delete();
        return back()->with([
            'title' => 'Success',
            'class' => 'danger',
            'message' => 'The Category has been deleted.',
        ]);
    }
}
