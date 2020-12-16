@extends('layouts.admin')

@section('title', 'Registrar parceiro')

@section('breadcrumb')
	<li>
		<a href="{{ route('parceiros.consultar') }}">
			<span>Parceiros</span>
		</a>
	</li>

	<li>
		<span>Registrar</span>
	</li>
@stop

@section('content')

	<div class="container-fluid">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">Registrar parceiro</h4>
					</div>
				</div>
				<div class="card-body">
					@if(session('mensagem'))
						<div class="alert alert-warning">
							<p>{{ session('mensagem') }}</p>
						</div>
					@endif
					<form action="{{ route('admin.parceiro.store') }}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="parceiro">Parceiro</label>
							<input type="text" id="parceiro" name="parceiro" class="form-control{{ $errors->has('parceiro') ? ' is-invalid' : '' }}" value="{{ old('parceiro') }}" />
							
							@if ($errors->has('parceiro'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('parceiro') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<label for="site">Site</label>
							<input type="url" id="site" name="site" class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" value="{{ old('site') }}" placeholder="http://www.exemplo.com" />
							
							@if ($errors->has('site'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('site') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<label for="logo">Logotipo</label>
							<input type="file" id="logo" name="logo" value="{{ old('logo') }}" />

							@if ($errors->has('logo'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('logo') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Cadastrar</button>
							<button type="reset" class="btn btn-danger btn-sm">Limpar campos</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@stop