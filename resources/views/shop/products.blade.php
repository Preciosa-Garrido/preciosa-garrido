@extends('layouts.structure')

@section('title', 'Produtos')

@section('content')

	@auth
		<products-component :auth="{{ auth()->user()->id }}"></products-component>
	@else
		<products-component :auth="null"></products-component>
	@endauth

@stop
