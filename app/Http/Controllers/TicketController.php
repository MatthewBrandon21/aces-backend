<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class TicketController extends Controller
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
        return view('dashboard.memberticket.index', [
            'title' => 'Ticket Management',
            "tickets" => Ticket::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.memberticket.add', [
            'title' => "Add ticket"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:repositorylabs',
            'body' => 'required'
        ]);
        $validatedData['status'] = "Pending";
        $validatedData['user_id'] = auth()->user()->id;
        Ticket::create($validatedData);
        return redirect('/dashboard/ticket')->with('success', 'New ticket has been added! We will contact you shortly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if($ticket->user_id != auth()->user()->id){
            return redirect('/dashboard/ticket')->with('warning', 'Invalid Ticket');
        }
        return view('dashboard.memberticket.detail', [
            'title' => $ticket->title,
            "ticket" => $ticket
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Ticket::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
