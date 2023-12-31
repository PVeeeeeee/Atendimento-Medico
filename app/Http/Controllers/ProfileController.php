<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Outros métodos do controller...

    /**
     * Remove o usuário logado.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = Auth::user();

        if ($user) {
            /** @var \App\Models\User $user **/
            $user->delete();
            Auth::logout(); // Desconecta o usuário após excluir a conta
            return redirect('/login')->with('success', 'Conta excluída com sucesso. Faça login para continuar.');
        }

        return redirect('/')->with('error', 'Usuário não autenticado ou não encontrado.');
    }

        public function edit()
        {
            return view('profile.edit');
        }
    
        public function update(Request $request)
        {
            $user = Auth::user();

            if ($user) {
                // Criar regras de validação dinamicamente com base nos campos fornecidos
                $rules = [];
                
                if ($request->filled('nome')) {
                    $rules['nome'] = 'string|max:255';
                }

                if ($request->filled('email')) {
                    $rules['email'] = 'string|email|max:255|unique:users,email,' . $user->id;
                }

                if ($request->filled('password')) {
                    $rules['password'] = 'string|min:6|confirmed';
                }

                $this->validate($request, $rules);

                // Atualizar apenas os campos fornecidos
                if ($request->filled('nome')) {
                    $user->nome = $request->input('nome');
                }

                if ($request->filled('email')) {
                    $user->email = $request->input('email');
                }

                if ($request->filled('password')) {
                    $user->password = Hash::make($request->input('password'));
                }

                /** @var \App\Models\User $user **/
                $user->save();

                return redirect('/home')->with('success', 'Perfil atualizado com sucesso!');
            }

            return redirect('/')->with('error', 'Usuário não autenticado ou não encontrado.');
        }
      

        public function editUser($userId)
        {
            // $user = Auth::user();
            $user = DB::table('users')->where('id', $userId)->first();
            
            if (Auth::user()->tipo == 'admin') {
                return view('auth.admin.editAdmin', compact('user'));
            }

            return redirect('/')->with('error', 'Usuário não autenticado ou não encontrado.');
        }

        public function updateUser(Request $request, $userId)
        {
            $adminUser = Auth::user();
            $user = User::find($userId);

            if ($adminUser && $adminUser->tipo == 'admin' && $user) {
                $this->validate($request, [
                    'nome' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                    'cpf' => 'required|string|max:11|unique:users,cpf,' . $user->id,
                    'data_nasc' => 'required|date',
                    'tipo' => 'required|in:admin,comum,medico',
                    'funcao' => 'required|string',
                    'password' => 'nullable|string|min:6|confirmed',
                ]);

                $user->nome = $request->input('nome');
                $user->email = $request->input('email');
                $user->cpf = $request->input('cpf');
                $user->data_nasc = $request->input('data_nasc');
                $user->tipo = $request->input('tipo');


                if ($user->tipo == 'medico') {
                    $user->funcao = $request->input('funcao') ?: null;
                }if ($user->tipo == 'admin') {
                    $user->funcao = 'Administrador';
                } elseif ($user->tipo == 'comum') {
                    $user->funcao = 'Paciente';
                } 

                if ($request->filled('password')) {
                    $user->password = Hash::make($request->input('password'));
                }

                $user->save();

                return redirect()->route('admin.showUser', $user->id)->with('success', 'Perfil atualizado com sucesso!');
            }

            return redirect()->back()->with('error', 'Erro ao atualizar o perfil.');
        }


}
