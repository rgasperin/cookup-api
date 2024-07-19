<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CookupController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $ingredients = $this->apiService->getIngredients();
        $response = $this->apiService->getRecipes();
        $recipes = $response['data'];

        foreach ($recipes as &$recipe) {
            $recipe['ingredientes'] = $this->limitString($recipe['ingredientes'], 50);
        }

        return view('index', compact('ingredients', 'recipes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response = $this->apiService->getRecipeTypes();
        $types = $response['data'] ?? [];

        $ingredients = $this->apiService->getIngredients();

        if (empty($types)) {
            return redirect('receitas')->with('error', 'Você precisa criar um tipo antes de criar uma receita.');
        }

        return view('recipes.create', compact('types', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|exists:types,id',
            'ingredients_default' => 'required|string',
            'mode_preparation' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*' => 'string',
        ]);

        $data = $request->only(['name', 'type_id', 'ingredients_default', 'mode_preparation', 'ingredients']);

        $response = $this->apiService->storeRecipes($data);

        if ($response) {
            return redirect('receitas');
        } else {
            return redirect('receitas');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $recipes = $this->apiService->RecipeByid($id);

            if (!$recipes) {
                abort(404, 'Receita não encontrada.');
            }

            return view('recipes.show', compact('recipes'));
        } catch (\Exception $e) {
            abort(500, 'Erro ao obter receitas. Por favor, tente novamente mais tarde.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = $this->apiService->RecipeByid($id);

        if (isset($response['data'])) {
            $recipe = $response['data'];
            $types = $this->apiService->getRecipeTypes();
            $ingredients = $this->apiService->getIngredients();

            return view('recipes.edit', compact('recipe', 'types', 'ingredients'));
        } else {
            return view('recipes.edit')->with('error', 'Receita não encontrada.');
        }
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
            'ingredient' => 'required|array',
            'ingredient.*' => 'exists:ingredients,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'type_id' => $request->type_id,
            'ingredients_default' => $request->ingredients_default,
            'mode_preparation' => $request->mode_preparation,
            'ingredients' => $request->ingredient,
        ];

        $response = $this->apiService->updateRecipes($id, $data);

        if ($response['status'] == 200) {
            return redirect('receitas')->with('success', 'Receita atualizada com sucesso!');
        } else {
            return redirect('receitas')->with('error', 'Falha ao atualizar a receita');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->apiService->deleteRecipes($id);

        return redirect('receitas')->with('success', 'Receita atualizada com sucesso!');
    }

    public function findByIngredients(Request $request)
    {
        try {
            $request->validate([
                'ingredientes' => 'required|string',
            ]);

            $ingredientes = explode(',', $request->input('ingredientes'));

            $recipes = $this->apiService->getFindByIngredients($ingredientes);
            // dd($recipes);
            return view('index', compact('recipes'));
        } catch (\Exception $e) {
            abort(500, 'Erro ao obter receitas. Por favor, tente novamente mais tarde.');
        }
    }

    private function limitString($string, $limit)
    {
        if (strlen($string) > $limit) {
            return substr($string, 0, $limit) . '...';
        }
        return $string;
    }
}
