<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\RolPermiso;

class RolController extends Controller
{
    public function index(): void
    {
        $rolModel = new Rol();
        $permisoModel = new Permiso();
        $rpModel = new RolPermiso();

        $roles = $rolModel->all();
        $selected = isset($_GET['id']) ? $rolModel->find((int) $_GET['id']) : null;

        $this->view('roles/index', [
            'title' => 'Gestión de roles',
            'roles' => $roles,
            'permisos' => $permisoModel->all(),
            'selected' => $selected,
            'selectedPermisos' => $selected ? $rpModel->permisosRol((int) $selected['id']) : [],
        ]);
    }

    public function store(): void
    {
        verify_csrf();
        $model = new Rol();
        $ok = $model->create([
            'nombre' => trim($_POST['nombre'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'estado' => $_POST['estado'] ?? 'activo',
        ]);
        flash('success', $ok ? 'Rol creado correctamente.' : 'No fue posible crear el rol.');
        redirect('/roles');
    }

    public function update(): void
    {
        verify_csrf();
        $id = (int) ($_POST['id'] ?? 0);
        $model = new Rol();
        $ok = $model->update($id, [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'slug' => trim($_POST['slug'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'estado' => $_POST['estado'] ?? 'activo',
        ]);

        $rpModel = new RolPermiso();
        $rpModel->sync($id, $_POST['permisos'] ?? []);

        flash('success', $ok ? 'Rol actualizado correctamente.' : 'No fue posible actualizar el rol.');
        redirect('/roles');
    }

    public function destroy(): void
    {
        verify_csrf();
        (new Rol())->delete((int) ($_POST['id'] ?? 0));
        flash('success', 'Rol eliminado.');
        redirect('/roles');
    }
}
