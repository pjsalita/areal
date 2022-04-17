<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Http\Requests\UnlikeRequest;
use App\Notifications\LikeNotification;
use App\Models\Notification;
use App\Models\Post;

class LikeController extends Controller
{
    public function like(LikeRequest $request)
    {
        $request->user()->like($request->likeable());
        $post = Post::find($request->id);

        if ($post->user->id !== $request->user()->id) {
            $post->user->notify(new LikeNotification($request->user(), $post));
        }

        if ($request->ajax()) {
            return response()->json([
                'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }

    public function unlike(UnlikeRequest $request)
    {
        $request->user()->unlike($request->likeable());

        Notification::where([
            ['type', 'App\Notifications\LikeNotification'],
            ['data->user_id', $request->user()->id],
            ['data->reference_id', $request->id]
        ])->delete();

        if ($request->ajax()) {
            return response()->json([
                'likes' => $request->likeable()->likes()->count(),
            ]);
        }

        return redirect()->back();
    }
}
