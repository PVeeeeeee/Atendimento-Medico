<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{

    public function create()
    {
        $usuariosMedicos = User::where('tipo', 'medico')->get();
        return view('consultas.create', compact('usuariosMedicos'));
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'usuario_medico_id' => 'required|exists:users,id',
            'data_consulta' => 'required|date',
            'hora_consulta' => 'required|date_format:H:i',
        ]);

        // Obtém o ID do usuário comum a partir do usuário autenticado
        $userComumID = auth()->user()->id;

        // Cria a consulta no banco de dados
        Consulta::create([
            'user_comum_id' => $userComumID,
            'user_medico_id' => $request->input('usuario_medico_id'),
            'data_consulta' => $request->input('data_consulta'),
            'hora_consulta' => $request->input('hora_consulta'),
        ]);

        return redirect()->route('consultas.create')->with('success', 'Consulta agendada com sucesso!');
    }
    public function index()
    {
        // Obtém o ID do usuário autenticado
        $userID = Auth::user()->id;
    
        // Busca todas as consultas para o usuário autenticado
        $consultas = Consulta::where('user_comum_id', $userID)
            ->with('usuarioMedico') // Carrega os dados do usuário médico relacionado
            ->get();
    
        return view('consultas.index', compact('consultas'));
    }

}