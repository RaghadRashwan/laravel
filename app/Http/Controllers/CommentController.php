<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
   // public function store(Request $request, Post $post)
    //{
     //   $request['user_id'] = Auth::id();
      //  $post->comments()->create($request->all());

      //  return redirect()->back();
   // }

   public function store(Request $request, Post $post)
{

    $request->validate([
        'comment' => 'required|min:5', // Add validation rule for the 'content' field
    ]);


    $commentData = [
        'user_id' => Auth::id(),
        'content' => $request->input('comment'),
    ];

    // Create the comment using the relationship
    $post->comments()->create($commentData);

    return redirect()->back();
}

}
