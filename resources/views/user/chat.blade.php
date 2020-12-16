@extends('layouts.structure')

@section('title', 'Chat enviar mensagem')

@section('content')
    
    @if ($admin != null)
        <user-admin-chat-component :auth="{{ auth()->user() }}" :admin="{{ $admin }}"></user-admin-chat-component>
    @else
        <user-chat-component :auth="{{ auth()->user() }}" :gestor="{{ $gestor }}"></user-chat-component>        
    @endif
    

@stop