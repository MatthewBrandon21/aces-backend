<?php

namespace App\Http\Controllers;

use App\Models\Websitegallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class WebsitegalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';
        return view('dashboard.websitegallery.index', [
            'title' => 'Website Gallery',
            "images" => Websitegallery::latest()->filter(request(['search']))->paginate(6)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.websitegallery.add', [
            'title' => "Add Image"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWebsitegalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'image' => 'required|image|file|max:2048'
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('website-images-folder');
        }
        Websitegallery::create($validatedData);
        return redirect('/dashboard/websitegallery')->with('success', 'New image has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Websitegallery  $websitegallery
     * @return \Illuminate\Http\Response
     */
    public function show(Websitegallery $websitegallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Websitegallery  $websitegallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Websitegallery $websitegallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWebsitegalleryRequest  $request
     * @param  \App\Models\Websitegallery  $websitegallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Websitegallery $websitegallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Websitegallery  $websitegallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Websitegallery $websitegallery)
    {
        if($websitegallery->image){
            Storage::delete($websitegallery->image);
        }
        Websitegallery::destroy($websitegallery->id);
        return redirect('/dashboard/websitegallery')->with('success', 'Image has been deleted!');
    }
}
