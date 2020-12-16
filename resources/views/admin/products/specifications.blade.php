@extends('layouts.admin')

@section('title', 'Actualizar produto '.$product->product)

@section('breadcrumb')
	<li>
		<a href="{{ route('admin.products.consultar') }}">
			<span>Produtos</span>
		</a>
	</li>
	
	<li>
		<span>Actualizar especificações</span>
	</li>
@stop

@section('content')

	<admin-specification-component :product="{{ $product }}"></admin-specification-component>

@stop