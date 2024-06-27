@extends('template.index')

@section('content')
<section class="padding-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <a class="d-flex text-decoration-none text-style" href="{{ url('receitas') }}">
                    <i class="fi fi-rr-angle-circle-left icon-style me-2"></i> Voltar
                </a>
            </div>
        </div>
        <div class="row">
            @foreach ($recipes as $recipe)
                <div class="col-lg-12 mt-3">
                    <h1 class="text-center">{{ $recipe['receita'] }}</h1> <hr>
                </div>
                <div class="col-lg-12 mt-3">
                    <h3>Tipo:</h3>
                    <ul class="list-group">
                        <li class="list-group-item">{{ $recipe['tipo'] }}</li>
                    </ul>
                </div>
                <div class="col-lg-12 mt-5">
                    <h3>Ingredientes:</h3>
                    <ul class="list-group">
                        <li class="list-group-item">{{ $recipe['ingredientes'] }}</li>
                    </ul>
                </div>
                <div class="col-lg-12 mt-5">
                    <h3>Modo de Preparo:</h3>
                    <textarea class="form-control textarea-height" disabled>{{ $recipe['modo_preparo'] }}</textarea>
                </div>
                <div class="col-lg-12 mt-5">
                    <h3>Ingredientes Comprados:</h3>
                    <ul>
                        @foreach ($recipe['ingredientesBase'] as $ingrediente)
                            <div class="card card-style mt-3">
                                <p class="text">{{ $ingrediente['name'] }}</p>
                                <span class="sub-text">Data de Validade: <b class="ms-2">{{ $ingrediente['data_de_validade'] }}</b></span>
                            </div>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
