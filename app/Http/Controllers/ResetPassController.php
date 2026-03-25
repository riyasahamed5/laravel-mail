<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPassController extends Controller
{
   public function showResetPassForm($token){
    return view('forgotPasswordLink',['token'=>$token]);

   }

   public function submitResetPassForm(Request $request){

   $request->validate([
    'email'=>'required|email|exists:users,email',
    'password'=>'required|min:6| confirmed',
   ]);

   $password_reset_request = DB::table('password_reset_tokens')
   ->where('email',$request->input('email'))
   ->where('token', $request->input('token'))->first();


if(!$password_reset_request){
    return back()->with('error','invalid token');
}

else{
    User::where('email', $request->input('email'))
    ->update(['password'=>Hash::make($request->input('password'))]);

    DB::table('password_reset_tokens')
    ->where('email',$request->input('email'))
    ->delete();

    return redirect('/login')->with('message', 'password Rested');
}



   }
}
