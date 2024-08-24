<?php

namespace App\Http\Controllers;

use App;
use App\Models\Message;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function startVideoCall(Request $request)
{
    $friendId = $request->input('friend_id');
    $userId = Auth::user()->id;

    // Generate link Zoom (ganti dengan logika Anda sendiri jika perlu)
    $zoomLink = "https://zoom.us/join?conference_id=" . uniqid();

    // Simpan pesan video call di database (jika perlu)
    Message::create([
        'sender_id' => $userId,
        'receiver_id' => $friendId,
        'message' => "Let's have a video call! Join here: " . $zoomLink,
    ]);

    $loc = session()->get('locale');
    App::setLocale($loc);

    return redirect()->back()->with('success', 'Video call link has been sent!');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $senderID = Auth::user()->id;
        $receiverID = $request->input('friend_id');

        // Validate the input
        $request->validate([
            'new_message' => 'required|string|max:255',
        ]);

        // Create and save the new message
        Message::create([
            'sender_id' => $senderID,
            'receiver_id' => $receiverID,
            'message' => $request->input('new_message'),
        ]);

        return redirect()->route('message.show', $receiverID);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currentUserID = Auth::user()->id;
        $friend = User::findOrFail($id);

       
        $messages = Message::where(function ($query) use ($currentUserID, $id) {
            $query->where('sender_id', $currentUserID)
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($currentUserID, $id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', $currentUserID);
        })->orderBy('created_at', 'asc')->get();

        $loc = session()->get('locale');
        App::setLocale($loc);

        return view('message', compact('friend', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
