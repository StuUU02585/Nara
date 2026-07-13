<section class="page-hero certification-hero">
    <p class="eyebrow">Sertifikasi</p>
    <h1>Sertifikasi profesional nasional dan internasional</h1>
</section>

<section class="section certification-program-section">
    <div class="section-head">
        <p class="eyebrow">Program Sertifikasi</p>
        <h2>Flyer sertifikasi yang tersedia</h2>
        <p>Pilih flyer untuk melihat ukuran besar, lalu hubungi Customer Service sesuai program sertifikasi yang diminati.</p>
    </div>

    <div class="certification-program-grid">
        <?php foreach ($programs as $program): ?>
            <?php $program_message = urlencode('Saya ingin menanyakan program ' . $program['title']); ?>
            <article class="certification-program-card">
                <div class="certification-flyer-media">
                    <?php if (!empty($program['flyer_path']) && strtolower(pathinfo($program['flyer_path'], PATHINFO_EXTENSION)) !== 'pdf'): ?>
                        <button class="flyer-preview-trigger" type="button" data-flyer-src="<?= base_url($program['flyer_path']); ?>" data-flyer-title="<?= html_escape($program['title']); ?>" data-poster-track data-poster-type="certification" data-poster-key="<?= html_escape('certification-' . $program['id']); ?>" data-poster-name="<?= html_escape($program['title']); ?>" aria-label="Lihat flyer <?= html_escape($program['title']); ?>">
                            <img src="<?= base_url($program['flyer_path']); ?>" alt="<?= html_escape($program['title']); ?>" loading="lazy" decoding="async">
                        </button>
                    <?php elseif (!empty($program['flyer_path'])): ?>
                        <a class="program-flyer-pdf" href="<?= base_url($program['flyer_path']); ?>" target="_blank" rel="noopener" data-poster-track data-poster-type="certification" data-poster-key="<?= html_escape('certification-' . $program['id']); ?>" data-poster-name="<?= html_escape($program['title']); ?>">Lihat flyer PDF</a>
                    <?php else: ?>
                        <span>Flyer segera tersedia</span>
                    <?php endif; ?>
                </div>
                <div class="certification-program-body">
                    <span><?= html_escape($program['category_name'] ?: str_replace('_', ' ', $program['category'])); ?></span>
                    <h3><?= html_escape($program['title']); ?></h3>
                    <p><?= html_escape($program['description']); ?></p>
                    <a class="card-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= $program_message; ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
                </div>
            </article>
        <?php endforeach; ?>
        <?php if (empty($programs)): ?>
            <article class="certification-program-card empty-certification">
                <div class="certification-program-body">
                    <span>Belum tersedia</span>
                    <h3>Flyer sertifikasi belum ditambahkan</h3>
                    <p>Admin dapat menambahkan data melalui menu Data Program Unggulan dengan kategori sertifikasi dan upload flyer.</p>
                </div>
            </article>
        <?php endif; ?>
    </div>
</section>

<section class="section muted narrow certification-benefits">
    <h2>Manfaat Sertifikasi</h2>
    <div class="certification-benefit-grid">
        <article><span>01</span><p>Diakui secara nasional maupun internasional</p></article>
        <article><span>02</span><p>Meningkatkan kompetensi dan peluang karier</p></article>
        <article><span>03</span><p>Mendukung pemenuhan kebutuhan regulasi perusahaan</p></article>
        <article><span>04</span><p>Didampingi oleh praktisi yang berpengalaman</p></article>
    </div>
</section>

<div class="flyer-modal" data-flyer-modal aria-hidden="true">
    <button class="flyer-modal-backdrop" type="button" data-flyer-close aria-label="Tutup preview flyer"></button>
    <div class="flyer-modal-dialog" role="dialog" aria-modal="true" aria-label="Preview flyer">
        <div class="flyer-modal-head">
            <strong data-flyer-modal-title>Preview Flyer</strong>
            <button type="button" data-flyer-close aria-label="Tutup">&times;</button>
        </div>
        <img data-flyer-modal-image src="" alt="">
    </div>
</div>
