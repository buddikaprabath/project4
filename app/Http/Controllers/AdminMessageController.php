<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\Storage;

class AdminMessageController extends Controller
{
    public function inbox(): ViewContract
    {
        // Fetch all users who have sent messages
        $users = User::whereHas('messages', function($query) {
            $query->where('status', 'sent');
        })->get();

        // Return view with users data
        return view('Admin.pages.message.inbox', compact('users'));
    }

    public function show($id): ViewContract
    {
        // Fetch the user by ID
        $user = User::findOrFail($id);

        // Fetch all messages for this user
        $messages = Message::where('cus_id', $user->national_id)
                           ->orderBy('created_at', 'asc')
                           ->get();

        // Return view with messages data
        return view('Admin.pages.message.show', compact('user', 'messages'));
    }

    public function reply(Request $request, $id)
{
    $validatedData = $request->validate([
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $originalMessage = Message::findOrFail($id);

    $message = new Message([
        'content' => $validatedData['content'],
        'status' => 'received',
        'cus_id' => $originalMessage->cus_id,
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $message->image = $imagePath;
    }

    $message->save();

    return redirect()->back()->with('success', 'Reply sent successfully.');
}
    
}