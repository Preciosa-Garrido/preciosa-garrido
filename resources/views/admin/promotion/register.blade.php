@extends('layouts.admin')

@section('title', 'Registrar produtos')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.promotion.consultar') }}">
			<span>Promoções</span>
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
						<h4 class="title">Registrar promoção</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ route('admin.promotion.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						<input type="hidden" name="status" value="1" />
						<div class="form-group">
							<select name="product_id" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" value="{{ old('product_id') }}">
								<option>-- SELECIONE O PRODUTO --</option>
								<optgroup label="Produtos">
									@foreach($products as $product)
										<option value="{{ $product->id }}">{{ $product->product }}</option>
									@endforeach
								</optgroup>
							</select>
							@if ($errors->has('product_id'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('product_id') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="desconto">Desconto do produto(%)</label>
							<input type="text" id="desconto" name="desconto" class="form-control{{ $errors->has('desconto') ? ' is-invalid' : '' }}" value="{{ old('desconto') }}" placeholder="50" />
							
							@if ($errors->has('desconto'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('desconto') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<label for="promotion_end">Fim da promoção</label>
							<input type="date" id="promotion_end" name="promotion_end" class="form-control{{ $errors->has('promotion_end') ? ' is-invalid' : '' }}" value="{{ old('promotion_end') }}" />
							
							@if ($errors->has('promotion_end'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('promotion_end') }}</strong>
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