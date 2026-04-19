<?php

namespace App\Models;

use App\Core\Model;

class Permiso extends Model
{
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM permisos ORDER BY modulo, nombre')->fetchAll();
    }

    public function countAll(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM permisos')->fetchColumn();
    }
}
