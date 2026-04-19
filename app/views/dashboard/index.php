<div class="kpi-grid">
    <article class="kpi-card"><span>Usuarios</span><h3><?= (int) $usuariosCount ?></h3></article>
    <article class="kpi-card"><span>Roles</span><h3><?= (int) $rolesCount ?></h3></article>
    <article class="kpi-card"><span>Permisos</span><h3><?= (int) $permisosCount ?></h3></article>
</div>

<div class="panel-grid mt-3">
    <section class="panel-card">
        <div class="panel-head"><h4>Actividad mensual</h4></div>
        <canvas id="mainChart" height="120"></canvas>
    </section>
    <section class="panel-card">
        <div class="panel-head"><h4>Distribución por estado</h4></div>
        <canvas id="stateChart" height="120"></canvas>
    </section>
</div>

<section class="panel-card mt-3">
    <div class="panel-head"><h4>Últimos usuarios registrados</h4></div>
    <div class="table-responsive">
        <table class="table table-sm align-middle custom-table">
            <thead><tr><th>#</th><th>Nombre</th><th>Correo</th><th>Fecha</th></tr></thead>
            <tbody>
            <?php foreach ($ultimosUsuarios as $u): ?>
                <tr>
                    <td><?= (int) $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nombres'] . ' ' . $u['apellidos'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars($u['correo'], ENT_QUOTES) ?></td>
                    <td><?= htmlspecialchars($u['created_at'], ENT_QUOTES) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
