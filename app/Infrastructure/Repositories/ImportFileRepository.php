<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Enums\ImportingEntityType;
use App\Domain\Models\ImportFile;
use App\Domain\Models\ValueObjects\FilePath;
use App\Domain\Models\ValueObjects\UploadedImportFile;
use App\Domain\Repositories\ImportFileRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportFileRepository implements ImportFileRepositoryInterface
{
    private static string $tableName = 'imports';

    public function store(UploadedImportFile $file): ?ImportFile
    {
        $path = Storage::disk()->putFile($file->path->value);

        if (!$path) {
            return null;
        }

        $id = DB::table(self::$tableName)->insertGetId([
            'path' => new FilePath(Storage::disk()->path($path)),
            'importing_entity_type' => $file->importingEntityType,
            'imported' => false,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return $id ? new ImportFile(
            id: $id,
            path: new FilePath($path),
            type: $file->importingEntityType,
            imported: false
        ) : null;
    }

    public function getOldest(ImportingEntityType $importingEntityType): ?ImportFile
    {
        $importFile = DB::table(self::$tableName)
            ->where('importing_entity_type', $importingEntityType)
            ->where('imported', false)
            ->orderByDesc('id')
            ->limit(1)
            ->first();

        if (!$importFile) {
            return null;
        }

        $importFile = (array)$importFile;
        return new ImportFile(
            id: $importFile['id'],
            path: new FilePath($importFile['path']),
            type: ImportingEntityType::tryFrom($importFile['importing_entity_type']),
            imported: $importFile['imported']
        );
    }

    public function checkAsImported(ImportFile $importFile): bool
    {
        $updatedCount = DB::table(self::$tableName)
            ->where('id', $importFile->getId())
            ->update([
                'imported' => true,
                'updated_at' => date("Y-m-d H:i:s"),
            ]);

        return $updatedCount === 1;
    }
}
