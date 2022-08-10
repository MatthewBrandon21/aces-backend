<?php

namespace App\Http\Controllers;

use App\Models\Websitegallery;
use Illuminate\Http\Request;

class ApiWebsiteGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websitegalleries = Websitegallery::latest()->filter(request(['search']))->paginate(6)->withQueryString();
        foreach ($websitegalleries as $websitegallery){
            if($websitegallery->image != null){
                $websitegallery->image = asset('storage/' . $websitegallery->image);
            }
        }
        return $websitegalleries;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
