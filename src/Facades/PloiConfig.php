<?php

namespace Savelend\PloiDeployer\Facades;

use Illuminate\Support\Facades\Facade;

class PloiConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ploi-config';
    }
}