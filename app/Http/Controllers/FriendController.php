<?php

namespace App\Http\Controllers;

use App;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;
use App\Notifications\FriendRequestAccepted;
use Auth;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $currentUserID = Auth::user()->id;

    $userlist = Friend::where('user_id', $currentUserID)
        ->join('users', 'friends.friend_id', '=', 'users.id')
        ->select('users.*')
        ->distinct()
        ->get();

    $friendList = Friend::where('friend_id', $currentUserID)
        ->join('users', 'friends.user_id', '=', 'users.id')
        ->select('users.*')
        ->distinct()
        ->get();

    
    $userlist = $userlist->merge($friendList)->unique('id');

    $loc = session()->get('locale');
    App::setLocale($loc);

    return view('friend', compact('userlist'));
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
        $currentUserID = Auth::user()->id;
        $friendID = $request->input('friend_id');
        $request_id = $request->input('request_id');

        // Create the friendship
        $friend = Friend::create([
            'user_id' => $currentUserID,
            'friend_id' => $friendID
        ]);

        // Create the reciprocal friendship
        $friend2 = Friend::create([
            'user_id' => $friendID,
            'friend_id' => $currentUserID
        ]);

        
        $updateRequest = FriendRequest::find($request_id);
        $updateRequest->status = 'accepted';
        $updateRequest->save();

       
        $receiver = User::find($friendID);
        $receiver->notify(new FriendRequestAccepted($currentUserID));

        return redirect()->route('friend-request.index')->with('success', 'Friend request accepted and notification sent!');
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
    public function destroy(string $id)
    {
        //
    }
}
