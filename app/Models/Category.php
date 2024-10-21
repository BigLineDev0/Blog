<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Recuperer tous les posts d'une catégorie
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
