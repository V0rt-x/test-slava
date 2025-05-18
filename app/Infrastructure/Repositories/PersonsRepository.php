<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Person;
use App\Domain\Repositories\PersonsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PersonsRepository implements PersonsRepositoryInterface
{
    private static string $table = 'persons';

    /**
     * @inheritDoc
     */
    public function saveMany(array $persons): void
    {
        DB::table(self::$table)->insertOrIgnore(array_map(fn (Person $person) => [
            'id' => $person->getId(),
            'first_name' => $person->getFirstName(),
            'last_name' => $person->getLastName(),
            'date' => $person->getDate()->format('Y-m-d'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ], $persons));
    }
}
