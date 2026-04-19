<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (auth_user()) {
            redirect('/dashboard');
        }
        $this->view('auth/login', [], '');
    }

    public function login(): void
    {
        verify_csrf();

        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($login === '' || $password === '') {
            flash('error', 'Debes completar usuario/correo y contraseña.');
            redirect('/login');
        }

        $userModel = new Usuario();
        $user = $userModel->findByLogin($login);

        if (!$user || !password_verify($password, $user['password'])) {
            flash('error', 'Credenciales inválidas.');
            redirect('/login');
        }

        $permissions = $userModel->permisosByUsuario((int) $user['id']);
        $userModel->updateLastAccess((int) $user['id']);

        $_SESSION['user'] = [
            'id' => (int) $user['id'],
            'nombre' => $user['nombres'] . ' ' . $user['apellidos'],
            'correo' => $user['correo'],
            'username' => $user['username'],
            'rol_id' => (int) $user['rol_id'],
            'rol' => $user['rol_nombre'],
            'permissions' => $permissions,
        ];

        redirect('/dashboard');
    }

    public function logout(): void
    {
        session_destroy();
        redirect('/');
    }
}
