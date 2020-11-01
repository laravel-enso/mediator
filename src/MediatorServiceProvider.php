<?php

namespace LaravelEnso\Mediator;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Mediator\Contracts\ClientServiceProvider;
use LaravelEnso\Mediator\Contracts\MediatorServiceProvider as Contract;
use LaravelEnso\Mediator\Exceptions\Mediator;
use ReflectionClass;

abstract class MediatorServiceProvider extends ServiceProvider implements ClientServiceProvider
{
    private static array $providers = [];

    protected ?string $provider = null;

    protected bool $optional = true;

    public static function add(Contract $provider, $name = null)
    {
        static::$providers[$name ?? self::className($provider)] = $provider;
    }

    public function boot()
    {
        $provider = static::$providers[$this->provider ?? self::className($this)] ?? null;

        throw_if(
            $provider && ! $this->optional,
            Mediator::providerNotFound($this->provider ?? self::className($this))
        );

        optional($provider)->handle($this);
    }

    private static function className($provider): string
    {
        return (new ReflectionClass(get_class($provider)))->getShortName();
    }
}
