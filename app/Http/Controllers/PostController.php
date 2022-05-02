<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\PostAttachment;
use Illuminate\Support\Str;

class PostController extends Controller
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
        $post = Post::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'body' => $request->body,
            'type' => $request->type,
            'measurements' => $request->measurements,
        ]);

        $time = time();

        if ($request->hasFile('model')) {
            $file = $request->file('model');
            $fileOriginalName = $file->getClientOriginalName();
            $name = pathinfo($fileOriginalName, PATHINFO_FILENAME) . "_" . $time;
            $extension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);
            $filename = "{$name}.{$extension}";
            $file->storeAs(config('chatify.attachments.folder'), $filename);
            PostAttachment::create([
                'post_id' => $post->id,
                'filename' => $filename,
                'type' => 'model'
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileOriginalName = $file->getClientOriginalName();
                $extension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);
                $filename = "{$name}.{$extension}";
                $file->storeAs(config('chatify.attachments.folder'), $filename);
                PostAttachment::create([
                    'post_id' => $post->id,
                    'filename' => $filename,
                ]);
            }
        }

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                $fileOriginalName = $image->getClientOriginalName();
                $name = pathinfo($fileOriginalName, PATHINFO_FILENAME) . "_" . time();
                $extension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);
                $filename = "{$name}.{$extension}";
                $image->storeAs(config('chatify.attachments.folder'), $filename);
                PostAttachment::create([
                    'post_id' => $post->id,
                    'filename' => $filename,
                ]);
            }
        }

        $type = ucFirst($post->type);

        return redirect()->back()->with('success', "{$type} successfully added.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        abort_if($post->type !== "post", 404);
        return view('post', compact('post'));
    }

    public function design(Post $post)
    {
        abort_if($post->type !== "design", 404);
        return view('post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Notification::whereIn('type', [
            'App\Notifications\LikeNotification',
            'App\Notifications\CommentNotification'
        ])->where('data->parent_id', $post->id)->delete();

        $post->delete();

        $type = ucFirst($post->type);

        return redirect()->route('feed')->with('success', "{$type} successfully deleted.");
    }
}
