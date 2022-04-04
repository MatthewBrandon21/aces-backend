<?php

namespace App\Http\Controllers;

use App\Models\Frontliner;
use App\Models\Generation;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DashboardGenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.generations.index', [
            'title' => 'ACES Generation Management',
            "generations" => Generation::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.generations.add', [
            'title' => "Add Generation",
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'periode' => 'required|max:255',
            'visi' => 'required',
            'misi' => 'required',
            'slug' => 'required|unique:generations',
            'image' => 'image|file|max:2048'
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('generations-images');
        }
        Generation::create($validatedData);
        return redirect('/dashboard/generations')->with('success', 'New generation has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function show(Generation $generation)
    {
        return view('dashboard.generations.detail', [
            'title' => $generation->name,
            "generation" => $generation,
            "frontliners" => Frontliner::where('generation_id', '=', $generation->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function edit(Generation $generation)
    {
        return view('dashboard.generations.edit', [
            'title' => "Edit generation",
            'generation' => $generation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Generation $generation)
    {
        $rules = [
            'name' => 'required|max:255',
            'periode' => 'required|max:255',
            'visi' => 'required',
            'misi' => 'required',
            'image' => 'image|file|max:2048'
        ];
        if($request->slug != $generation->slug){
            $rules['slug'] = 'required|unique:generations';
        }
        $validatedData = $request->validate($rules);
        if($request->file('image')){
            if($request->oldimage){
                Storage::delete($request->oldimage);
            }
            $validatedData['image'] = $request->file('image')->store('generations-images');
        }
        Generation::where('id', $generation->id)->update($validatedData);
        return redirect('/dashboard/generations')->with('success', 'Generation has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Generation  $generation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Generation $generation)
    {
        $generationUsed = Frontliner::where('generation_id', '=', $generation->id)->first();
        if($generationUsed === null){
            if($generation->image){
                Storage::delete($generation->image);
            }
            Generation::destroy($generation->id);
            return redirect('/dashboard/generations')->with('success', 'Generation has been deleted!');
        }
        return redirect('/dashboard/generations')->with('fail', 'There is a frontliner that in this generation!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Generation::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
