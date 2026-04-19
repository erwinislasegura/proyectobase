<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title ?? 'Panel', ENT_QUOTES) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= url('public/assets/css/app.css') ?>">
</head>
<body>
<div class="app-shell">
    <?php require BASE_PATH . '/app/views/layouts/sidebar.php'; ?>
    <main class="app-content">
        <?php require BASE_PATH . '/app/views/layouts/topbar.php'; ?>
        <section class="content-area">
            <?php if ($msg = flash('success')): ?><div class="alert alert-success py-2"><?= htmlspecialchars($msg, ENT_QUOTES) ?></div><?php endif; ?>
            <?php if ($msg = flash('error')): ?><div class="alert alert-danger py-2"><?= htmlspecialchars($msg, ENT_QUOTES) ?></div><?php endif; ?>
            <?php require $viewFile; ?>
        </section>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script src="<?= url('public/assets/js/app.js') ?>"></script>
</body>
</html>
