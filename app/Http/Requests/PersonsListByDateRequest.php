<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class PersonsListByDateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date_from' => 'date_format:d.m.Y',
            'date_to' => 'date_format:d.m.Y',
        ];
    }

    /**
     * @return array{\DateTime, \DateTime}
     */
    public function datesAsDateTime(): array
    {
        $dateFrom = $this->validated('date_from');
        $dateTo = $this->validated('date_to');

        if (!empty($dateFrom) && empty($dateTo)) {
            $dateTo = Carbon::createFromFormat('d.m.Y', $dateFrom)->addMonths(6);
            $dateFrom = Carbon::createFromFormat('d.m.Y', $dateFrom);
        } elseif (empty($dateFrom) && !empty($dateTo)) {
            $dateFrom = Carbon::createFromFormat('d.m.Y', $dateTo)->subMonths(6);
            $dateTo = Carbon::createFromFormat('d.m.Y', $dateTo);
        } elseif (empty($dateFrom) && empty($dateTo)) {
            $dateTo = Carbon::createFromTimestamp(0);
            $dateFrom = Carbon::createFromTimestamp(0)->addMonths(6);
        } else {
            $dateTo = Carbon::createFromFormat('d.m.Y', $dateTo);
            $dateFrom = Carbon::createFromFormat('d.m.Y', $dateFrom);
        }

        return [$dateFrom, $dateTo];
    }
}
