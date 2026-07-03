<section class="page-hero certification-hero">
    <p class="eyebrow">Sertifikasi</p>
    <h1>Sertifikasi profesional nasional dan internasional</h1>
</section>

<section class="section certification-program-section" style="margin-bottom: 50px;">
    <div class="section-head">
        <p class="eyebrow">Program Nasional</p>
        <h2>Sertifikasi Profesional BNSP (Nasional)</h2>
        <p>Tingkatkan kredibilitas dan kompetensi Anda dengan sertifikasi resmi dari Badan Nasional Sertifikasi Profesi (BNSP).</p>
    </div>

    <div class="certification-slider-container">
        <button class="slide-btn prev-btn" type="button" aria-label="Previous">&lt;</button>
        <button class="slide-btn next-btn" type="button" aria-label="Next">&gt;</button>

        <div class="certification-slider-wrapper">
            <?php 
            $has_nasional = false;
            if (!empty($sertifikasi_flyer)): 
                foreach ($sertifikasi_flyer as $sf): 
                    if ($sf['kategori'] === 'Sertifikasi Nasional' && $sf['is_active'] == 1): 
                        $has_nasional = true;
                        $program_message = urlencode('Saya ingin menanyakan program ' . $sf['judul']); 
                        $path_gambar = 'uploads/sertifikasi/' . $sf['flyer'];
                        $flyer_url = base_url($path_gambar) . '?v=' . (file_exists($path_gambar) ? filemtime($path_gambar) : time());
            ?>
                    <article class="certification-program-card">
                        <div class="certification-flyer-media">
                            <button class="flyer-preview-trigger" type="button" data-flyer-src="<?= $flyer_url; ?>" data-flyer-title="<?= html_escape($sf['judul']); ?>">
                                <img src="<?= $flyer_url; ?>" alt="<?= html_escape($sf['judul']); ?>" loading="lazy">
                            </button>
                        </div>
                        <div class="certification-program-body">
                           
                            <a class="card-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp'] ?? '628123456789'); ?>?text=<?= $program_message; ?>" target="_blank" rel="noopener">Konsultasi CS</a>
                        </div>
                    </article>
            <?php 
                    endif;
                endforeach; 
            endif; 
            ?>
            
            <?php if (!$has_nasional): ?>
                <p style="color: #888; text-align: center; width: 100%; padding: 20px;">Belum ada program Sertifikasi Nasional yang tersedia saat ini.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section certification-program-section" style="margin-bottom: 50px;">
    <div class="section-head">
        <p class="eyebrow">Program Internasional</p>
        <h2>Sertifikasi Profesional KAN - IAF (International)</h2>
        <p>Tingkatkan kredibilitas dan kompetensi Anda dengan sertifikasi resmi dari Komite Akreditasi Nasional (KAN) yang berafiliasi ke International Accreditation Forum (IAF).</p>
    </div>

    <div class="certification-slider-container">
        <button class="slide-btn prev-btn" type="button" aria-label="Previous">&lt;</button>
        <button class="slide-btn next-btn" type="button" aria-label="Next">&gt;</button>

        <div class="certification-slider-wrapper">
            <?php 
            $has_internasional = false;
            if (!empty($sertifikasi_flyer)): 
                foreach ($sertifikasi_flyer as $sf): 
                    if ($sf['kategori'] === 'Sertifikasi Internasional' && $sf['is_active'] == 1): 
                        $has_internasional = true;
                        $program_message = urlencode('Saya ingin menanyakan program ' . $sf['judul']); 
                        $path_gambar = 'uploads/sertifikasi/' . $sf['flyer'];
                        $flyer_url = base_url($path_gambar) . '?v=' . (file_exists($path_gambar) ? filemtime($path_gambar) : time());
            ?>
                    <article class="certification-program-card">
                        <div class="certification-flyer-media">
                            <button class="flyer-preview-trigger" type="button" data-flyer-src="<?= $flyer_url; ?>" data-flyer-title="<?= html_escape($sf['judul']); ?>">
                                <img src="<?= $flyer_url; ?>" alt="<?= html_escape($sf['judul']); ?>" loading="lazy">
                            </button>
                        </div>
                        <div class="certification-program-body">
                            
                            <a class="card-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp'] ?? '628123456789'); ?>?text=<?= $program_message; ?>" target="_blank" rel="noopener">Konsultasi CS</a>
                        </div>
                    </article>
            <?php 
                    endif;
                endforeach; 
            endif; 
            ?>
            
            <?php if (!$has_internasional): ?>
                <p style="color: #888; text-align: center; width: 100%; padding: 20px;">Belum ada program Sertifikasi Internasional yang tersedia saat ini.</p>
            <?php endif; ?>
        </div>
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