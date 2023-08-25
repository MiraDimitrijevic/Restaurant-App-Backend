<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KonobarResource;
use App\Http\Resources\GostResource;
use App\Http\Resources\RadnaSmenaResource;


class PorudzbinaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='porudzbina';

    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'ukupnaCena'=>$this->resource->ukupnaCena,
            'placeno'=>$this->resource->placeno,
            'saPopustom'=>$this->resource->saPopustom,
            'popust'=>$this->resource->popust,
            'datumVremePorudzbine'=>$this->resource->datumVremePorudzbine,
            'gost'=>new GostResource($this->resource->gost),
            'konobar'=>new KonobarResource($this->resource->konobar),
            'radnaSmena'=>new RadnaSmenaResource($this->resource->radnaSmena),


        ];

    }
}
