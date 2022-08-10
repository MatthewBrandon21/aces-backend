<?php

namespace App\Http\Controllers;

use App\Models\Labscategory;
use App\Models\Repositorylabs;
use App\Models\User;
use Illuminate\Http\Request;

class ApiRepositorylabsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('labscategory')){
            $labscategory = Labscategory::firstWhere('slug', request('labscategory'));
        }
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
        }
        $repositories = Repositorylabs::latest()->filter(request(['search', 'labscategory', 'author']))->paginate(10)->withQueryString();
        foreach ($repositories as $repository){
            if($repository->image != null){
                $repository->image = asset('storage/' . $repository->image);
            }
        }
        return $repositories;
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
     * @param  \App\Models\Repositorylabs  $repositorylabs
     * @return \Illuminate\Http\Response
     */
    public function show(Repositorylabs $repositorylabs)
    {
        return $repositorylabs;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repositorylabs  $repositorylabs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repositorylabs $repositorylabs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repositorylabs  $repositorylabs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repositorylabs $repositorylabs)
    {
        //
    }
}
