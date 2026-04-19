<?php

namespace App\Models;

use App\Core\Model;

class Usuario extends Model
{
    public function findByLogin(string $login): ?array
    {
        $sql = "SELECT u.*, r.nombre AS rol_nombre FROM usuarios u INNER JOIN roles r ON r.id=u.rol_id WHERE (u.correo=:login OR u.username=:login) AND u.estado='activo' LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['login' => trim($login)]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function all(string $search = ''): array
    {
        $sql = "SELECT u.*, r.nombre AS rol_nombre FROM usuarios u INNER JOIN roles r ON r.id=u.rol_id";
        $params = [];
        if ($search !== '') {
            $sql .= ' WHERE u.nombres LIKE :q OR u.apellidos LIKE :q OR u.correo LIKE :q OR u.username LIKE :q';
            $params['q'] = '%' . $search . '%';
        }
        $sql .= ' ORDER BY u.id DESC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO usuarios (nombres,apellidos,correo,telefono,username,password,rol_id,estado,created_at,updated_at)
                VALUES (:nombres,:apellidos,:correo,:telefono,:username,:password,:rol_id,:estado,NOW(),NOW())";
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE usuarios SET nombres=:nombres, apellidos=:apellidos, correo=:correo, telefono=:telefono, username=:username, rol_id=:rol_id, estado=:estado, updated_at=NOW() WHERE id=:id";
        $data['id'] = $id;
        return $this->pdo->prepare($sql)->execute($data);
    }

    public function delete(int $id): bool
    {
        return $this->pdo->prepare('DELETE FROM usuarios WHERE id = :id')->execute(['id' => $id]);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function updatePassword(int $id, string $hash): bool
    {
        return $this->pdo->prepare('UPDATE usuarios SET password=:password, updated_at=NOW() WHERE id=:id')->execute(['id' => $id, 'password' => $hash]);
    }

    public function updateLastAccess(int $id): void
    {
        $this->pdo->prepare('UPDATE usuarios SET ultimo_acceso=NOW() WHERE id=:id')->execute(['id' => $id]);
    }

    public function countAll(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM usuarios')->fetchColumn();
    }

    public function latest(int $limit = 5): array
    {
        $stmt = $this->pdo->prepare('SELECT id, nombres, apellidos, correo, created_at FROM usuarios ORDER BY id DESC LIMIT :limit');
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function permisosByUsuario(int $usuarioId): array
    {
        $sql = 'SELECT p.slug FROM permisos p INNER JOIN rol_permiso rp ON rp.permiso_id=p.id INNER JOIN usuarios u ON u.rol_id=rp.rol_id WHERE u.id=:id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $usuarioId]);
        return array_column($stmt->fetchAll(), 'slug');
    }
}
