<?php

use Symfony\Component\Console\Application;
use ZnLib\Db\Capsule\Manager;
use ZnLib\Fixture\Domain\Repositories\DbRepository;
use ZnLib\Fixture\Domain\Repositories\FileRepository;
use ZnLib\Fixture\Domain\Services\FixtureService;
use Illuminate\Container\Container;
use ZnLib\Console\Symfony4\Helpers\CommandHelper;

/**
 * @var Application $application
 * @var Container $container
 */

$capsule = $container->get(Manager::class);

$container->bind(FileRepository::class, function () {
    return new FileRepository($_ENV['ELOQUENT_CONFIG_FILE']);
});

CommandHelper::registerFromNamespaceList([
    'ZnLib\Fixture\Commands'
], $container);
