@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> 		
					<div class="row">
						<div class="col-3">
							<a class="btn btn-outline-secondary float-left" role="button" href="{{ route('tarefa.index') }}" >
								Ver Tarefas
							</a>
						</div>
						<div class="col-3">
							<a class="btn btn-outline-dark mr-1" role="button" href="{{ route('tarefa.export', ['extensao' => 'xlsx']) }}" >
								Baixar Tabela (.xlsx)
							</a>
						</div>	
						<div class="col-3">
							<a class="btn btn-outline-dark mr-1" role="button" href="{{ route('tarefa.export', ['extensao' => 'csv']) }}" >
								Baixar Tabela (.csv)
							</a>
						</div>
						<div class="col-3">
							<a class="btn btn-outline-secondary float-right" role="button" href="{{ route('tarefa.create') }}" >
								Nova Tarefa
							</a>
						</div>
					</div>
				</div>
                <div class="card-body">
									<table class="table table-striped table-hover">
										<thead>
											<tr>
												<th scope="col">ID</th>
												<th scope="col">Tarefa</th>
												<th scope="col">Data Cadastro</th>
												<th scope="col">Data Limite</th>
												<th scope="col">Editar</th>
												<th scope="col">Remover</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($tarefas as $key => $tarefa)
												<tr>
													<th scope="row">{{ $tarefa['id'] }}</th>
													<td>{{ $tarefa['tarefa'] }}</td>
													<td>{{ date('d/m/Y', strtotime($tarefa['created_at'])) }}</td>
													<td>{{ date('d/m/Y', strtotime($tarefa['data_limite'])) }}</td>
													<td>
														<a href="{{ route('tarefa.edit', $tarefa['id']) }}" >
															<img src="{{ asset('storage/icons/editIcon_000.svg') }}">
														</a>
													</td>
													<td>
														<form id="form_{{ $tarefa['id'] }}" method="post"
															action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id]) }}" >
															@method('DELETE')
															@csrf
														</form>
														<a href="#" onclick="document.getElementById('form_{{ $tarefa['id'] }}').submit()">
															<img src="{{ asset('storage/icons/deleteIcon.svg') }}">
														</a>
													</td>
												</tr>
											@endforeach
										</tbody>
									</table>

									<nav>
										<ul class="pagination">
												<li class="page-item"><a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Voltar</a></li>

												@for($i = 1; $i <= $tarefas->lastPage(); $i++)
														<li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}">
																<a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
														</li>
												@endfor
												
												<li class="page-item"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Avançar</a></li>
										</ul>
								</nav>
							</div>
            </div>
        </div>
    </div>
</div>
@endsection
