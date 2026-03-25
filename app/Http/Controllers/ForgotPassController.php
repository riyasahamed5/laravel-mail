<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
 use App\Mail\ForgotPasswordMail;

class ForgotPassController extends Controller
{
    public function showForgotPassForm()
    {
        return view('forgotPassword');
    }

    public function submitForgotPassForm(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
    ['email' => $request->email], // condition
    [
        'token' => $token,
        'created_at' => Carbon::now()
    ]
);
        // Mail::send(
        //     'email.forgotPassword',
        //     ['token' => $token],
        //     function ($message) use ($request) {
        //         $message->to($request->input('email'));
        //         $message->subject('Reset Password');
        //     }
        // );

        Mail::to($request->input('email'))->send(new ForgotPasswordMail($token));
        return back()->with('message', 'Sent you a mail for reset password');
    }
}
