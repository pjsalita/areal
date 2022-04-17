<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        $architects = User::verified()->architects()->get();

        return view('feed', compact('posts', 'architects'));
    }
}
