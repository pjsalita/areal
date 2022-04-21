<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    public function show(User $user)
    {
        if ($user->account_type === "admin") {
            abort(404);
        }

        return view('profile', compact('user'));
    }
}
