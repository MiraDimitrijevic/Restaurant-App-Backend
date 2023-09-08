<?php

namespace App\Http\Controllers;

use App\Models\RadnaSmena;
use Illuminate\Http\Request;
use App\Http\Resources\RadnaSmenaResource;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Porudzbina;
use App\Models\StavkaPorudzbine;


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
            'konobar_id'=>'required'

        ]);
            if ($validator->fails())
            return response()->json($validator->errors());

            $currentTime=Carbon::now()->setTimezone(1)->format('H:i:s');
            $currentDate=Carbon::now()->setTimezone(1)->format('d-m-Y');
            $tomorrowDate=Carbon::now()->setTimezone(1)->addDays(1)->format('d-m-Y');
            $yesterdayDate=Carbon::now()->setTimezone(1)->addDays(-1)->format('d-m-Y');
            $promenaSmeneTime=Carbon::createFromTime(16,0,0,1)->format('H:i:s');
            $pocetakPrveSmene=Carbon::createFromTime(8,0,0,1)->format('H:i:s');

            $smena='prva';
        if($currentTime>$promenaSmeneTime || $currentTime<$pocetakPrveSmene)
        $smena='druga';
        $ukupanPromet=0;
        $porudzbine=Porudzbina::all();
        if(count($porudzbine)==0)
        return response()->json(['success'=>false, 'message'=>'Radna smena nema nijednu porudzbinu!']);

       foreach($porudzbine as $porudzbina){
        $dVP=strtotime($porudzbina->datumVremePorudzbine);
        $day= date('d', $dVP);
        $month= date('m', $dVP);
        $year= date('Y', $dVP);
        $hour= date('H', $dVP);
        $minute= date('i', $dVP);
        $sec= date('s', $dVP);
        $datumPor=Carbon::createFromDate($year, $month, $day, 1)->format('d-m-Y');
        $vremePor=Carbon::createFromTime($hour, $minute, $sec, 1)->format('H:i:s');

        $smenaPor='prva';
        if($vremePor>$promenaSmeneTime || $vremePor<$pocetakPrveSmene)
        $smenaPor='druga';

        if(($datumPor==$currentDate && $smenaPor==$smena && $vremePor>$pocetakPrveSmene ) 
        || (($datumPor==$yesterdayDate || $datumPor==$currentDate) && $smenaPor=='druga' && $smena=='druga' && $currentTime<$pocetakPrveSmene)  ){
            $ukupanPromet+=$porudzbina->ukupnaCena;
            $stavke=StavkaPorudzbine::get()->where('porudzbina_id', $porudzbina->id);
            foreach($stavke as $stavka){
                  $stavka->delete();
            }
            $porudzbina->delete();
        }
       }


     $rsmena=RadnaSmena::create([
                'smena'=>$smena,
                'datum'=>now(),
                'konobar_id'=>$request->konobar_id,
                 'ukupanPromet'=>$ukupanPromet
            ]);

            return response()->json(['success'=>true,'promet'=>$rsmena->ukupanPromet, 'smena'=> new RadnaSmenaResource($rsmena)]);

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
       /* $validator = Validator::make($request->all() , [
            'ukupanPromet'=>'required|numeric|min:0|max:1000000',
            
        ]);
          
        if ($validator->fails())
            return response()->json($validator->errors());

            $radnaSmena->napomena=$request->napomena;
            $radnaSmena->ukupanPromet=$request->ukupanPromet;

            $radnaSmena->save();
            return response()->json(['success'=>true, 'id'=> $radnaSmena->id,'radnaSmena'=> new RadnaSmenaResource($radnaSmena) ]);

    */  }

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
