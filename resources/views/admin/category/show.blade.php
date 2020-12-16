@extends('layouts.admin')

@section('title', 'Ver categoria')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.category.consultar') }}">
			<span>Categorias</span>
		</a>
	</li>

	<li>
		<span>Ver</span>
	</li>
@stop

@section('content')

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Ver categoria</h4>
					</div>
				</div>
				<div class="card-body">
					<form>
						@csrf
						@method('put')
						<div class="form-group">
							<label for="category">Categoria</label>
							<input type="text" id="category" name="category" value="{{ $category->category }}" class="form-control" disabled />
						</div>
						<div class="form-group">
							<a href="{{ route('admin.category.consultar') }}" class="btn btn-primary btn-sm">Voltar</a>
						</div>
					</form>
				</div>
			</div>
		</div>

@stop