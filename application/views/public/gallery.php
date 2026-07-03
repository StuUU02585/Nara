<section class="section gallery-page">
    <div class="section-head">
        <p class="eyebrow">Galeri</p>
        <h1>Dokumentasi kegiatan Nara-HR</h1>
    </div>

    <?php if (!empty($gallery)): ?>
        <div class="home-gallery-grid">
            <?php foreach ($gallery as $index => $image): ?>
                <button class="home-gallery-item flyer-preview-trigger" type="button" data-flyer-src="<?= base_url($image['path']); ?>" data-poster-track data-poster-type="gallery" data-poster-key="<?= html_escape('gallery-' . basename($image['path'])); ?>" data-poster-name="<?= html_escape('Galeri ' . ($index + 1)); ?>" aria-label="Perbesar foto galeri <?= $index + 1; ?>">
                    <img src="<?= base_url($image['path']); ?>" alt="Dokumentasi kegiatan Nara-HR" loading="lazy" decoding="async">
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<div class="flyer-modal gallery-modal" data-flyer-modal aria-hidden="true">
    <button class="flyer-modal-backdrop" type="button" data-flyer-close aria-label="Tutup foto"></button>
    <div class="flyer-modal-dialog" role="dialog" aria-modal="true" aria-label="Foto galeri">
        <div class="flyer-modal-head">
            <button type="button" data-flyer-close aria-label="Tutup">&times;</button>
        </div>
        <img data-flyer-modal-image src="" alt="">
    </div>
</div>
