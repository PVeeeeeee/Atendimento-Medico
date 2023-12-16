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
                        <th>Médico</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($consultas as $consulta)
                        <tr>
                            <td>{{ $consulta->data_consulta }}</td>
                            <td>{{ $consulta->hora_consulta }}</td>
                            <td>{{ $consulta->usuarioMedico->nome }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection