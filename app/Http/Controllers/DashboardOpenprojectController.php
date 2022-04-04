<?php

namespace App\Http\Controllers;

use App\Models\Openproject;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DashboardOpenprojectController extends Controller
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
        return view('dashboard.openprojects.index', [
            'title' => 'ACES Open Project',
            "projects" => Openproject::latest()->filter(request(['search', 'author']))->paginate(6)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.openprojects.add', [
            'title' => "Add project"
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
            'title' => 'required|max:255',
            'slug' => 'required|unique:openprojects',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('openprojects-images');
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Openproject::create($validatedData);
        return redirect('/dashboard/openproject')->with('success', 'New project has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function show(Openproject $openproject)
    {
        return view('dashboard.openprojects.detail', [
            'title' => $openproject->title,
            "project" => $openproject
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function edit(Openproject $openproject)
    {
        return view('dashboard.openprojects.edit', [
            'title' => "Edit project",
            'project' => $openproject
        ]);
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
        $rules = [
            'title' => 'required|max:255',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ];
        if($request->slug != $openproject->slug){
            $rules['slug'] = 'required|unique:openprojects';
        }
        $validatedData = $request->validate($rules);
        if($request->file('image')){
            if($request->oldimage){
                Storage::delete($request->oldimage);
            }
            $validatedData['image'] = $request->file('image')->store('openprojects-images');
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Openproject::where('id', $openproject->id)->update($validatedData);
        return redirect('/dashboard/openproject')->with('success', 'Project has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Openproject  $openproject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Openproject $openproject)
    {
        if($openproject->image){
            Storage::delete($openproject->image);
        }
        Openproject::destroy($openproject->id);
        return redirect('/dashboard/openproject')->with('success', 'Project has been deleted!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Openproject::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function publishConf(Request $request, Openproject $openproject)
    {
        $rules = [
            'published' => 'required'
        ];
        $validatedData = $request->validate($rules);
        Openproject::where('id', $openproject->id)->update($validatedData);
        return redirect('/dashboard/openproject')->with('success', 'Project publish configuration has been updated!');
    }
}
