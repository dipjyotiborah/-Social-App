<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240', // 10MB limit
            'type' => 'required|in:text,image,video,code',
        ]);

        $mediaPath = null; // Initialize as null
        
        if ($request->hasFile('media')) {
            // Store in storage/app/public/uploads
            $mediaPath = $request->file('media')->store('uploads', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'media' => $mediaPath,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Post created successfully.');
    }
}
