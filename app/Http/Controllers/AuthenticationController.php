<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    //
    public function register(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required',
            'instagram' => ['required', 'regex:/^http:\/\/www\.instagram\.com\/[A-Za-z0-9._]+$/'],
            'hobbies' => 'required|array|min:3',
            'number' => 'required',
        ]);

        $hobbies = implode(',', (array) $request->input('hobbies'));

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'gender' => $validatedData['gender'],
            'instagram' => $validatedData['instagram'],
            'hobbies' => $hobbies,
            'number' => $validatedData['number'],
            'profile_path'=> 'images/defaultAvatar.jpg',
            'register_price' => rand(100000,125000),
        ]);

        Auth::login($user);

        return redirect()->route('paymentCheck');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            return redirect('/home');
        }

        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){
     
        Auth::logout();
    
        
        $request->session()->invalidate();
    
        
        $request->session()->regenerateToken();
    
        
        return redirect('/'); 
    }
    
    public function paid(Request $request)
    {
        
        $validatedData = $request->validate([
            'payment_amount' => 'required|numeric|min:0',
            'price' => 'required|numeric',
        ]);

        $paymentAmount = $validatedData['payment_amount'];
        $price = $validatedData['price'];
        $difference = $paymentAmount - $price;

        $user = Auth::user();
        if ($difference < 0) {
            return redirect()->back()->with('error', 'You are still underpaid $' . number_format(-$difference, 2));
        } elseif ($difference > 0) {
            
            return redirect()->route('overpaid', [
                'amount' => $difference,
                'payment_amount' => $paymentAmount,
                'price' => $price
            ]);
        } else {
            $user->has_paid = true;
            $user->save();
            return redirect()->route('home');
        }
    }

    public function overpaid(Request $request)
    {
        $amount = $request->input('amount');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');

        return view('overpaid', [
            'amount' => $amount,
            'payment_amount' => $paymentAmount,
            'price' => $price
        ]);
    }

    public function overpaidTransfer(Request $request)
    {
        $action = $request->input('action');
        $paymentAmount = $request->input('payment_amount');
        $price = $request->input('price');
        $user = Auth::user();

        if ($action === 'accept') {
           
            $amount = $request->input('amount');
            $user->coins += $amount;
            $user->has_paid = true;
            $user->save();


            return redirect('/')->with('success', 'Your wallet has been successfully updated with the excess amount.');
        } else {
            
            return redirect()->route('paymentCheck')->with('error', 'Please enter the correct payment amount.');
        }
    }
}
