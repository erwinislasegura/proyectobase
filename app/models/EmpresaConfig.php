<?php

namespace App\Models;

use App\Core\Model;

class EmpresaConfig extends Model
{
    public function get(): ?array
    {
        $sql = 'SELECT * FROM configuracion_empresa ORDER BY id ASC LIMIT 1';
        $row = $this->pdo->query($sql)->fetch();

        return $row ?: null;
    }

    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE configuracion_empresa
                SET nombre=:nombre,
                    razon_social=:razon_social,
                    ruc=:ruc,
                    correo=:correo,
                    telefono=:telefono,
                    direccion=:direccion,
                    ciudad=:ciudad,
                    pais=:pais,
                    sitio_web=:sitio_web,
                    moneda=:moneda,
                    updated_at=NOW()
                WHERE id=:id';

        $data['id'] = $id;

        return $this->pdo->prepare($sql)->execute($data);
    }
}
