<?php

namespace ZnLib\Fixture\Domain\Traits;

use ZnCore\Base\Helpers\LoadHelper;
use ZnCore\Base\Libs\Store\StoreFile;

/**
 * Trait ConfigTrait
 * @package ZnLib\Fixture\Domain\Traits
 * @deprecated
 * @see LoadHelper::loadConfig()
 */
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