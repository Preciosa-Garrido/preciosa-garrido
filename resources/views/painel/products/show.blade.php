@extends('layouts.painel')

@section('title', 'Consultar produto - '.$product->product)

@section('breadcrumb')
	<li>
		<a href="{{ route('products.consultar') }}">
			<span>Produtos</span>
		</a>
	</li>
	<li>
		<span>Ver</span>
	</li>
@stop

@section('content')

		<div class="col-md-8">
			<div class="card">
				<div>
					<div class="card-header">
						<div class="card-title">
							<div class="title">
								Produto:
								<span style="color: red">{{ $product->product }}</span> || Categoria <span style="color: red">{{ $product->category->category }}</span>
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
							<a href="{{ route('products.consultar') }}" class="btn btn-default btn-sm">Voltar</a>
							<a href="{{ url('painel/products/images/edit/'.$product->id) }}" class="btn btn-primary btn-sm">Outras imagens</a>
						</div>
					</div>
				</div>
			</div>
		</div>

@stop