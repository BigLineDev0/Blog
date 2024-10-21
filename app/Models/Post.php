<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['category', 'tags'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Methode de scope
    public function scopeFilters(Builder $query, array $filters){

        if (isset($filters['search'])) {
            $query->where(fn(Builder $query) => $query
                ->where('title', 'LIKE', '%'. $filters['search']. '%')
                ->orWhere('content', 'LIKE', '%'.$filters['search']. '%')
            );
        }

        if (isset($filters['category'])) {
            $query->where(
                'category_id', $filters['category']->id ?? $filters['category']
            );
        }

        if (isset($filters['tag'])) {
            $query->whereRelation(
                'tags', 'tags.id', $filters['tag']->id ?? $filters['tag'] 
            );
        }
    }

    public function exists()
    {
        return (bool) $this->id;
    }

    // Recuperer la catégorie d'un post
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Recuper tous les tags associé à un post
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    // Recuper tous les commentaires associé à un post
    public function comments(){
        return $this->hasMany(Comment::class)->latest();
    }

}
