<form method="post" action="<?= $selected ? '/roles/update' : '/roles/store' ?>" class="panel-card">
    <?= csrf_field() ?>
    <?php if ($selected): ?><input type="hidden" name="id" value="<?= (int) $selected['id'] ?>"><?php endif; ?>
    <div class="row g-2">
        <div class="col-md-4"><label>Nombre</label><input class="form-control form-control-sm" name="nombre" required value="<?= htmlspecialchars($selected['nombre'] ?? '', ENT_QUOTES) ?>"></div>
        <div class="col-md-3"><label>Slug</label><input class="form-control form-control-sm" name="slug" required value="<?= htmlspecialchars($selected['slug'] ?? '', ENT_QUOTES) ?>"></div>
        <div class="col-md-3"><label>Estado</label><select name="estado" class="form-select form-select-sm"><option value="activo">Activo</option><option value="inactivo" <?= ($selected['estado'] ?? '')==='inactivo'?'selected':'' ?>>Inactivo</option></select></div>
        <div class="col-md-2 d-flex align-items-end"><button class="btn btn-sm btn-fuchsia w-100"><?= $selected ? 'Actualizar' : 'Crear' ?></button></div>
        <div class="col-12"><label>Descripción</label><textarea class="form-control form-control-sm" name="descripcion"><?= htmlspecialchars($selected['descripcion'] ?? '', ENT_QUOTES) ?></textarea></div>
    </div>

    <?php if ($selected): ?>
    <div class="mt-3">
        <label class="d-block mb-2">Permisos</label>
        <div class="permission-grid">
            <?php foreach ($permisos as $permiso): ?>
                <label><input type="checkbox" name="permisos[]" value="<?= (int) $permiso['id'] ?>" <?= in_array((int) $permiso['id'], $selectedPermisos, true) ? 'checked' : '' ?>> <?= htmlspecialchars($permiso['nombre'], ENT_QUOTES) ?></label>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</form>
