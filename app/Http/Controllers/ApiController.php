<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function designs()
    {
        $designs = Post::designs()->get();
        $designs = $designs->map(function ($design) {
            return $design->only(['id', 'user_id', 'architect_name', 'title', 'measurements', 'model', 'image', 'created_at']);
        });

        return response()->json($designs);
    }

    public function design($id)
    {
        $design = Post::find($id);

        if (!$design || $design->type !== "design") {
            return response()->json([ "message" => "Not found."], 404);
        }

        $design = $design->only(['id', 'user_id', 'architect_name', 'title', 'measurements', 'model', 'image', 'created_at']);

        return response()->json($design);
    }

    public function userDesigns()
    {
        $users = User::architects()->get();
        $users = $users->map(function ($user) {
            $designs = $user->posts()->designs()->get()->map(function ($design) {
                return $design->only(['id', 'title', 'measurements', 'model', 'image', 'created_at']);
            });

            return collect($user->only([
                'id',
                'name',
                'position',
                'gender',
                'birthdate',
                'address',
                'phone_number',
                'created_at'
            ]))->put('designs', $designs);
        });

        return response()->json($users);
    }

    public function userDesign(User $user)
    {
        $designs = $user->posts()->designs()->get()->map(function ($design) {
            return $design->only(['id', 'user_id', 'architect_name', 'title', 'measurements', 'model', 'image', 'created_at']);
        });

        return response()->json($designs);
    }

    public function userDesignIds(User $user)
    {
        $designs = $user->posts()->designs()->get()->map(function ($design) {
            return $design->only(['id']);
        })->flatten();

        return response()->json($designs);
    }
}
