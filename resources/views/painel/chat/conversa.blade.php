@extends('layouts.painel')

@section('title', 'Chat')

@section('breadcrumb')

    <li>
        <a href="{{ route('gestor.chat') }}">
            <span>Chat</span>
        </a>
    </li>

    <li>
        <span>Conversa</span>
    </li>

@stop


@section('content')

	<chat-component :auth="{{ auth('gestor')->user() }}" :cliente="{{ $cliente }}"></chat-component>

@stop
