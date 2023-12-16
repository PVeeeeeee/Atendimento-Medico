<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('home', compact('user'));
        $usuariosMedicos = User::where('tipo', 'medico')->get();
        return view('nome_da_sua_visao', compact('usuariosMedicos'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
