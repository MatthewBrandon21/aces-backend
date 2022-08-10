<?php

namespace App\Http\Controllers;

use App\Models\Openproject;
use App\Models\User;
use Illuminate\Http\Request;

class ApiOpenprojectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
        }
        $projects = Openproject::latest()->filter(request(['search', 'author']))->paginate(10)->withQueryString();
        foreach ($projects as $project){
            if($project->image != null){
                $project->image = asset('storage/' . $project->image);
            }
        }
        return $projects;
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
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function show(Openproject $openproject)
    {
        return $openproject;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Openproject $openproject)
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
