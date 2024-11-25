<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function store(Request $request) {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ], [
            'email.required'    => 'Campo Obrigatório',
            'email.email'       => 'Email inválido',
            'password.required' => 'Obrigatório senha'
        ]);

        $credentials = $request->only('email', 'password');
        $authenticated = Auth::attempt($credentials, false);
        // dd($authenticated);
        if(!$authenticated) {
            return redirect()->route('login.index')->withErrors(['error' => 'Email ou senha inválidos']);
        }

        return redirect()->route('login.index')->with('success', 'Logged in');

        // try {
        //     $authenticated = Auth::attempt($credentials);
        //     dd($authenticated); // Exibe o valor de retorno
        // } catch (\Exception $e) {
        //     // Captura qualquer erro relacionado a autenticação
        //     dd($e->getMessage());
        // }        

    }

    public function destroy() {
        dd('logout');
    }
}
