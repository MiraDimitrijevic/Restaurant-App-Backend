<?php

namespace App\Http\Controllers;

use App\Models\StavkaMenija;
use Illuminate\Http\Request;
use App\Http\Resources\StavkaMenijaResource;
use Illuminate\Support\Facades\Validator;


class StavkaMenijaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['stavkeMenija'=> StavkaMenijaResource::collection(StavkaMenija::get())];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'naziv'=> 'string|required|max:100',
            'cena'=>'required|min:0|max:5000',
            'jedinicaMere'=>'required|in:kg,g,ml,l',
            'vrstaStavkeMenija_id'=>'required' 
        ]);

        
        if ($validator->fails())
            return response()->json($validator->errors());

            $stavkaMenija=StavkaMenija::create([
             'naziv'=>$request->naziv,
             'cena'=>$request->cena,
             'opsirnije'=>$request->opsirnije,
             'napomene'=>$request->napomene,
             'jedinicaMere'=>$request->jedinicaMere,
             'vrstaStavkeMenija_id'=>$request->vrstaStavkeMenija_id
            ]);

            return response()->json(['success'=>true,'stavkaMenija'=> new StavkaMenijaResource($stavkaMenija)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StavkaMenija  $stavkaMenija
     * @return \Illuminate\Http\Response
     */
    public function show(StavkaMenija $stavkaMenija)
    {
        return new StavkaMenijaResource($stavkaMenija);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StavkaMenija  $stavkaMenija
     * @return \Illuminate\Http\Response
     */
    public function edit(StavkaMenija $stavkaMenija)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StavkaMenija  $stavkaMenija
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StavkaMenija $stavkaMenija)
    {
        
        $validator = Validator::make($request->all() , [
            'naziv'=> 'string|required|max:100',
            'cena'=>'required|min:0|max:5000',
            'jedinicaMere'=>'required|in:kg,g,ml,l'
        ]);

        
        if ($validator->fails())
            return response()->json($validator->errors());

            $stavkaMenija->naziv=$request->naziv;
            $stavkaMenija->cena=$request->cena; 
            $stavkaMenija->opsirnije=$request->opsirnije;
            $stavkaMenija->napomene=$request->napomene;
            $stavkaMenija->jedinicaMere=$request->jedinicaMere;
            $stavkaMenija->save();


            return response()->json(['success'=>true, 'id'=> $stavkaMenija->id,'stavkaMenija'=> new StavkaMenijaResource($stavkaMenija) ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StavkaMenija  $stavkaMenija
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $stavkaMenija_id)
    {
        $stavkaMenija=StavkaMenija::find($stavkaMenija_id);
        if(is_null($stavkaMenija)){
            return response()->json('failed',404);
        }
        $stavkaMenija->delete();
        return response()->json(['success'=>true]);

    }
}
