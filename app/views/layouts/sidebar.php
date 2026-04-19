<?php
$user = auth_user();
$canManageEmpresa = has_permission('gestionar_empresa') || (int) ($user['rol_id'] ?? 0) === 1;
?>
<aside class="sidebar">
    <div class="brand">PA <span class="brand-text">Panel Admin</span></div>
    <nav>
        <a class="nav-icon <?= str_starts_with(request_path(), '/dashboard') ? 'active' : '' ?>" href="<?= url('dashboard') ?>" title="Dashboard">
            <i class="fa-solid fa-chart-line"></i><span class="nav-text">Dashboard</span>
        </a>
        <?php if (has_permission('gestionar_roles')): ?>
            <a class="nav-icon <?= str_starts_with(request_path(), '/roles') ? 'active' : '' ?>" href="<?= url('roles') ?>" title="Roles">
                <i class="fa-solid fa-user-shield"></i><span class="nav-text">Roles</span>
            </a>
        <?php endif; ?>
        <?php if (has_permission('gestionar_usuarios')): ?>
            <a class="nav-icon <?= str_starts_with(request_path(), '/usuarios') ? 'active' : '' ?>" href="<?= url('usuarios') ?>" title="Usuarios">
                <i class="fa-solid fa-users"></i><span class="nav-text">Usuarios</span>
            </a>
        <?php endif; ?>
        <?php if ($canManageEmpresa): ?>
            <a class="nav-icon <?= str_starts_with(request_path(), '/empresa') ? 'active' : '' ?>" href="<?= url('empresa') ?>" title="Empresa">
                <i class="fa-solid fa-building"></i><span class="nav-text">Empresa</span>
            </a>
        <?php endif; ?>
    </nav>
    <a class="nav-icon logout" href="<?= url('logout') ?>" title="Salir">
        <i class="fa-solid fa-right-from-bracket"></i><span class="nav-text">Salir</span>
    </a>
</aside>
