<?php

namespace ZnLib\Fixture\Domain\Traits;

use ZnCore\Base\Libs\Store\StoreFile;

trait ConfigTrait
{

    protected $config;

    public function loadConfig($mainConfigFile = null)
    {
        if ($mainConfigFile == null) {
            $mainConfigFile = $_ENV['ELOQUENT_CONFIG_FILE'];
        }
        $store = new StoreFile(__DIR__ . '/../../../../../../' . $mainConfigFile);
        $config = $store->load();
        return $config;
    }

}