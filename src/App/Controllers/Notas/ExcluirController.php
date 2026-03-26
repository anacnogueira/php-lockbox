<?php

namespace App\Controllers\Notas;

use Core\Database;
use App\Models\Nota;

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
