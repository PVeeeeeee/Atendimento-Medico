<!-- resources/views/consultas/create.blade.php -->

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

            <!-- Campo para usuário comum -->
            <div class="form-group">
                <label for="usuario_comum_id">Usuário Comum:</label>
                <input type="text" name="usuario_comum_id" class="form-control" value="{{ Auth::user()->nome }}" readonly>
            </div>

            <!-- Campo para usuário médico (lista de usuários médicos) -->
            <div class="form-group">
                <label for="usuario_medico_id">Usuário Médico:</label>
                <select name="usuario_medico_id" class="form-control">
                    @foreach ($usuariosMedicos as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
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
        </form>
    </div>
@endsection