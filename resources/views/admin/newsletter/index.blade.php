@extends('layouts.admin')

@section('title', 'Consultar emails')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.contacts') }}">
			<span>Newsletter</span>
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
					<h4 class="title">Consultar email da newsletter</h4>
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
								<th>E-mail</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>E-mail</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($newsletters as $newsletter)
								<tr>
									<td>{{ $newsletter->id }}</td>
									<td>{{ $newsletter->email }}</td>
									<td>
										<a href="mailto:{{ $newsletter->email }}">Enviar novidades</a> |
										<a href="{{ url('admin/newsletter/destroy/'.$newsletter->id) }}">Eliminar email</a>
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