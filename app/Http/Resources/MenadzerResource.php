<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;


class MenadzerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='menadzer';

    public function toArray($request)
    {

        return [
            'id'=>$this->resource->id,
            'datumZaposlenja'=>$this->resource->datumZaposlenja,
            'plata'=>$this->resource->plata,
            'napomena'=>$this->resource->napomena,
            'naOdmoru'=>$this->resource->naOdmoru,
            'naBolovanju'=>$this->resource->naBolovanju,

            'licniPodaci'=>new UserResource($this->resource->user)

            
        ];
    }
}
