<?php
namespace GDO\ApiHub;

use GDO\Form\MethodForm;

abstract class MethodAPI extends MethodForm
{

    protected abstract function getAPIName(): string;

    protected function getAPIHeaders(): array
    {
        $key = Module_ApiHub::instance()->cfgApiKey();
        return [
            "X-RapidAPI-Host: g-search.p.rapidapi.com",
            "X-RapidAPI-Key: {$key}",
        ];
    }

}
