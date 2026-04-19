<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index(): void
    {
        $usuarioModel = new Usuario();
        $rolModel = new Rol();
        $permisoModel = new Permiso();

        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'usuariosCount' => $usuarioModel->countAll(),
            'rolesCount' => $rolModel->countAll(),
            'permisosCount' => $permisoModel->countAll(),
            'ultimosUsuarios' => $usuarioModel->latest(6),
        ]);
    }
}
