<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories;

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
            'path' => new FilePath($path),
            'importing_entity_type' => $file->importingEntityType,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return $id ? new ImportFile(
            id: $id,
            path: new FilePath($path),
            type: $file->importingEntityType
        ) : null;
    }
}
