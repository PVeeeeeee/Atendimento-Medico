<!-- admin/admin.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Usuários</h1>

        <div class="order-links">
            <p>Ordenar por:</p>
            <a href="{{ route('admin.index', ['order' => 'nome', 'direction' => $order === 'nome' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                Nome {!! $order === 'nome' ? ($direction === 'asc' ? '&#9662;' : '&#9652;') : '' !!}
            </a> |
            <a href="{{ route('admin.index', ['order' => 'created_at', 'direction' => $order === 'created_at' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                Data de Registro {!! $order === 'created_at' ? ($direction === 'asc' ? '&#9662;' : '&#9652;') : '' !!}
            </a> |
            <a href="{{ route('admin.index', ['order' => 'tipo', 'direction' => $order === 'tipo' && $direction === 'asc' ? 'desc' : 'asc']) }}">
                Tipo {!! $order === 'tipo' ? ($direction === 'asc' ? '&#9662;' : '&#9652;') : '' !!}
            </a>
        </div>

        <ul class="user-list">
            @foreach($users as $user)
                <li class="user-item">
                    <div class="user-info">
                        <strong>Nome:</strong> {{ $user->nome }}<br>
                        <strong>Tipo:</strong> {{ $user->tipo }}<br>
                        <strong>Função:</strong> {{ $user->funcao }}<br>
                        <strong>Data de Registro:</strong> {{ $user->created_at->format('d/m/Y H:i:s') }}<br>
                    </div>
                    <div class="user-actions">
                        <form method="get" action="{{ route('admin.showUser', $user->id) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Ver Dados</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
    </div>
@endsection