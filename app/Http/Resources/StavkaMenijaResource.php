<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\VrstaStavkeMenijaResource;


class StavkaMenijaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='stavkaMenija';

    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'naziv'=>$this->resource->naziv,
            'cena'=>$this->resource->cena,
            'opsirnije'=>$this->resource->opsirnije,
            'napomene'=>$this->resource->napomene,
            'jedinicaMere'=>$this->resource->jedinicaMere,
            'vrsta'=> new VrstaStavkeMenijaResource($this->resource->vrstaStavkeMenija)

        ];
    }
}
