@extends('layouts.admin')

@section('title', 'Ver funcionários')

@section('breadcrumb')

	<li>
		<a href="{{ route('gestors.consultar') }}">
			<span>Funcionários</span>
		</a>
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
					<h4 class="title">Consultar funcionários</h4>
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
								<th>Nome</th>
								<th>E-mail</th>
								<th>Username</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>E-mail</th>
								<th>Username</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($gestors as $gestor)
								<tr>
									<td>{{ $gestor->id }}</td>
									<td>{{ $gestor->name }}</td>
									<td>{{ $gestor->email }}</td>
									<td>{{ $gestor->username }}</td>
									<td>
										@if($gestor->status == 0)
											<a href="{{ url('admin/gestors/update/'.$gestor->id.'/1') }}">Recontratar</a>
										@else
											<a href="{{ url('admin/gestors/update/'.$gestor->id.'/0') }}">Despedir</a>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

@stop