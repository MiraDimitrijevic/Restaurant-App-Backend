<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KonobarResource;


class RadnaSmenaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap='radnaSmena';

    public function toArray($request)
    {
        return[
            'smena'=>$this->resource->smena,
            'datum'=>$this->resource->datum,
            'napomena'=>$this->resource->napomena,
            'ukupanPromet'=>$this->resource->ukupanPromet,
            'konobar'=> new KonobarResource($this->resource->konobar)

        ];
    }
}
