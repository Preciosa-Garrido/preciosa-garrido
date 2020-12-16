@extends('layouts.admin')

@section('title', 'Registrar categoria')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.category.consultar') }}">
			<span>Categorias</span>
		</a>
	</li>
	
	<li>
		<span>Registrar</span>
	</li>
@stop

@section('content')
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Registrar Categoria</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="category">Categoria</label>
							<input type="text" id="category" name="category" class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" value="{{ old('category') }}" />
							
							@if ($errors->has('category'))
								<span class="invalid-feedback" role="alert">
									<strong>{!! $errors->first('category') !!}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Registrar</button>
							<button type="reset" class="btn btn-danger btn-sm">Limpar campo</button>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop