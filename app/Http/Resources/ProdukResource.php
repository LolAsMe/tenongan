<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Tenongan;

class ProdukResource extends JsonResource
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
            'nama'=>$this->nama,
            'harga_jual'=>Tenongan::toCurrency($this->harga_jual),
            'harga_beli'=>Tenongan::toCurrency($this->harga_beli),
            'produsen'=>!($this->whenLoaded('produsen') instanceof MissingValue) ? $this->whenLoaded('produsen')->nama : new MissingValue,
            'deleted_at'=>$this->deleted_at,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
