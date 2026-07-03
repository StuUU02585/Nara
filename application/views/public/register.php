<section class="page-hero register-hero">
    <p class="eyebrow">Konsultansi Nara-HR</p>
    <h1>Program Consultancy SDM Nara-HR</h1>
    <p>Tidak berhenti di pelatihan. Kami mendampingi Anda dalam mengimplementasikan perubahan di perusahaan kearah yang lebih baik untuk menunjang kemajuan bisnis dan mengoptimalkan sumber daya manusia yang terus berkembang.</p>
</section>

<section class="section consultation-intro-section">
    <div class="consultation-intro-card">
        <span>Konsultasi Gratis</span>
        <h2>Hubungi tim Nara-HR sekarang</h2>
        <p>Layanan ini sangat cocok bagi perusahaan yang ingin membangun sistem HR yang solid dan berkelanjutan dengan bantuan praktisi berpengalaman.</p>
    </div>
</section>

<section class="section narrow register-section">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert success"><?= html_escape($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert error"><?= html_escape($this->session->flashdata('error')); ?></div>
    <?php endif; ?>

    <form class="form registration-panel" method="post" action="<?= site_url('daftar/simpan'); ?>">
        <label>Nama Lengkap<input name="full_name" value="<?= set_value('full_name'); ?>" required></label>
        <label>Email<input type="email" name="email" value="<?= set_value('email'); ?>" required></label>
        <label>Nomor WhatsApp<input name="phone" value="<?= set_value('phone'); ?>" required></label>
        <label>Instansi / Perusahaan<input name="institution" value="<?= set_value('institution'); ?>" required></label>
        <label>Jabatan<input name="position" value="<?= set_value('position'); ?>" required></label>
        <label>Jumlah Peserta<input type="number" min="1" name="participant_count" value="<?= set_value('participant_count', 1); ?>"></label>
        <label>Program
            <select name="program_id" required>
                <option value="">Pilih program</option>
                <?php foreach ($programs as $program): ?>
                    <option value="<?= html_escape($program['id']); ?>"><?= html_escape($program['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Training
            <select name="training_id">
                <option value="">Belum memilih training spesifik</option>
                <?php foreach ($trainings as $training): ?>
                    <option value="<?= html_escape($training['id']); ?>"><?= html_escape($training['program_title']); ?> - <?= html_escape($training['title']); ?> - <?= html_escape($training['schedule_label']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Agenda
            <select name="agenda_id">
                <option value="">Belum memilih agenda khusus</option>
                <?php foreach ($agendas as $agenda): ?>
                    <option value="<?= html_escape($agenda['id']); ?>"><?= html_escape($agenda['title']); ?> - <?= html_escape($agenda['start_date']); ?><?= $agenda['flyer_path'] ? ' - flyer tersedia' : ''; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Kebutuhan / Pesan<textarea name="message" rows="5"><?= set_value('message'); ?></textarea></label>
        <button class="btn primary" type="submit">Kirim Permintaan Konsultasi</button>
    </form>
</section>
