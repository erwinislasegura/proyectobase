<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\EmpresaConfig;

class EmpresaController extends Controller
{
    public function index(): void
    {
        $config = (new EmpresaConfig())->get();

        $this->view('empresa/index', [
            'title' => 'Configuración de empresa',
            'config' => $config,
        ]);
    }

    public function update(): void
    {
        verify_csrf();

        $model = new EmpresaConfig();
        $actual = $model->get();

        if (!$actual) {
            flash('error', 'No existe configuración inicial de empresa. Ejecuta migraciones/seeds.');
            redirect('/empresa');
        }

        $ok = $model->update((int) $actual['id'], [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'razon_social' => trim($_POST['razon_social'] ?? ''),
            'ruc' => trim($_POST['ruc'] ?? ''),
            'correo' => trim($_POST['correo'] ?? ''),
            'telefono' => trim($_POST['telefono'] ?? ''),
            'direccion' => trim($_POST['direccion'] ?? ''),
            'ciudad' => trim($_POST['ciudad'] ?? ''),
            'pais' => trim($_POST['pais'] ?? ''),
            'sitio_web' => trim($_POST['sitio_web'] ?? ''),
            'moneda' => trim($_POST['moneda'] ?? ''),
        ]);

        flash('success', $ok ? 'Configuración de empresa actualizada.' : 'No fue posible actualizar la configuración.');
        redirect('/empresa');
    }
}
