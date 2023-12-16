<!-- profile/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Perfil</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.updateUser', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $user->nome) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="{{ old('cpf', $user->cpf) }}" required>
            </div>

            <div class="form-group">
                <label for="data_nasc">Data de Nascimento</label>
                <input type="date" name="data_nasc" id="data_nasc" class="form-control" value="{{ old('data_nasc', $user->data_nasc) }}" required>
            </div>

            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control" required>
                    <option value="admin" {{ old('tipo', $user->tipo) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="comun" {{ old('tipo', $user->tipo) === 'comun' ? 'selected' : '' }}>Comum</option>
                    <option value="medico" {{ old('tipo', $user->tipo) === 'medico' ? 'selected' : '' }}>Médico</option>
                </select>
            </div>


            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input type="password" name="password" id="password" class="form-control" minlength="6">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Nova Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" minlength="6">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
        </form>
    </div>
@endsection