<?php

namespace App\Controllers\Notas;

use App\Models\Nota;
use Core\Database;

class ExcluirController
{
    public function __invoke()
    {
        $database = new Database(config('database'));

        Nota::delete(request()->post('id'));

        flash()->push('mensagem', 'Nota excluida com sucesso! 👍');

        return redirect('/notas');
    }
}
