<section class="panel-card">
    <form method="post" action="<?= url('empresa/update') ?>">
        <?= csrf_field() ?>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Datos de la empresa</h4>
            <button class="btn btn-sm btn-fuchsia">Guardar cambios</button>
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
    </div>
</section>
