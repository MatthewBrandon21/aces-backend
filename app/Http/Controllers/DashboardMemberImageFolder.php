<?php

namespace App\Http\Controllers;

use App\Models\Imagefolder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DashboardMemberImageFolder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        return view('dashboard.memberimagefolder.index', [
            'title' => 'User Image Folder',
            "images" => Imagefolder::where('user_id', auth()->user()->id)->latest()->filter(request(['author']))->paginate(6)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.memberimagefolder.add', [
            'title' => "Add Image"
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
            'image' => 'required|image|file|max:2048'
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images-folder');
        }
        $validatedData['user_id'] = auth()->user()->id;
        Imagefolder::create($validatedData);
        return redirect('/dashboard/imagefolder')->with('success', 'New image has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imagefolder  $imagefolder
     * @return \Illuminate\Http\Response
     */
    public function show(Imagefolder $imagefolder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imagefolder  $imagefolder
     * @return \Illuminate\Http\Response
     */
    public function edit(Imagefolder $imagefolder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imagefolder  $imagefolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imagefolder $imagefolder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imagefolder  $imagefolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imagefolder $imagefolder)
    {
        if($imagefolder->user_id != auth()->user()->id){
            return redirect('/dashboard/imagefolder')->with('warning', 'Invalid Image');
        }
        if($imagefolder->image){
            Storage::delete($imagefolder->image);
        }
        Imagefolder::destroy($imagefolder->id);
        return redirect('/dashboard/imagefolder')->with('success', 'Image has been deleted!');
    }
}
