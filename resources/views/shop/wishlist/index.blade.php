@extends('layouts.structure')

@section('title', 'Lista de desejos')

@section('content')

	<wishlist-component :auth="{{ auth()->user() }}"></wishlist-component>

@stop