<?php

namespace App\Traits\Tenongan;

trait HasLog
{
    protected $last_log;


    public function createLog(array $attribute=[])
    {
        $this->last_log = $this->log()->create($attribute);
        return $this;
    }

    public function getLastLog()
    {
        return $this->last_log;
    }
}
