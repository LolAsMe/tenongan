<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class RutinitasResource extends JsonResource
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
            'jumlah' => $this->jumlah,
            'keterangan' => $this->keterangan,
            'frekuensi' => $this->frekuensi,
            'sender'=>!($this->whenLoaded('sender') instanceof MissingValue) ? $this->whenLoaded('sender')->nama : new MissingValue,
            'receiver'=>!($this->whenLoaded('receiver') instanceof MissingValue) ? $this->whenLoaded('receiver')->nama : new MissingValue,
        ];
    }
}
