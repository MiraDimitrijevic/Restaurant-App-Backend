<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VrstaStavkeMenijaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='vrstaStavkeMenija';

    public function toArray($request)
    {
        return [
            'id'=>$this->resource->id,
            'naziv'=>$this->resource->naziv,
            'sadrziAlkohol'=>$this->resource->sadrziAlkohol
        ];
    }
}
