<?php

namespace App\Controllers;

use App\Models\Usuario;
use Core\Database;
use Core\Validacao;

class LoginController
{
    public function index()
    {
        return view('login', template: 'guest');
    }

    public function login()
    {
        $validacao = Validacao::validar([
            'email' => ['required', 'email'],
            'senha' => ['required'],

        ], request()->all());

        if ($validacao->naoPassou()) {
            return view('login', template: 'guest');
        }

        $database = new Database(config('database'));

        $usuario = $database->query(
            query: 'SELECT * FROM usuarios WHERE email = :email',
            class: Usuario::class,
            params: [request()->post('email')]
        )->fetch();

        if ($usuario && password_verify(request()->post('senha'), $usuario->senha)) {
            session()->set('auth', $usuario);
            flash()->push('mensagem', 'Seja bem-vindo '.$usuario->nome.'!');

            return redirect('/notas');
        } else {
            flash()->push('validacoes', ['email' => ['Usuário ou senha estão incorretos!']]);

            return view('login', template: 'guest');
        }
    }
}
