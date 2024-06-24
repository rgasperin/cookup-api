<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'receita' => $this->name,
            'ingredientes' => $this->ingredients_default,
            'modo_preparo' => $this->mode_preparation,
            'tipo' => $this->types->name,
            'ingredientesBase' => $this->ingredients->map(function ($ingredient) {
                $date = Carbon::parse($ingredient->date);
                $validityDate = $date->addDays(30);
                
                return [
                    'name' => $ingredient->name,
                    'data de validade' => $validityDate->format('d/m/Y'),
                ];
            }),
        ];
    }
}
