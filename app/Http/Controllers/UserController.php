<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

class UserController extends Controller
{
    //

    function showSignupPage()
    {
        return view('SignupPage');
    }
    function showLoginPage()
    {
        return view('loginPage');
    }
    function handleSignup(Request $request)
    {
        // Handle signup logic here
        $User = new UserDetail();
        $User->name = $request->input('name');
        $User->email = $request->input('email');
        $User->password = bcrypt($request->input('password'));
        $User->role = $request->input('role');
        $User->phone = $request->input('phone');
        $User->address = $request->input('address');
        $User->save();

        // encode the user id
        $encoded_id = base64_encode($User->id);
        Mail::to($User->email)->send(new VerifyEmail($encoded_id));

        return redirect('/login')->with('success', 'User registered successfully. Please verify your email to log in.');

    }
    function handleLogin(Request $request)
    {
        // Handle login logic here
        $User = UserDetail::where('email', $request->input('email'))->first();
        if ($User && password_verify($request->input('password'), $User->password)) {
            if (!$User->email_verified) {
                return redirect('/login')->with('error', 'Please verify your email before logging in.');
            }
            // Authentication passed
            session(['user' => $User]);

            return redirect('/dashboard')->with('success', 'Login successful');
        } else {
            return redirect('/login')->with('error', 'Invalid credentials');
        }
    }

    function logout(Request $request)
    {
        // Handle logout logic here
        session()->forget('user');
        return redirect('/login')->with('success', 'Logged out successfully');
    }

    function profile(Request $request)
    {
        // Fetch the logged-in user's details
        $user = UserDetail::find(session('user')->id);

        // Check if the user exists
        if (!$user) {
            return redirect('/login')->with('error', 'User not found. Please log in again.');
        }

        // Pass the user data to the Profile view
        return view('Profile', ['user' => $user]);
    }

    function verifyEmail($encodedId)
    {
        $userId = base64_decode($encodedId);

        $user = UserDetail::find($userId);

        if (!$user) {
            return redirect('/login')->with('error', 'Invalid verification link.');
        }

        $user->email_verified = true;
        $user->save();

        return redirect('/login')->with('success', 'Email verified successfully. You can now log in.');
    }
}
