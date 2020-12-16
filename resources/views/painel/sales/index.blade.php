@extends('layouts.painel')

@section('title', 'Ver vendas')

@section('breadcrumb')
	<li>
		<a href="{{ route('sales') }}">
			<span>Vendas</span>
		</a>
	</li>

	<li>
		<span>Consultar</span>
	</li>

@endsection

@section('content')

	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h4 class="title">Consultar vendas</h4>
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
								<th>Total</th>
								<th>Estado</th>
								<th>Cupão</th>
								<th>Data de venda</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Total</th>
								<th>Estado</th>
								<th>Cupão</th>
								<th>Data de venda</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($sales as $sale)
								<tr>
									<td>{{ $sale->id }}</td>
									<td>{{ number_format($sale->amount, 2, ',', ' ') }}KZs</td>
									@if($sale->status == 'start')
										<td class="danger">Encomendado</td>
									@elseif($sale->status == 'processing')
										<td class="warning">Em andamento</td>
									@else
										<td class="success">Concluído</td>
									@endif
									<td>
										@if($sale->coupon_id)
											{{ $sale->coupon->desconto }} %
										@else
											Não efectuado
										@endif
									</td>
									<td>{{ $sale->created_at }}</td>
									<td>
										<a href="{{ url('painel/sales/show/'.$sale->id) }}">Ver produtos</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endsection