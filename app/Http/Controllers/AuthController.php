<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        $checkActive = User::where('email', '=', $request->email)->first();
        if(!$checkActive->active){
            return back()->with('fail', 'Banned');
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('fail', 'Login failed!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register(){
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'passwordconfirm' => 'required|same:password|min:5|max:255'
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }

    public function forgot(){
        return view('auth.forgot', [
            'title' => 'Forgot Password'
        ]);
    }

    public function reset(){
        return view('auth.reset', [
            'title' => 'Reset Password'
        ]);
    }
}
