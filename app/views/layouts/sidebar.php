<?php
$user = auth_user();
$path = request_path();

$module = 'dashboard';
if (str_starts_with($path, '/roles')) {
    $module = 'roles';
} elseif (str_starts_with($path, '/usuarios')) {
    $module = 'usuarios';
} elseif (str_starts_with($path, '/empresa')) {
    $module = 'empresa';
}

$tab = trim($_GET['tab'] ?? '');
$canManageRoles = has_permission('gestionar_roles');
$canManageUsuarios = has_permission('gestionar_usuarios');
$canManageEmpresa = has_permission('gestionar_empresa') || (int) ($user['rol_id'] ?? 0) === 1;

$contextMap = [
    'dashboard' => [
        'title' => 'Dashboard',
        'subtitle' => 'Vista general',
        'sections' => [
            ['label' => 'General', 'items' => [
                ['label' => 'Inicio', 'url' => url('dashboard'), 'active' => $tab === '' || $tab === 'inicio'],
                ['label' => 'Resumen', 'url' => url('dashboard?tab=resumen'), 'active' => $tab === 'resumen'],
                ['label' => 'Actividad reciente', 'url' => url('dashboard?tab=actividad'), 'active' => $tab === 'actividad'],
            ]],
        ],
    ],
    'roles' => [
        'title' => 'Roles',
        'subtitle' => 'Control de perfiles',
        'sections' => [
            ['label' => 'Administración', 'items' => [
                ['label' => 'Listado de roles', 'url' => url('roles'), 'active' => $tab === '' || $tab === 'listado'],
                ['label' => 'Crear rol', 'url' => url('roles?tab=crear'), 'active' => $tab === 'crear'],
                ['label' => 'Permisos', 'url' => url('roles?tab=permisos'), 'active' => $tab === 'permisos'],
            ]],
        ],
    ],
    'usuarios' => [
        'title' => 'Usuarios',
        'subtitle' => 'Gestión de cuentas',
        'sections' => [
            ['label' => 'Administración', 'items' => [
                ['label' => 'Listado de usuarios', 'url' => url('usuarios'), 'active' => $tab === '' || $tab === 'listado'],
                ['label' => 'Crear usuario', 'url' => url('usuarios?tab=crear'), 'active' => $tab === 'crear'],
                ['label' => 'Estados', 'url' => url('usuarios?tab=estados'), 'active' => $tab === 'estados'],
                ['label' => 'Accesos recientes', 'url' => url('usuarios?tab=accesos'), 'active' => $tab === 'accesos'],
            ]],
        ],
    ],
    'empresa' => [
        'title' => 'Empresa',
        'subtitle' => 'Configuración corporativa',
        'sections' => [
            ['label' => 'Configuración', 'items' => [
                ['label' => 'Datos generales', 'url' => url('empresa'), 'active' => true],
            ]],
        ],
    ],
];

$context = $contextMap[$module] ?? $contextMap['dashboard'];
?>

<aside class="atl-nav-shell">
    <div class="atl-global-sidebar">
        <div class="atl-global-top">
            <a href="<?= url('dashboard') ?>" class="atl-gbtn atl-brand" data-tooltip="Inicio" aria-label="Inicio">
                <i class="fa-solid fa-layer-group"></i>
            </a>

            <a href="<?= url('dashboard') ?>" class="atl-gbtn <?= $module === 'dashboard' ? 'active' : '' ?>" data-tooltip="Dashboard" aria-label="Dashboard"><i class="fa-solid fa-house"></i></a>
            <?php if ($canManageRoles): ?><a href="<?= url('roles') ?>" class="atl-gbtn <?= $module === 'roles' ? 'active' : '' ?>" data-tooltip="Roles" aria-label="Roles"><i class="fa-solid fa-user-shield"></i></a><?php endif; ?>
            <?php if ($canManageUsuarios): ?><a href="<?= url('usuarios') ?>" class="atl-gbtn <?= $module === 'usuarios' ? 'active' : '' ?>" data-tooltip="Usuarios" aria-label="Usuarios"><i class="fa-solid fa-users"></i></a><?php endif; ?>
            <?php if ($canManageEmpresa): ?><a href="<?= url('empresa') ?>" class="atl-gbtn <?= $module === 'empresa' ? 'active' : '' ?>" data-tooltip="Empresa" aria-label="Empresa"><i class="fa-solid fa-building"></i></a><?php endif; ?>

            <div class="atl-gbtn-separator"></div>

            <button type="button" class="atl-gbtn" data-tooltip="Search" aria-label="Search" data-open-search="1"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="<?= url('usuarios?tab=crear') ?>" class="atl-gbtn" data-tooltip="Create" aria-label="Create"><i class="fa-solid fa-plus"></i></a>
            <button type="button" class="atl-gbtn" data-tooltip="Notifications" aria-label="Notifications"><i class="fa-regular fa-bell"></i></button>
            <button type="button" class="atl-gbtn" data-tooltip="Apps" aria-label="Apps"><i class="fa-solid fa-grip"></i></button>
        </div>

        <div class="atl-global-bottom">
            <a href="<?= url('logout') ?>" class="atl-gbtn" data-tooltip="Salir" aria-label="Salir"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            <div class="atl-avatar" data-tooltip="<?= htmlspecialchars($user['nombre'] ?? 'Usuario', ENT_QUOTES) ?>">
                <?= strtoupper(substr($user['nombre'] ?? 'A', 0, 1)) ?>
            </div>
        </div>
    </div>

    <div class="atl-context-sidebar" id="atlContextSidebar">
        <div class="atl-context-header">
            <div>
                <h2><?= htmlspecialchars($context['title'], ENT_QUOTES) ?></h2>
                <small><?= htmlspecialchars($context['subtitle'], ENT_QUOTES) ?></small>
            </div>
            <button type="button" class="atl-collapse-btn" aria-label="Colapsar panel" id="atlCollapseContext"><i class="fa-solid fa-chevron-left"></i></button>
        </div>

        <div class="atl-context-body">
            <?php foreach ($context['sections'] as $section): ?>
                <details class="atl-context-group" open>
                    <summary><?= htmlspecialchars($section['label'], ENT_QUOTES) ?></summary>
                    <nav>
                        <?php foreach ($section['items'] as $item): ?>
                            <a href="<?= $item['url'] ?>" class="atl-context-link <?= $item['active'] ? 'active' : '' ?>"><span><?= htmlspecialchars($item['label'], ENT_QUOTES) ?></span> <i class="fa-solid fa-angle-right"></i></a>
                        <?php endforeach; ?>
                    </nav>
                </details>
            <?php endforeach; ?>

            <hr>

            <details class="atl-context-group" open>
                <summary>Módulos</summary>
                <nav>
                    <a class="atl-context-link <?= $module === 'dashboard' ? 'active' : '' ?>" href="<?= url('dashboard') ?>"><span>Dashboard</span><i class="fa-solid fa-angle-right"></i></a>
                    <?php if ($canManageRoles): ?><a class="atl-context-link <?= $module === 'roles' ? 'active' : '' ?>" href="<?= url('roles') ?>"><span>Roles</span><i class="fa-solid fa-angle-right"></i></a><?php endif; ?>
                    <?php if ($canManageUsuarios): ?><a class="atl-context-link <?= $module === 'usuarios' ? 'active' : '' ?>" href="<?= url('usuarios') ?>"><span>Usuarios</span><i class="fa-solid fa-angle-right"></i></a><?php endif; ?>
                    <?php if ($canManageEmpresa): ?><a class="atl-context-link <?= $module === 'empresa' ? 'active' : '' ?>" href="<?= url('empresa') ?>"><span>Empresa</span><i class="fa-solid fa-angle-right"></i></a><?php endif; ?>
                </nav>
            </details>
        </div>
    </div>
</aside>

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
