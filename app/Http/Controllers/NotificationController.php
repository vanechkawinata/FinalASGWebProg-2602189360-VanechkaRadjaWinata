<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);

        $loc = session()->get('locale');
        App::setLocale($loc);

        return view('notifications', compact('notifications'));
    }

    public function destroy($id)
    {
        $notification = Auth::user()->notifications()->find($id);

        if ($notification) {
            $notification->delete();
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }
}
