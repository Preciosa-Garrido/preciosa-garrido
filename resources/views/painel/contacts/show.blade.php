@extends('layouts.painel')

@section('title', 'Ver mensagem')

@section('breadcrumb')

	<li>
		<a href="{{ route('painel.contacts') }}">
			<span>Contactos</span>
		</a>
	</li>

	<li>
		<span>Ver mensagem</span>
	</li>

@endsection

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							@if($contact->user_id != null)
								<h4 class="title">Ver mensagem de {{ $contact->user->first_name }}</h4>
							@else
								<h4 class="title">Ver mensagem de {{ $contact->name }}</h4>
							@endif
						</div>
					</div>
					<div class="card-body">
						<div class="col-md-2 text-right">
							<p>Assunto</p>
							<p>Mensagem</p>
						</div>
						<div class="col-md-10">
							<p class="text-justify">{{ $contact->subject }}</p>
							<p class="text-justify">{{ $contact->message }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection