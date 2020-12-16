@extends('layouts.admin')

@section('title', 'Consultar parceiro - '.$parceiro->parceiro)

@section('breadcrumb')
	<li>
		<a href="{{ route('parceiros.consultar') }}">
			<span>Parceiros</span>
		</a>
	</li>

	<li>
		<span>Ver</span>
	</li>
@stop

@section('content')

		<div class="col-md-8">
			<div class="card">
				<form action="{{ url('admin/parceiros/destroy/'.$parceiro->id) }}" method="post">
					@method('DELETE')
					{{ csrf_field() }}
					<div class="card-header">
						<div class="card-title">
							<div class="title">
								Parceiro:
								<span style="color: red">{{ $parceiro->parceiro }}</span>
							</div>
						</div>
					</div>
					<div class="card-body">
						@if(session('mensagem'))
							<div class="alert alert-warning">
								<p>{{ session('mensagem') }}</p>
							</div>
						@endif
						<div class="info-parceiro">
							<img src="{{ url('storage/parceiros/'.$parceiro->logo) }}" alt="Imagem do logotipo do parceiro" class="img-parceiro" />
							<div>
								<p>
									Site oficial:
									<a href="{{ url($parceiro->site) }}" target="_blank">
										<span style="color: red">{{ $parceiro->site }}</span>
									</a>
								</p>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="pull-right" style="float: right !important;">
							<a href="{{ route('parceiros.consultar') }}" class="btn btn-default btn-sm">Voltar</a>
							<button type="submit" class="btn btn-danger btn-sm">Apagar</button>
							<a href="{{ url('admin/parceiros/edit/'.$parceiro->id) }}" class="btn btn-info btn-sm">Actualizar</a>
						</div>
					</div>
				</form>
			</div>
		</div>

@stop