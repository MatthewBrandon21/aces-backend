<?php

namespace App\Http\Controllers;

use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages());
        }
        $contactuses = Contactus::create([
            'name' => request('name'),
            'email' => request('email'),
            'title' => request('title'),
            'body' => request('body'),
            'status' => "Pending"
        ]);
        if($contactuses){
            return response()->json(['message' => 'We have recieved your message. Someone from our team will contact you soon.']);
        } else {
            return response()->json(['message' => 'Something wrong. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
