<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">Dashboard Médico</div>

                    <div class="card-body">
                        @if (Auth::check())
                            <p class="lead">Bem-vindo, {{ Auth::user()->nome }}!</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>CPF:</strong> {{ Auth::user()->cpf }}</p>
                            <p><strong>Data de Nascimento:</strong> {{ Auth::user()->data_nasc }}</p>

                            <a href="{{ route('profile.edit', ['userId' => $user->id]) }}" class="btn btn-primary">Editar Perfil</a>

                            @auth
                                @if(auth()->user()->tipo === 'admin')
                                <form method="get" action="{{ route('admin.index') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Apenas para Admins</button>
                                </form>
                                @endif

                                <a href="{{ route('consultas.index') }}" class="btn btn-info">Ver Consultas</a>
                                <a href="{{ route('consultas.create') }}" class="btn btn-success">Criar Consulta</a>
                            @endauth

                            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir Conta</button>
                            </form>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Logout</button>
                            </form>
                        @else
                            <p class="lead">Você não está logado.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection