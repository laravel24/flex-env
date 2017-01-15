<?php

namespace Sven\Tests\FlexEnv;

use Sven\FlexEnv\FlexEnvServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return FlexEnvServiceProvider::class;
    }
}
