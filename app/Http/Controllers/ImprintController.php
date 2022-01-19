<?php

namespace App\Http\Controllers;

use App\Models\Imprint;
use Illuminate\Http\Request;

class ImprintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Imprint::all(), 200);
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
     * @param  \App\Models\Imprint  $imprint
     * @return \Illuminate\Http\Response
     */
    public function show(Imprint $imprint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imprint  $imprint
     * @return \Illuminate\Http\Response
     */
    public function edit(Imprint $imprint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imprint  $imprint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imprint $imprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imprint  $imprint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imprint $imprint)
    {
        //
    }
}
