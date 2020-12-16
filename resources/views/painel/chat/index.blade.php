@extends('layouts.painel')

@section('title', 'Chat')

@section('breadcrumb')

    <li>
        <a href="{{ route('gestor.chat') }}">
            <span>Chat</span>
        </a>
    </li>

    <li>
        <span>Clientes</span>
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
				<div class="table-responsive col-md-12">
					<table class="datatable table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Primeiro nome</th>
								<th>E-mail</th>
								<th>Residência</th>
								<th>Nº telefone</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Primeiro nome</th>
								<th>E-mail</th>
								<th>Residência</th>
								<th>Nº telefone</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($clientes as $cliente)
								<tr>
									<td>{{ $cliente->id }}</td>
									<td>{{ $cliente->first_name . ' ' . $cliente->last_name }}</td>
									<td>{{ $cliente->email }}</td>
									<td>{{ $cliente->address }}</td>
									<td>{{ $cliente->phone }}</td>
									<td>
										<a href="{{ url('painel/chat/show/'.$cliente->id) }}">Conversar</a>
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
