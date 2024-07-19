<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://cookup-api.com/',
            'timeout' => 2.0,
        ]);
    }

    // --------------------------------------- Recipes ---------------------------------------

    public function getRecipes()
    {
        try {
            $response = $this->client->request('GET', '/api/receitas');

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function RecipeById($id)
    {
        try {
            $response = $this->client->request('GET', "/api/receitas/{$id}");

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function storeRecipes($data)
    {
        try {
            $response = $this->client->post('/api/receitas', [
                'json' => $data,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function updateRecipes($id, $data)
    {
        try {
            $response = $this->client->request('PUT', "/api/receitas/{$id}", [
                'json' => $data,
            ]);

            return [
                'status' => $response->getStatusCode(),
                'data' => json_decode($response->getBody()->getContents(), true),
            ];

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function deleteRecipes($id)
    {
        try {
            $response = $this->client->request('DELETE', "/api/receitas/{$id}");

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    // --------------------------------------- Ingredients ---------------------------------------

    public function getIngredients()
    {
        try {
            $response = $this->client->request('GET', '/api/ingredientes');

            if ($response->getStatusCode() == 200) {
                $responseData = json_decode($response->getBody()->getContents(), true);
                return $responseData['data'] ?? [];
            }

            return null;
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function IngredientsById($id)
    {
        try {
            $response = $this->client->request('GET', "/api/ingredientes/{$id}");

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function storeIngredients($data)
    {
        try {
            $response = $this->client->post('/api/ingredientes', [
                'json' => $data,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function updateIngredients($id, $data)
    {
        try {
            $response = $this->client->request('PUT', "/api/ingredientes/{$id}", [
                'json' => $data,
            ]);

            return [
                'status' => $response->getStatusCode(),
                'data' => json_decode($response->getBody()->getContents(), true),
            ];

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function deleteIngredients($id)
    {
        try {
            $response = $this->client->request('DELETE', "/api/ingredientes/{$id}");

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    // --------------------------------------- Others ---------------------------------------

    public function getRecipeTypes()
    {
        try {
            $response = $this->client->request('GET', '/api/tipos');

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                return $data['data'] ?? [];
            }

            return null;

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function RecipeTypesById($id)
    {
        try {
            $response = $this->client->request('GET', "/api/tipos/{$id}");

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function storeRecipeTypes($data)
    {
        try {
            $response = $this->client->post('/api/tipos', [
                'json' => $data,
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function updateRecipeTypes($id, $data)
    {
        try {
            $response = $this->client->request('PUT', "/api/tipos/{$id}", [
                'json' => $data,
            ]);

            return [
                'status' => $response->getStatusCode(),
                'data' => json_decode($response->getBody()->getContents(), true),
            ];

        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function deleteRecipeTypes($id)
    {
        try {
            $response = $this->client->request('DELETE', "/api/tipos/{$id}");

            if ($response->getStatusCode() == 200) {
                return true;
            }

            return false;
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function getFindByIngredients(array $ingredients)
    {
        try {
            $response = $this->client->request('POST', '/api/receitas/buscar-ingredientes', [
                'json' => ['ingredients' => $ingredients],
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            }

            return null;
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'data' => $e->getMessage(),
            ];
        }
    }
}
