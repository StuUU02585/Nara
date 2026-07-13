<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= html_escape($title); ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css?v=20260609b'); ?>">
    <script defer src="<?= base_url('assets/js/app.js?v=20260606n'); ?>"></script>
</head>
<body class="participant-body">
    <header class="participant-topbar">
        <a class="brand" href="<?= site_url(); ?>" aria-label="Nara-HR Home">
            <img src="<?= base_url('assets/img/logo-nara-hr-header.png?v=20260609a'); ?>" alt="Nara-HR" width="1600" height="575">
        </a>
        <nav>
            <a href="<?= site_url(); ?>">Website</a>
            <a href="<?= site_url('peserta/logout'); ?>">Keluar</a>
        </nav>
    </header>

    <main class="participant-main participant-portal">
        <aside class="participant-sidebar">
            <div class="participant-identity">
                <span><?= html_escape(strtoupper(substr($participant['full_name'], 0, 1))); ?></span>
                <div>
                    <strong><?= html_escape($participant['full_name']); ?></strong>
                    <small>Peserta Nara-HR</small>
                </div>
            </div>
            <nav aria-label="Menu dashboard peserta" role="tablist" data-participant-tabs>
                <a href="#konsultasi" role="tab" data-participant-tab="konsultasi" aria-controls="konsultasi" aria-selected="true" class="is-active">Konsultasi Nara-HR</a>
                <a href="#sertifikat" role="tab" data-participant-tab="sertifikat" aria-controls="sertifikat" aria-selected="false">Sertifikat Program</a>
                <a href="#profil" role="tab" data-participant-tab="profil" aria-controls="profil" aria-selected="false">Profil Peserta</a>
                <a href="#keamanan" role="tab" data-participant-tab="keamanan" aria-controls="keamanan" aria-selected="false">Keamanan Akun</a>
            </nav>
        </aside>

        <div class="participant-content">
            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert success"><?= html_escape($this->session->flashdata('success')); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert error"><?= html_escape($this->session->flashdata('error')); ?></div>
            <?php endif; ?>

            <section class="admin-hero participant-hero">
                <div>
                    <p class="eyebrow">Dashboard Peserta</p>
                    <h1>Selamat datang, <?= html_escape($participant['full_name']); ?></h1>
                    <p>Kelola profil, lihat program yang telah diikuti, dan unduh sertifikat Anda.</p>
                </div>
            </section>

            <section id="sertifikat" class="dashboard-panel participant-section-panel" role="tabpanel" data-participant-panel="sertifikat" hidden>
                <div class="panel-title">
                    <div>
                        <p class="eyebrow">Program Diikuti</p>
                        <h2>Sertifikat Program</h2>
                    </div>
                </div>
                <div class="certificate-list">
                    <?php foreach ($programs as $program): ?>
                        <div class="certificate-item">
                            <div>
                                <strong><?= html_escape($program['program_name']); ?></strong>
                                <span><?= date('d M Y', strtotime($program['attended_at'])); ?></span>
                            </div>
                            <a class="btn primary" href="<?= site_url('peserta/download/' . $program['id']); ?>">Download Sertifikat</a>
                        </div>
                    <?php endforeach; ?>
                    <?php if (!$programs): ?>
                        <p class="empty-state">Belum ada sertifikat yang dipublish oleh admin.</p>
                    <?php endif; ?>
                </div>
            </section>

            <section id="profil" class="dashboard-panel participant-section-panel" role="tabpanel" data-participant-panel="profil" hidden>
                <div class="panel-title">
                    <div>
                        <p class="eyebrow">Profil</p>
                        <h2>Lengkapi Profil</h2>
                    </div>
                </div>
                <form class="form compact" method="post" action="<?= site_url('peserta/update_profile'); ?>">
                    <label>Nama<input name="full_name" value="<?= html_escape($participant['full_name']); ?>" required></label>
                    <label>No HP<input name="phone" value="<?= html_escape($participant['phone']); ?>" required></label>
                    <label>Instansi<input name="institution" value="<?= html_escape($participant['institution']); ?>"></label>
                    <label>Email<input type="email" name="email" value="<?= html_escape($participant['email']); ?>"></label>
                    <button class="btn primary" type="submit">Simpan Profil</button>
                </form>
            </section>

            <section id="konsultasi" class="dashboard-panel participant-consulting-panel participant-section-panel" role="tabpanel" data-participant-panel="konsultasi">
                <div class="participant-consulting-copy">
                    <p class="eyebrow">Konsultansi SDM</p>
                    <h2>Program Konsultansi SDM Nara-HR</h2>
                    <p>Tidak berhenti di pelatihan. Kami mendampingi Anda dalam mengimplementasikan perubahan di perusahaan, mulai dari penyusunan SOP HR, struktur organisasi, performance management, industrial relations, hingga talent development.</p>
                    <p>Layanan ini sangat cocok bagi perusahaan yang ingin membangun sistem HR yang solid dan berkelanjutan dengan bantuan praktisi berpengalaman.</p>
                </div>
                <a class="btn primary participant-consulting-action" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= urlencode('Halo CS Nara-HR, saya ingin berkonsultasi mengenai Program Konsultansi SDM Nara-HR.'); ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
            </section>

            <section id="keamanan" class="dashboard-panel participant-password-panel participant-section-panel" role="tabpanel" data-participant-panel="keamanan" hidden>
                <div class="panel-title">
                    <div>
                        <p class="eyebrow">Keamanan Akun</p>
                        <h2>Ganti Password</h2>
                    </div>
                </div>
                <form class="form form-row" method="post" action="<?= site_url('peserta/change_password'); ?>">
                    <label>Password Saat Ini<input type="password" name="current_password" required></label>
                    <label>Password Baru<input type="password" name="new_password" minlength="8" required></label>
                    <button class="btn primary" type="submit">Update Password</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>
