<?php
declare(strict_types=1);

namespace App\Console\Commands;

use App\Application\Commands\ImportCommand;
use App\Application\Handlers\ImportHandler;
use App\Domain\Enums\ImportingEntityType;
use Illuminate\Console\Command;

class ImportRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:run
                            {type? : The name of the queue connection to work}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run import';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle(ImportHandler $handler): void
    {
        if (!$importingEntityType = ImportingEntityType::tryFrom($this->argument('type'))) {
            throw new \Exception('Передан неверный тип импортируемой сущности');
        }

        $command = new ImportCommand($importingEntityType);

        $handler->handle($command);
    }
}
