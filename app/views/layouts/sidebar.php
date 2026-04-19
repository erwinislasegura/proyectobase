<?php $user = auth_user(); ?>
<aside class="sidebar">
    <div class="brand">PA</div>
    <nav>
        <a class="nav-icon <?= str_starts_with($_SERVER['REQUEST_URI'], '/dashboard') ? 'active' : '' ?>" href="/dashboard" title="Dashboard"><i class="fa-solid fa-chart-line"></i></a>
        <?php if (has_permission('gestionar_roles')): ?>
            <a class="nav-icon <?= str_starts_with($_SERVER['REQUEST_URI'], '/roles') ? 'active' : '' ?>" href="/roles" title="Roles"><i class="fa-solid fa-user-shield"></i></a>
        <?php endif; ?>
        <?php if (has_permission('gestionar_usuarios')): ?>
            <a class="nav-icon <?= str_starts_with($_SERVER['REQUEST_URI'], '/usuarios') ? 'active' : '' ?>" href="/usuarios" title="Usuarios"><i class="fa-solid fa-users"></i></a>
        <?php endif; ?>
    </nav>
    <a class="nav-icon logout" href="/logout" title="Salir"><i class="fa-solid fa-right-from-bracket"></i></a>
</aside>
