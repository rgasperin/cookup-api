@extends('template.index')

@section('content')
    <section class="padding-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Editar Tipo</h1>
                    <hr>

                    <form action="{{ url('tipos/' . $type['id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="margin-show">Nome da Receita</p>
                                <input class="form-control form-control-bg" type="text" name="name" id="name"
                                    value="{{ $type['name'] }}" required>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end p-3">
                            <button class="btn btn-secondary" type="submit">
                                Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
@endsection
