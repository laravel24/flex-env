<?php

namespace Sven\Tests\FlexEnv;

use Sven\FlexEnv\FlexEnv;
use Sven\FlexEnv\FlexEnvFactory;
use Sven\FlexEnv\FlexEnvManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    /** @test */
    public function flex_env_factory_is_injectable()
    {
        $this->assertIsInjectable(FlexEnvFactory::class);
    }

    /** @test */
    public function flex_env_manager_is_injectable()
    {
        $this->assertIsInjectable(FlexEnvManager::class);
    }

    /** @test */
    public function bindings_are_registered_correctly()
    {
        $this->assertIsInjectable(FlexEnv::class);

        $original = $this->app['flexenv.connection'];
        $this->app['flexenv']->reconnect();
        $new = $this->app['flexenv.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
