<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Rol;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index(): void
    {
        $q = trim($_GET['q'] ?? '');
        $model = new Usuario();

        $this->view('usuarios/index', [
            'title' => 'Gestión de usuarios',
            'usuarios' => $model->all($q),
            'roles' => (new Rol())->all(),
            'selected' => isset($_GET['id']) ? $model->find((int) $_GET['id']) : null,
            'q' => $q,
        ]);
    }

    public function store(): void
    {
        verify_csrf();
        $ok = (new Usuario())->create([
            'nombres' => trim($_POST['nombres'] ?? ''),
            'apellidos' => trim($_POST['apellidos'] ?? ''),
            'correo' => trim($_POST['correo'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'username' => trim($_POST['username'] ?? ''),
            'password' => password_hash($_POST['password'] ?? 'Temp123*', PASSWORD_DEFAULT),
            'rol_id' => (int) ($_POST['rol_id'] ?? 0),
            'estado' => $_POST['estado'] ?? 'activo',
        ]);
        flash('success', $ok ? 'Usuario creado correctamente.' : 'No fue posible crear el usuario.');
        redirect('/usuarios');
    }

    public function update(): void
    {
        verify_csrf();
        $id = (int) ($_POST['id'] ?? 0);
        $ok = (new Usuario())->update($id, [
            'nombres' => trim($_POST['nombres'] ?? ''),
            'apellidos' => trim($_POST['apellidos'] ?? ''),
            'correo' => trim($_POST['correo'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'username' => trim($_POST['username'] ?? ''),
            'rol_id' => (int) ($_POST['rol_id'] ?? 0),
            'estado' => $_POST['estado'] ?? 'activo',
        ]);
        flash('success', $ok ? 'Usuario actualizado correctamente.' : 'No fue posible actualizar.');
        redirect('/usuarios');
    }

    public function destroy(): void
    {
        verify_csrf();
        (new Usuario())->delete((int) ($_POST['id'] ?? 0));
        flash('success', 'Usuario eliminado.');
        redirect('/usuarios');
    }

    public function resetPassword(): void
    {
        verify_csrf();
        $id = (int) ($_POST['id'] ?? 0);
        (new Usuario())->updatePassword($id, password_hash('Admin123*', PASSWORD_DEFAULT));
        flash('success', 'Contraseña restablecida a Admin123*.');
        redirect('/usuarios');
    }
}
