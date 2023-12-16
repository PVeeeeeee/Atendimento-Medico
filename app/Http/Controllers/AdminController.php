<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('auth.admin.admin');
    }

    public function listUsers(Request $request)
    {
        $order = $request->get('order', 'nome');
        $direction = $request->get('direction', 'asc');

        $users = User::orderBy($order, $direction)->get();

        return view('auth.admin.admin', compact('users', 'order', 'direction'));
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return view('auth.admin.showUser',['user'=>$user]);
    }
}
