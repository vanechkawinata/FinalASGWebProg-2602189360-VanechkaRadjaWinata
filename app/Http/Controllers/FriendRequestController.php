<?php

namespace App\Http\Controllers;

use App;
use App\Models\FriendRequest;
use App\Models\User;
use App\Notifications\FriendRequestSent;
use Auth;
use Illuminate\Http\Request;

class FriendRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserID = Auth::user()->id;
        $userlist = FriendRequest::where('friend_request.receiver_id', '=', $currentUserID)->where('friend_request.status', '=', 'pending')->join('users', 'users.id', '=', 'friend_request.sender_id')->get(['friend_request.id as request_id', 'users.*']);

        $loc = session()->get('locale');
        App::setLocale($loc);

        return view('friendrequest', compact('userlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sender_id = Auth::user()->id;
        $receiver_id = $request->input('receiver_id');
    
        $friendRequest = FriendRequest::create([
            'sender_id' => $sender_id,
            'receiver_id' => $receiver_id
        ]);
    
        if ($friendRequest) {
            $receiver = User::find($receiver_id);
            $receiver->notify(new FriendRequestSent($sender_id));

            return redirect()->route('user.index')->with('success', 'Friend request sent');
        }
    
        $loc = session()->get('locale');
        App::setLocale($loc);
        return redirect()->back()->with('error', 'Failed to send friend request');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(FriendRequest $friendRequest)
    {
        $deleteRequest = FriendRequest::destroy($friendRequest->id);

        return redirect()->route('friend-request.index')->with('success', 'Succesfully Delete');
    }
}
