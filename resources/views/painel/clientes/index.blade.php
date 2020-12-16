@extends('layouts.painel')

@section('title', 'Ver clientes')

@section('breadcrumb')

	<li>
		<span>Clientes</span>
	</li>

	<li>
		<span>Consultar</span>
	</li>

@stop

@section('content')

	<section class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h4 class="title">Consultar clientes</h4>
				</div>
			</div>
			<div class="card-body">
				@if(session('mensagem'))
					<div class="alert alert-warning">
						<p>{{ session('mensagem') }}</p>
					</div>
				@endif
				<div class="table-responsive col-md-12">
					<table class="datatable table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Primeiro nome</th>
								<th>Último nome</th>
								<th>E-mail</th>
								<th>Residência</th>
								<th>Nº telefone</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Primeiro nome</th>
								<th>Último nome</th>
								<th>E-mail</th>
								<th>Residência</th>
								<th>Nº telefone</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($clientes as $cliente)
								<tr>
									<td>{{ $cliente->id }}</td>
									<td>{{ $cliente->first_name }}</td>
									<td>{{ $cliente->last_name }}</td>
									<td>{{ $cliente->email }}</td>
									<td>{{ $cliente->address }}</td>
									<td>{{ $cliente->phone }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

@stop