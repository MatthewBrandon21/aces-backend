<?php

namespace App\Http\Controllers;

use App\Models\Celecturer;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CelecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';
        return view('dashboard.celecturer.index', [
            'title' => 'Computer Engineering Lecturers',
            "celecturers" => Celecturer::latest()->filter(request(['search']))->paginate(6)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.celecturer.add', [
            'title' => "Add Lecturer"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCelecturerRequest  $request
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
            'slug' => 'required|unique:celecturers',
            'image' => 'image|file|max:2048',
            'bio' => 'required'
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('celecturers-images');
        }
        Celecturer::create($validatedData);
        return redirect('/dashboard/lecturers')->with('success', 'New lecturer has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Celecturer  $celecturer
     * @return \Illuminate\Http\Response
     */
    public function show(Celecturer $celecturer)
    {
        return view('dashboard.celecturer.detail', [
            'title' => $celecturer->name,
            "lecturer" => $celecturer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Celecturer  $celecturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Celecturer $celecturer)
    {
        return view('dashboard.celecturer.edit', [
            'title' => "Edit lecturer",
            'lecturer' => $celecturer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCelecturerRequest  $request
     * @param  \App\Models\Celecturer  $celecturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Celecturer $celecturer)
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
            'image' => 'image|file|max:2048',
            'bio' => 'required'
        ];
        if($request->slug != $celecturer->slug){
            $rules['slug'] = 'required|unique:celecturers';
        }
        $validatedData = $request->validate($rules);
        if($request->file('image')){
            if($request->oldimage){
                Storage::delete($request->oldimage);
            }
            $validatedData['image'] = $request->file('image')->store('celecturers-images');
        }
        Celecturer::where('id', $celecturer->id)->update($validatedData);
        return redirect('/dashboard/lecturers')->with('success', 'Lecturer has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Celecturer  $celecturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Celecturer $celecturer)
    {
        if($celecturer->image){
            Storage::delete($celecturer->image);
        }
        Celecturer::destroy($celecturer->id);
        return redirect('/dashboard/lecturers')->with('success', 'Lecturer has been deleted!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Celecturer::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
