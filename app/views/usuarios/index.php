<?php require BASE_PATH . '/app/views/usuarios/form.php'; ?>
<section class="panel-card mt-3">
    <form class="d-flex gap-2 mb-2" method="get" action="<?= url('usuarios') ?>"><input class="form-control form-control-sm" name="q" placeholder="Buscar usuarios" value="<?= htmlspecialchars($q, ENT_QUOTES) ?>"><button class="btn btn-sm btn-outline-secondary">Filtrar</button></form>
    <table class="table table-sm custom-table align-middle">
        <thead><tr><th>ID</th><th>Usuario</th><th>Rol</th><th>Correo</th><th>Estado</th><th>Acciones</th></tr></thead>
        <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= (int) $usuario['id'] ?></td>
                <td><div class="d-flex align-items-center gap-2"><span class="avatar-mini"><?= strtoupper($usuario['nombres'][0]) ?></span><?= htmlspecialchars($usuario['nombres'] . ' ' . $usuario['apellidos'], ENT_QUOTES) ?></div></td>
                <td><?= htmlspecialchars($usuario['rol_nombre'], ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($usuario['correo'], ENT_QUOTES) ?></td>
                <td><span class="badge <?= $usuario['estado']==='activo'?'bg-success':'bg-secondary' ?>"><?= htmlspecialchars($usuario['estado'], ENT_QUOTES) ?></span></td>
                <td class="d-flex gap-1">
                    <a class="btn btn-xs btn-outline-secondary" href="<?= url('usuarios?id=' . (int) $usuario['id']) ?>"><i class="fa fa-pen"></i></a>
                    <form method="post" action="<?= url('usuarios/reset-password') ?>"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int) $usuario['id'] ?>"><button class="btn btn-xs btn-outline-warning"><i class="fa fa-key"></i></button></form>
                    <form method="post" action="<?= url('usuarios/delete') ?>" onsubmit="return confirm('¿Eliminar usuario?');"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int) $usuario['id'] ?>"><button class="btn btn-xs btn-outline-danger"><i class="fa fa-trash"></i></button></form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>
