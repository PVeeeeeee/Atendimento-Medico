@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Agendar Consulta</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="post" action="{{ route('consultas.store') }}">
            @csrf

            <!-- Campo para usuário comum (apenas visível para admin e médicos) -->
            @if(Auth::user()->tipo === 'admin' || Auth::user()->tipo === 'medico')
                <div class="form-group">
                    <label for="usuario_comum_id">Usuário Comum:</label>
                    <select name="usuario_comum_id" class="form-control">
                        @foreach ($usuariosComuns as $comum)
                            <option value="{{ $comum->id }}">{{ $comum->nome }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Campo para usuário médico -->
            <div class="form-group">
                <label for="usuario_medico_id">Usuário Médico:</label>
                <select name="usuario_medico_id" class="form-control">
                    @foreach ($usuariosMedicos as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->nome }} ({{ $medico->funcao }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Campos restantes -->
            <div class="form-group">
                <label for="data_consulta">Data da Consulta:</label>
                <input type="date" name="data_consulta" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hora_consulta">Hora da Consulta:</label>
                <input type="time" name="hora_consulta" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Agendar Consulta</button>
            <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
        </form>
    </div>
@endsection