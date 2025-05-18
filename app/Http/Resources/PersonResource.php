<?php
declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string)$this->resource->getId(),
            'first_name' => (string)$this->resource->getFirstName(),
            'last_name' => (string)$this->resource->getLastName(),
            'date' => (string)$this->resource->getDate(),
        ];
    }
}
