<?php

declare(strict_types = 1);

namespace App\Controllers\Notas;

use App\Models\Nota;

class IndexController
{
    public function __invoke()
    {
        $search = request()->get('search', null);
        $notas  = Nota::all($search);

        $notaSelecionada = $this->getNotaSelecionada($notas);

        if (! $notaSelecionada) {
            return view('notas/nao-encontrada');
        }

        //dd($notaSelecionada->dataCriacao()->diffForHumans());

        return view('notas/index', compact('notas', 'notaSelecionada'));
    }

    private function getNotaSelecionada($notas)
    {
        $id     = request()->get('id', (count($notas) > 0 ? $notas[0]->id : null));
        $filtro = array_filter($notas, fn ($n) => $n->id == $id);

        return array_pop($filtro);
    }
}
