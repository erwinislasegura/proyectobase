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
            'logo_color_url' => trim($_POST['logo_color_url'] ?? ''),
            'logo_blanco_url' => trim($_POST['logo_blanco_url'] ?? ''),
            'imap_host' => trim($_POST['imap_host'] ?? ''),
            'imap_puerto' => (int) ($_POST['imap_puerto'] ?? 993),
            'imap_cifrado' => trim($_POST['imap_cifrado'] ?? 'ssl'),
            'imap_usuario' => trim($_POST['imap_usuario'] ?? ''),
            'imap_password' => trim($_POST['imap_password'] ?? ''),
            'imap_remitente_nombre' => trim($_POST['imap_remitente_nombre'] ?? ''),
            'imap_remitente_correo' => trim($_POST['imap_remitente_correo'] ?? ''),
        ]);

        flash('success', $ok ? 'Configuración de empresa actualizada.' : 'No fue posible actualizar la configuración.');
        redirect('/empresa');
    }
}
