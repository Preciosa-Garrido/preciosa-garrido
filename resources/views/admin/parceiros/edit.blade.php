@extends('layouts.admin')

@section('title', 'Actualizar parceiro '.$parceiro->parceiro)

@section('breadcrumb')
	<li>
		<a href="{{ route('parceiros.consultar') }}">
			<span>Parceiros</span>
		</a>
	</li>

	<li>
		<span>Actualizar</span>
	</li>
@stop

@section('content')

	<div class="container-fluid">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4 class="title">
							Actualizar parceiro 
							<span style="color: red">{{ $parceiro->parceiro }}</span>
						</h4>
					</div>
				</div>
				<div class="card-body">
					<form action="{{ url('admin/parceiros/update/'.$parceiro->id) }}" method="post" enctype="multipart/form-data">
						@csrf
						@method('put')
						<div class="form-group">
							<label for="parceiro">Produto</label>
							<input type="text" id="parceiro" name="parceiro" class="form-control{{ $errors->has('parceiro') ? ' is-invalid' : '' }}" value="{{ $parceiro->parceiro }}" />
							
							@if ($errors->has('parceiro'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('parceiro') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<label for="site">Site</label>
							<input type="url" id="site" name="site" class="form-control{{ $errors->has('site') ? ' is-invalid' : '' }}" value="{{ $parceiro->site }}" placeholder="http://www.exemplo.com" />
							
							@if ($errors->has('site'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('site') }}</strong>
								</span>
							@endif
						</div>

						<div class="form-group">
							<label for="logo">Logotipo</label>
							<input type="file" id="logo" name="logo" value="{{ $parceiro->logo }}" />

							@if ($errors->has('logo'))
								<span class="invalid-feedback" role="alert">
									<strong>{{ $errors->first('logo') }}</strong>
								</span>
							@endif
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
							<button type="reset" class="btn btn-danger btn-sm">Limpar campos</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@stop