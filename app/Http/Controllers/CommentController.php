<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeComment(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'subject' => 'nullable|string|max:255',
            'review' => 'required|string',
            'rate' => 'required|integer|min:1|max:5',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'subject' => $request->subject,
            'review' => $request->review,
            'rate' => $request->rate,
            'ip' => $request->ip(),
            'status' => 'False' // İlk başta onay bekliyor
        ]);

        return back()->with('success', 'Your review has been submitted successfully and is awaiting admin approval.');
    }
}
