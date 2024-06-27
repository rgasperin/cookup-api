@extends('template.index')

@section('content')
<section class="padding-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Criar Nova Receita</h1> <hr>
                
                <form action="{{ url('receitas') }}" method="POST" >
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="margin-show">Nome da Receita</p>
                            <input class="form-control form-control-bg" type="text" name="name" id="name" placeholder="Nome da receita" required>
                        </div>
                        <div class="col-lg-6">
                            <p class="margin-show">Tipo</p>
                            <select class="form-select form-control-bg" name="type_id" id="type_id" required>
                                @foreach ($types as $type)
                                    <option value="{{ $type['id'] }}">{{ $type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <p class="margin-show">Ingredientes da Receita</p>
                            <input class="form-control form-control-bg" type="text" name="ingredients_default" id="ingredients_default" placeholder="Ingredientes da receita" required>
                        </div>
                        <div class="col-lg-6" id="ingredients-wrapper">
                            <p class="margin-show">Ingredientes Comprados</p>
                            <select class="form-select form-control-bg" name="ingredients[]" required>
                                <option>Selecione um ingrediente</option>
                                @foreach ($ingredients as $ingredient)
                                    <option value="{{ $ingredient['id'] }}">{{ $ingredient['name'] }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-secondary mt-2" type="button" onclick="addIngredient()">Adicionar Ingredientes</button>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <p class="margin-show">Modo de Preparo</p>
                            <textarea class="form-control textarea-height" id="mode_preparation" name="mode_preparation" placeholder="Mensagem..."  required></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end p-3">
                        <button class="btn btn-secondary" type="submit">
                            Criar
                        </button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function addIngredient() {
        var wrapper = document.getElementById('ingredients-wrapper');
        var ingredientGroup = document.createElement('div');
        ingredientGroup.innerHTML = `
            <select class="form-select form-control-bg mt-1" name="ingredients[]" required>
                <option>Selecione um ingrediente</option>
                @foreach ($ingredients as $ingredient)
                    <option value="{{ $ingredient['id'] }}">{{ $ingredient['name'] }}</option>
                @endforeach
            </select>
            <button class="btn btn-danger mt-1" type="button" onclick="removeIngredient(this)">
                <i class="d-flex fi fi-rr-trash"></i>
            </button>
        `;
        wrapper.appendChild(ingredientGroup);
    }

    function removeIngredient(button) {
        var ingredientGroup = button.parentNode;
        ingredientGroup.parentNode.removeChild(ingredientGroup);
    }
</script>
@endsection