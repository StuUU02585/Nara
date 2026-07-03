<?php if (($title ?? '') === 'Tentang Kami'): ?>
<section class="section about-overview">
    <div class="about-story">
        <p class="eyebrow">Who We Are</p>
        <?php foreach ($body as $paragraph): ?>
            <p><?= html_escape($paragraph); ?></p>
        <?php endforeach; ?>
    </div>
</section>

<section class="section about-principles-section" aria-label="Visi, misi, dan nilai Nara-HR">
    <div class="about-poster-grid">
        <figure class="about-visual-poster">
            <img src="<?= base_url('assets/img/beranda/our_vision.png'); ?>" alt="Visi Nara-HR" loading="eager" decoding="async">
        </figure>
        <figure class="about-visual-poster">
            <img src="<?= base_url('assets/img/beranda/our_mision.png'); ?>" alt="Misi Nara-HR" loading="lazy" decoding="async">
        </figure>
        <figure class="about-visual-poster">
            <img src="<?= base_url('assets/img/beranda/Our_value.png'); ?>" alt="Nilai Nara-HR" loading="lazy" decoding="async">
        </figure>
    </div>
</section>

<section class="section about-contact-section">
    <div class="about-contact-card">
        <div>
            <p class="eyebrow">Alamat</p>
            <h2>Kantor Nara-HR</h2>
            <p><?= html_escape($address ?? ''); ?></p>
        </div>
        <div>
            <p class="eyebrow">CS Nara-HR</p>
            <a class="btn primary" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= urlencode('Halo CS Nara-HR, saya ingin bertanya tentang program Nara-HR.'); ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
        </div>
    </div>
</section>
<?php elseif (($title ?? '') === 'In-House Training'): ?>
<section class="page-hero inhouse-hero">
    <div>
        <p class="eyebrow"><?= html_escape($title); ?></p>
        <h1><?= html_escape($heading); ?></h1>
        <p>Program privat untuk perusahaan yang ingin membangun kompetensi tim secara fokus, relevan dengan kebutuhan bisnis, dan didampingi trainer praktisi.</p>
        <div class="actions">
            <a class="btn primary" href="<?= site_url('daftar'); ?>">Diskusikan Kebutuhan</a>
            <a class="btn" href="https://wa.me/<?= preg_replace('/\D+/', '', $site['whatsapp']); ?>?text=<?= urlencode('Halo CS Nara-HR, saya ingin bertanya tentang program in-house training.'); ?>" target="_blank" rel="noopener">Konsultasi CS Nara-HR</a>
        </div>
    </div>
    <div class="inhouse-brief">
        <span>Corporate Program</span>
        <strong>Tailored learning for your team</strong>
        <p>Assessment kebutuhan, desain materi, pelaksanaan, hingga evaluasi program dalam satu alur kerja yang rapi.</p>
    </div>
</section>

<section class="section inhouse-overview">
    <div class="inhouse-story">
        <p class="eyebrow">Executive Learning</p>
        <?php foreach ($body as $paragraph): ?>
            <p><?= html_escape($paragraph); ?></p>
        <?php endforeach; ?>
    </div>
    <div class="inhouse-highlight">
        <article>
            <strong>Custom</strong>
            <span>Materi menyesuaikan tantangan dan budaya organisasi</span>
        </article>
        <article>
            <strong>Private</strong>
            <span>Kelas eksklusif untuk tim internal perusahaan</span>
        </article>
        <article>
            <strong>Impact</strong>
            <span>Evaluasi diarahkan pada penerapan kerja nyata</span>
        </article>
    </div>
</section>

<section class="section inhouse-process">
    <div class="section-head">
        <p class="eyebrow">Alur Program</p>
        <h2>Didesain dari kebutuhan bisnis, bukan template kelas umum</h2>
    </div>
    <div class="inhouse-process-grid">
        <article>
            <span>01</span>
            <h3>Needs assessment</h3>
            <p>Memetakan tujuan, level peserta, masalah bisnis, dan ekspektasi hasil program.</p>
        </article>
        <article>
            <span>02</span>
            <h3>Program design</h3>
            <p>Menyusun silabus, metode belajar, studi kasus, dan durasi yang paling sesuai.</p>
        </article>
        <article>
            <span>03</span>
            <h3>Delivery</h3>
            <p>Pelaksanaan online, offline, atau blended bersama trainer praktisi berpengalaman.</p>
        </article>
        <article>
            <span>04</span>
            <h3>Evaluation</h3>
            <p>Ringkasan evaluasi dan rekomendasi tindak lanjut setelah program selesai.</p>
        </article>
    </div>
</section>

<section class="section inhouse-package">
    <div class="inhouse-package-card">
        <div>
            <p class="eyebrow">Included</p>
            <h2>Fleksibel untuk training leadership, HR, compliance, dan people management</h2>
        </div>
        <div class="feature-list">
            <?php foreach ($points as $point): ?>
                <span><?= html_escape($point); ?></span>
            <?php endforeach; ?>
        </div>
        <a class="btn primary" href="<?= site_url('daftar'); ?>">Ajukan In-House Training</a>
    </div>
</section>
<?php else: ?>
<section class="page-hero">
    <p class="eyebrow"><?= html_escape($title); ?></p>
    <h1><?= html_escape($heading); ?></h1>
</section>

<section class="section narrow">
    <?php foreach ($body as $paragraph): ?>
        <p><?= html_escape($paragraph); ?></p>
    <?php endforeach; ?>
    <div class="feature-list">
        <?php foreach ($points as $point): ?>
            <span><?= html_escape($point); ?></span>
        <?php endforeach; ?>
    </div>
    <a class="btn primary" href="<?= site_url('daftar'); ?>">Konsultasi / Daftar</a>
</section>
<?php endif; ?>
