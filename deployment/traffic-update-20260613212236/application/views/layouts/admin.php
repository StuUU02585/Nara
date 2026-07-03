<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= html_escape($title ?? 'Admin'); ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=20260613a'); ?>">
    <script defer src="<?= base_url('assets/js/app.js?v=20260613a'); ?>"></script>
</head>
<body class="admin-body">
    <?php
        $request_path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
        $base_path = trim(parse_url(site_url(), PHP_URL_PATH), '/');
        $current_path = trim(preg_replace('#^' . preg_quote($base_path, '#') . '#', '', $request_path), '/');
    ?>
    <div class="admin-layout adminlte-layout">
        <aside class="admin-sidebar">
            <a class="admin-brand" href="<?= site_url('admin'); ?>">
                <img src="<?= base_url('assets/img/logo-nara-hr-header.png?v=20260609a'); ?>" alt="Nara-HR" width="1600" height="575">
            </a>
            <nav class="admin-nav" aria-label="Navigasi admin">
                <small>Operasional</small>
                <a class="<?= $current_path === 'admin' ? 'is-active' : ''; ?>" href="<?= site_url('admin'); ?>"><span>DB</span>Dashboard</a>
                <a href="<?= site_url('admin#pendaftaran'); ?>"><span>PD</span>Pendaftaran Peserta</a>
                <a class="<?= $current_path === 'admin/slides' ? 'is-active' : ''; ?>" href="<?= site_url('admin/slides'); ?>"><span>SL</span>Slide Beranda</a>
                <a class="<?= $current_path === 'admin/socials' ? 'is-active' : ''; ?>" href="<?= site_url('admin/socials'); ?>"><span>MS</span>Media Sosial</a>

                <small>Manajemen Data</small>
                <a class="<?= $current_path === 'admin/programs' ? 'is-active' : ''; ?>" href="<?= site_url('admin/programs'); ?>"><span>PG</span>Data Program Unggulan</a>
                <a class="<?= strpos($current_path, 'admin/training_catalog') === 0 ? 'is-active' : ''; ?>" href="<?= site_url('admin/training_catalog'); ?>"><span>TR</span>Data Trainning</a>
                <a class="<?= $current_path === 'admin/participants' ? 'is-active' : ''; ?>" href="<?= site_url('admin/participants'); ?>"><span>PS</span>Data Peserta Alumni</a>
                <a class="<?= $current_path === 'admin/mentors' ? 'is-active' : ''; ?>" href="<?= site_url('admin/mentors#crud-mentor'); ?>"><span>MT</span>Data Mentor</a>
                <a class="<?= $current_path === 'admin/articles' ? 'is-active' : ''; ?>" href="<?= site_url('admin/articles#crud-artikel'); ?>"><span>AR</span>Data Artikel</a>
                <a class="<?= $current_path === 'admin/clients' ? 'is-active' : ''; ?>" href="<?= site_url('admin/clients#crud-perusahaan'); ?>"><span>CP</span>Data Perusahaan</a>

                <small>Lain-lain</small>
                <a href="<?= site_url(); ?>"><span>WB</span>Lihat Website</a>
                <a class="danger-nav" href="<?= site_url('auth/logout'); ?>"><span>LO</span>Keluar</a>
            </nav>
        </aside>
        <div class="admin-content-wrap">
            <header class="admin-topbar">
                <div>
                    <strong>Admin Panel</strong>
                    <span>Kelola konten website Sahabat Nara</span>
                </div>
                <div class="admin-top-actions">
                    <a href="<?= site_url(); ?>">Website</a>
                    <a class="logout" href="<?= site_url('auth/logout'); ?>">Keluar</a>
                </div>
            </header>
            <main class="admin-main">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert success"><?= html_escape($this->session->flashdata('success')); ?></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert error"><?= html_escape($this->session->flashdata('error')); ?></div>
                <?php endif; ?>
                <?= $content; ?>
            </main>
        </div>
    </div>
</body>
</html>
