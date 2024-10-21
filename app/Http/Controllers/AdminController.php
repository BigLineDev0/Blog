<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::without('category', 'tags')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->showForm();
    }

    protected function showForm(Post $post = new Post)
    {
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return $this->showForm($post);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        return $this->save($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        return $this->save($request->validated(), $post);
    }

    protected function save(array $data, Post $post = null)
    {
        //
        if (isset($data['image'])) {
            if (isset($post->image)) {
                Storage::delete($post->image);
            }
            $data['image'] = $data['image']->store('image');
        }

        $data['extrait'] = Str::limit($data['content'], 150);

        $post = Post::updateOrCreate(['id' => $post?->id], $data);
        $post->tags()->sync($data['tag_ids'] ?? null);

        return redirect()->route('posts.show', ['post' => $post])->withStatus(
            $post->wasRecentlyCreated ? 'Article publié !' : 'Article mis à jour !'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        Storage::delete($post->image);
        $post->delete();

        return redirect()->route('admin.posts.index')->withStatus('Article  supprimé !');
    }
}
