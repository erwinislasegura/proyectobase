<header class="topbar">
    <div>
        <h1><?= htmlspecialchars($title ?? 'Panel', ENT_QUOTES) ?></h1>
        <small><?= date('d/m/Y') ?></small>
    </div>
    <div class="topbar-actions">
        <input type="search" class="form-control form-control-sm" placeholder="Buscar...">
        <div class="avatar-chip"><?= strtoupper(substr(auth_user()['nombre'] ?? 'A', 0, 1)) ?></div>
    </div>
</header>
