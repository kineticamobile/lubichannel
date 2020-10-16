<?php

namespace Kineticamobile\Ubicual\Test;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Kineticamobile\Ubicual\UbicualServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use MockeryPHPUnitIntegration;

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            UbicualServiceProvider::class,
        ];
    }
}
