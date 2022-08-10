<?php

namespace App\Http\Controllers;

use App\Models\Frontliner;
use App\Models\Generation;
use Illuminate\Http\Request;

class ApiFrontlinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('generation')){
            $generation = Generation::firstWhere('slug', request('generation'));
        } 
        $frontliners = Frontliner::latest()->filter(request(['search', 'generation']))->get();
        foreach ($frontliners as $frontliner){
            if($frontliner->image != null){
                $frontliner->image = asset('storage/' . $frontliner->image);
            }
        }
        return $frontliners;
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
     * @param  \App\Models\Frontliner  $frontliner
     * @return \Illuminate\Http\Response
     */
    public function show(Frontliner $frontliner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Frontliner  $frontliner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Frontliner $frontliner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frontliner  $frontliner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frontliner $frontliner)
    {
        //
    }
}
