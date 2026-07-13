<section class="admin-head">
    <div>
        <p class="eyebrow">Data Peserta Alumni</p>
        <h1>Manajemen Peserta Selesai Program</h1>
        <p>Kelola profil peserta, program yang sudah diikuti, sertifikat, dan akses login peserta. Setelah dipublish, peserta dapat login memakai nomor HP dan password.</p>
    </div>
</section>

<section class="crud-panel participant-existing-panel">
    <h2>Tambah Program untuk Peserta Terdaftar</h2>
    <p class="panel-note">Gunakan form ini jika nomor HP peserta sudah pernah dibuat. Admin cukup isi nomor HP, program, tanggal, dan sertifikat baru.</p>
    <form class="form form-row" method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_participant'); ?>">
        <input type="hidden" name="existing_only" value="1">
        <label>No HP Peserta Terdaftar<input name="phone" placeholder="0856..." required></label>
        <label>Tanggal Mengikuti Program<input type="date" name="attended_at" value="<?= date('Y-m-d'); ?>" required></label>
        <label>Program
            <select name="program_id">
                <option value="">Pilih program</option>
                <?php foreach ($programs as $program): ?>
                    <option value="<?= html_escape($program['id']); ?>"><?= html_escape($program['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Training Opsional
            <select name="training_id">
                <option value="">Pilih training</option>
                <?php foreach ($trainings as $training): ?>
                    <option value="<?= html_escape($training['id']); ?>"><?= html_escape($training['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Nama Program Manual<input name="program_name" placeholder="Isi jika tidak memilih program/training"></label>
        <label>Sertifikat<input type="file" name="certificate_file" accept=".pdf,.jpg,.jpeg,.png,.webp" required></label>
        <label class="check"><input type="checkbox" name="is_published" value="1" checked> Publish ke dashboard peserta</label>
        <button class="btn primary" type="submit">Tambah Program Peserta</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Tambah Peserta Selesai Program</h2>
    <p class="panel-note">Gunakan form ini untuk peserta baru yang belum memiliki akun login.</p>
    <form class="form form-row" method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_participant'); ?>">
        <label>Nama Peserta<input name="full_name" required></label>
        <label>No HP<input name="phone" placeholder="0856..." required></label>
        <label>Password<input type="password" name="password" minlength="8" required></label>
        <label>Instansi Opsional<input name="institution"></label>
        <label>Email Opsional<input type="email" name="email"></label>
        <label>Tanggal Mengikuti Program<input type="date" name="attended_at" value="<?= date('Y-m-d'); ?>" required></label>
        <label>Program
            <select name="program_id">
                <option value="">Pilih program</option>
                <?php foreach ($programs as $program): ?>
                    <option value="<?= html_escape($program['id']); ?>"><?= html_escape($program['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Training Opsional
            <select name="training_id">
                <option value="">Pilih training</option>
                <?php foreach ($trainings as $training): ?>
                    <option value="<?= html_escape($training['id']); ?>"><?= html_escape($training['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Nama Program Manual<input name="program_name" placeholder="Isi jika tidak memilih program/training"></label>
        <label>Sertifikat<input type="file" name="certificate_file" accept=".pdf,.jpg,.jpeg,.png,.webp" required></label>
        <label class="check"><input type="checkbox" name="is_active" value="1" checked> Akun aktif</label>
        <label class="check"><input type="checkbox" name="is_published" value="1" checked> Publish ke dashboard peserta</label>
        <button class="btn primary" type="submit">Publish Peserta</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Data Peserta dan Sertifikat</h2>
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th>Peserta</th>
                    <th>Kontak</th>
                    <th>Program</th>
                    <th>Tanggal</th>
                    <th>Sertifikat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($participants as $item): ?>
                    <tr class="<?= (!$item['is_active'] || !$item['is_published']) ? 'inactive-row' : ''; ?>">
                        <form method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_participant/' . $item['id']); ?>">
                            <td>
                                <input name="full_name" value="<?= html_escape($item['full_name']); ?>" required>
                                <input name="institution" value="<?= html_escape($item['institution']); ?>" placeholder="Instansi">
                            </td>
                            <td>
                                <input name="phone" value="<?= html_escape($item['phone']); ?>" required>
                                <input type="email" name="email" value="<?= html_escape($item['email']); ?>" placeholder="Email opsional">
                                <input type="password" name="password" minlength="8" placeholder="Password baru opsional">
                            </td>
                            <td>
                                <select name="program_id">
                                    <option value="">-</option>
                                    <?php foreach ($programs as $program): ?>
                                        <option value="<?= html_escape($program['id']); ?>" <?= $program['id'] == $item['program_id'] ? 'selected' : ''; ?>><?= html_escape($program['title']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select name="training_id">
                                    <option value="">-</option>
                                    <?php foreach ($trainings as $training): ?>
                                        <option value="<?= html_escape($training['id']); ?>" <?= $training['id'] == $item['training_id'] ? 'selected' : ''; ?>><?= html_escape($training['title']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input name="program_name" value="<?= html_escape($item['program_name']); ?>" required>
                            </td>
                            <td><input type="date" name="attended_at" value="<?= html_escape($item['attended_at']); ?>" required></td>
                            <td>
                                <a href="<?= site_url('admin/download_certificate/' . $item['id']); ?>" target="_blank" rel="noopener">Download sertifikat</a>
                                <input type="file" name="certificate_file" accept=".pdf,.jpg,.jpeg,.png,.webp">
                            </td>
                            <td>
                                <label class="check"><input type="checkbox" name="is_active" value="1" <?= $item['is_active'] ? 'checked' : ''; ?>> Aktif</label>
                                <label class="check"><input type="checkbox" name="is_published" value="1" <?= $item['is_published'] ? 'checked' : ''; ?>> Publish</label>
                            </td>
                            <td>
                                <button type="submit">Update</button>
                                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_participant_program/' . $item['id']); ?>" onclick="return confirm('Hapus data program peserta ini?')">Hapus</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$participants): ?>
                    <tr>
                        <td colspan="7">Belum ada data peserta selesai program.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
