<h1 align="center"> CookUp API </h1>

<p align="center">Esta é uma API que fornece receitas aos usuários, com os dados armazenados no Laravel, onde a aplicação está implantada.</p>

<h2> 📦 INSTALANDO DEPENDECIAS </h2>

<p>Eu utilizei o Laragon como ambiente de desenvolvimente e recomendo utilizar este mas fique a vontade para utilizar qualquer outro.</p>
<p>Link para download: https://laragon.org/download/</p>

## Clone o Repositorio

```bash
git clone https://github.com/rgasperin/cookup-api.git
```

## Instale as dependencias do composer

```bash
composer install
```

## Configure o .env

```bash
  APP_DEBUG=false
  APP_URL=http://cookup-api.com/

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=cookup_db
  DB_USERNAME=root
  DB_PASSWORD=
```

## Gere a chave do laravel

```bash
  php artisan key:generate
```

## Configurando o banco de dados

<p>Acesse o diretorio ".../cookup-api/database/" dentro tem um arquivo chamado cookup_db em formato MySQL, utilize o MySQL Workbench para abri-lo, depois de aberto apenas exporte ele seguindo este passo:</p>

```bash 
  File/Export/Forward Engineer SQL Create (apenas de "next" até chegar em COPY TO Clickboard)
``` 
<p>Com o SQL copiado vá no seu banco de dados e cole ele lá em "Consulta" (Se estiver utilizando o HeidiSQL)</p>

E está pronto, apenas rode o projeto.

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
