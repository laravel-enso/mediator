<?php

namespace LaravelEnso\Mediator\Exceptions;

use LaravelEnso\Helpers\Exceptions\EnsoException;

class Mediator extends EnsoException
{
    public static function providerNotFound($provider)
    {
        return new static(__('Provider :provider Not Found', [
            'provider' => $provider
        ]));
    }
}
