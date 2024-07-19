<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class TypesController extends Controller
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
        $response = $this->apiService->getRecipeTypes();
        $types = $response['data'];

        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $data = $request->only(['name']);

        $response = $this->apiService->storeRecipeTypes($data);

        if ($response) {
            return redirect('tipos')->with('error', 'Erro ao criar o tipo!');
        } else {
            return redirect('tipos')->with('success', 'Tipo criado com sucesso!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $response = $this->apiService->RecipeTypesById($id);

        if (isset($response['data'])) {
            $type = $response['data'];

            return view('types.edit', compact('type'));
        } else {
            return view('recipes.edit')->with('error', 'Tipo não encontrada.');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:45',
        ]);

        $data = [
            'name' => $request->name,
        ];

        $response = $this->apiService->updateRecipeTypes($id, $data);

        if ($response) {
            return redirect('tipos')->with('success', 'Tipo atualizado com sucesso!');
        } else {
            return redirect('tipos')->with('error', 'Erro ao atualizar o tipo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->apiService->deleteRecipeTypes($id);

        return redirect('tipos')->with('success', 'Tipo deletado com sucesso!');
    }
}
