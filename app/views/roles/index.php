<?php require BASE_PATH . '/app/views/roles/form.php'; ?>
<section class="panel-card mt-3">
    <div class="d-flex justify-content-between mb-2"><h4>Listado de roles</h4></div>
    <table class="table table-sm custom-table">
        <thead><tr><th>ID</th><th>Nombre</th><th>Slug</th><th>Estado</th><th>Acciones</th></tr></thead>
        <tbody>
        <?php foreach ($roles as $rol): ?>
            <tr>
                <td><?= (int) $rol['id'] ?></td><td><?= htmlspecialchars($rol['nombre'], ENT_QUOTES) ?></td><td><?= htmlspecialchars($rol['slug'], ENT_QUOTES) ?></td><td><span class="badge <?= $rol['estado']==='activo'?'bg-success':'bg-secondary' ?>"><?= htmlspecialchars($rol['estado'], ENT_QUOTES) ?></span></td>
                <td class="d-flex gap-1">
                    <a class="btn btn-xs btn-outline-secondary" href="/roles?id=<?= (int) $rol['id'] ?>"><i class="fa fa-pen"></i></a>
                    <form method="post" action="/roles/delete" onsubmit="return confirm('¿Eliminar rol?');">
                        <?= csrf_field() ?><input type="hidden" name="id" value="<?= (int) $rol['id'] ?>"><button class="btn btn-xs btn-outline-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>
