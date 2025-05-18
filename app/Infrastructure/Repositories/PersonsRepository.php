<?php
declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Person;
use App\Domain\Models\ValueObjects\DateTime;
use App\Domain\Models\ValueObjects\Id;
use App\Domain\Models\ValueObjects\Name;
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

    /**
     * @param DateTime $dateFrom
     * @param DateTime $dateTo
     * @return Person[]
     */
    public function listBetweenDates(DateTime $dateFrom, DateTime $dateTo): array
    {
        return DB::table(self::$table)
            ->whereBetween('date', [$dateFrom->format('Y-m-d'), $dateTo->format('Y-m-d')])
//            ->orderBy('date')
            ->get()
            ->map(fn ($row) => new Person(
                new Id($row->id),
                new Name($row->first_name),
                new Name($row->last_name),
                DateTime::fromFormat('Y-m-d', $row->date),
            ))
            ->toArray();
    }
}
