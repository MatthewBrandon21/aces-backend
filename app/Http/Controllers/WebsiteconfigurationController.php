<?php

namespace App\Http\Controllers;

use App\Models\Generation;
use App\Models\Websiteconfiguration;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class WebsiteconfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';
        return view('dashboard.websiteconfiguration.index', [
            'title' => 'Website Configuration',
            "configuration" => Websiteconfiguration::first(),
            "generations" => Generation::all()
        ]);
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
     * @param  \App\Http\Requests\StoreWebsiteconfigurationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Websiteconfiguration  $websiteconfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(Websiteconfiguration $websiteconfiguration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Websiteconfiguration  $websiteconfiguration
     * @return \Illuminate\Http\Response
     */
    public function edit(Websiteconfiguration $websiteconfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWebsiteconfigurationRequest  $request
     * @param  \App\Models\Websiteconfiguration  $websiteconfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Websiteconfiguration $websiteconfiguration)
    {
        $rules = [
            'instagram' => 'required',
            'twitter' => 'required',
            'facebook' => 'required',
            'email' => 'required',
            'header_hero' => 'required',
            'announcement_title' => 'required',
            'announcement_link' => 'required',
            'generation_slug' => 'required',
            'hero_image' => 'image|file|max:2048'
        ];
        $validatedData = $request->validate($rules);
        if($request->file('hero_image')){
            if($request->oldimage){
                Storage::delete($request->oldimage);
            }
            $validatedData['hero_image'] = $request->file('hero_image')->store('webconfiguration-images');
        }
        Websiteconfiguration::where('id', $websiteconfiguration->id)->update($validatedData);
        return redirect('/dashboard/websiteconfiguration')->with('success', 'Project has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Websiteconfiguration  $websiteconfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Websiteconfiguration $websiteconfiguration)
    {
        //
    }
}
