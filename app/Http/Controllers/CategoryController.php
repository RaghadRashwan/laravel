<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       // $this->middleware('permission:create category|edit category|delete category')->except('index');
          $this->middleware('permission:create category')->only('create', 'store');
          $this->middleware('permission:edit category')->only('edit', 'update');
          $this->middleware('permission:delete category')->only('destroy');
    }
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
        $request->validate([
            'name' => 'required', // Add validation rule for the 'content' field
        ]);

        Category::create([
            'name' => $request->input('name'),
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('categories.index');
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
        if(Auth::id() != $category->user->id && !auth()->user()->roles->contains('name', 'admin')){
            return abort(code:401);
        }
       return view('categories.edit', compact('category'));
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
        $request->validate([
            'name' => 'required', // Add validation rule for the 'content' field
        ]);
    
        $category->update([
            'name' => $request->input('name'),
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Auth::id() != $category->user->id && !auth()->user()->roles->contains('name', 'admin')){
            return abort(code:401);
        }
       $category->delete();

        return redirect()->route('categories.index');
    }
}
