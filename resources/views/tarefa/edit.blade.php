@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header">{{ __('Tarefas') }}</div>
                <div class="card-body">
                    
                    <form method="POST" action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}">
                        @csrf
												@method('PUT')
                        <div class="mb-3">
                          <label class="form-label">Tarefa</label>
                          <input type="text" class="form-control" name="tarefa" value="{{ $tarefa->tarefa }}">
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Data limite</label>
                          <input type="date" class="form-control" name="data_limite" value="{{ $tarefa->data_limite }}">
                        </div>

                        <button type="submit" class="btn btn-primary btn-success">Atualizar</button>
                      </form>


                </div>
            </div>

        </div>


    </div>
</div>
@endsection
