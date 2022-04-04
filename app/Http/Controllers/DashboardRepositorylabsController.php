<?php

namespace App\Http\Controllers;

use App\Models\Labscategory;
use App\Models\Repositorylabs;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DashboardRepositorylabsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = '';
        if(request('labscategory')){
            $labscategory = Labscategory::firstWhere('slug', request('labscategory'));
            $title = ' in ' . $labscategory->name;
        }
        if(request('author')){
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }
        return view('dashboard.repositorylabss.index', [
            'title' => 'Repository Management',
            "repositories" => Repositorylabs::latest()->filter(request(['search', 'labscategory', 'author']))->paginate(6)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.repositorylabss.add', [
            'title' => "Add repository",
            'labscategories' => Labscategory::all()
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
            'slug' => 'required|unique:repositorylabs',
            'labscategory_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('repositories-images');
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Repositorylabs::create($validatedData);
        return redirect('/dashboard/labs')->with('success', 'New reoository has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repositorylabs  $repositorylabs
     * @return \Illuminate\Http\Response
     */
    public function show(Repositorylabs $repositorylabs)
    {
        return view('dashboard.repositorylabss.detail', [
            'title' => $repositorylabs->title,
            "repository" => $repositorylabs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repositorylabs  $repositorylabs
     * @return \Illuminate\Http\Response
     */
    public function edit(Repositorylabs $repositorylabs)
    {
        return view('dashboard.repositorylabss.edit', [
            'title' => "Edit repository",
            'repository' => $repositorylabs,
            'labscategories' => Labscategory::all()
        ]);
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
        $rules = [
            'title' => 'required|max:255',
            'labscategory_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ];
        if($request->slug != $repositorylabs->slug){
            $rules['slug'] = 'required|unique:repositorylabs';
        }
        $validatedData = $request->validate($rules);
        if($request->file('image')){
            if($request->oldimage){
                Storage::delete($request->oldimage);
            }
            $validatedData['image'] = $request->file('image')->store('repositories-images');
        }
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        Repositorylabs::where('id', $repositorylabs->id)->update($validatedData);
        return redirect('/dashboard/labs')->with('success', 'Repository has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repositorylabs  $repositorylabs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repositorylabs $repositorylabs)
    {
        if($repositorylabs->image){
            Storage::delete($repositorylabs->image);
        }
        Repositorylabs::destroy($repositorylabs->id);
        return redirect('/dashboard/labs')->with('success', 'Repository has been deleted!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Repositorylabs::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }

    public function publishConf(Request $request, Repositorylabs $repositorylabs)
    {
        $rules = [
            'published' => 'required'
        ];
        $validatedData = $request->validate($rules);
        Repositorylabs::where('id', $repositorylabs->id)->update($validatedData);
        return redirect('/dashboard/labs')->with('success', 'Repository publish configuration has been updated!');
    }
}
