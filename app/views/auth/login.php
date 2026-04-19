<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="<?= url('public/assets/css/app.css') ?>">
</head>
<body class="login-body">
<div class="login-card">
    <h2>Bienvenido</h2>
    <p>Ingresa a tu panel administrativo.</p>
    <?php if ($msg = flash('error')): ?><div class="alert alert-danger py-2"><?= htmlspecialchars($msg, ENT_QUOTES) ?></div><?php endif; ?>
    <form method="post" action="<?= url('login') ?>">
        <?= csrf_field() ?>
        <label>Usuario o correo</label>
        <input type="text" name="login" required>
        <label>Contraseña</label>
        <input type="password" name="password" required>
        <button type="submit">Entrar</button>
    </form>
    <small>Admin demo: admin / Admin123*</small>
</div>
</body>
</html>
