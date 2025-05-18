<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Commands\PersonsListByDateCommand;
use App\Application\Handlers\PersonsListByDateHandler;
use App\Http\Requests\PersonsListByDateRequest;
use App\Http\Resources\PersonsByDateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonsController extends Controller
{
    public function listByDate(PersonsListByDateRequest $request, PersonsListByDateHandler $handler): JsonResource
    {
        [$dateFrom, $dateTo] = $request->datesAsDateTime();

        $command = new PersonsListByDateCommand($dateFrom, $dateTo);

        $personsByDate = $handler->handle($command);

        $result = [];
        foreach ($personsByDate as $date => $persons) {
            $result[] = [
                'date' => $date,
                'items' => $persons
            ];
        }

        return PersonsByDateResource::collection($result);
    }
}
