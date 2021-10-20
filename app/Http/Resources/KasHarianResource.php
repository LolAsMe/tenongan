<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Tenongan;

class KasHarianResource extends JsonResource
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
            'id'=>$this->id,
            'tanggal'=>$this->tanggal,
            'tipe'=>$this->tipe,
            'payer'=>!($this->whenLoaded('payer') instanceof MissingValue) ? $this->whenLoaded('payer')->nama : new MissingValue,
            'jumlah'=>Tenongan::toCurrency($this->jumlah),
            'status'=>$this->status,
            'keterangan'=>$this->keterangan,
        ];
    }
}
