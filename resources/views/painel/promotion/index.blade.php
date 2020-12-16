<?php use App\Models\Product; ?>
@extends('layouts.painel')

@section('title', 'Consultar promoções de produtos')

@section('breadcrumb')
	<li>
		<a href="{{ route('promotion.consultar') }}">
			<span>Promoções</span>
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
					<h4 class="title">Consultar promoções de produtos</h4>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive col-md-12">
					<table class="datatable table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Produto</th>
								<th>Preço</th>
								<th>Preço de promoção</th>
								<th>C. de barra</th>
								<th>Desconto</th>
								<th>Fim</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Produto</th>
								<th>Preço</th>
								<th>Preço de promoção</th>
								<th>C. de barra</th>
								<th>Desconto</th>
								<th>Fim</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($promotions as $promotion)
								<tr>
									<?php $product = Product::find($promotion->product_id); ?>
									<td>{{ $promotion->id }}</td>
									<td>{{ $product->product }}</td>
									<td>{{ number_format($product->price, 2, ',', ' ') }} KZs</td>
									<td>{{ number_format($promotion->products->price - ($promotion->products->price * ($promotion->desconto / 100)), 2, ',', ' ') }} KZs</td>
									<td>{{ $product->barcode }}</td>
									<td>{{ $promotion->desconto }} %</td>
									<td>{{ $promotion->promotion_end }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@stop