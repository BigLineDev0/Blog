<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('comment');
    }

    // Refactorie avec une methode scope
    protected function postsView(array $filters){
        return view('posts.index', [
            'posts' => Post::filters($filters)->latest()->paginate(5)
        ]);
    }

    // Afficher toute les posts
    public function index(Request $request){

        return $this->postsView( request()->search ? ['search' =>  request()->search] : []);
    }

    // Filtrer les post par catégorie
    public function postsByCategory(Category $category){

        return $this->postsView(['category' => $category]);
    }
    
    // Filtrer les post par tag
    public function postsByTag(Tag $tag){

        return $this->postsView(['tag' => $tag]);
    }

    // Afficher un post
    public function show(Post $post){
        return view('posts.show', compact('post'));
    }

    // Ajouter des commentaires à un post
    public function comment(Post $post, Request $request){
        $validated = $request->validate([
            'comment' => ['required', 'string', 'between:2,255'],
        ]);

        Comment::create([
            'content' => $validated['comment'],
            'post_id' => $post->id,
            'user_id' => Auth::id(),
        ]);

        return back()->withStatus('Commentaire publié !');
    }
}
