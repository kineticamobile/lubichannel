<?php

namespace Kineticamobile\Ubicual;

class UbicualConfig
{
    /**
     * @var UbicualConfig
     */
    public $config;

    /**
     * UbicualConfig constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->config['from'];
    }

}
