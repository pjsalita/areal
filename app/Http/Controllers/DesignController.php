<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DesignController extends Controller
{
    public function index()
    {
        $designs = Post::designs()->get(['id', 'title', 'created_at']);

        return response()->json($designs);
    }

    public function show($id)
    {
        $design = Post::find($id);

        if (!$design || $design->type !== "design") {
            return response()->json([ "message" => "Not found."], 404);
        }

        $design = $design->only(['id', 'title', 'created_at', 'model', 'model_link']);

        return response()->json($design);
    }
}
