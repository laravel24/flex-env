<?php

namespace Sven\FlexEnv;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

class FlexEnvServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setCommands();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerConnection();
    }

    /**
     * Bind all commands to the service container.
     *
     * @return void
     */
    private function setCommands()
    {
        $this->app['env:set'] = $this->app->share(function () {
            return new Commands\SetEnv();
        });

        $this->app['env:get'] = $this->app->share(function () {
            return new Commands\GetEnv();
        });

        $this->app['env:delete'] = $this->app->share(function () {
            return new Commands\DeleteEnv();
        });

        $this->app['env:list'] = $this->app->share(function () {
            return new Commands\ListEnv();
        });

        $this->commands(
            'env:set',
            'env:get',
            'env:delete',
            'env:list'
        );
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    private function registerFactory()
    {
        $this->app->singleton('flexenv.factory', function () {
            return new FlexEnvFactory();
        });

        $this->app->alias('flexenv.factory', FlexEnvFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    private function registerManager()
    {
        $this->app->singleton('flexenv', function (Container $app) {
            $config = $app['config'];
            $factory = $app['flexenv.factory'];

            return new FlexEnvManager($config, $factory);
        });

        $this->app->alias('flexenv', FlexEnvManager::class);
    }

    /**
     * Register the connection.
     *
     * @return void
     */
    private function registerConnection()
    {
        $this->app->bind('flexenv.connection', function (Container $app) {
            $manager = $app['flexenv'];

            return $manager->connection();
        });

        $this->app->alias('flexenv.connection', FlexEnv::class);
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [
            'flexenv.factory',
            'flexenv',
            'flexenv.connection',
        ];
    }
}
