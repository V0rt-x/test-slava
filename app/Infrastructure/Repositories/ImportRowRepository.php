<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Models\ValueObjects\ImportRow;
use App\Domain\Repositories\ImportRowRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ImportRowRepository implements ImportRowRepositoryInterface
{
    private static string $table = 'import_rows';

    public function saveMany(Collection $importRows): bool
    {
        return DB::table(self::$table)->insert($importRows->map(fn (ImportRow $importRow) => [
            'data' => $importRow->jsonValue(),
            'type' => $importRow->type,
        ])->toArray());
    }
}
