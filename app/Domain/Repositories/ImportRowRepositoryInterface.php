<?php
declare(strict_types=1);

namespace App\Domain\Repositories;

use Illuminate\Support\Collection;

interface ImportRowRepositoryInterface
{
    public function saveMany(Collection $importRows): bool;
}
