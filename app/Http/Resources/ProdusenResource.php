<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Tenongan;

class ProdusenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // dd($this->whenLoaded('saldo')->jumlah);
        return [
            'id'=>$this->id,
            'nama'=>$this->nama,
            'deleted_at'=>$this->deleted_at,
            'updated_at'=>$this->updated_at,
            'created_at'=>$this->created_at,
            'saldo'=>!($this->whenLoaded('saldo') instanceof MissingValue) ? Tenongan::toCurrency($this->whenLoaded('saldo')->jumlah) : new MissingValue,
            'produk'=>!($this->whenLoaded('produk') instanceof MissingValue) ? $this->whenLoaded('produk')->pluck('nama') : new MissingValue,
        ];
    }
}
