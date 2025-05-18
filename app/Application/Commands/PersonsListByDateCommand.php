<?php
declare(strict_types=1);

namespace App\Application\Commands;

use DateTime;

readonly class PersonsListByDateCommand
{
    public function __construct(
        public DateTime $dateFrom,
        public DateTime $dateTo
    )
    {

    }
}
