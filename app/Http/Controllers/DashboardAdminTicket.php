<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class DashboardAdminTicket extends Controller
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
        return view('dashboard.adminticket.index', [
            'title' => 'Ticket Management',
            "tickets" => Ticket::filter(request(['author']))->get()
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
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('dashboard.adminticket.detail', [
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
        $rules = [
            'response' => 'required'
        ];
        $validatedData = $request->validate($rules);
        $validatedData['status'] = "Answered";
        Ticket::where('id', $ticket->id)->update($validatedData);
        return redirect('/dashboard/admin-ticket')->with('success', 'Ticket has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        Ticket::destroy($ticket->id);
        return redirect('/dashboard/admin-ticket')->with('success', 'Ticket has been deleted!');
    }
}
