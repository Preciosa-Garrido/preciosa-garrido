@extends('layouts.admin')

@section('title', 'Actualizar produto '.$product->product)

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.products.consultar') }}">
			<span>Produtos</span>
		</a>
	</li>
	
	<li>
		<span>Actualizar</span>
	</li>
@stop

@section('content')

	<div class="container-fluid">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Actualizar produto {{ $product->product }}</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ url('admin/products/update/'.$product->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('put')
						<div class="form-group">
							<label for="product">Nome do produto</label>
							<input type="text" id="product" name="product" class="form-control{{ $errors->has('product') ? ' is-invalid' : '' }}" value="{{ $product->product }}" />
							
							@if ($errors->has('product'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('product') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="price">Preço do produto</label>
							<input type="text" id="price" name="price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{ $product->price }}" />
							
							@if ($errors->has('price'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('price') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="stock">Quantidade do produto</label>
							<input type="number" id="stock" name="stock" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" value="{{ $product->stock }}" />
							
							@if ($errors->has('stock'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('stock') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="barcode">Código de barras</label>
							<input type="text" id="barcode" name="barcode" class="form-control{{ $errors->has('barcode') ? ' is-invalid' : '' }}" value="{{ $product->barcode }}" />
							
							@if ($errors->has('barcode'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('barcode') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="description">Descrição do produto</label>
							<textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" >{{ $product->description }}</textarea>
							
							@if ($errors->has('description'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('description') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" value="{{ $product->category_id }}">
								<option>-- SELECIONE A CATEGORIA --</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->category }}</option>
								@endforeach
							</select>

							@if ($errors->has('category_id'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('category_id') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<select name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" value="{{ $product->status }}">
								<option>-- SELECIONE O ESTADO --</option>
								<option value="activo">Activo</option>
								<option value="inactivo">Desativado</option>
							</select>

							@if ($errors->has('status'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('status') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="image">Imagem do produto</label>
							<input type="file" id="image" name="image" value="{{ $product->image }}" />

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
							<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
							<button type="reset" class="btn btn-danger btn-sm">Limpar campos</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@stop