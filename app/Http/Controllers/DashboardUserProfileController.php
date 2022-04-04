<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DashboardUserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.user-profile.index', [
            'title' => 'My Profile',
            "user" => auth()->user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:255',
            'image' => 'image|file|max:2048'
        ];
        $validatedData = $request->validate($rules);
        if($request->file('image')){
            if($request->oldimage){
                Storage::delete($request->oldimage);
            }
            $validatedData['image'] = $request->file('image')->store('user-images');
        }
        User::where('id', auth()->user()->id)->update($validatedData);
        return redirect('/dashboard/profile')->with('success', 'Profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function changePassword(Request $request, User $user)
    {
        $rules = [
            'oldpassword' => 'required|min:5|max:255',
            'password' => 'required|min:5|max:255',
            'passwordconfirm' => 'same:password|min:5|max:255'
        ];
        $validatedData = $request->validate($rules);
        if(Hash::check($request->oldpassword, $user->password)){
            $inputData['password'] = bcrypt($validatedData['password']);
            User::where('id', $user->id)->update($inputData);
            return redirect('/dashboard/profile')->with('success', 'Password has been updated!');
        }
        return redirect('/dashboard/profile')->with('fail', 'Old password incorrect!');
    }
}
