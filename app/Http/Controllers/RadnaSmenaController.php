<?php

namespace App\Http\Controllers;

use App\Models\RadnaSmena;
use Illuminate\Http\Request;
use App\Http\Resources\RadnaSmenaResource;
use Illuminate\Support\Facades\Validator;



class RadnaSmenaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['smene'=> RadnaSmenaResource::collection(RadnaSmena::get())];

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
            'smena'=>'required|in:prva,druga',
            'konobar_id'=>'required'

        ]);

          
        if ($validator->fails())
            return response()->json($validator->errors());

            $smena=RadnaSmena::create([
                'smena'=>$request->smena,
                'datum'=>now(),
                'napomena'=>$request->napomena,
                'konobar_id'=>$request->konobar_id

            ]);

            return response()->json(['success'=>true,'smena'=> new RadnaSmenaResource($smena)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RadnaSmena  $radnaSmena
     * @return \Illuminate\Http\Response
     */
    public function show(RadnaSmena $radnaSmena)
    {
        return new RadnaSmenaResource($radnaSmena);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RadnaSmena  $radnaSmena
     * @return \Illuminate\Http\Response
     */
    public function edit(RadnaSmena $radnaSmena)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RadnaSmena  $radnaSmena
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RadnaSmena $radnaSmena)
    {
        $validator = Validator::make($request->all() , [
            'ukupanPromet'=>'required|numeric|min:0|max:1000000',
            
        ]);
          
        if ($validator->fails())
            return response()->json($validator->errors());

            $radnaSmena->napomena=$request->napomena;
            $radnaSmena->ukupanPromet=$request->ukupanPromet;

            $radnaSmena->save();
            return response()->json(['success'=>true, 'id'=> $radnaSmena->id,'radnaSmena'=> new RadnaSmenaResource($radnaSmena) ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RadnaSmena  $radnaSmena
     * @return \Illuminate\Http\Response
     */
    public function destroy(RadnaSmena $radnaSmena)
    {
        //
    }
}
