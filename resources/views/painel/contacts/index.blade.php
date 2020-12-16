@extends('layouts.painel')

@section('title', 'Consultar contactos')

@section('breadcrumb')
	<li>
		<a href="{{ route('painel.contacts') }}">
			<span>Contactos</span>
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
					<h4 class="title">Consultar contactos</h4>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive col-md-12">
					<table class="datatable table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>E-mail</th>
								<th>Assunto</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>E-mail</th>
								<th>Assunto</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($contacts as $contact)
								@if($contact->user_id)
									<tr>
										<td>{{ $contact->id }}</td>
										<td>{{ $contact->user->first_name }}</td>
										<td>{{ $contact->user->email }}</td>
										<td>{{ $contact->subject }}</td>
										<td>
											<a href="{{ url('painel/contacts/show/'.$contact->id) }}">Ver mensagem</a>
										</td>
									</tr>
								@else
									<tr>
										<td>{{ $contact->id }}</td>
										<td>{{ $contact->name }}</td>
										<td>{{ $contact->email }}</td>
										<td>{{ $contact->subject }}</td>
										<td>
											<a href="{{ url('painel/contacts/show/'.$contact->id) }}">Ver mensagem</a>
										</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

@stop