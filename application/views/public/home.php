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

<section class="section home-program-section">
    <div class="section-head">
        <p class="eyebrow">Program</p>
        <h2>Program unggulan untuk kebutuhan tim modern</h2>
        <p>Pilih kelas publik, sertifikasi, atau rancangan in-house yang sesuai dengan prioritas perusahaan.</p>
    </div>

    <div class="program-slider-container">
        <button class="program-nav-btn prev-btn" type="button" aria-label="Previous slide">&#10094;</button>

        <div class="program-slider-wrapper">
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

                        <!-- Tombol Konsultasi tetap dipertahankan di sini agar ukuran card tidak mungil -->
                        <a class="card-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= $program_message; ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR ></a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>

        <button class="program-nav-btn next-btn" type="button" aria-label="Next slide">&#10095;</button>
    </div>
</section>

<section class="section trainer-list-section">
    <div class="section-head">
        <p class="eyebrow">Trainer & Konsultan Nara-HR</p>
        </div>

    <div class="carousel-3d-container">
        <div class="carousel-3d-stage">
            <div class="carousel-3d-track">
                <?php foreach ($trainers as $index => $trainer): ?>
                    <article class="card" style="--index: <?= $index; ?>">
                        <?php if ($trainer['photo_path']): ?>
                            <img class="trainer-photo large" src="<?= base_url($trainer['photo_path']); ?>" alt="<?= html_escape($trainer['name']); ?>" loading="lazy" decoding="async">
                        <?php endif; ?>
                        <h3><?= html_escape($trainer['name']); ?></h3>
                        <p class="trainer-role"><strong><?= html_escape($trainer['role']); ?></strong></p>
                        <p class="trainer-expertise"><?= html_escape($trainer['expertise']); ?></p>
                        <p class="trainer-bio"><?= html_escape($trainer['bio']); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
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

    <div class="grid cards" id="prolead-home-container">
        <p style="grid-column: 1/-1; text-align: center; color: #666;" id="home-loading-text">Sedang memuat artikel terbaru...</p>
    </div>

    <div class="section-action-center" style="display: flex; justify-content: center; margin-top: 35px;">
        <!-- Diubah ke site_url('home/articles') agar routing CI3 langsung mengenali method controllernya -->
        <a href="<?= site_url('home/articles'); ?>" style="color: #00875a; text-decoration: none; font-size: 15px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; padding: 10px 20px; border: 1px solid #00875a; border-radius: 4px; transition: all 0.2s ease;">
            Lebih lanjut <span style="font-size: 16px; line-height: 0;">&rsaquo;</span>
        </a>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById('prolead-home-container');
    const loadingText = document.getElementById('home-loading-text');
    
    const apiUrl = 'https://proleadindonesia.com/wp-json/wp/v2/posts?_embed&per_page=4';

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) throw new Error('Gagal mengambil data dari API');
            return response.json();
        })
        .then(posts => {
            if(loadingText) loadingText.remove();

            if (posts.length === 0) {
                container.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: #666;">Tidak ada artikel terbaru.</p>';
                return;
            }

            let htmlContent = '';

            posts.forEach(post => {
                const title = post.title && post.title.rendered ? post.title.rendered : 'No Title';
                const link = post.link ? post.link : '#';
                
                let summary = '';
                if (post.excerpt && post.excerpt.rendered) {
                    summary = post.excerpt.rendered.replace(/<\/?[^>]+(>|$)/g, "");
                    if (summary.length > 120) {
                        summary = summary.substring(0, 120) + '...';
                    }
                }

                htmlContent += `
                    <article class="card">
                        <h3>${title}</h3>
                        <p>${summary}</p>
                        <a class="card-link" href="${link}" target="_blank" rel="noopener">Baca artikel &rsaquo;</a>
                    </article>
                `;
            });

            container.innerHTML = htmlContent;
        })
        .catch(error => {
            console.error(error);
            if(loadingText) {
                loadingText.innerText = 'Terjadi gangguan sementara. Silakan coba kembali beberapa saat lagi.';
            }
        });
});
</script>