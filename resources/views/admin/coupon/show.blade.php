@extends('layouts.admin')

@section('title', 'Ver cupão')

@section('breadcrumb')
	<li>
		<a href="{{ route('coupon.consultar') }}">
			<span>Cupão</span>
		</a>
	</li>

	<li>
		<span>Ver</span>
	</li>
@stop

@section('content')

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Ver cupão</h4>
					</div>
				</div>
				<div class="card-body">
					<form>
						@csrf
						@method('put')
						<div class="form-group">
							<label for="coupon">Código</label>
							<input type="text" id="coupon" name="coupon" value="{{ $coupon->code }}" class="form-control" disabled />
						</div>
						<div class="form-group">
							<label for="coupon">Desconto(%)</label>
							<input type="text" id="coupon" name="coupon" value="{{ $coupon->desconto }}" class="form-control" disabled />
						</div>
						<div class="form-group">
							<a href="{{ route('coupon.consultar') }}" class="btn btn-primary btn-sm">Voltar</a>
						</div>
					</form>
				</div>
			</div>
		</div>

@stop