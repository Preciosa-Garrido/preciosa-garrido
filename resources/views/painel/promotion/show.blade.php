@extends('layouts.admin')

@section('title', 'Consultar produto - '.$product->product)

@section('li')
	<li>
		<a href="{{ route('admin.promotion.consultar') }}">
			<span>Promoções</span>
		</a>
	</li>
	
	<li>
		<span>Ver produto: {{ $product->product }}</span>
	</li>
@stop

@section('content')

		<div class="col-md-8">
			<div class="card">
				<form action="{{ url('admin/products/destroy/'.$product->id) }}" method="post">
					@method('DELETE')
					{{ csrf_field() }}
					<div class="card-header">
						<div class="card-title">
							<div class="title">
								Produto:
								<span style="color: red">{{ $product->product }}</span>
							</div>
						</div>
					</div>
					<div class="card-body info-produto">
						<img src="{{ url('storage/product/'.$product->image) }}" alt="Imagem do produto" class="img-produto" />
						<div>
							<p>{{ $product->description }}</p>
							<p>
								Está custando: 
								<span style="color: red">{{ number_format($product->price, 2, ',', ' ') }} KZs</span> por unidade
							</p>
							<p>Quantidade: <span style="color: red">{{ $product->stock }}</span></p>
							<p>Código de barra: <span style="color: red">{{ $product->barcode }}</span></p>
						</div>
					</div>
					<div class="card-footer">
						<div class="pull-right" style="float: right !important;">
							<a href="{{ route('admin.product.consultar') }}" class="btn btn-default btn-sm">Voltar</a>
							<button type="submit" class="btn btn-danger btn-sm">Apagar</button>
							<a href="{{ url('admin/products/edit/'.$product->id) }}" class="btn btn-info btn-sm">Actualizar</a>
						</div>
					</div>
				</form>
			</div>
		</div>

@stop