<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RecipeResource::collection(Recipe::with('ingredients')->with('type')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'ingredients_default' => 'required|string',
            'mode_preparation' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredients,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $recipe = Recipe::create($request->only(['name', 'type_id', 'ingredients_default', 'mode_preparation']));
        $recipe->ingredients()->attach($request->ingredients);

        return response()->json($recipe->load('ingredients'), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new RecipeResource(Recipe::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'ingredients_default' => 'required|string',
            'mode_preparation' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredients,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $recipe = Recipe::findOrFail($id);
        $recipe->update([
            'name' => $request->name,
            'type_id' => $request->type_id,
            'ingredients_default' => $request->ingredients_default,
            'mode_preparation' => $request->mode_preparation,
        ]);

        $recipe->ingredients()->sync($request->ingredients);

        return response()->json($recipe->load('ingredients'), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return response()->json(['message' => 'Receita deletada com sucesso!'], 200);
    }

    public function findByIngredients(Request $request)
    {
        $request->validate([
            'ingredients' => 'required|array',
            'ingredients.*' => 'exists:ingredients,id',
        ]);

        $ingredients = $request->ingredients;

        $recipes = Recipe::with('ingredients')->get()->filter(function ($recipe) use ($ingredients) {
            $recipeIngredients = $recipe->ingredients->pluck('id')->toArray();
            $matchCount = count(array_intersect($recipeIngredients, $ingredients));
            $totalIngredients = count($recipeIngredients);

            if ($matchCount == $totalIngredients || ($totalIngredients - $matchCount <= 1)) {
                $recipe->compatibility = 100;
            } else {
                $recipe->compatibility = ($matchCount / $totalIngredients) * 100;
            }

            return $matchCount > 0;
        });

        $sortedRecipes = $recipes->sortByDesc('compatibility')->values();

        if ($sortedRecipes->isEmpty()) {
            return response()->json(['message' => 'Nenhuma receita encontrada com os ingredientes fornecidos.'], 404);
        }

        return response()->json($sortedRecipes, 200);
    }
}
