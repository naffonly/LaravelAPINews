<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDetailResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        return PostDetailResource::collection($post->loadMissing(['writer:id,users','comments:id,post_id,user_id,comments_content,created_at']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        $validated = $request->validate([
            'tittle' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,users'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $post = Post::with('writer:id,users')->findOrFail($id);
        return new PostDetailResource($post->loadMissing(['writer:id,users','comments:id,post_id,user_id,comments_content,created_at']));
    }
    public function show2($id)
    {
       $post = Post::findOrFail($id);
        return new PostDetailResource($$post->loadMissing(['writer:id,users','comments:id,post_id,user_id,comments_content,created_at']));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
        $validated = $request->validate([
            'tittle' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $post =  Post::findOrFail($id);
        $post->update($request->all());

        return new PostDetailResource($post->loadMissing('writer:id,users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
            $post = Post::findOrFail($id);
            $post->delete(); 
            return new PostDetailResource($post->loadMissing('writer:id,users'));
    }
}
