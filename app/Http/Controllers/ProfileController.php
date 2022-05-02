<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    public function show(User $user)
    {
        $isAdmin = $user->account_type === "admin";
        abort_if($isAdmin, 404);

        return view('profile', compact('user'));
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back();
    }

    public function edit()
    {
        $user = auth()->user();

        return view('profile-edit', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->all();

        if ($request->password === null) {
            $request->request->remove('password');
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($request->password);
        }

        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'before:today', 'max:255'],
            'gender' => ['required', 'in:male,female', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'position' => [Rule::requiredIf($request->user()->account_type === 'architect'), 'nullable', 'string', 'max:255'],
            'password' => ['sometimes', 'confirmed', Rules\Password::defaults()],
        ]);

        User::find(auth()->id())->update($data);

        return redirect()->back()->with('success', 'Profile successfully updated.');
    }

    public function achievement(Request $request)
    {
        optional(auth()->user())->achievements()->delete();

        foreach ($request->achievement_names as $key => $name) {
            if ($name) {
                Achievement::create([
                    'user_id' => auth()->id(),
                    'name' => $name,
                    'value' => $request->achievement_values[$key],
                ]);
            }
        }

        return redirect()->back()->with('success', 'Achievements successfully updated.');
    }

    public function avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatar = Str::uuid() . "." . $file->getClientOriginalExtension();
            User::where('id', auth()->user()->id)->update(['avatar' => config('chatify.user_avatar.folder') . "/" . $avatar]);
            $file->storeAs(config('chatify.user_avatar.folder'), $avatar);
        }

        return redirect()->back()->with('success', 'Profile Picture successfully updated.');
    }
}
