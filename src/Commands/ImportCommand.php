<?php

namespace ZnLib\Fixture\Commands;

use Illuminate\Database\Eloquent\Collection;
use ZnLib\Console\Symfony4\Widgets\LogWidget;
use ZnCore\Domain\Helpers\EntityHelper;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;
use ZnLib\Fixture\Domain\Entities\FixtureEntity;
use ZnLib\Console\Symfony4\Question\ChoiceQuestion;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends BaseCommand
{
    protected static $defaultName = 'db:fixture:import';

    protected function configure()
    {
        parent::configure();
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Import fixture data to DB')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('...');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Fixture IMPORT</>');

        /** @var FixtureEntity[]|Collection $tableCollection */
        $tableCollection = $this->fixtureService->allFixtures();
        $tableArray = EntityHelper::getColumn($tableCollection, 'name');

        $withConfirm = $input->getOption('withConfirm');
        if ($withConfirm) {
            $output->writeln('');
            $question = new ChoiceQuestion(
                'Select tables for import',
                $tableArray,
                'a'
            );
            $question->setMultiselect(true);
            $selectedTables = $this->getHelper('question')->ask($input, $output, $question);
        } else {
            $selectedTables = $tableArray;
        }

        $output->writeln('');

        $logWidget = new LogWidget($output);

        $this->fixtureService->importAll($selectedTables, function ($tableName) use($logWidget) {
            $logWidget->start(' ' . $tableName);
        }, function ($tableName) use($logWidget) {
            $logWidget->finishSuccess();
        });

        $output->writeln(['', '<fg=green>Fixture IMPORT success!</>', '']);
        return 0;
    }

}
