<?php

namespace App\Http\Controllers;

use App\Models\Porudzbina;
use App\Models\StavkaMenija;
use App\Models\StavkaPorudzbine;
use App\Models\Gost;
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
         $ukupnaCena=0;
         $saPopustom=false;
         $popust=0;
         foreach($request->stavke as $stavka ){
        $validator = Validator::make($stavka , [
            'kolicina'=>'required|numeric|min:0|max:1000',
            'stavka_menija_id'=>'required',
        ]);
           if ($validator->fails())
            return response()->json($validator->errors());
            $stavkaMenija=StavkaMenija::find($stavka["stavka_menija_id"]);
            $iznos=$stavkaMenija->cena*$stavka["kolicina"];
            $stavka["iznos"]=$iznos;
            $ukupnaCena+=$stavka["iznos"];
         }

        $validator = Validator::make($request->all() , [
            'gost_id'=>'required'
        ]);
$gost=Gost::find($request->gost_id);
if($gost->imaPopust==true){
    $ukupnaCena*=0.8;
    $saPopustom=true;
    $popust=20;
}
 if ($validator->fails())
            return response()->json($validator->errors());


            $porudzbina=Porudzbina::create([
                'ukupnaCena'=>$ukupnaCena,
                'datumVremePorudzbine'=>now(),
                'gost_id'=>$request->gost_id,
                'saPopustom'=>$saPopustom,
                $popust=>$popust

            ]);

            foreach($request->stavke as $stavka){

                StavkaPorudzbine::create([
                    'kolicina'=>$stavka["kolicina"],
                    'porudzbina_id'=>$porudzbina->id,
                    'stavka_menija_id'=>$stavka["stavka_menija_id"],
                    'iznos'=>$stavka["iznos"],
                    
                    
                ]);
            }

            return response()->json(['success'=>true,'porudzbina_id'=>$porudzbina->id]);

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
           // 'radna_smena_id'=>'required',
            
        ]);
  if ($validator->fails())
            return response()->json($validator->errors());
        if($porudzbina->ukupnaCena>$request->iznos){
            $gost=Gost::find($porudzbina->gost_id);
            $gost->zaduzenje=$porudzbina->ukupnaCena-$request->iznos;
            $gost->save();
        }
            $porudzbina->konobar_id=$request->konobar_id;
           // $porudzbina->radna_smena_id=$request->radna_smena_id;
            $porudzbina->placeno=true;
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
