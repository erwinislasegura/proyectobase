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

        $logoColorPath = $this->handleLogoUpload('logo_color_file', $actual['logo_color_url'] ?? null);
        if ($logoColorPath === null) {
            flash('error', 'El logo color debe ser una imagen válida (jpg, jpeg, png, webp, svg).');
            redirect('/empresa');
        }

        $logoBlancoPath = $this->handleLogoUpload('logo_blanco_file', $actual['logo_blanco_url'] ?? null);
        if ($logoBlancoPath === null) {
            flash('error', 'El logo blanco debe ser una imagen válida (jpg, jpeg, png, webp, svg).');
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
            'logo_color_url' => $logoColorPath ?? '',
            'logo_blanco_url' => $logoBlancoPath ?? '',
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

    private function handleLogoUpload(string $fileKey, ?string $currentPath): ?string
    {
        if (!isset($_FILES[$fileKey]) || !is_array($_FILES[$fileKey])) {
            return $currentPath;
        }

        $file = $_FILES[$fileKey];
        $error = (int) ($file['error'] ?? UPLOAD_ERR_NO_FILE);

        if ($error === UPLOAD_ERR_NO_FILE) {
            return $currentPath;
        }

        if ($error !== UPLOAD_ERR_OK) {
            return null;
        }

        $tmpName = (string) ($file['tmp_name'] ?? '');
        $originalName = (string) ($file['name'] ?? '');
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

        if ($tmpName === '' || !is_uploaded_file($tmpName) || !in_array($extension, $allowedExtensions, true)) {
            return null;
        }

        $uploadDir = BASE_PATH . '/public/uploads/empresa/logos';
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
            return null;
        }

        $safeFilename = $fileKey . '_' . date('YmdHis') . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
        $destination = $uploadDir . '/' . $safeFilename;

        if (!move_uploaded_file($tmpName, $destination)) {
            return null;
        }

        return 'public/uploads/empresa/logos/' . $safeFilename;
    }
}
