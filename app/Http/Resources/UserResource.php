<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='user';

    public function toArray($request)
    {
        return  [
            'id'=>$this->resource->id,
            'ime'=>$this->resource->ime,
            'prezime'=>$this->resource->prezime,
            'godinaRodjenja'=>$this->resource->godinaRodjenja,
            'email'=>$this->resource->email,
            'korisnickoIme'=>$this->resource->korisnickoIme,
            'brojTelefona'=>$this->resource->brojTelefona,
            ];
    }
}
