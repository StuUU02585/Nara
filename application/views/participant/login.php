<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= html_escape($title); ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=20260609b'); ?>">
</head>
<body class="login-body participant-login-body">
    <section class="login-card admin-login-card">
        <div class="participant-login-logo">
            <img src="<?= base_url('assets/img/logo-nara-hr-header.png?v=20260609a'); ?>" alt="Nara-HR" width="1600" height="575">
        </div>
        <p class="eyebrow">Portal Peserta</p>
        <p>Masuk untuk melihat program yang telah diikuti dan mengunduh sertifikat.</p>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert error"><?= html_escape($this->session->flashdata('error')); ?></div>
        <?php endif; ?>
        <form class="form" method="post" action="<?= site_url('peserta/login'); ?>">
            <label>No HP<input name="phone" placeholder="0856..." required></label>
            <label>Password<input type="password" name="password" required></label>
            <button class="btn primary" type="submit">Masuk</button>
        </form>
        <p class="hint"><a href="<?= site_url(); ?>">Kembali ke website</a></p>
    </section>
</body>
</html>
