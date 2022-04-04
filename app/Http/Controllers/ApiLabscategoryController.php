<?php

namespace App\Http\Controllers;

use App\Models\Labscategory;
use Illuminate\Http\Request;

class ApiLabscategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Labscategory::latest()->get();
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
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function show(Labscategory $labscategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Labscategory $labscategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Labscategory $labscategory)
    {
        //
    }
}
