@extends('layouts.admin')

@section('title', 'Registrar produtos')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.products.consultar') }}">
			<span>Produtos</span>
		</a>
	</li>
	
	<li>
		<span>Registrar</span>
	</li>
@stop

@section('content')
	<div class="container-fluid">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Registrar produto</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="product">Nome do produto</label>
							<input type="text" id="product" name="product" class="form-control{{ $errors->has('product') ? ' is-invalid' : '' }}" value="{{ old('product') }}" />
							
							@if ($errors->has('product'))
								<span class="invalid-feedback" role="alert">
									<strong>{!! $errors->first('product') !!}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="price">Preço do produto</label>
							<input type="text" id="price" name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ old('price') }}" />
							
							@if ($errors->has('price'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('price') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="stock">Quantidade do produto</label>
							<input type="number" id="stock" name="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{ old('stock') }}" />
							
							@if ($errors->has('stock'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('stock') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="barcode">Código de barras</label>
							<input type="text" id="barcode" name="barcode" class="form-control{{ $errors->has('barcode') ? ' is-invalid' : '' }}" value="{{ old('barcode') }}" />
							
							@if ($errors->has('barcode'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('barcode') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="description">Descrição do produto</label>
							<textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description') }}"></textarea>
							
							@if ($errors->has('description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" value="{{ old('category_id') }}">
								<option value="">-- SELECIONE A CATEGORIA --</option>
								<optgroup label="Categorias">
									@foreach($categories as $category)
										<option value="{{ $category->id }}">{{ $category->category }}</option>
									@endforeach
								</optgroup>
							</select>
							@if ($errors->has('category_id'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('category_id') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="image">Imagem do produto</label>
							<input type="file" id="image" name="image" />
							@if ($errors->has('image'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('image') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="image1">Imagem de alternativa 1</label>
							<input type="file" id="image1" name="image1" />
							@if ($errors->has('image1'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('image1') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="image2">Imagem de alternativa 2</label>
							<input type="file" id="image2" name="image2" />
							@if ($errors->has('image2'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('image2') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Registrar</button>
							<button type="reset" class="btn btn-danger btn-sm">Limpar campos</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@stop