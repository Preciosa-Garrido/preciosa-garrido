@extends('layouts.structure')

@section('title', 'Confirmation')

@section('content')

    @php
        if(isset($_GET['cart']) and isset($_GET['sale'])):
            $sale = $_GET['sale'];
            $cart = $_GET['cart'];
        endif
    @endphp
    
    <confirmation-component :sale="{{ $sale }}" :cart="{{ $cart }}"></confirmation-component>

@stop