<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Category;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('permission:create post|edit post|delete post')->except('show', 'index');
    }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        

        return view('posts.index', compact('posts'));
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
        
        return view('posts.create', compact('categories', 'users'));
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
        
        //dd($request);
        if ($request->hasFile('image') ) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Save the image to the "public/images" directory
        
            // Storage::put('file.jpg', $image);

           // dd($imagePath);
        }
        Post::create([
            'title' => $request->input('title'),
            'post_text' => $request->input('post_text'),
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->id(),
            'image' => $imagePath, // Store the image path in the 'image' column
            
        ]); 
        
        return redirect()->route('posts.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Auth::id() != $post->user->id && !auth()->user()->roles->contains('name', 'admin')){
            return abort(code:401);
        }

       //if(auth()->user()->roles->contains('name', 'admin')){
        //    $this->call([
         //       AuthServiceProvider::class,
         //   ]);
      // }

        $categories = Category::all();
       return view('posts.edit', compact('post', 'categories'));
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
        
        $post->update([
            'title' => $request->input('title'),
            'post_text' => $request->input('post_text'),
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->id(), 
            'image' => $request->input('image'),
            
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Auth::id() != $post->user->id && !auth()->user()->roles->contains('name', 'admin')){
            return abort(code:401);
        }

       $post->delete();

        return redirect()->route('posts.index');
    }

   // public function storeImage(Request $request){
   //     $data= new Post;

    //    if($request->file('image')){
    //        $file= $request->file('image');
    //        $filename= date('YmdHi').$file->getClientOriginalName();
    //        $file-> move(public_path('public/Image'), $filename);
    //        $data['image']= $filename;
    //    }
    //    $data->save();
        //return redirect()->route('images.view');
       
//}
}   

