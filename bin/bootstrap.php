<?php

use Illuminate\Container\Container;
use Symfony\Component\Console\Application;
use ZnLib\Console\Symfony4\Helpers\CommandHelper;
use ZnLib\Db\Capsule\Manager;
use ZnLib\Fixture\Domain\Repositories\FileRepository;
use Psr\Container\ContainerInterface;
use ZnCore\Domain\Libs\EntityManager;
use ZnCore\Domain\Interfaces\Libs\EntityManagerInterface;

/**
 * @var Application $application
 * @var Container $container
 */

$capsule = $container->get(Manager::class);

$em = new EntityManager($container);
$container->bind(EntityManagerInterface::class, function (ContainerInterface $container) use ($em) {
    return $em;
});
$container->bind(ContainerInterface::class, function (ContainerInterface $container) {
    return $container;
});
$container->bind(FileRepository::class, function () {
    return new FileRepository($_ENV['ELOQUENT_CONFIG_FILE']);
});

CommandHelper::registerFromNamespaceList([
    'ZnLib\Fixture\Commands'
], $container);
