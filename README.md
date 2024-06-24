<h1 align="center"> CookUp API </h1>

<p align="center">Esta é uma API que fornece receitas aos usuários, com os dados armazenados no Laravel, onde a aplicação está implantada.</p>

## 📦 URL BASE
```bash
http://cookup-api.com/api
```

## :paw_prints: Diferentes rotas
```bash
"/receitas" - retorna todos as receitas.
"/receitas/:id" - retorna a receita por id.
"/receitas/buscar-ingredientes"  - retorna as receitas por ingredientes.
"/ingredientes" - retorna todos os ingredientes.
"/ingredientes/:id" - retorna um ingrediente por id.
```

## :paw_prints: Tipos de receitas
```bash
"doce" - retorna apenas as receitas doces
"salgado"  - retorna apenas as receitas salgadas
"agridoce"  - retorna apenas as receitas agridoces
```
## :dart: Exemplo de resposta
```bash
  {
    "id": 1,
    "receita": "Pão com ovo",
    "ingredientes": "100 g de mussarela, 100 g de presunto, 1 tomate picado, 2 colheres (sopa) de creme de leite, 3 ovos",
    "modo_preparo": "Abra o pão em formato de canoa e reserve. Em uma frigideira, leve ao fogo o ovo, o queijo, o creme de leite, o tomate e misture como um omelete. Recheie o pão e cubra com catupiri.",
    "tipo": "Salgado",
    "ingredientesBase": [
      {
        "name": "Pão",
        "data de validade": "22/07/2024"
      },
      {
        "name": "Ovo",
        "data de validade": "22/07/2024"
      }
    ]
    "compatibility": "20"
  }
```

