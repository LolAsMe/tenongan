<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Tenongan;

class KasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'jumlah' => Tenongan::toCurrency($this->jumlah),
            'log' => LogKasResource::collection($this->whenLoaded('log')),
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
