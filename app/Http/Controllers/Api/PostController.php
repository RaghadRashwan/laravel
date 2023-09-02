<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Category;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $posts = Post::all();

    return response()->json(['message' => 'post displyed successfully', 'data' => $posts]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
    
        return response()->json([
            'categories' => $categories,
            'users' => $users,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(StorePostRequest $request, Post $post)
     {
         $imagePath = '';
     
         if ($request->hasFile('image')) {
             $image = $request->file('image');
             $imagePath = $image->store('images', 'public');
         }
     
         $newPost = Post::create([
             'title' => $request->input('title'),
             'post_text' => $request->input('post_text'),
             'category_id' => $request->input('category_id'),
             'user_id' => auth()->id(),
             'image' => $imagePath,
         ]);
     
         return response()->json(['message' => 'Post created successfully', 'post' => $newPost]);
     }
     
    

    /**
     * Display the specified resource.
     *
     * @param  App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
{
    return response()->json(['post' => $post]);
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
{
    if (Auth::id() != optional($post->user)->id && !auth()->user()->roles->contains('name', 'admin')) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $categories = Category::all();

    return response()->json(['post' => $post, 'categories' => $categories]);
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
{
    
    $imagePath = '';

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('images', 'public');
    }

    $post->update([
        'title' => $request->input('title'),
        'post_text' => $request->input('post_text'),
        'category_id' => $request->input('category_id'),
        'user_id' => auth()->id(),
        'image' => $imagePath,
    ]);

    return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Auth::id() != optional($post->user)->id && !auth()->user()->roles->contains('name', 'admin')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $post->delete();
    
        return response()->json(['message' => 'Post deleted successfully']);
    }
    
}
