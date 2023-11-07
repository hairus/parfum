<?php

namespace App\Http\Controllers;

use App\client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construc()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cs');
    }

    public function sc()
    {
        $clients = client::with(['trxs' => function($q){
            $q->sum('bonus');
        }])->with('claims')->get();

        return view('sc', compact('clients'));
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
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = client::find($id);

        return view('edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, client $client)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = client::find($id);
        $id->delete();

        return;
    }

    public function getData()
    {
        $clients = client::all();
        return view('getData', compact('clients'));
    }

    public function update(Request $request)
    {
        $client = client::find($request->id);
        $client->update([
            "nama" => $request->nama,
            "deskripsi" => $request->desk,
        ]);

        return;
    }
}
