<?php

declare(strict_types = 1);

namespace App\Controllers\Notas;

use App\Models\Nota;
use Core\Validacao;

class CriarController
{
    public function index()
    {
        return view('notas/criar');
    }

    public function store()
    {
        $data      = request()->all();
        $validacao = Validacao::validar([
            'titulo' => ['required', 'min:3', 'max:255'],
            'nota'   => ['required'],

        ], $data);

        if ($validacao->naoPassou()) {
            return view('notas/criar');

            exit();
        }

        Nota::create($data);

        flash()->push('mensagem', 'Nota criada com sucesso! 👍');

        redirect('/notas');
    }
}
