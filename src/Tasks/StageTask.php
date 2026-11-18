<?php

namespace NSWDPC\Search\Typesense\Jobs;

use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use SilverStripe\Versioned\Versioned;

/**
 * Check stage task and output
 */
class StageTask extends BuildTask
{
    protected string $title = 'Check the current stage';

    protected static string $description = 'Checks and outputs the current stage';

    protected static string $commandName = "WaratahStageTask";

    #[\Override]
    public function getOptions(): array
    {
        return [];
    }

    /**
     * Run the import task
     * @inheritdoc
     */
    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        $stage = Versioned::get_stage();
        if (is_null($stage)) {
            $stage = "NULL";
        }

        $output->writeln(_t("nswds.CURRENT_STAGE_IS", "Current stage is '{stage}'", ['stage' => $stage]));
        return Command::SUCCESS;
    }

}
