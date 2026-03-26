<?php

namespace App\Controllers\Notas;


use Core\Validacao;


class VisualizarController
{
    public function  confirm()
    {
        return view('notas/confirm');
    }

    public function show()
    {       
         $validacao = Validacao::validar([
            'senha' => ['required']

        ], request()->all());

        if ($validacao->naoPassou()) {
            return view('notas/confirm');
            exit();
        }

        if (!(password_verify(request()->post('senha'), auth()->senha)) ) {
            flash()->push('validacoes', ['senha' => ['Senha incorreta!']]);

            return view('notas/confirm');
        }
    
        session()->set('show', true);

        return redirect('/notas');

    }

    public function hide()
    {
        session()->forget('show');

        return redirect('/notas');

    }
}