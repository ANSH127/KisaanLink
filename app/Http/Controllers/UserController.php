<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        echo "Signup logic here";
        echo $request->input('name');
        echo $request->input('email');
        echo $request->input('password');
        echo $request->input('role');




        // return redirect()->route('login');
    }
    function handleLogin(Request $request)
    {
        // Handle login logic here
        echo "Login logic here";
        echo $request->input('email');
        echo $request->input('password');
        // For example, validate the request and authenticate the user
        // return redirect()->route('home');
    }
}
