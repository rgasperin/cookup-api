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
        <div class="row mt-2">
            <div class="col-lg-12">
                <div class="card p-0">
                    <table class="table table-bg table-hover">
                        <thead class="table-dark-bg">
                            <tr>
                                <th class="padding-card">Nome do Ingrediente</th>
                                <th class="padding-card">Data de validade</th>
                                <th class="padding-card text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($ingredients))
                                @foreach ($ingredients as $ingredient)
                                    <tr>
                                        <td class="padding-table">
                                            <p class="mt-3">{{ $ingredient['name'] }}</p>
                                        </td>
                                        <td class="padding-table">
                                            <p class="formatted-date ms-2 mt-3">{{ $ingredient['data_de_validade'] }} </p>
                                        </td>
                                        
                                        <td class="padding-table">
                                            <div class="mt-3 d-flex justify-content-end">
                                                <a class="ms-2 text-decoration-none"
                                                    href="{{ url('ingredientes/' . $ingredient['id']) . '/editar' }}">
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
                <form id="deleteForm" method="POST" action="{{ url('ingredientes/' . $ingredient['id']) }}">
                    @csrf
                    @method('DELETE')
                    <button class="ms-2 btn btn-danger btn-view" type="submit">
                        Confirmar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script> 
    document.addEventListener('DOMContentLoaded', function() {
        var formattedDates = document.querySelectorAll('.formatted-date');

        formattedDates.forEach(function(element) {
            var originalDate = element.textContent.trim();
            var formattedDate = formatDate(originalDate); 
            element.textContent = formattedDate;
        });
        
        function formatDate(dateString) {
            var date = new Date(dateString);
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            return `${day}/0${month}/${year}`;
        }
    });

    $(".btn-danger").click(function () {
        $("#confirmDeleteModal").modal("show");
    });
</script>
@endsection