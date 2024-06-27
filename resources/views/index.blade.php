@extends('template.index')

@section('content')
<section class="padding-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <a class="d-flex text-decoration-none text-style" href="{{ url('ingredientes/criar') }}">
                    <i class="fi fi-rr-add icon-style me-1"></i> Adicionar Ingredientes
                </a>
            </div>
        </div>
    </div>
</section>
<section class="padding-section">
    <div class="container">
        <div class="row">
            @if (!empty($ingredients))
                <div class="slider">
                    @foreach ($ingredients as $ingredient)
                        <div class="card card-style me-1 ms-1">
                            <p class="text">{{ $ingredient['name'] }}</p>
                            <span class="sub-text">Data de Validade: <b class="ms-1">{{ $ingredient['data_de_validade'] }}</b></span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-lg-12">
                    <p class="text-center">Nenhum resultaho encontrado!</p>
                </div>
            @endif
            <div class="col-lg-12 mt-4">
                <div class="d-flex justify-content-center">
                    <a href="{{ url('ingredientes') }}">
                        <button class="btn btn-secondary">
                           Ver Ingredientes
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="padding-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <a class="d-flex text-decoration-none text-style" href="{{ url('criar') }}">
                    <i class="fi fi-rr-add icon-style me-1"></i> Adicionar Receitas
                </a>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card p-0">
                    <table class="table table-bg table-hover">
                        <thead class="table-dark-bg">
                            <tr>
                                <th class="padding-card">Receita</th>
                                <th class="padding-card">Tipo</th>
                                <th class="padding-card">Ingredientes</th>
                                <th class="padding-card text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($recipes))
                                @foreach ($recipes as $recipe)
                                    <tr>
                                        <td class="padding-table">
                                            <p class="mt-3">{{ $recipe['receita'] }}</p>
                                        </td>
                                        <td class="padding-table">
                                            <p class="ms-2 mt-3">{{ $recipe['tipo'] }} </p>
                                        </td>
                                        <td class="padding-table">
                                            <p class="mt-3">{{ $recipe['ingredientes'] }}</p>
                                        </td>
                                        
                                        <td class="padding-table">
                                            <div class="mt-3 d-flex justify-content-end">
                                                <a class="text-decoration-none"
                                                    href="{{ url('receitas/' . $recipe['id']) }}">
                                                    <button class="btn btn-dark btn-view">
                                                        <i class="fi fi-rr-eye icon-style"></i>
                                                    </button>
                                                </a>

                                                <a class="ms-2 text-decoration-none"
                                                    href="{{ url('receitas/' . $recipe['id']) . '/editar' }}">
                                                    <button class="btn btn-primary btn-view">
                                                        <i class="fi fi-rr-file-edit icon-style"></i>
                                                    </button>
                                                </a>
                                                <button class="ms-2 btn btn-danger btn-view" type="button"
                                                    data-toggle="modal" data-target="#confirmDeleteModal">
                                                    <i class="fi fi-rr-trash icon-style"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <table>
                                    <p class="text-center">Nenhum resultaho encontrado!</p>
                                </table>
                            @endif  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja deletar este item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                @if (!empty($recipes))
                    <form id="deleteForm" method="POST" action="{{ url('receitas/' . $recipe['id']) }}">
                        @csrf
                        @method('DELETE')
                        <button class="ms-2 btn btn-danger btn-view" type="submit">
                            Confirmar
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('.slider').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            centerMode: true,
        });
    });

    $(".btn-danger").click(function () {
        $("#confirmDeleteModal").modal("show");
    });
</script>
@endsection