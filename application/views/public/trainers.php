<section class="page-hero trainer-hero">
    <p class="eyebrow">Trainer & Konsultan</p>
    <h1>Semua program kami dibawakan oleh praktisi HR senior yang telah berkecimpung puluhan tahun di perusahaan-perusahaan ternama (BUMN, Nasional, dan Multinasional).</h1>
</section>

<section class="section trainer-list-section">
    <div class="section-head">
        <p class="eyebrow">Trainer Nara-HR</p>
        <p>Mereka bukan hanya trainer, tapi juga konsultan yang paham betul tantangan nyata di lapangan. Daftar trainer kami akan ditampilkan di sini beserta profil singkat dan pengalaman mereka.</p>
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
