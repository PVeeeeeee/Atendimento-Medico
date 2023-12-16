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
        $usuariosComuns = [];

        if (Auth::user()->tipo === 'admin' || Auth::user()->tipo === 'medico') {
            $usuariosComuns = User::where('tipo', 'comum')->get();
        }

        $usuariosMedicos = User::where('tipo', 'medico')->get();

        return view('consultas.create', compact('usuariosComuns', 'usuariosMedicos'));
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $rules = [
            'usuario_medico_id' => 'required|exists:users,id',
            'data_consulta' => 'required|date',
            'hora_consulta' => 'required|date_format:H:i',
        ];

        // Se o usuário autenticado for admin, valida também o usuário comum
        if (Auth::user()->tipo === 'admin') {
            $rules['usuario_comum_id'] = 'required|exists:users,id';
        }

        $request->validate($rules);

        // Cria a consulta no banco de dados
        Consulta::create([
            'user_comum_id' => $request->input('usuario_comum_id', Auth::user()->id),
            'user_medico_id' => $request->input('usuario_medico_id'),
            'data_consulta' => $request->input('data_consulta'),
            'hora_consulta' => $request->input('hora_consulta'),
        ]);

        return redirect()->route('consultas.create')->with('success', 'Consulta agendada com sucesso!');
    }

    public function index()
{
    $user = Auth::user();

    if ($user->tipo == 'admin') {
        $consultas = Consulta::with('usuarioMedico')->get();
    } elseif ($user->tipo == 'medico') {
        $consultas = Consulta::where('user_medico_id', $user->id)
            ->with('usuarioMedico')
            ->get();
    } else {
        $consultas = Consulta::where('user_comum_id', $user->id)
            ->with('usuarioMedico')
            ->get();
    }

    return view('consultas.index', compact('consultas'));
}

    public function destroy($consultaId)
    {
        $consulta = Consulta::find($consultaId);

        if ($consulta) {
            $consulta->delete();
            return redirect()->route('consultas.index')->with('success', 'Consulta excluída com sucesso!');
        }

        return redirect()->route('consultas.index')->with('error', 'Consulta não encontrada.');
    }

}