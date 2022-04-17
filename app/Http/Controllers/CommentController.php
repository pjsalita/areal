<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Notifications\CommentNotification;
use App\Models\Notification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('body');
        $comment->user()->associate($request->user());
        $post = Post::find($request->get('post_id'));
        $post->comments()->save($comment);

        if ($post->user->id !== $request->user()->id) {
            $post->user->notify(new CommentNotification($request->user(), $post, $comment));
        } else {
            // dd($post->comments()->get()->groupBy('user_id'), $post->comments()->groupBy('user_id')->get());
            foreach ($post->comments()->get()->groupBy('user_id') as $userComment) {
                // dd($userComment->first());
                $firstUserComment = $userComment->first();
                if ($firstUserComment->user->id !== $post->user->id) {
                    $firstUserComment->user->notify(new CommentNotification($request->user(), $post, $comment, true));
                }
            }
        }

        return redirect()->route("post.show", $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        Notification::where([
            ['type', 'App\Notifications\CommentNotification'],
            ['data->reference_id', $comment->id]
        ])->delete();

        return redirect()->back();
    }
}
