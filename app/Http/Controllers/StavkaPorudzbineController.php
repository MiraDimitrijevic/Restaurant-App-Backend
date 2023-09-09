<?php

namespace App\Http\Controllers;

use App\Models\StavkaPorudzbine;
use Illuminate\Http\Request;
use App\Http\Resources\StavkaPorudzbineResource;
use Illuminate\Support\Facades\Validator;
use App\Models\StavkaMenija;


class StavkaPorudzbineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['stavkePorudzbine'=> StavkaPorudzbineResource::collection(StavkaPorudzbine::get())];

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
            'kolicina'=>'required|numeric|min:0|max:1000',
            'porudzbina_id'=>'required',
            'stavka_menija_id'=>'required',
        ]);

        
        if ($validator->fails())
            return response()->json($validator->errors());

            $stavkaMenija=StavkaMenija::find($request->stavka_menija_id);
          //  $iznos=$stavkaMenija->cena*$request->kolicina;

            $stavka=StavkaPorudzbine::create([
                'kolicina'=>$request->kolicina,
                'porudzbina_id'=>$request->porudzbina_id,
                'stavka_menija_id'=>$request->stavka_menija_id,
              //  'iznos'=>$iznos
                
            ]);
            return response()->json(['success'=>true,'stavkaPorudzbine'=> new StavkaPorudzbineResource($stavka)]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StavkaPorudzbine  $stavkaPorudzbine
     * @return \Illuminate\Http\Response
     */
    public function show(StavkaPorudzbine $stavkaPorudzbine)
    {
        return new StavkaPorudzbineResource($stavkaPorudzbine);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StavkaPorudzbine  $stavkaPorudzbine
     * @return \Illuminate\Http\Response
     */
    public function edit(StavkaPorudzbine $stavkaPorudzbine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StavkaPorudzbine  $stavkaPorudzbine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StavkaPorudzbine $stavkaPorudzbine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StavkaPorudzbine  $stavkaPorudzbine
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $stavka_id)
    {
        $stavka=StavkaPorudzbine::find($stavka_id);
        if(is_null($stavka)){
            return response()->json('failed',404);
        }
        $stavka->delete();
        return response()->json(['success'=>true]);
    }
}
