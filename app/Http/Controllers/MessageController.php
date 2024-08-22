<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage()
    {
        $messages = Message::where('cus_id', Auth::id())
                           ->orderBy('created_at', 'asc')
                           ->get();

        return view('User.Message.SendMessage', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
    
        $message = new Message();
        $message->content = $request->input('content');
        $message->status = 'sent';
        $message->cus_id = Auth::id();
        if ($imagePath) {
            $message->image = $imagePath;
        }
    
        $message->save();
    
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}