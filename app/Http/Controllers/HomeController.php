<?php

namespace App\Http\Controllers;

use App;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
       
        $currentUserId = Auth::id();


        if ($currentUserId) {
            $userlist = User::where('id', '!=', $currentUserId)->get();
        } else {
          
            $userlist = User::all();
        }

        $loc = session()->get('locale');
        App::setLocale($loc);



        return view('home', compact('userlist'));
    }
}

