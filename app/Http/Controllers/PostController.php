<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\post;
class PostController extends Controller
{
    public function show(Post $post){

        //$post = Post::find(Post $post)

        //return view(view: 'post', compact(var_name: 'post'));
          return view( 'post', compact('post'));

    }
    
}
