<?php

namespace App\Models;

use Core\Database;

class Nota
{
    public $id;
    public $usuario_id;
    public $titulo;
    public $nota;
    public $data_criacao;
    public $data_atualizacao;

    public static function all($search = null)
    {
        $database = new Database(config('database'));
        $query = "SELECT * FROM notas WHERE usuario_id = :usuario_id";
        $params = ['usuario_id' => auth()->id];

        if ($search) {
            $query .= " AND titulo LIKE :search";
            $params['search'] = '%' . $search . '%';
        }

        return $database->query(
            query: $query,
            class: self::class,
            params: $params
        )->fetchAll();
    }

    public static function create($data = [])
    {
        $database = new Database(config('database'));
        $data["now"] = date('Y-m-d H:i:s');

        $database->query(
            query: "INSERT INTO notas (
                usuario_id,
                titulo,
                nota, 
                data_criacao,
                data_atualizacao
            ) VALUES (
                :usuario_id,
                :titulo,
                :nota, 
                :data_criacao,
                :data_atualizacao
            )",
            params: [
                'usuario_id' => auth()->id,
                'titulo' => $data['titulo'],
                'nota' =>  trim(encrypt($data['nota'])),
                'data_criacao' => $data["now"],
                'data_atualizacao' => $data["now"]
            ]
        );
    }

    public static function update($id, $titulo, $nota)
    {
        $database = new Database(config('database'));
        $now = date('Y-m-d H:i:s');
        $params = [];

        $set = "titulo = :titulo,               
                data_atualizacao = :data_atualizacao";

        if ($nota) {
            $set .= ", nota = :nota";
            $params['nota'] = trim(encrypt($nota));
        }

        $query = "UPDATE notas SET
            $set
            WHERE id = :id AND usuario_id = :usuario_id";
    
        $params = array_merge($params,[
            'id' => $id,
            'titulo' => $titulo,
            'data_atualizacao' => $now,
            'usuario_id' => auth()->id,
        ]);

        $database->query(
            query: $query,
            params: $params
        );
    }

    public static function delete($id)
    {
        $database = new Database(config('database'));

        $database->query(
            query: "DELETE FROM notas WHERE id = :id AND usuario_id = :usuario_id",
            params: [
                'id' => $id,
                'usuario_id' => auth()->id,
            ]
        );
    }

    public function nota()
    {
        if (session()->get("show")) {
            return decrypt($this->nota);
        }

        return str_repeat('*', 10);
    }
}
