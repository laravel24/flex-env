<?php

namespace Sven\FlexEnv;

class FlexEnvFactory
{
    /**
     * Make a new FlexEnv client.
     *
     * @param array $config
     *
     * @return \Sven\FlexEnv\FlexEnv
     */
    public function make(array $config)
    {
        $config = $this->parseConfig($config);

        return $this->getClient($config);
    }

    /**
     * Retrieve all relevant configuration data.
     *
     * @param array $config
     *
     * @return array
     */
    protected function parseConfig(array $config)
    {
        return [
            'location' => array_get($config, 'location', base_path('.env')),
            'quoted' => array_get($config, 'quoted', false),
        ];
    }

    /**
     * Get the FlexEnv client.
     *
     * @param array $config
     *
     * @return \Sven\FlexEnv\FlexEnv
     */
    protected function getClient(array $config)
    {
        return new FlexEnv($config['location'], $config['quoted']);
    }
}
