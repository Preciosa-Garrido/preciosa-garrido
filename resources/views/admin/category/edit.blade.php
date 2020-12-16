@extends('layouts.admin')

@section('title', 'Actualizar categoria')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.category.consultar') }}">
			<span>Categorias</span>
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
						<h4 class="title">Actualizar Categoria</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ url('admin/categories/update/'.$category->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('put')
						<div class="form-group">
							<label for="category">Categoria</label>
							<input type="text" id="category" name="category" value="{{ $category->category }}" class="form-control" />
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
							<button type="reset" class="btn btn-danger btn-sm">Limpar campos</button>
						</div>
					</form>
				</div>
			</div>
		</div>

@stop