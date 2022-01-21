<?php
namespace App\Http\Helpers;

use App\Services\Tenongan\TenonganService;

class Helper {
    public static function numerize($value) {
        return TenonganService::numerize($value);
    }
}
