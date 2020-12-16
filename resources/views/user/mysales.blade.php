@extends('layouts.structure')

@section('title', 'Minhas compras')

@section('content')
    
    <div class="section_gap">
    	<div class="container table-responsive">
			<table class="table">
				<thead>
					<tr align="center">
						<th colspan="6">Minhas compras</th>
					</tr>
					<tr>
						<th>Total</th>
						<th>Estado</th>
						<th>Pagamentos</th>
						<th>Cupão</th>
						<th>Data de venda</th>
						<th>Operação</th>
					</tr>
				</thead>

				<tbody>
					@forelse($sales as $sale)
						<tr>
							<td>{{ $sale->amount }}</td>
							<td>
								@if($sale->status == 'start')
									Encomendado
								@elseif($sale->status == 'processing')
									Em andamento
								@else
									Concluído
								@endif
							</td>

							<td>
								@if($sale->payment == 'transfer')
									Transferência
								@elseif($sale->payment == 'deposit')
									Depósito
								@else
									Pagamento a mão
								@endif
							</td>
							<td>
								@if($sale->cupao)
									$sale->cupao->desconto
								@else
									Não efectuado
								@endif
							</td>
							<td>{{ $sale->created_at }}</td>
							<td>
								<a href="{{ url('user/mysales/'.$sale->id) }}">Ver produtos</a>
							</td>
						</tr>
					@empty
						<tr align="center">
							<td colspan="6">Ainda não efectuou nenhuma compra</td>
						</tr>
					@endforelse
				</tbody>
			</table>
    	</div>
    </div>    

@stop