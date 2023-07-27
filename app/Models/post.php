<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'post_text', 'category_id'];

    public function category(){

        return $this->belongsTo(Category::class);

    }

    public function comments(){

        return $this->hasMany(Comment::class);

    }
}

