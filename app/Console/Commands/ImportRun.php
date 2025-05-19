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
                            {type? : Type of import}';

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
        $start = microtime(true);

        if (!$importingEntityType = ImportingEntityType::tryFrom($this->argument('type'))) {
            throw new \Exception('Передан неверный тип импортируемой сущности');
        }

        $command = new ImportCommand($importingEntityType);

        $handler->handle($command);

        $this->output->writeln(sprintf('Импорт завершен за %f секунд', microtime(true) - $start));
    }
}
