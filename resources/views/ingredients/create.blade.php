@extends('template.index')

@section('content')
    <section class="padding-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Novo Ingrediente</h1>
                    <hr>

                    <form action="{{ url('ingredientes') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="margin-show">Nome do ingrediente</p>
                                <input class="form-control form-control-bg" type="text" name="name" id="name"
                                    placeholder="Nome do ingrediente" required>
                            </div>

                            <div class="col-lg-6">
                                <p class="margin-show">Data de Compra:</p>
                                <input class="form-control form-control-bg" type="date" id="date" name="date">
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
        document.addEventListener('DOMContentLoaded', function() {
            var currentDate = new Date().toISOString().slice(0, 10);
            document.getElementById('date').value = currentDate;
        });
    </script>
@endsection
