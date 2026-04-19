<form method="post" action="<?= url($selected ? 'usuarios/update' : 'usuarios/store') ?>" class="panel-card">
    <?= csrf_field() ?>
    <?php if ($selected): ?><input type="hidden" name="id" value="<?= (int) $selected['id'] ?>"><?php endif; ?>
    <div class="row g-2">
        <div class="col-md-3"><label>Nombres</label><input class="form-control form-control-sm" name="nombres" required value="<?= htmlspecialchars($selected['nombres'] ?? '', ENT_QUOTES) ?>"></div>
        <div class="col-md-3"><label>Apellidos</label><input class="form-control form-control-sm" name="apellidos" required value="<?= htmlspecialchars($selected['apellidos'] ?? '', ENT_QUOTES) ?>"></div>
        <div class="col-md-3"><label>Correo</label><input type="email" class="form-control form-control-sm" name="correo" required value="<?= htmlspecialchars($selected['correo'] ?? '', ENT_QUOTES) ?>"></div>
        <div class="col-md-3"><label>Username</label><input class="form-control form-control-sm" name="username" required value="<?= htmlspecialchars($selected['username'] ?? '', ENT_QUOTES) ?>"></div>
        <div class="col-md-2"><label>Teléfono</label><input class="form-control form-control-sm" name="telefono" value="<?= htmlspecialchars($selected['telefono'] ?? '', ENT_QUOTES) ?>"></div>
        <div class="col-md-2"><label>Rol</label><select name="rol_id" class="form-select form-select-sm"><?php foreach($roles as $rol): ?><option value="<?= (int) $rol['id'] ?>" <?= (int)($selected['rol_id'] ?? 0)===(int)$rol['id']?'selected':'' ?>><?= htmlspecialchars($rol['nombre'], ENT_QUOTES) ?></option><?php endforeach; ?></select></div>
        <div class="col-md-2"><label>Estado</label><select name="estado" class="form-select form-select-sm"><option value="activo">Activo</option><option value="inactivo" <?= ($selected['estado'] ?? '')==='inactivo'?'selected':'' ?>>Inactivo</option></select></div>
        <?php if (!$selected): ?><div class="col-md-3"><label>Contraseña inicial</label><input class="form-control form-control-sm" name="password" value="Admin123*"></div><?php endif; ?>
        <div class="col-md-3 d-flex align-items-end"><button class="btn btn-sm btn-fuchsia w-100"><?= $selected ? 'Actualizar usuario' : 'Crear usuario' ?></button></div>
    </div>
</form>
