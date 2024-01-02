<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <div class="card shadow">
                    <div class="card-body">
                        @if (Auth::check())
                            <p class="lead bg-primary text-light justify-content-center">Bem-vindo, {{ Auth::user()->nome }}!</p>
                            <p class="text-uppercase"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p class="text-uppercase"><strong>CPF:</strong> {{ Auth::user()->cpf }}</p>
                            <p class="text-uppercase"><strong>Data de Nascimento:</strong> {{ Auth::user()->data_nasc }}</p>

                            <div class="container">
                                <div class="row justify-content-center p-5">
                                    <div class="col-2"><a href="{{ route('profile.edit', ['userId' => $user->id]) }}" class="btn btn-primary p-2">Editar Perfil</a></div>
                                    @auth
                                        @if(auth()->user()->tipo === 'admin')
                                        <form method="get" action="{{ route('admin.index') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Lista de Usuários</button>
                                        </form>
                                        @endif
                                        <div class="col-2"><a href="{{ route('consultas.index') }}" class="btn btn-info">Ver Consultas</a></div>
                                        <div class="col-2"><a href="{{ route('consultas.create') }}" class="btn btn-success">Criar Consulta</a></div>
                                    @endauth
                                        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?')" class="col-2">
                                            @csrf
                                            @method('DELETE')
                                            <div><button type="submit" class="btn btn-danger">Deletar conta</button></div>
                                        </form>
                                        <form action="{{ route('logout') }}" method="POST" class="col-2">
                                            @csrf
                                            <div><button type="submit" class="btn btn-secondary">Sair</button></div>
                                        </form>
                                </div>
                            </div>
                        @else
                            <p class="lead">Você não está logado.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection