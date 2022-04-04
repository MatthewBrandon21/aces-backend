<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use App\Http\Requests\StoreGenerationRequest;
use App\Http\Requests\UpdateGenerationRequest;

class GenerationController extends Controller
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
     * @param  \App\Http\Requests\StoreGenerationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenerationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function show(Generation $generation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function edit(Generation $generation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGenerationRequest  $request
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenerationRequest $request, Generation $generation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Generation $generation)
    {
        //
    }
}
