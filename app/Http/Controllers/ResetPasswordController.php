<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showForgotForm(){
        return view('auth.forgot', [
            'title' => 'Forgot Password']);
    }

    public function sendResetLink(Request $request){
         $request->validate([
             'email'=>'required|email|exists:users,email'
         ]);

         $token = \Str::random(64);
         \DB::table('password_resets')->insert([
               'email'=>$request->email,
               'token'=>$token,
               'created_at'=>Carbon::now(),
         ]);
         
         $action_link = route('reset.password.form',['token'=>$token,'email'=>$request->email]);
         $body = "We are received a request to reset the password for <b>ACES UMN Website </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

        \Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
              $message->from('aces@umn.ac.id','ACES UMN Website');
              $message->to($request->email,'ACES UMN Website')
                      ->subject('Reset Password Account for ACES UMN Website');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function showResetForm(Request $request, $token = null){
        return view('auth.reset', [
            'title' => 'Forgot Password'])->with(['token'=>$token,'email'=>$request->email]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid token');
        }else{

            User::where('email', $request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect('/login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }
}
