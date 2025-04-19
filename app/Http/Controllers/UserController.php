<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;

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
        $User->save();

        return redirect('/login')->with('success', 'User registered successfully');

    }
    function handleLogin(Request $request)
    {
        // Handle login logic here
        $User = UserDetail::where('email', $request->input('email'))->first();
        if ($User && password_verify($request->input('password'), $User->password)) {
            // Authentication passed
            session(['user' => $User]);
           
            return redirect('/add-product')->with('success', 'Login successful');
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
}
