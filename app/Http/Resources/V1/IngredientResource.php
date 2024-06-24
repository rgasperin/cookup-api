<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IngredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $date = Carbon::parse($this->date);

        $validityDate = $date->addDays(30);

        return [
            'name' => $this->name,
            'data de validade' => $validityDate->format('Y-m-d'),
        ];
    }
}
