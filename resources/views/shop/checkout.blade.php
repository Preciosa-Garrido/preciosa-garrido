@extends('layouts.structure')

@section('title', 'Checkout')

@section('content')
    
    @auth
        <checkout-component :auth="{{ auth()->user() }}"></checkout-component>
    @else
        <checkout-component :auth="null"></checkout-component>
    @endauth

@stop
