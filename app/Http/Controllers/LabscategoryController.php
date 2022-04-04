<?php

namespace App\Http\Controllers;

use App\Models\Labscategory;
use App\Http\Requests\StoreLabscategoryRequest;
use App\Http\Requests\UpdateLabscategoryRequest;

class LabscategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreLabscategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLabscategoryRequest $request)
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Labscategory $labscategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLabscategoryRequest  $request
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabscategoryRequest $request, Labscategory $labscategory)
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
