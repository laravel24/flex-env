<?php

namespace Sven\FlexEnv;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

class FlexEnvManager extends AbstractManager
{
    /**
     * @var FlexEnvFactory
     */
    private $factory;

    /**
     * FlexEnvManager constructor.
     *
     * @param Repository $config
     * @param FlexEnvFactory $factory
     */
    public function __construct(Repository $config, FlexEnvFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfigName()
    {
        return 'flexenv';
    }
}
