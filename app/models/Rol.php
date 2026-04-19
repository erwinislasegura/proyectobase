<?php

namespace App\Models;

use App\Core\Model;

class Rol extends Model
{
    public function all(): array
    {
        return $this->pdo->query('SELECT * FROM roles ORDER BY id DESC')->fetchAll();
    }

    public function countAll(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM roles')->fetchColumn();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM roles WHERE id=:id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function create(array $data): bool
    {
        $sql = 'INSERT INTO roles (nombre, slug, descripcion, estado, created_at, updated_at) VALUES (:nombre,:slug,:descripcion,:estado,NOW(),NOW())';
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = 'UPDATE roles SET nombre=:nombre, slug=:slug, descripcion=:descripcion, estado=:estado, updated_at=NOW() WHERE id=:id';
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function delete(int $id): bool
    {
        return $this->pdo->prepare('DELETE FROM roles WHERE id=:id')->execute(['id' => $id]);
    }
}
