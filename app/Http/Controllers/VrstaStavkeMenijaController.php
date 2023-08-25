<?php

namespace App\Http\Controllers;

use App\Models\VrstaStavkeMenija;
use Illuminate\Http\Request;
use App\Http\Resources\VrstaStavkeMenijaResource;


class VrstaStavkeMenijaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['vrste'=> VrstaStavkeMenijaResource::collection(VrstaStavkeMenija::get())];

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
     * @param  \App\Models\VrstaStavkeMenija  $vrstaStavkeMenija
     * @return \Illuminate\Http\Response
     */
    public function show(VrstaStavkeMenija $vrstaStavkeMenija)
    {
        return new VrstaStavkeMenijaResource($vrstaStavkeMenija);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VrstaStavkeMenija  $vrstaStavkeMenija
     * @return \Illuminate\Http\Response
     */
    public function edit(VrstaStavkeMenija $vrstaStavkeMenija)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VrstaStavkeMenija  $vrstaStavkeMenija
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VrstaStavkeMenija $vrstaStavkeMenija)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VrstaStavkeMenija  $vrstaStavkeMenija
     * @return \Illuminate\Http\Response
     */
    public function destroy(VrstaStavkeMenija $vrstaStavkeMenija)
    {
        //
    }
}
