<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function store(Request $request){

    $request->validate([
        'name'=>'required',
        'email'=>'required',
        'password'=>'required|confirmed'
        
    ]);

    $user = new User;
    $user->name= $request->input('name');
    $user->email= $request->input('email');
    $user->password= $request->input('password');
    $user->password= Hash::make($request->input('password'));

    $user->save();
    Auth::login($user);
    return redirect('/welcome');
    }
};
