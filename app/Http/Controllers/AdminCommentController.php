<?php

namespace App\Http\Controllers; // 🌟 Klasör değiştiği için namespace sadeleşti

use Illuminate\Http\Request;
use App\Models\Comment;

class AdminCommentController extends Controller
{
    public function index()
    {
        // Yorumları kullanıcı ve ürün ilişkileriyle birlikte çekiyoruz
        $comments = Comment::with(['user', 'product'])->orderBy('created_at', 'desc')->get();
        return view('admin.comments.index', compact('comments'));
    }

    public function show($id)
    {
        $comment = Comment::with(['user', 'product'])->findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = $request->input('status');
        $comment->save();

        // İşlem bitince SweetAlert tetiklensin diye success mesajı fırlatıyoruz
        return redirect()->route('admin.comments.index')->with('success', 'Comment status updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comment has been deleted from Merve Shop database.');
    }
}
