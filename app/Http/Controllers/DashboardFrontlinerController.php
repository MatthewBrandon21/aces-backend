<?php

namespace App\Http\Controllers;

use App\Models\Frontliner;
use App\Models\Generation;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DashboardFrontlinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';
        if(request('generation')){
            $generation = Generation::firstWhere('slug', request('generation'));
            $title = ' in ' . $generation->name;
        }
        return view('dashboard.frontliners.index', [
            'title' => 'ACES Frontliner Management',
            "frontliners" => Frontliner::latest()->filter(request(['search', 'generation']))->paginate(6)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.frontliners.add', [
            'title' => "Add frontliner member",
            'generations' => Generation::all()
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
            'jobdesk' => 'required|max:255',
            'email' => 'max:255',
            'linkedin' => 'max:255',
            'instagram' => 'max:255',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'website' => 'max:255',
            'slug' => 'required|unique:frontliners',
            'generation_id' => 'required',
            'image' => 'image|file|max:2048',
            'bio' => 'required'
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('frontliners-images');
        }
        Frontliner::create($validatedData);
        return redirect('/dashboard/frontliners')->with('success', 'New frontliner member has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Frontliner  $frontliner
     * @return \Illuminate\Http\Response
     */
    public function show(Frontliner $frontliner)
    {
        return view('dashboard.frontliners.detail', [
            'title' => $frontliner->name,
            "frontliner" => $frontliner
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Frontliner  $frontliner
     * @return \Illuminate\Http\Response
     */
    public function edit(Frontliner $frontliner)
    {
        return view('dashboard.frontliners.edit', [
            'title' => "Edit fronliner",
            'frontliner' => $frontliner,
            'generations' => Generation::all()
        ]);
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
        $rules = [
            'name' => 'required|max:255',
            'jobdesk' => 'required|max:255',
            'email' => 'max:255',
            'linkedin' => 'max:255',
            'instagram' => 'max:255',
            'facebook' => 'max:255',
            'twitter' => 'max:255',
            'website' => 'max:255',
            'generation_id' => 'required',
            'image' => 'image|file|max:2048',
            'bio' => 'required'
        ];
        if($request->slug != $frontliner->slug){
            $rules['slug'] = 'required|unique:frontliners';
        }
        $validatedData = $request->validate($rules);
        if($request->file('image')){
            if($request->oldimage){
                Storage::delete($request->oldimage);
            }
            $validatedData['image'] = $request->file('image')->store('frontliners-images');
        }
        Frontliner::where('id', $frontliner->id)->update($validatedData);
        return redirect('/dashboard/frontliners')->with('success', 'Frontliner member has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Frontliner  $frontliner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Frontliner $frontliner)
    {
        if($frontliner->image){
            Storage::delete($frontliner->image);
        }
        Frontliner::destroy($frontliner->id);
        return redirect('/dashboard/frontliners')->with('success', 'Frontliner member has been deleted!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Frontliner::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
