<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Tenongan;

class SaldoResource extends JsonResource
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
            'jumlah' => Tenongan::toCurrency($this->jumlah),
            'tipe' => $this->tipe,
            'owner' => new PedagangResource($this->whenLoaded('owner')),
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
