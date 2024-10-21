<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $with = ['user'];

     // protected $fillable = ['content', 'post_id', 'user_id'];
     protected $guarded = ['id', 'created_at', 'updated_at'];

     // Recuperer les utilisateurs  lié à un commentaire
     public function user(){
        return $this->belongsTo(User::class);
    }
}
