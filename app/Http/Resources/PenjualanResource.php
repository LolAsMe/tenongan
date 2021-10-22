<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
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
            'harga_jual' => $this->harga_jual,
            'harga_beli' =>  $this->harga_beli,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
            'keterangan' => $this->keterangan,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'produk' => !($this->whenLoaded('produk') instanceof MissingValue) ? $this->whenLoaded('produk')->nama ?? '' : new MissingValue,
            'pedagang' => !($this->whenLoaded('pedagang') instanceof MissingValue) ? $this->whenLoaded('pedagang')->nama??'' : new MissingValue
        ];
    }
}
