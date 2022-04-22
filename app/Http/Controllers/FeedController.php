<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::posts()->get()->sortByDesc('created_at');
        $designs = Post::designs()->get()->sortByDesc('created_at');
        $architects = User::verified()->architects()->get();

        return view('feed', compact('posts', 'designs', 'architects'));
    }
}
