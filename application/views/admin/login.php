<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= html_escape($title); ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=20260609b'); ?>">
</head>
<body class="login-body">
    <section class="login-card admin-login-card">
        <div class="participant-login-logo admin-login-logo">
            <img src="<?= base_url('assets/img/logo-nara-hr-header.png?v=20260609a'); ?>" alt="Nara-HR" width="1600" height="575">
        </div>
        <p class="eyebrow">Administrator</p>
        <h1>Nara-HR</h1>
        <p>Masuk untuk mengelola pendaftaran, data training, foto trainer, logo mitra, dan flyer program.</p>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert error"><?= html_escape($this->session->flashdata('error')); ?></div>
        <?php endif; ?>
        <form class="form" method="post" action="<?= site_url('auth/login'); ?>">
            <label>Email<input type="email" name="email" required></label>
            <label>Password<input type="password" name="password" required></label>
            <button class="btn primary" type="submit">Masuk</button>
        </form>
    </section>
</body>
</html>
