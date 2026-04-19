<?php $user = auth_user(); ?>
<aside class="sidebar">
    <div class="brand">PA</div>
    <nav>
        <a class="nav-icon <?= str_starts_with(request_path(), '/dashboard') ? 'active' : '' ?>" href="<?= url('dashboard') ?>" title="Dashboard"><i class="fa-solid fa-chart-line"></i></a>
        <?php if (has_permission('gestionar_roles')): ?>
            <a class="nav-icon <?= str_starts_with(request_path(), '/roles') ? 'active' : '' ?>" href="<?= url('roles') ?>" title="Roles"><i class="fa-solid fa-user-shield"></i></a>
        <?php endif; ?>
        <?php if (has_permission('gestionar_usuarios')): ?>
            <a class="nav-icon <?= str_starts_with(request_path(), '/usuarios') ? 'active' : '' ?>" href="<?= url('usuarios') ?>" title="Usuarios"><i class="fa-solid fa-users"></i></a>
        <?php endif; ?>
    </nav>
    <a class="nav-icon logout" href="<?= url('logout') ?>" title="Salir"><i class="fa-solid fa-right-from-bracket"></i></a>
</aside>
