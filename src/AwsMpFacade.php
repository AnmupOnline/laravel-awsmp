<?php

namespace Anmup\LaravelAwsMp;

use Illuminate\Support\Facades\Facades;

class AwsMpFacade extends Facades 
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'awsmp';
    }
}