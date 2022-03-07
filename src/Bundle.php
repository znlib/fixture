<?php

namespace ZnLib\Fixture;

use ZnCore\Base\Libs\App\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function deps(): array
    {
        return [
            new \ZnDatabase\Fixture\Bundle(['all']),
        ];
    }

    /*public function console(): array
    {
        return [
            'ZnDatabase\Fixture\Commands',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }*/
}
