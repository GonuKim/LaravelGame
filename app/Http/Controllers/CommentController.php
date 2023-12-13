<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request, string $post_id)
    {
        $text = $request->text;
        $user = Auth::user(); 

        $comment = new Comment();
        $comment->text=$text;
        $comment->user_id = $user->id;
        $comment->post_id = $post_id;

        $comment->save();

        return redirect('posts/'.$post_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $post_id, string $comment_id)
    {

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $post_id, string $comment_id)
    {
        // comments 테이블에서 $comment_id인 레코드를 찾아 삭제
        Comment::destroy($comment_id);

        return redirect('posts/'.$post_id);
    }
}
