<?php

namespace App\Http\Controllers;

use App\Models\Menadzer;
use Illuminate\Http\Request;
use App\Http\Resources\MenadzerResource;
use Illuminate\Support\Facades\Validator;



class MenadzerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['menadzeri'=> MenadzerResource::collection(Menadzer::get())];

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
        $validator = Validator::make($request->all() , [
            'user_id'=>'required' 
        ]);

          
        if ($validator->fails())
            return response()->json($validator->errors());

            $menadzer=Menadzer::create([
                'user_id'=>$request->user_id,
                'datumZaposlenja'=>now(),

            ]);

            return response()->json(['success'=>true,'user_id'=> $menadzer->user_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menadzer  $menadzer
     * @return \Illuminate\Http\Response
     */
    public function show(Menadzer $menadzer)
    {
        return new MenadzerResource($menadzer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menadzer  $menadzer
     * @return \Illuminate\Http\Response
     */
    public function edit(Menadzer $menadzer)
    {
         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menadzer  $menadzer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menadzer $menadzer)
    {
        $validator = Validator::make($request->all() , [
            'plata'=>'required|numeric|min:43000|max:200000',
            'naOdmoru'=>'required|boolean',
            'naBolovanju'=>'required|boolean'
            
        ]);
        if ($validator->fails())
        return response()->json($validator->errors());

        $menadzer->plata=$request->plata;
        $menadzer->napomena=$request->napomena;
        $menadzer->naOdmoru=$request->naOdmoru;
        $menadzer->naBolovanju=$request->naBolovanju;

        $menadzer->save();

        return response()->json(['success'=>true, 'id'=> $menadzer->id,'menadzer'=> new MenadzerResource($menadzer) ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menadzer  $menadzer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menadzer $menadzer)
    {
        //
    }
}
