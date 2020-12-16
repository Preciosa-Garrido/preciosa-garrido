@extends('layouts.admin')

@section('title', 'Actualizar venda')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.sales') }}">
			<span>Vendas</span>
		</a>
	</li>

	<li>
		<span>Actualizar</span>
	</li>
@stop

@section('content')

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Actualizar estado</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ url('admin/sales/update/'.$sale->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('put')
						<div class="form-group">
							<label for="state">Estado</label>
							<select id="state" name="status" value="{{ $sale->status }}" class="form-control">
								<option value="start">Encomendado</option>
								<option value="processing">Em andamento</option>
								<option value="made">Concluído</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
						</div>
					</form>
				</div>
			</div>
		</div>

@stop