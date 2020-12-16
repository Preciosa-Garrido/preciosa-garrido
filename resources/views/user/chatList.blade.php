@extends('layouts.structure')

@section('title', 'Escolher com quem conversar')
<?php use App\Models\Chat; ?>

@section('content')

    <div class="section_gap container">
        <div class="section-top-border">
            <h3 class="mb-30 title_color">Escolha com quem conversar</h3>
            <div class="flex">
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th colspan="2">Administradores</th>
                            </tr>
                            <tr>
                                <th>Nome</th>
                                <th>Operação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                @php
                                    $chat = Chat::whereUserId(auth()->user()->id)
                                        ->whereAdminId($admin->id)
                                        ->where('sender', '!=', 'user')
                                        ->whereState(0)
                                        ->get()->count();
                                @endphp

                                <tr>
                                    <td>
                                        {{ $admin->name }}
                                        <div class="badge badge-danger">{{ $chat }}</div>
                                    </td>
                                    <td>
                                        <a href="{{ url('chat/admin/'.$admin->id) }}">Conversar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr align="center">
                                    <td colspan="2"></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6 col-md-offset-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th colspan="2">Gestores</th>
                            </tr>
                            <tr>
                                <th>Nome</th>
                                <th>Operação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gestors as $gestor)
                                @php
                                    $chat = Chat::whereUserId(auth()->user()->id)
                                        ->whereGestorId($gestor->id)
                                        ->where('sender', '!=', 'user')
                                        ->whereState(0)
                                        ->get()->count();
                                @endphp

                                <tr>
                                    <td>
                                        {{ $gestor->name }}
                                        <div class="badge badge-danger">{{ $chat }}</div>
                                    </td>
                                    <td>
                                        <a href="{{ url('chat/painel/'.$gestor->id) }}">Conversar</a>
                                    </td>
                                </tr>
                            @empty
                                <tr align="center">
                                    <td colspan="2"></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection