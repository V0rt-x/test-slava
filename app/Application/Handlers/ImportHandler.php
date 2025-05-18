<?php
declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Commands\ImportCommand;
use App\Application\Loggers\ImportLoggerInterface;
use App\Domain\Models\ImportFile;
use App\Domain\Parsers\FileParserInterface;
use App\Domain\Repositories\ImportFileRepositoryInterface;
use App\Domain\Repositories\PersonsRepositoryInterface;
use App\Domain\Services\PersonImportService;

readonly class ImportHandler
{
    const IMPORTING_PERSONS_FLUSH_COUNT = 500;

    public function __construct(
        private ImportFileRepositoryInterface $importFileRepository,
        private PersonImportService           $personImportService,
        private FileParserInterface           $fileParser,
        private PersonsRepositoryInterface    $personsRepository,
        private ImportLoggerInterface         $importLogger
    )
    {

    }

    /**
     * @throws \Exception
     */
    public function handle(ImportCommand $command): void
    {
        $importFile = $this->importFileRepository->getOldest($command->importingEntityType);

        if (!$importFile) {
            throw new \Exception('Файл для импорта не найден');
        }

        $this->importFromFile($importFile);

        $this->importFileRepository->checkAsImported($importFile);
    }

    private function importFromFile(ImportFile $file): void
    {
        $persons = [];
        $rowCount = 1;

        $this->fileParser->readRows($file, function (array $row) use (&$persons, &$rowCount) {
            try {
                $rowCount += 1;
                $persons[] = $this->personImportService->rowToPerson($row);
            } catch (\InvalidArgumentException $e) {
                $this->importLogger->error('{row_number} - {error}', [
                    'row_number' => $rowCount,
                    'error' => $e->getMessage(),
                ]);
            }

            if (count($persons) === self::IMPORTING_PERSONS_FLUSH_COUNT) {
                $this->personsRepository->saveMany($persons);
                $persons = [];
            }
        });

        if (!empty($persons)) {
            $this->personsRepository->saveMany($persons);
        }
    }
}
