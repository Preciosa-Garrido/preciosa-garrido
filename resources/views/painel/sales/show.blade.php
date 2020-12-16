@extends('layouts.painel')

@section('title', 'Ver produtos da venda')

@section('breadcrumb')
	<li>
		<a href="{{ route('sales') }}">
			<span>Vendas</span>
		</a>
	</li>

	<li>
		<span>Ver produtos</span>
	</li>

@endsection

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Ver produtos da venda | Total: {{ number_format($sale->amount, 2, ',', ' ') }} KZs</h4>
					</div>
				</div>
				<div class="card-body">
					@foreach($products as $product)
						<div class="col-md-3">
							<ol class="list-group">
								<li class="list-group-item active">
									<strong>Produto:</strong> 
									{{ $product->product->product }}
								</li>
								<li class="list-group-item">
									<strong>Preço:</strong> 
									{{ number_format($product->price, 2, ',', ' ') }} KZs
								</li>
								<li class="list-group-item">
									<strong>Detalhes:</strong> 
									{{ $product->product->description }}
								</li>
								<li class="list-group-item">
									<strong>Quantidade:</strong> 
									<span class="badge">{{ $product->qtd }}</span>
								</li>
								<li class="list-group-item">
									<strong>Categoria:</strong> 
									{{ $product->product->category->category }}
								</li>
							</ol>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

@endsection