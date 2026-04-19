<?php
$user = auth_user();
$path = request_path();
$canManageRoles = has_permission('gestionar_roles');
$canManageUsuarios = has_permission('gestionar_usuarios');
$canManageEmpresa = has_permission('gestionar_empresa') || (int) ($user['rol_id'] ?? 0) === 1;
?>

<aside class="sidebar" id="mainSidebar">
    <div class="sidebar-head">
        <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Contraer menú">
            <i class="fa-solid fa-bars"></i>
        </button>
        <span class="sidebar-brand">Panel Admin</span>
    </div>

    <nav class="sidebar-nav">
        <a href="<?= url('dashboard') ?>" class="sidebar-link <?= str_starts_with($path, '/dashboard') ? 'active' : '' ?>" title="Dashboard">
            <i class="fa-solid fa-chart-line"></i><span>Dashboard</span>
        </a>
        <?php if ($canManageRoles): ?>
            <a href="<?= url('roles') ?>" class="sidebar-link <?= str_starts_with($path, '/roles') ? 'active' : '' ?>" title="Roles">
                <i class="fa-solid fa-user-shield"></i><span>Roles</span>
            </a>
        <?php endif; ?>
        <?php if ($canManageUsuarios): ?>
            <a href="<?= url('usuarios') ?>" class="sidebar-link <?= str_starts_with($path, '/usuarios') ? 'active' : '' ?>" title="Usuarios">
                <i class="fa-solid fa-users"></i><span>Usuarios</span>
            </a>
        <?php endif; ?>
        <?php if ($canManageEmpresa): ?>
            <a href="<?= url('empresa') ?>" class="sidebar-link <?= str_starts_with($path, '/empresa') ? 'active' : '' ?>" title="Empresa">
                <i class="fa-solid fa-building"></i><span>Empresa</span>
            </a>
        <?php endif; ?>
    </nav>

    <div class="sidebar-foot">
        <a href="<?= url('logout') ?>" class="sidebar-link" title="Salir">
            <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Salir</span>
        </a>
        <div class="sidebar-user" title="<?= htmlspecialchars($user['nombre'] ?? 'Usuario', ENT_QUOTES) ?>"><?= strtoupper(substr($user['nombre'] ?? 'A', 0, 1)) ?></div>
    </div>
</aside>

<button type="button" class="atl-expand-context-btn" id="atlExpandContext" aria-label="Expandir panel contextual">
    <i class="fa-solid fa-chevron-right"></i>
</button>

<div class="atl-search-overlay" id="atlSearchOverlay" hidden>
    <div class="atl-search-panel">
        <div class="atl-search-head">
            <strong>Búsqueda rápida</strong>
            <button type="button" data-close-search="1"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <input class="form-control form-control-sm" placeholder="Buscar usuarios, roles, vistas...">
        <div class="atl-search-list">
            <a href="<?= url('dashboard') ?>">Ir a Dashboard</a>
            <?php if ($canManageRoles): ?><a href="<?= url('roles') ?>">Ir a Roles</a><?php endif; ?>
            <?php if ($canManageUsuarios): ?><a href="<?= url('usuarios') ?>">Ir a Usuarios</a><?php endif; ?>
            <?php if ($canManageEmpresa): ?><a href="<?= url('empresa') ?>">Ir a Empresa</a><?php endif; ?>
        </div>
    </div>
</div>
