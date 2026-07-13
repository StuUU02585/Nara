<section class="home-hero">
    <div class="hero-showcase" aria-label="Cuplikan layanan Nara-HR">
        <div class="home-slider" data-slider aria-label="Dokumentasi kegiatan Nara-HR">
            <div class="slider-track">
                <?php $home_slides = !empty($slides) ? $slides : [
                    ['image_path' => 'uploads/slides/headline-utama-1.jpg', 'alt_text' => 'Dokumentasi kegiatan pelatihan Nara-HR'],
                    ['image_path' => 'uploads/slides/headline-utama-2.jpg', 'alt_text' => 'Dokumentasi peserta dan trainer Nara-HR'],
                ]; ?>
                <?php foreach ($home_slides as $index => $slide): ?>
                    <figure class="slider-slide <?= $index === 0 ? 'is-active' : ''; ?>">
                        <img src="<?= base_url($slide['image_path']); ?>" alt="<?= html_escape($slide['alt_text'] ?: 'Dokumentasi kegiatan Nara-HR'); ?>" decoding="async" loading="<?= $index === 0 ? 'eager' : 'lazy'; ?>" <?= $index === 0 ? 'fetchpriority="high"' : ''; ?>>
                    </figure>
                <?php endforeach; ?>
            </div>
            <button class="slider-nav prev" type="button" data-slider-prev aria-label="Slide sebelumnya">&lt;</button>
            <button class="slider-nav next" type="button" data-slider-next aria-label="Slide berikutnya">&gt;</button>
            <div class="slider-dots" aria-label="Pilih slide">
                <?php foreach ($home_slides as $index => $slide): ?>
                    <button class="<?= $index === 0 ? 'is-active' : ''; ?>" type="button" data-slider-dot="<?= html_escape($index); ?>" aria-label="Tampilkan slide <?= html_escape($index + 1); ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="hero-copy">
        <p class="eyebrow">Nara-HR.com</p>
        <h1>Partner strategis untuk pertumbuhan SDM yang terukur.</h1>
    </div>
</section>

<section class="section home-headline-section" aria-label="Headline utama Nara-HR">
    <div class="home-headline-card">
        <div class="home-headline-copy">
            <p class="eyebrow">Headline Utama</p>
            <h2>Nara-HR.com - We Make People Grow</h2>
            <p>Nara-HR.com adalah mitra terpercaya dalam pengembangan Sumber Daya Manusia dan organisasi. Kami menyediakan solusi lengkap berupa pelatihan HR praktis, sertifikasi profesional BNSP dan sertifikasi internasional KAN-IAF, in-house dan public training, serta konsultansi pendampingan bagi Business Owner, Direktur, Praktisi HR, Leader, dan talenta muda yang ingin menguasai manajemen manusia yang efektif dan strategis.</p>
            <p>Bersama Nara-HR, bangun tim yang kompeten, produktif, dan siap menghadapi tantangan bisnis.</p>
        </div>
        <div class="home-headline-points" aria-label="Solusi utama Nara-HR">
            <span>Pelatihan HR praktis</span>
            <span>Sertifikasi BNSP</span>
            <span>Sertifikasi KAN-IAF</span>
            <span>In-house & public training</span>
            <span>Konsultansi organisasi</span>
        </div>
    </div>
</section>

<section class="section home-why-section" aria-label="Alasan memilih Nara-HR">
    <div class="section-head">
        <p class="eyebrow">WHY US</p>
        <h2>Alasan Memilih Kami</h2>
    </div>
    <?php if (!empty($why_us_images)): ?>
        <div class="why-us-image-grid">
            <?php foreach ($why_us_images as $index => $image): ?>
                <button
                    class="why-us-image-button flyer-preview-trigger"
                    type="button"
                    data-flyer-src="<?= base_url($image); ?>"
                    data-poster-track
                    data-poster-type="why_us"
                    data-poster-key="<?= html_escape('why-us-' . ($index + 1) . '-' . basename($image)); ?>"
                    data-poster-name="<?= html_escape('Why Us ' . ($index + 1)); ?>"
                    aria-label="Perbesar poster alasan memilih Nara-HR <?= $index + 1; ?>"
                >
                    <img src="<?= base_url($image); ?>" alt="Alasan memilih Nara-HR <?= $index + 1; ?>" loading="lazy" decoding="async">
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<section class="section participant-section" aria-label="Alur peserta">
    <div class="section-head compact-head">
        <p class="eyebrow">Flow Sistem Informasi Nara HR</p>
        <h2>Dari melihat informasi program hingga masuk grup pembelajaran</h2>
    </div>
    <div class="participant-cards">
        <article class="flow-card">
            <strong>01</strong>
            <h3>Explore beranda dan menu</h3>
            <p>Masyarakat melihat informasi Beranda, Tentang, Training, Sertifikasi, Trainer, dan Artikel.</p>
        </article>
        <article class="flow-card">
            <strong>02</strong>
            <h3>Lihat flyer program</h3>
            <p>Flyer program unggulan dan training dapat diperbesar saat diarahkan kursor agar detailnya lebih mudah dibaca.</p>
        </article>
        <article class="flow-card">
            <strong>03</strong>
            <h3>Konsultasi CS Nara-HR</h3>
            <p>Tombol layanan mengirim pesan awal WhatsApp sesuai program yang dipilih.</p>
        </article>
        <article class="flow-card">
            <strong>04</strong>
            <h3>Pendaftaran dan pembayaran</h3>
            <p>Customer Service membantu informasi program, pendaftaran, pembayaran, dan bukti pembayaran.</p>
        </article>
        <article class="flow-card">
            <strong>05</strong>
            <h3>Masuk grup pembelajaran</h3>
            <p>Setelah pembayaran tervalidasi, peserta diarahkan ke grup untuk jadwal, materi, dan informasi kelas.</p>
        </article>
    </div>
</section>

<section class="section service-band" aria-label="Layanan utama">
    <a href="<?= site_url('short-training'); ?>">Short Training</a>
    <a href="<?= site_url('in-house-training'); ?>">In-House Training</a>
    <a href="<?= site_url('sertifikasi'); ?>">Sertifikasi Profesional</a>
    <a href="<?= site_url('konsultansi'); ?>">Konsultansi HR</a>
</section>

<section class="section home-program-section">
        <div class="section-head">
            <p class="eyebrow">Program</p>
            <h2>Program unggulan untuk kebutuhan tim modern</h2>
            <p>Pilih kelas publik, sertifikasi, atau rancangan in-house yang sesuai dengan prioritas perusahaan.</p>
        </div>
    <div class="grid cards program-cards">
        <?php foreach ($programs as $program): ?>
            <?php $program_message = urlencode('Saya ingin menanyakan program ' . $program['title']); ?>
            <article class="card">
                <?php if (!empty($program['flyer_path']) && strtolower(pathinfo($program['flyer_path'], PATHINFO_EXTENSION)) !== 'pdf'): ?>
                    <button class="flyer-preview-trigger" type="button" data-flyer-src="<?= base_url($program['flyer_path']); ?>" data-flyer-title="<?= html_escape($program['title']); ?>" data-poster-track data-poster-type="program" data-poster-key="<?= html_escape('program-' . $program['id']); ?>" data-poster-name="<?= html_escape($program['title']); ?>" aria-label="Lihat flyer <?= html_escape($program['title']); ?>">
                        <img class="program-flyer-photo" src="<?= base_url($program['flyer_path']); ?>" alt="<?= html_escape($program['title']); ?>" loading="lazy" decoding="async">
                    </button>
                <?php elseif (!empty($program['flyer_path'])): ?>
                    <a class="program-flyer-pdf" href="<?= base_url($program['flyer_path']); ?>" target="_blank" rel="noopener" data-poster-track data-poster-type="program" data-poster-key="<?= html_escape('program-' . $program['id']); ?>" data-poster-name="<?= html_escape($program['title']); ?>">Lihat flyer PDF</a>
                <?php endif; ?>
                <span><?= html_escape($program['category_name'] ?: $program['category']); ?></span>
                <h3><?= html_escape($program['title']); ?></h3>
                <p><?= html_escape($program['description']); ?></p>
                <a class="card-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= $program_message; ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php if (!empty($trainings)): ?>
<section class="section training-showcase home-training-section">
    <div class="section-head">
        <p class="eyebrow">Jadwal Training</p>
        <h2>Training terbaru yang siap diikuti</h2>
        <p>Flyer dan detail training diambil langsung dari data training yang dikelola admin.</p>
    </div>
    <div class="training-flyer-grid">
        <?php foreach (array_slice($trainings, 0, 4) as $training): ?>
            <?php $training_message = urlencode('Saya ingin menanyakan program ' . $training['title']); ?>
            <article class="training-flyer-card">
                <div class="training-flyer-media">
                    <?php if ($training['flyer_path'] && strtolower(pathinfo($training['flyer_path'], PATHINFO_EXTENSION)) !== 'pdf'): ?>
                        <button class="flyer-preview-trigger" type="button" data-flyer-src="<?= base_url($training['flyer_path']); ?>" data-flyer-title="<?= html_escape($training['title']); ?>" data-poster-track data-poster-type="training" data-poster-key="<?= html_escape('training-' . $training['id']); ?>" data-poster-name="<?= html_escape($training['title']); ?>" aria-label="Lihat flyer <?= html_escape($training['title']); ?>">
                            <img src="<?= base_url($training['flyer_path']); ?>" alt="<?= html_escape($training['title']); ?>" loading="lazy" decoding="async">
                        </button>
                    <?php elseif ($training['flyer_path']): ?>
                        <a href="<?= base_url($training['flyer_path']); ?>" target="_blank" rel="noopener" data-poster-track data-poster-type="training" data-poster-key="<?= html_escape('training-' . $training['id']); ?>" data-poster-name="<?= html_escape($training['title']); ?>">Lihat PDF Flyer</a>
                    <?php else: ?>
                        <span>Flyer segera tersedia</span>
                    <?php endif; ?>
                </div>
                <div class="training-flyer-body">
                    <span><?= html_escape($training['program_title']); ?></span>
                    <h3><?= html_escape($training['title']); ?></h3>
                    <p><?= html_escape($training['schedule_label'] ?: 'Jadwal menyusul'); ?> · <?= html_escape($training['venue_method']); ?></p>
                    <a class="card-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= $training_message; ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php endif; ?>

<section class="section home-trainer-section">
    <div class="section-head">
        <p class="eyebrow">Expert Team</p>
        <h2>Trainer dan konsultan berpengalaman</h2>
    </div>
    <div class="grid trainers">
        <?php foreach ($trainers as $trainer): ?>
            <article class="card">
                <?php if ($trainer['photo_path']): ?>
                    <img class="trainer-photo" src="<?= base_url($trainer['photo_path']); ?>" alt="<?= html_escape($trainer['name']); ?>" loading="lazy" decoding="async">
                <?php endif; ?>
                <h3><?= html_escape($trainer['name']); ?></h3>
                <p><?= html_escape($trainer['expertise']); ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section muted home-client-section">
    <div class="section-head compact-head">
        <p class="eyebrow">Kolaborasi</p>
        <h2>Dipercaya oleh berbagai organisasi</h2>
    </div>
    <div class="client-strip">
        <?php foreach ($clients as $client): ?>
            <span>
                <?php if ($client['logo_path']): ?>
                    <img src="<?= base_url($client['logo_path']); ?>" alt="<?= html_escape($client['name']); ?>" loading="lazy" decoding="async">
                <?php else: ?>
                    <?= html_escape($client['name']); ?>
                <?php endif; ?>
            </span>
        <?php endforeach; ?>
    </div>
</section>

<div class="flyer-modal" data-flyer-modal aria-hidden="true">
    <button class="flyer-modal-backdrop" type="button" data-flyer-close aria-label="Tutup preview gambar"></button>
    <div class="flyer-modal-dialog" role="dialog" aria-modal="true" aria-label="Preview gambar">
        <div class="flyer-modal-head">
            <strong data-flyer-modal-title>Preview Gambar</strong>
            <button type="button" data-flyer-close aria-label="Tutup">&times;</button>
        </div>
        <img data-flyer-modal-image src="" alt="">
    </div>
</div>

<section class="section home-article-section">
    <div class="section-head">
        <p class="eyebrow">Insights</p>
        <h2>Artikel terbaru seputar SDM dan organisasi</h2>
    </div>
    <div class="grid cards">
        <?php foreach ($articles as $article): ?>
            <article class="card">
                <h3><?= html_escape($article['title']); ?></h3>
                <p><?= html_escape($article['summary']); ?></p>
                <a class="card-link" href="<?= html_escape($article['external_url']); ?>" target="_blank" rel="noopener">Baca artikel</a>
            </article>
        <?php endforeach; ?>
    </div>
</section>
