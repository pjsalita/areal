<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'position' => ['required_if:account_type,architect', 'nullable', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'before:today', 'max:255'],
            'account_type' => ['required', 'in:client,architect', 'max:255'],
            'gender' => ['required', 'in:male,female', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'prc_id' => ['required_if:account_type,architect', 'image'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'position' => $request->position,
            'birthdate' => $request->birthdate,
            'account_type' => $request->account_type,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('prc_id')) {
            $file = $request->file('prc_id');
            $fileOriginalName = $file->getClientOriginalName();
            $name = pathinfo($fileOriginalName, PATHINFO_FILENAME) . "_" . time();
            $extension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);
            $filename = "{$name}.{$extension}";
            $file->storeAs(config('chatify.attachments.folder'), $filename);
            $data['prc_id'] = config('chatify.attachments.folder') . "/" . $filename;
        }

        $user = User::create($data);

        event(new Registered($user));

        Auth::login($user);

        return response()->json([
            "success" => true,
            "redirect_url" => route("feed")
        ]);
    }
}
