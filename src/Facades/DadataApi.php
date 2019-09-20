<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */


namespace CodersStudio\DadataApi\Facades;

use Illuminate\Support\Facades\Facade;

class DadataApi extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'dadataapi';
    }
}
