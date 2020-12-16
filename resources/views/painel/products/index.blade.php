@extends('layouts.painel')

@section('title', 'Consultar produtos')

@section('breadcrumb')
	<li>
		<a href="{{ route('products.consultar') }}">
			<span>Produtos</span>
		</a>
	</li>

	<li>
		<span>Consultar</span>
	</li>
@stop

@section('content')

	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h4 class="title">Consultar produtos</h4>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive col-md-12">
					<table class="datatable table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome do produto</th>
								<th>Preço do produto</th>
								<th>Quantidade</th>
								<th>Código de barra</th>
								<th>Categoria</th>
								<th>Estado</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Nome do produto</th>
								<th>Preço do produto</th>
								<th>Quantidade</th>
								<th>Código de barra</th>
								<th>Categoria</th>
								<th>Estado</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($products as $product)
								<tr>
									<td>{{ $product->id }}</td>
									<td>{{ $product->product }}</td>
									<td>{{ number_format($product->price, 2, ',', ' ') }} KZs</td>
									<td>{{ $product->stock }}</td>
									<td>{{ $product->barcode }}</td>
									<td>{{ $product->category->category }}</td>
									<td>{{ $product->status }}</td>
									<td>
										<a href="{{ url('painel/products/show/'.$product->id) }}">Mostrar mais...</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@stop