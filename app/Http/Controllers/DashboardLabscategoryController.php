<?php

namespace App\Http\Controllers;

use App\Models\Labscategory;
use App\Models\Repositorylabs;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class DashboardLabscategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.labscategories.index', [
            'title' => 'Labs Category Management',
            "labscategories" => Labscategory::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.labscategories.add', [
            'title' => "Add labs category",
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
            'slug' => 'required|unique:categories'
        ]);
        Labscategory::create($validatedData);
        return redirect('/dashboard/labs-categories')->with('success', 'New category has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function show(Labscategory $labscategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Labscategory $labscategory)
    {
        return view('dashboard.labscategories.edit', [
            'title' => "Edit labs category",
            'labscategory' => $labscategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Labscategory $labscategory)
    {
        $rules = [
            'name' => 'required|max:255',
        ];
        if($request->slug != $labscategory->slug){
            $rules['slug'] = 'required|unique:categories';
        }
        $validatedData = $request->validate($rules);
        Labscategory::where('id', $labscategory->id)->update($validatedData);
        return redirect('/dashboard/labs-categories')->with('success', 'Category has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Labscategory  $labscategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Labscategory $labscategory)
    {
        $categoryUsed = Repositorylabs::where('labscategory_id', '=', $labscategory->id)->first();
        if($categoryUsed === null){
            Labscategory::destroy($labscategory->id);
            return redirect('/dashboard/labs-categories')->with('success', 'Category has been deleted!');
        }
        return redirect('/dashboard/labs-categories')->with('fail', 'There is a repository that uses this category!');
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Labscategory::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
