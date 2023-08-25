<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PorudzbinaResource;
use App\Http\Resources\StavkaMenijaResource;


class StavkaPorudzbineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='stavkaPorudzbine';

    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'kolicina'=>$this->resource->kolicina,
            'iznos'=>$this->resource->iznos,
            'porudzbina'=>new PorudzbinaResource($this->resource->porudzbina),
            'stavkaMenija'=>new StavkaMenijaResource($this->resource->stavkaMenija),
            

        ];
    }
}
