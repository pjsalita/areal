<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('account_type', 'client')
            ->orWhere('account_type', 'architect')
            ->orderBy('id', 'asc')
            ->get();

        return view('admin', compact('users'));
    }

    public function verifyEmail(User $user)
    {
        $user->email_verified_at = now();
        $user->save();

        return back();
    }

    public function verifyPrc(User $user)
    {
        $user->prc_verified = true;
        $user->save();

        return back();
    }

    public function unverifyEmail(User $user)
    {
        $user->email_verified_at = null;
        $user->save();

        return back();
    }

    public function unverifyPrc(User $user)
    {
        $user->prc_verified = false;
        $user->save();

        return back();
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return back();
    }
}
