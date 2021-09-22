<?php

namespace App\Traits\Tenongan;

trait HasLog
{
    protected $last_log;


    public function createLog()
    {
        $this->last_log = $this->log()->create();
        return $this;
    }

    public function getLastLog()
    {
        return $this->last_log;
    }
}
