@extends('layouts.admin')

@section('title', 'Chat')

@section('breadcrumb')

    <li>
        <a href="{{ route('admin.chat') }}">
            <span>Chat</span>
        </a>
    </li>

    <li>
        <span>Conversa</span>
    </li>

@stop


@section('content')

	<admin-chat-component :auth="{{ auth('admin')->user() }}" :cliente="{{ $cliente }}"></admin-chat-component>

@stop
