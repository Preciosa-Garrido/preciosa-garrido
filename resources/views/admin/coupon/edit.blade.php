@extends('layouts.admin')

@section('title', 'Actualizar cupão')

@section('breadcrumb')
	<li>
		<a href="{{ route('coupon.consultar') }}">
			<span>Cupão</span>
		</a>
	</li>

	<li>
		<span>Actualizar</span>
	</li>
@stop

@section('content')

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Actualizar cupão</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ url('admin/coupon/update/'.$coupon->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('put')
						<div class="form-group">
							<label for="desconto">Desconto</label>
							<input type="text" id="desconto" name="desconto" class="form-control{{ $errors->has('desconto') ? ' is-invalid' : '' }}" value="{{ $coupon->desconto }}" />
							
							@if ($errors->has('desconto'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('desconto') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							Também quer actualizar o código? 
							<div class="radio3 radio-check  radio-info radio-inline">
								<input type="radio" id="sim" name="confirm" value="sim" checked>
								<label for="sim">Sim</label>
							</div>
							<div class="radio3 radio-check radio-danger radio-inline">
								<input type="radio" id="nao" name="confirm" value="nao">
								<label for="nao">Não</label>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
							<button type="reset" class="btn btn-danger btn-sm">Limpar campos</button>
						</div>
					</form>
				</div>
			</div>
		</div>

@stop