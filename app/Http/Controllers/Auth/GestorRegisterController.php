<?php

namespace App\Http\Controllers\Auth;

use App\Models\Gestor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class GestorRegisterController extends Controller
{
    public function showLoginForm()
    {
    	return view('auth.gestor-register');
    }

    public function cadastrar(Request $request)
    {
    	$this->validate($request, [
    		'name' => ['required', 'string'],
            'username' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:gestors'],
            'password' => ['required', 'min:4', 'confirmed']
    	]);

        Gestor::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('gestor.register.form')->with('msg', 'Funcionário contratado');
    }
}
