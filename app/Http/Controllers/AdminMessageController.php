<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class AdminMessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        // Mesaj açıldığı an durumu otomatik olarak 'Read' (Okundu) yapalım
        if ($message->status == 'New') {
            $message->status = 'Read';
            $message->save();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->note = $request->input('note');
        $message->status = $request->input('status');
        $message->save();

        return redirect()->route('admin.messages.index')->with('success', 'Message status and logs updated.');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return back()->with('success', 'Message permanently purged from database.');
    }
}
