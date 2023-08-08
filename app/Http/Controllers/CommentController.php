<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comments;
use Illuminate\Http\Request;
use PhpParser\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);
        $request['user_id'] = auth()->user()->id;
        $comment = Comments::create($request->all());

        return new CommentResource($comment->loadMissing(['commentator:id,users']));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comments)
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
            'comments_content' => 'required',
        ]);


        $comment =  Comments::findOrFail($id);
        $comment->update($request->only('comments_content'));

        return new CommentResource($comment->loadMissing(['commentator:id,users']));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $comment = Comments::findOrFail($id);
        $comment->delete();
        return new CommentResource($comment->loadMissing(['commentator:id,users']));

    }
}
