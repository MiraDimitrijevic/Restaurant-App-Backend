<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StavkaPorudzbine;
use App\Http\Resources\StavkaPorudzbineResource;


class PorudzbinaStavkeController extends Controller
{
    public function index($porudzbina_id) {
        $stavke=StavkaPorudzbine::get()->where('porudzbina_id', $porudzbina_id);
        if(is_null($stavke)) return response()->json("Porudzbina nema nijednu stavku",404);
        else return response()->json( ['stavke' => StavkaPorudzbineResource::collection(StavkaPorudzbine::get()->where('porudzbina_id', $porudzbina_id))]);
           }
}
