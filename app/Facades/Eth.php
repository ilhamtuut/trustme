<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Eth extends Facade{
    protected static function getFacadeAccessor() { return 'eth'; }
}