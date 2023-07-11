<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Models\Category;

class HomeCntroller extends Controller
{
    public function index()
    {
        //$allCategories = ['category 1', 'category 2'];
       // $allCategories = DB::table(table: 'categories')->get();
        //$allCategories = DB::table('categories')->get();
        $allCategories = Category::all();


        
        return view('index', ['categories' => $allCategories]);
    }
}
