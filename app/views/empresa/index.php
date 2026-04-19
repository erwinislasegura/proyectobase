<section class="panel-card">
    <form method="post" action="<?= url('empresa/update') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="alert alert-info py-2 mb-3">
            Configuración global de la empresa. Los logos y el correo IMAP definidos aquí se usarán como base para
            informes, notificaciones y futuras integraciones del proyecto (incluyendo implementaciones en cada chat/módulo).
        </div>

        <div class="row g-2">
            <div class="col-md-4"><label>Nombre comercial</label><input class="form-control form-control-sm" name="nombre" required value="<?= htmlspecialchars($config['nombre'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-4"><label>Razón social</label><input class="form-control form-control-sm" name="razon_social" value="<?= htmlspecialchars($config['razon_social'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-4"><label>RUC / NIT</label><input class="form-control form-control-sm" name="ruc" value="<?= htmlspecialchars($config['ruc'] ?? '', ENT_QUOTES) ?>"></div>

            <div class="col-md-3"><label>Correo</label><input type="email" class="form-control form-control-sm" name="correo" value="<?= htmlspecialchars($config['correo'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-3"><label>Teléfono</label><input class="form-control form-control-sm" name="telefono" value="<?= htmlspecialchars($config['telefono'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-3"><label>Ciudad</label><input class="form-control form-control-sm" name="ciudad" value="<?= htmlspecialchars($config['ciudad'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-3"><label>País</label><input class="form-control form-control-sm" name="pais" value="<?= htmlspecialchars($config['pais'] ?? '', ENT_QUOTES) ?>"></div>

            <div class="col-md-8"><label>Dirección</label><input class="form-control form-control-sm" name="direccion" value="<?= htmlspecialchars($config['direccion'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-4"><label>Sitio web</label><input class="form-control form-control-sm" name="sitio_web" placeholder="https://..." value="<?= htmlspecialchars($config['sitio_web'] ?? '', ENT_QUOTES) ?>"></div>

            <div class="col-md-3"><label>Moneda</label><input class="form-control form-control-sm" name="moneda" value="<?= htmlspecialchars($config['moneda'] ?? 'USD', ENT_QUOTES) ?>"></div>
            <div class="col-md-4">
                <label>Logo color (archivo)</label>
                <input type="file" class="form-control form-control-sm" name="logo_color_file" accept=".jpg,.jpeg,.png,.webp,.svg,image/*">
                <small class="text-muted d-block">Actual: <?= htmlspecialchars($config['logo_color_url'] ?? 'No configurado', ENT_QUOTES) ?></small>
            </div>
            <div class="col-md-5">
                <label>Logo blanco (archivo)</label>
                <input type="file" class="form-control form-control-sm" name="logo_blanco_file" accept=".jpg,.jpeg,.png,.webp,.svg,image/*">
                <small class="text-muted d-block">Actual: <?= htmlspecialchars($config['logo_blanco_url'] ?? 'No configurado', ENT_QUOTES) ?></small>
            </div>

            <div class="col-12 mt-2">
                <h6 class="mb-1">Correo IMAP para reportes y notificaciones</h6>
                <small class="text-muted">Este buzón será el origen estándar para envío/gestión de informes y alertas en todo el sistema.</small>
            </div>
            <div class="col-md-4"><label>Servidor IMAP</label><input class="form-control form-control-sm" name="imap_host" placeholder="imap.tu-dominio.com" value="<?= htmlspecialchars($config['imap_host'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-2"><label>Puerto</label><input type="number" min="1" class="form-control form-control-sm" name="imap_puerto" value="<?= htmlspecialchars((string)($config['imap_puerto'] ?? '993'), ENT_QUOTES) ?>"></div>
            <div class="col-md-2">
                <label>Cifrado</label>
                <select class="form-select form-select-sm" name="imap_cifrado">
                    <?php $imapCifrado = $config['imap_cifrado'] ?? 'ssl'; ?>
                    <option value="ssl" <?= $imapCifrado === 'ssl' ? 'selected' : '' ?>>SSL</option>
                    <option value="tls" <?= $imapCifrado === 'tls' ? 'selected' : '' ?>>TLS</option>
                    <option value="none" <?= $imapCifrado === 'none' ? 'selected' : '' ?>>Sin cifrado</option>
                </select>
            </div>
            <div class="col-md-4"><label>Usuario IMAP</label><input class="form-control form-control-sm" name="imap_usuario" value="<?= htmlspecialchars($config['imap_usuario'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-4"><label>Contraseña IMAP</label><input type="password" class="form-control form-control-sm" name="imap_password" value="<?= htmlspecialchars($config['imap_password'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-4"><label>Nombre remitente</label><input class="form-control form-control-sm" name="imap_remitente_nombre" value="<?= htmlspecialchars($config['imap_remitente_nombre'] ?? '', ENT_QUOTES) ?>"></div>
            <div class="col-md-4"><label>Correo remitente</label><input type="email" class="form-control form-control-sm" name="imap_remitente_correo" value="<?= htmlspecialchars($config['imap_remitente_correo'] ?? '', ENT_QUOTES) ?>"></div>

            <div class="col-md-12 d-flex align-items-end">
                <button class="btn btn-sm btn-fuchsia w-100">Guardar configuración</button>
            </div>
        </div>
    </form>
</section>

<section class="panel-card mt-3">
    <h5 class="mb-2">Vista rápida</h5>
    <div class="row g-2">
        <div class="col-md-6">
            <small class="text-muted d-block">Empresa</small>
            <strong><?= htmlspecialchars($config['nombre'] ?? '-', ENT_QUOTES) ?></strong>
        </div>
        <div class="col-md-6">
            <small class="text-muted d-block">RUC / NIT</small>
            <strong><?= htmlspecialchars($config['ruc'] ?? '-', ENT_QUOTES) ?></strong>
        </div>
        <div class="col-md-6">
            <small class="text-muted d-block">Contacto</small>
            <strong><?= htmlspecialchars(($config['correo'] ?? '-') . ' / ' . ($config['telefono'] ?? '-'), ENT_QUOTES) ?></strong>
        </div>
        <div class="col-md-6">
            <small class="text-muted d-block">Ubicación</small>
            <strong><?= htmlspecialchars(trim(($config['ciudad'] ?? '') . ' ' . ($config['pais'] ?? '')) ?: '-', ENT_QUOTES) ?></strong>
        </div>
        <div class="col-md-6">
            <small class="text-muted d-block">Logos configurados</small>
            <strong><?= htmlspecialchars((($config['logo_color_url'] ?? '') !== '' ? 'Color' : '') . ((($config['logo_color_url'] ?? '') !== '' && ($config['logo_blanco_url'] ?? '') !== '') ? ' / ' : '') . (($config['logo_blanco_url'] ?? '') !== '' ? 'Blanco' : ''), ENT_QUOTES) ?: '-' ?></strong>
        </div>
        <div class="col-md-6">
            <small class="text-muted d-block">Buzón IMAP</small>
            <strong><?= htmlspecialchars(($config['imap_usuario'] ?? '-') . ' @ ' . ($config['imap_host'] ?? '-'), ENT_QUOTES) ?></strong>
        </div>
    </div>
</section>
