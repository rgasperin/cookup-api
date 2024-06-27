<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = $this->apiService->getIngredients();

        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'date' => 'required',
        ]);

        $data = $request->only(['name', 'date']);

        $response = $this->apiService->storeIngredients($data);

        if ($response) {
            return redirect('ingredientes');
        } else {
            return redirect('ingredientes');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = $this->apiService->IngredientsById($id);

        if (isset($response['data'])) {
            $ingredient = $response['data'];

            return view('ingredients.edit', compact('ingredient'));
        } else {
            return view('recipes.edit')->with('error', 'Receita não encontrada.');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:45',
            'date' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'date' => $request->date,
        ];

        $response = $this->apiService->updateIngredients($id, $data);

        if ($response['status'] == 200) {
            return redirect('ingredientes')->with('success', 'Ingrediente atualizado com sucesso!');
        } else {
            return redirect('ingredientes')->with('error', 'Erro ao atualizar o ingrediente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->apiService->deleteIngredients($id);

        return redirect('ingredientes')->with('success', 'Receita atualizada com sucesso!');
    }
}
