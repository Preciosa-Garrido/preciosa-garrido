@extends('layouts.admin')

@section('title', 'Registrar cupão')

@section('breadcrumb')
	<li>
		<a href="{{ route('coupon.consultar') }}">
			<span>Cupão</span>
		</a>
	</li>
	
	<li>
		<span>Registrar</span>
	</li>
@stop

@section('content')
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Registrar cupão</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ route('coupon.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="desconto">Desconto(%)</label>
							<input type="text" id="desconto" name="desconto" class="form-control{{ $errors->has('desconto') ? ' is-invalid' : '' }}" value="{{ old('desconto') }}" />
							
							@if ($errors->has('desconto'))
								<span class="invalid-feedback" role="alert">
									<strong>{!! $errors->first('desconto') !!}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Registrar</button>
							<button type="reset" class="btn btn-danger btn-sm">Limpar campo</button>
						</div>
					</form>
				</div>
			</div>
		</div>
@stop