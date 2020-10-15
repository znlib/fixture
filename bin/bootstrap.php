<?php

use Symfony\Component\Console\Application;
use ZnLib\Db\Capsule\Manager;
use ZnLib\Fixture\Commands\ExportCommand;
use ZnLib\Fixture\Commands\ImportCommand;
use ZnLib\Fixture\Domain\Repositories\DbRepository;
use ZnLib\Fixture\Domain\Repositories\FileRepository;
use ZnLib\Fixture\Domain\Services\FixtureService;

/**
 * @var Application $application
 */

$capsule = \ZnLib\Db\Factories\ManagerFactory::createManagerFromEnv();

// --- Fixture ---

// создаем сервис "Фикстуры" с внедрением двух репозиториев
$fixtureService = new FixtureService(new DbRepository($capsule), new FileRepository($eloquentConfigFile));

// создаем и объявляем команду "Экспорт фикстур"
$exportCommand = new ExportCommand(ExportCommand::getDefaultName(), $fixtureService);
$application->add($exportCommand);

// создаем и объявляем команду "Импорт фикстур"
$importCommand = new ImportCommand(ImportCommand::getDefaultName(), $fixtureService);
$application->add($importCommand);
