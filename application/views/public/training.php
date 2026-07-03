<section class="page-hero short-training-hero">
    <p class="eyebrow">Short Training</p>
    <h1>Pelatihan singkat intensif, praktis, dan langsung diterapkan</h1>
    <p>Pelatihan singkat intensif dengan materi padat, praktis, dan langsung bisa diterapkan. Cocok untuk Anda yang ingin upgrade skill cepat tanpa meninggalkan pekerjaan.</p>
</section>


<?php
// ==========================================
// PENGELOMPOKAN DATA BERDASARKAN KATEGORI DI FRONTEND
// ==========================================
$inhouse_flyers = [];
$short_flyers = [];

if (!empty($jadwal_training_flyer)) {
    foreach ($jadwal_training_flyer as $jt) {
        if ($jt['kategori'] === 'In-House Training') {
            $inhouse_flyers[] = $jt;
        } elseif ($jt['kategori'] === 'Short Training') {
            $short_flyers[] = $jt;
        }
    }
}
?>



<section class="section training-showcase home-training-section" style="margin-bottom: 50px;">
    <div class="section-head">
        <p class="eyebrow">Short Training</p>
        <h2>Nara-HR Short Training</h2>
        <p>Setiap kelas dirancang oleh praktisi senior agar peserta tidak hanya mendapat teori, tapi juga tools, template, dan best practices yang siap digunakan di perusahaan.</p>
    </div>
    
    <div class="training-slider-container">
        <?php if (!empty($short_flyers)): ?>
            
            <?php if (count($short_flyers) > 4): ?>
                <button class="training-nav-btn prev-btn" type="button" aria-label="Previous slide">&#10094;</button>
            <?php endif; ?>
            
            <div class="training-slider-wrapper">
                <?php foreach ($short_flyers as $jt): ?>
                    <?php 
                        $program_message = urlencode('Halo CS Nara-HR, saya tertarik dan ingin mendaftar program Short Training: ' . $jt['judul']); 
                        $path_gambar = 'uploads/jadwal_training/' . $jt['flyer'];
                        $flyer_url = base_url($path_gambar) . '?v=' . (file_exists($path_gambar) ? filemtime($path_gambar) : time());
                    ?>
                    <article class="training-flyer-card">
                        <div class="training-flyer-media">
                            <button class="flyer-preview-trigger" type="button" data-flyer-src="<?= $flyer_url; ?>" data-flyer-title="<?= html_escape($jt['judul']); ?>" aria-label="Lihat flyer <?= html_escape($jt['judul']); ?>">
                                <img src="<?= $flyer_url; ?>" alt="<?= html_escape($jt['judul']); ?>" loading="lazy" decoding="async">
                            </button>
                        </div>
                        <div class="training-flyer-body">
                            
                            <a class="card-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp'] ?? '628123456789'); ?>?text=<?= $program_message; ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if (count($short_flyers) > 4): ?>
                <button class="training-nav-btn next-btn" type="button" aria-label="Next slide">&#10095;</button>
            <?php endif; ?>

        <?php else: ?>
            <div style="background: #f8fafc; text-align: center; padding: 30px; border-radius: 8px; border: 1px dashed #cbd5e1; width: 100%; grid-column: span 12;">
                <p style="color: #64748b; margin: 0;">Belum ada jadwal program Short Training yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section short-benefits">
    <h2>Manfaat</h2>
    <div class="short-benefit-grid">
        <article><span>01</span><p>Jadwal fleksibel secara online maupun offline</p></article>
        <article><span>02</span><p>Materi terkini yang menyesuaikan regulasi</p></article>
        <article><span>03</span><p>Sertifikat keikutsertaan program pelatihan</p></article>
        <article><span>04</span><p>Akses ke komunitas alumni Nara-HR</p></article>
    </div>
</section>

<section class="section muted short-agenda">
    <h2>Agenda Pelatihan</h2>
    <p class="agenda-month-note">Menampilkan agenda bulan berjalan dan bulan berikutnya: <strong><?= html_escape($active_month_label ?? date('F Y')); ?></strong></p>
    <div class="table-wrap flowbite-table">
        <table>
            <thead>
                <tr>
                    <th>Agenda</th>
                    <th>Program</th>
                    <th>Tanggal</th>
                    <th>Mode</th>
                    <th>Flyer</th>
                    <th>Konsultasi CS Nara-HR</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trainings as $training): ?>
                    <?php
                        $program_name = $training['title'] ?: $training['program_title'];
                        $program_message = urlencode('Saya ingin menanyakan program ' . $program_name);
                    ?>
                    <tr>
                        <td><?= html_escape($training['title']); ?></td>
                        <td><?= html_escape($training['program_title']); ?></td>
                        <td><?= html_escape($training['schedule_label']); ?></td>
                        <td><?= html_escape($training['venue_method']); ?></td>
                        <td>
                            <?php if ($training['flyer_path']): ?>
                                <a href="<?= base_url($training['flyer_path']); ?>" target="_blank" rel="noopener">Lihat flyer</a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="table-action-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= $program_message; ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($trainings)): ?>
                    <tr>
                        <td colspan="6">Belum ada agenda pelatihan untuk periode <?= html_escape($active_month_label ?? date('F Y')); ?>.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="page-hero short-training-hero">
    <p class="eyebrow">In-House Training</p>
    <h1>Pelatihan singkat intensif, praktis, dan langsung diterapkan</h1>
    <p>Program pelatihan eksklusif yang disesuaikan 100% dengan kebutuhan, tantangan, dan budaya perusahaan Anda.</p>
</section>

<section class="section training-showcase home-training-section" style="margin-bottom: 50px;">
    <div class="section-head">
        <p class="eyebrow">In-House Training</p>
        <h2>In-House Training Nara-HR</h2>
        <p>Apakah Anda ingin training untuk tim HR, Supervisor, Manager, atau seluruh karyawan? Kami akan merancang kurikulum khusus mulai dari assessment kebutuhan hingga evaluasi pasca-pelatihan.</p>
    </div>
    
    <div class="training-slider-container">
        <?php if (!empty($inhouse_flyers)): ?>
            
            <?php if (count($inhouse_flyers) > 4): ?>
                <button class="training-nav-btn prev-btn" type="button" aria-label="Previous slide">&#10094;</button>
            <?php endif; ?>
            
            <div class="training-slider-wrapper">
                <?php foreach ($inhouse_flyers as $jt): ?>
                    <?php 
                        $program_message = urlencode('Halo CS Nara-HR, saya tertarik dan ingin menanyakan info lebih lanjut tentang program In-House Training: ' . $jt['judul']); 
                        $path_gambar = 'uploads/jadwal_training/' . $jt['flyer'];
                        $flyer_url = base_url($path_gambar) . '?v=' . (file_exists($path_gambar) ? filemtime($path_gambar) : time());
                    ?>
                    <article class="training-flyer-card">
                        <div class="training-flyer-media">
                            <button class="flyer-preview-trigger" type="button" data-flyer-src="<?= $flyer_url; ?>" data-flyer-title="<?= html_escape($jt['judul']); ?>" aria-label="Lihat flyer <?= html_escape($jt['judul']); ?>">
                                <img src="<?= $flyer_url; ?>" alt="<?= html_escape($jt['judul']); ?>" loading="lazy" decoding="async">
                            </button>
                        </div>
                        <div class="training-flyer-body">
                            
                            <a class="card-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp'] ?? '628123456789'); ?>?text=<?= $program_message; ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if (count($inhouse_flyers) > 4): ?>
                <button class="training-nav-btn next-btn" type="button" aria-label="Next slide">&#10095;</button>
            <?php endif; ?>

        <?php else: ?>
            <div style="background: #f8fafc; text-align: center; padding: 30px; border-radius: 8px; border: 1px dashed #cbd5e1; width: 100%; grid-column: span 12;">
                <p style="color: #64748b; margin: 0;">Belum ada jadwal program In-House Training yang tersedia saat ini.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="section short-benefits">
    <h2>Keunggulan</h2>
    <div class="short-benefit-grid">
        <article><span>01</span><p>Materi custom</p></article>
        <article><span>02</span><p>Lokasi sesuai keinginan (kantor Anda atau venue pilihan)</p></article>
        <article><span>03</span><p>Trainer senior sesuai topik  </p></article>
        <article><span>04</span><p>Pendampingan implementasi (opsional)</p></article>
    </div>
</section>