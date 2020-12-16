@extends('layouts.admin')

@section('title', 'Consultar parceiros')

@section('breadcrumb')
	<li>
		<a href="{{ route('parceiros.consultar') }}">
			<span>Parceiros</span>
		</a>
	</li>

	<li>
		<span>Consultar</span>
	</li>
@stop

@section('content')

	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h4 class="title">Consultar parceiros</h4>
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
								<th>Parceiro</th>
								<th>Site</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Parceiro</th>
								<th>Site</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($parceiros as $parceiro)
								<tr>
									<td>{{ $parceiro->id }}</td>
									<td>{{ $parceiro->parceiro }}</td>
									<td>{{ $parceiro->site }}</td>
									<td>
										<a href="{{ url('admin/parceiros/show/'.$parceiro->id) }}">Mostrar mais...</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@stop