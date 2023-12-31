<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;


class GostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='gost';
    public function toArray($request)
    {
        return[
            'id'=>$this->resource->id,
             'imaPopust'=>$this->resource->imaPopust,
             'zaduzenje'=>$this->resource->zaduzenje,
             'licniPodaci'=>new UserResource($this->resource->user)
        ];

    }
}
