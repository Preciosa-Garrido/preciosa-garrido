@extends('layouts.admin')

@section('title', 'Listar códigos de cupões')

@section('breadcrumb')
	<li>
		<a href="{{ route('coupon.consultar') }}">
			<span>Cupão</span>
		</a>
	</li>
	
	<li>
		<span>Consultar</span>
	</li>
@stop

@section('content')
		<div class="card">
			<div class="card-header">
				<div class="card-title">
					<h4 class="title">Consultar código de cupões</h4>
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
								<th>Código</th>
								<th>Desconto</th>
								<th>Criado em</th>
								<th>Operação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>ID</th>
								<th>Código</th>
								<th>Desconto</th>
								<th>Criado em</th>
								<th>Operação</th>
							</tr>
						</tfoot>
						<tbody>
							@forelse($coupons as $coupon)
								<tr>
									<td>{{ $coupon->id }}</td>
									<td>{{ $coupon->code }}</td>
									<td>{{ $coupon->desconto }} %</td>
									<td>{{ $coupon->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/coupon/destroy/'.$coupon->id) }}">Apagar</a>
                                        | <a href="{{ url('admin/coupon/edit/'.$coupon->id) }}">Actualizar</a> | <a href="{{ url('admin/coupon/show/'.$coupon->id) }}">Ver cupão</a>
                                    </td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

@stop
