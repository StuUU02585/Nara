<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= html_escape($this->session->csrf_token()); ?>">
    <meta name="poster-traffic-url" content="<?= html_escape(site_url('trafik/poster')); ?>">
    <title><?= html_escape($title ?? $site['name']); ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=20260613a'); ?>">
    <script defer src="<?= base_url('assets/js/app.js?v=20260613a'); ?>"></script>
</head>
<body>
    <?php
        $request_path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
        $base_path = trim(parse_url(site_url(), PHP_URL_PATH), '/');
        $current_page = $request_path;
        if ($base_path && strpos($request_path, $base_path) === 0) {
            $current_page = trim(substr($request_path, strlen($base_path)), '/');
        }
        $current_page = trim($current_page, '/');
        $nav_active = function ($targets) use ($current_page) {
            $targets = (array) $targets;
            return in_array($current_page, $targets, true);
        };
        $nav_items = [
            ['label' => 'Beranda', 'url' => site_url(), 'targets' => ['']],
            ['label' => 'Tentang', 'url' => site_url('tentang-kami'), 'targets' => ['tentang-kami']],
            ['label' => 'Training', 'url' => site_url('short-training'), 'targets' => ['short-training', 'in-house-training', 'konsultansi']],
            ['label' => 'Sertifikasi', 'url' => site_url('sertifikasi'), 'targets' => ['sertifikasi']],
            // PERUBAHAN 1: Konsultasi dipindah ke sini dan dibikin polos tanpa class 'nav-cta'
            ['label' => 'Konsultansi', 'url' => site_url('daftar'), 'targets' => ['daftar']], 
            ['label' => 'Trainer', 'url' => site_url('trainer'), 'targets' => ['trainer']],
            ['label' => 'Artikel', 'url' => site_url('artikel'), 'targets' => ['artikel']],
            ['label' => 'Galeri', 'url' => site_url('galeri'), 'targets' => ['galeri']],
            // PERUBAHAN 2: Portal Peserta naik ke navbar atas di posisi paling kanan dengan class 'nav-cta'
            ['label' => 'Portal Peserta', 'url' => site_url('peserta/login'), 'targets' => ['peserta/login'], 'class' => 'nav-cta'], 
        ];
    ?>
    <a class="skip-link" href="#content">Lewati ke konten</a>
    <header class="topbar">
        <a class="brand" href="<?= site_url(); ?>" aria-label="Nara-HR Home">
            <img src="<?= base_url('assets/img/logo-nara-hr-header.png?v=20260609a'); ?>" alt="Nara-HR" width="1600" height="575">
        </a>
        <nav>
            <?php foreach ($nav_items as $item): ?>
                <?php
                    $active = $nav_active($item['targets']);
                    $classes = trim(($item['class'] ?? '') . ' ' . ($active ? 'is-active' : ''));
                ?>
                <a<?= $classes ? ' class="' . html_escape($classes) . '"' : ''; ?> <?= $active ? 'aria-current="page"' : ''; ?> href="<?= html_escape($item['url']); ?>"><?= html_escape($item['label']); ?></a>
            <?php endforeach; ?>
        </nav>
    </header>

    <main id="content">
        <?= $content; ?>
    </main>

    <a class="wa-float" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= urlencode('Halo CS Nara-HR, saya ingin bertanya tentang program Nara-HR.'); ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>

    <?php $white_footer_pages = ['short-training', 'sertifikasi', 'trainer', 'artikel', 'galeri', 'daftar']; ?>
    <footer class="footer <?= in_array($current_page, $white_footer_pages, true) ? 'white-page-footer' : ''; ?>">
        <strong>Nara-HR.com</strong>
        <span class="footer-tagline">We Make People Grow</span>
        <?php if (!empty($site['social_links'])): ?>
            <div class="footer-socials" aria-label="Media sosial Sahabat Nara">
                <?php foreach ($site['social_links'] as $social): ?>
                    <?php
                        $social_url = trim($social['profile_url']);
                        if ($social_url && !preg_match('#^https?://#i', $social_url)) {
                            $social_url = 'https://' . $social_url;
                        }
                        $social_host = strtolower(parse_url($social_url, PHP_URL_HOST) ?: '');
                        $social_path = trim(parse_url($social_url, PHP_URL_PATH) ?: '', '/');
                        $social_label = preg_replace('#^https?://(www\.)?#i', '', $social_url);
                        $social_label = rtrim($social_label, '/');
                        if (strpos($social_host, 'instagram.com') !== false && $social_path) {
                            $social_label = strtolower(explode('/', $social_path)[0]);
                        }
                    ?>
                    <a href="<?= html_escape($social_url); ?>" target="_blank" rel="noopener" title="<?= html_escape($social['platform']); ?>">
                        <?php if (!empty($social['icon_path'])): ?>
                            <img src="<?= base_url($social['icon_path']); ?>" alt="<?= html_escape($social['platform']); ?>" loading="lazy" decoding="async">
                        <?php else: ?>
                            <span><?= html_escape(substr($social['platform'], 0, 2)); ?></span>
                        <?php endif; ?>
                        <strong><?= html_escape($social_label); ?></strong>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <a href="<?= site_url('admin'); ?>">Admin</a>
    </footer>
</body>
</html>