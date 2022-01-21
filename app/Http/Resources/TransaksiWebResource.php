<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\MissingValue;
use Tenongan;

class TransaksiWebResource extends ResourceCollection
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
            'tanggal' => $this->tanggal,
            'tipe' => $this->tipe,
            'owner' => !($this->whenLoaded('owner') instanceof MissingValue) ? $this->whenLoaded('owner')->nama : new MissingValue,
            'jumlah' => Tenongan::toCurrency($this->jumlah),
            'status' => $this->status,
            'kemarin' => $this->kemarin,
            'pembulatan' => $this->pembulatan,
            'penjualan' => PenjualanResource::collection($this->whenLoaded('penjualan')),
            'detail' => DetailTransaksiResource::collection($this->whenLoaded('detail')),
            // 'kas' => !($this->whenLoaded('kas') instanceof MissingValue) ? $this->whenLoaded('kas')->jumlah : new MissingValue,
            'kas' => $this->kas ? $this->kas->jumlah : 0,
            'tess' => 0,
            'keterangan' => $this->keterangan,
        ];
    }
}
