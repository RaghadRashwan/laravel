<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\post;

class HomeCntroller extends Controller
{
    public function index()
    {
        //$allCategories = ['category 1', 'category 2'];
       // $allCategories = DB::table(table: 'categories')->get();
        //$allCategories = DB::table('categories')->get();
        $categories = Category::all();
        $posts = Post::when(request('category_id'), function ($query) {
            $query->where('category_id', request('category_id'));
        })
        ->latest()
        ->get();


        
        return view('index', compact('categories' ,'posts'));
           // 'categories' => $categories,
            // 'posts' => $posts                            
            
    }
}
