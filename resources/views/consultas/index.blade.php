<!-- resources/views/consultas/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Consultas Agendadas</h2>

        @if($consultas->isEmpty())
            <p>Nenhuma consulta agendada.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultas as $consulta)
                        <tr>
                            <td>{{ $consulta->data_consulta }}</td>
                            <td>{{ $consulta->hora_consulta }}</td>
                            <td>{{ $consulta->usuarioComum->nome }}</td>
                            <td>{{ $consulta->usuarioMedico->nome }} ({{ $consulta->usuarioMedico->funcao }})</td>
                            <td>
                                <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <a href="{{ route('home') }}" class="btn btn-primary">Voltar</a>
    </div>
@endsection