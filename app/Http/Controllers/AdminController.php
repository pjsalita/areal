<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Storage;

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

        return redirect()->back()->with('success', 'User\'s email verification status successfully verified.');
    }

    public function verifyPrc(User $user)
    {
        $user->prc_verified = true;
        $user->save();

        return redirect()->back()->with('success', 'User\'s PRC status successfully verified.');
    }

    public function unverifyEmail(User $user)
    {
        $user->email_verified_at = null;
        $user->save();

        return redirect()->back()->with('success', 'User\'s email verification status successfully unverified.');
    }

    public function unverifyPrc(User $user)
    {
        $user->prc_verified = false;
        $user->save();

        return redirect()->back()->with('success', 'User\'s PRC status successfully unverified.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User successfully deleted.');
    }

    public function apk()
    {
        $lastModified = "N/A";

        if (Storage::exists('AReal_Latest.apk')) {
            $lastModified = Carbon::createFromTimestamp(Storage::lastModified('AReal_Latest.apk'))->toDateTimeString();
        }

        return view('apk', compact('lastModified'));
    }

    public function apkUpload(Request $request)
    {
        if ($request->hasFile('apk')) {
            $file = $request->file('apk');
            $file->storeAs("/", "AReal_Latest.apk");
        }

        return redirect()->back()->with('success', 'APK File successfully updated.');
    }
}
