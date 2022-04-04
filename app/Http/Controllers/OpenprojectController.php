<?php

namespace App\Http\Controllers;

use App\Models\Openproject;
use App\Http\Requests\StoreOpenprojectRequest;
use App\Http\Requests\UpdateOpenprojectRequest;

class OpenprojectController extends Controller
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
     * @param  \App\Http\Requests\StoreOpenprojectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOpenprojectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function show(Openproject $openproject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function edit(Openproject $openproject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOpenprojectRequest  $request
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOpenprojectRequest $request, Openproject $openproject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Openproject $openproject)
    {
        //
    }
}
