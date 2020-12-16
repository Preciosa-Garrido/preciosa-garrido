<?php use App\Models\Product; ?>
@extends('layouts.admin')

@section('title', 'Consultar promoções de produtos')

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.promotion.consultar') }}">
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
				@if(session('mensagem'))
					<div class="alert alert-warning">
						<p>{{ session('mensagem') }}</p>
					</div>
				@endif
				<div class="table-responsive col-md-12">
					<table class="datatable table table-striped table-bordered">
						<thead>
							<tr>
								<th>ID</th>
								<th>Produto</th>
								<th>Preço</th>
								<th>Preço de promoção</th>
								<th>Estado</th>
								<th>Desconto</th>
								<th>Fim</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Produto</th>
								<th>Preço</th>
								<th>Preço de promoção</th>
								<th>Estado</th>
								<th>Desconto</th>
								<th>Fim</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($promotions as $promotion)
								<tr>
									<td>{{ $promotion->id }}</td>
									<td>{{ $promotion->products->product }}</td>
									<td>{{ number_format($promotion->products->price, 2, ',', ' ') }} KZs</td>
									<td>{{ number_format($promotion->products->price - ($promotion->products->price * ($promotion->desconto / 100)), 2, ',', ' ') }} KZs</td>
									<td>
										@if($promotion->status == 0) 
											Inactivo
										@else
											Activo
										@endif
									</td>
									<td>{{ $promotion->desconto }} %</td>
									<td>{{ $promotion->promotion_end }}</td>
									<td>
										<a href="{{ url('admin/promotions/destroy/'.$promotion->id) }}">Apagar</a> ||
										<a href="{{ url('admin/promotions/edit/'.$promotion->id) }}">Actualizar</a>
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