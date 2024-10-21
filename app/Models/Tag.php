<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Recuperer tous les posts sur un tag
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
