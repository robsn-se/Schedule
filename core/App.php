<?php

namespace core;

class App {

    private array $config;


    public function __construct()
    {
        $this->config = include "config.php";
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config): void
    {
        $this->config = $config;
    }


}