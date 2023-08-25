<?php

namespace App\Http\Controllers;

use App\Models\Porudzbina;
use Illuminate\Http\Request;
use App\Http\Resources\PorudzbinaResource;
use Illuminate\Support\Facades\Validator;



class PorudzbinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['porudzbine'=> PorudzbinaResource::collection(Porudzbina::get())];

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
            'ukupnaCena'=>'required|numeric|min:0|max:100000',
            'gost_id'=>'required'
        ]);

        
        if ($validator->fails())
            return response()->json($validator->errors());


            $porudzbina=Porudzbina::create([
                'ukupnaCena'=>$request->ukupnaCena,
                'datumVremePorudzbine'=>now(),
                'gost_id'=>$request->gost_id

            ]);

            return response()->json(['success'=>true,'porudzbina'=> new PorudzbinaResource($porudzbina)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Porudzbina  $porudzbina
     * @return \Illuminate\Http\Response
     */
    public function show(Porudzbina $porudzbina)
    {
        return new PorudzbinaResource($porudzbina);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Porudzbina  $porudzbina
     * @return \Illuminate\Http\Response
     */
    public function edit(Porudzbina $porudzbina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Porudzbina  $porudzbina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Porudzbina $porudzbina)
    {
        $validator = Validator::make($request->all() , [
            'konobar_id'=>'required',
            'radna_smena_id'=>'required',
            'saPopustom'=>'required|boolean',
            'popust'=>'required|numeric|min:0|max:100'
            
            
        ]);

        
        if ($validator->fails())
            return response()->json($validator->errors());

            $porudzbina->ukupnaCena=$porudzbina->ukupnaCena-$porudzbina->ukupnaCena*$request->popust;
            $porudzbina->konobar_id=$request->konobar_id;
            $porudzbina->radna_smena_id=$request->radna_smena_id;
            $porudzbina->placeno=true;
            $porudzbina->saPopustom=$request->saPopustom;
            $porudzbina->popust=$request->popust;
            $porudzbina->save();

            return response()->json(['success'=>true, 'id'=> $porudzbina->id,'porudzbina'=> new PorudzbinaResource($porudzbina) ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Porudzbina  $porudzbina
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $porudzbina_id)
    {
        $porudzbina=Porudzbina::find($porudzbina_id);
        if(is_null($porudzbina)){
            return response()->json('failed',404);
        }
        $porudzbina->delete();
        return response()->json(['success'=>true]);
    }
}
