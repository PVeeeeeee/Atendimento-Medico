<!-- admin/showUser.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dados do Usuário</h1>

        <p>Nome: {{ $user->nome }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>CPF: {{ $user->cpf }}</p>
        <p>Tipo: {{ $user->tipo }}</p>
        <p>Data de Nascimento: {{ $user->data_nasc }}</p>
        <p>Data de Registro: {{ $user->created_at->format('d/m/Y H:i:s') }}</p>

        <a href="{{ route('profile.editUser', $user->id) }}" class="btn btn-primary">Editar Perfil</a>
        <a href="{{ route('admin.index') }}" class="btn btn-primary">Voltar</a>
    </div>
@endsection