<?php

namespace LaravelEnso\Mediator\Contracts;

interface MediatorServiceProvider
{
    public function handle(ClientServiceProvider $provider);
}
