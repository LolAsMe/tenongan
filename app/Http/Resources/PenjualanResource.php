<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Tenongan;

class PenjualanResource extends JsonResource
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
            'titip' => $this->titip,
            'laku' => $this->laku,
            'harga_jual' => Tenongan::toCurrency($this->harga_jual),
            'harga_beli' =>  Tenongan::toCurrency($this->harga_beli),
            'tanggal' => $this->tanggal,
            'status' => $this->status,
            'keterangan' => $this->keterangan,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'produk' => new ProdukResource($this->whenLoaded('produk')),
            'pedagang' => new PedagangResource($this->whenLoaded('pedagang'))
        ];
    }
}
