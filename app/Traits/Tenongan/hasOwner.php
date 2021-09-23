<?php

namespace App\Traits\Tenongan;

use App\Models\Tenongan\Owner;

trait HasOwner
{

    protected $owner;



    public function getOwner()
    {
        return $this->owner;
    }
    public function createOwner()
    {
        $this->owner = $this->owner()->create();
        return $this;
    }

    public function owner()
    {
        return $this->morphTo();
    }

    public function getTipeAttribute()
    {
        $value =  substr($this->owner_type, strpos($this->owner_type, "n\\") + 2);
        return $value;
    }
}
