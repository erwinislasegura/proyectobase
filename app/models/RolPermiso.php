<?php

namespace App\Models;

use App\Core\Model;

class RolPermiso extends Model
{
    public function permisosRol(int $rolId): array
    {
        $stmt = $this->pdo->prepare('SELECT permiso_id FROM rol_permiso WHERE rol_id=:rol_id');
        $stmt->execute(['rol_id' => $rolId]);
        return array_map('intval', array_column($stmt->fetchAll(), 'permiso_id'));
    }

    public function sync(int $rolId, array $permisos): void
    {
        $this->pdo->beginTransaction();
        $this->pdo->prepare('DELETE FROM rol_permiso WHERE rol_id=:rol_id')->execute(['rol_id' => $rolId]);
        $stmt = $this->pdo->prepare('INSERT INTO rol_permiso (rol_id, permiso_id, created_at) VALUES (:rol,:permiso,NOW())');
        foreach ($permisos as $permisoId) {
            $stmt->execute(['rol' => $rolId, 'permiso' => (int) $permisoId]);
        }
        $this->pdo->commit();
    }
}
