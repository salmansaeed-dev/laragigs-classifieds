<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show Register/ Create user form
    public function create(){
        
            return view( 'users.register' );
    }

    //Create new user
    Public function store(Request $request) {

        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6' ]);

            // hash Password
            $formFields['password'] = bcrypt($formFields['password']);

    $user = User::create($formFields);

    //login 
    auth()->login($user);

    return redirect()->route('listings.index')->withsuccess('User created successfully and logged In!');

    }

    // logout user
    public function logout(Request $request){
        
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->withsuccess('You have successfully logged out!');
    }

    //show login form
    public function login(){

            return view( 'users.login' );
    }

    // Login user 
    Public function authenticate(Request $request){

        $formFields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //  attempt to log user in
        if(auth()->attempt($formFields)) {

            return redirect()->route('listings.index')->withsuccess('You have successfully logged In!');
        }
    else {

            return back()->witherrors(['email' => 'Invalid Credentials!'])->onlyinput('email');
        }
    }
}