<?php

namespace App\Http\Controllers;

use App;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $currentUserID = Auth::user() ? Auth::user()->id : null;
    $searchTerm = $request->input('search');
    $gender = $request->input('gender');
    $hobbies = $request->input('hobbies', []);

    $userlist = User::query();

    if (!$currentUserID) {
        $userlist = $userlist->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', '%' . $searchTerm . '%');
        });
    } else {
        $sentRequestUserIDs = DB::table('friend_request')
            ->where('sender_id', '=', $currentUserID)
            ->pluck('receiver_id');

        $friendUserIDs = DB::table('friends')
            ->where('user_id', '=', $currentUserID)
            ->pluck('friend_id')
            ->merge(
                DB::table('friends')
                    ->where('friend_id', '=', $currentUserID)
                    ->pluck('user_id')
            );

        $userlist = $userlist->whereNotIn('id', $sentRequestUserIDs)
            ->whereNotIn('id', $friendUserIDs)
            ->where('id', '!=', $currentUserID)
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->when($gender, function ($query, $gender) {
                return $query->where('gender', $gender);
            })
            ->when($hobbies, function ($query) use ($hobbies) {
                return $query->where(function ($q) use ($hobbies) {
                    foreach ($hobbies as $hobby) {
                        $q->orWhere('hobbies', 'like', '%' . $hobby . '%');
                    }
                });
            });
    }
    $loc = session()->get('locale');
    App::setLocale($loc);

    return view('home', ['userlist' => $userlist->get()]);
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
        //
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
