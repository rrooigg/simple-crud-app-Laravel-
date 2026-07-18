<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller 
{
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200'],
        ]);
        $incomingFields['password'] = bcrypt($incomingFields['password']); //hashes password

        $user = User::create($incomingFields); //this adds info from the inputs to the db
        Auth::login($user); 
        
        return redirect('/');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginname' => ['required'],
            'loginpassword' => ['required'],
        ]);
        //find a match in db
        if(Auth::attempt(['name'=>$incomingFields['loginname'], 'password'=>$incomingFields['loginpassword']])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }

}