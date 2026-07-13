<section class="admin-head">
    <div>
        <p class="eyebrow">Data Trainning</p>
        <h1>Manajemen Trainning</h1>
        <p>Struktur data mengikuti ERD: satu service memiliki banyak program, satu program memiliki banyak training, dan setiap training dapat memiliki trainer serta segment pasar.</p>
    </div>
</section>

<section class="crud-grid">
    <article class="crud-panel">
        <h2>Tambah Service</h2>
        <form class="form compact" method="post" action="<?= site_url('admin/save_service'); ?>">
            <label>Service<input name="name" placeholder="HR Training" required></label>
            <label>Deskripsi<textarea name="description" rows="3"></textarea></label>
            <label>Urutan<input type="number" name="sort_order" value="0"></label>
            <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
            <button class="btn primary" type="submit">Simpan Service</button>
        </form>
    </article>

    <article class="crud-panel">
        <h2>Tambah Segment Pasar</h2>
        <form class="form compact" method="post" action="<?= site_url('admin/save_segment'); ?>">
            <label>Segment<input name="name" placeholder="HRD Staff / Non HR" required></label>
            <label>Deskripsi<textarea name="description" rows="3"></textarea></label>
            <label>Urutan<input type="number" name="sort_order" value="0"></label>
            <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
            <button class="btn primary" type="submit">Simpan Segment</button>
        </form>
    </article>
</section>

<section class="crud-panel">
    <h2>Short Training</h2>
    <form class="form form-row" method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_training'); ?>">
        <label>Program
            <select name="program_id" required>
                <option value="">Pilih program</option>
                <?php foreach ($programs as $program): ?>
                    <option value="<?= html_escape($program['id']); ?>"><?= html_escape(($program['service_name'] ? $program['service_name'] . ' - ' : '') . $program['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Training<input name="title" placeholder="Interviewing Skill" required></label>
        <label>Trainer
            <select name="trainer_id">
                <option value="">Belum dipilih</option>
                <?php foreach ($trainers as $trainer): ?>
                    <option value="<?= html_escape($trainer['id']); ?>"><?= html_escape($trainer['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Waktu<input name="schedule_label" placeholder="Juni 2026"></label>
        <label>Venue / Metode<input name="venue_method" placeholder="Online"></label>
        <label>Durasi Menit<input type="number" name="duration_minutes" value="150"></label>
        <label>Segment Pasar
            <select name="market_segment_id">
                <option value="">Belum dipilih</option>
                <?php foreach ($segments as $segment): ?>
                    <option value="<?= html_escape($segment['id']); ?>"><?= html_escape($segment['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Flyer<input type="file" name="flyer_file" accept=".jpg,.jpeg,.png,.webp,.pdf" required></label>
        <label>Urutan<input type="number" name="sort_order" value="0"></label>
        <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
        <label class="wide">Deskripsi<textarea name="description" rows="3"></textarea></label>
        <button class="btn primary" type="submit">Simpan Training</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Data Training</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Program</th>
                    <th>Training</th>
                    <th>Trainer</th>
                    <th>Waktu</th>
                    <th>Venue / Metode</th>
                    <th>Durasi</th>
                    <th>Segment</th>
                    <th>Flyer</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trainings as $training): ?>
                    <tr class="<?= !$training['is_active'] ? 'inactive-row' : ''; ?>">
                        <form method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_training/' . $training['id']); ?>">
                            <td><?= html_escape($training['service_name']); ?></td>
                            <td>
                                <select name="program_id">
                                    <?php foreach ($programs as $program): ?>
                                        <option value="<?= html_escape($program['id']); ?>" <?= $program['id'] == $training['program_id'] ? 'selected' : ''; ?>><?= html_escape($program['title']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input name="title" value="<?= html_escape($training['title']); ?>"></td>
                            <td>
                                <select name="trainer_id">
                                    <option value="">-</option>
                                    <?php foreach ($trainers as $trainer): ?>
                                        <option value="<?= html_escape($trainer['id']); ?>" <?= $trainer['id'] == $training['trainer_id'] ? 'selected' : ''; ?>><?= html_escape($trainer['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input name="schedule_label" value="<?= html_escape($training['schedule_label']); ?>"></td>
                            <td><input name="venue_method" value="<?= html_escape($training['venue_method']); ?>"></td>
                            <td><input type="number" name="duration_minutes" value="<?= html_escape($training['duration_minutes']); ?>"></td>
                            <td>
                                <select name="market_segment_id">
                                    <option value="">-</option>
                                    <?php foreach ($segments as $segment): ?>
                                        <option value="<?= html_escape($segment['id']); ?>" <?= $segment['id'] == $training['market_segment_id'] ? 'selected' : ''; ?>><?= html_escape($segment['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <?php if ($training['flyer_path']): ?>
                                    <a href="<?= base_url($training['flyer_path']); ?>" target="_blank" rel="noopener">Lihat flyer</a>
                                <?php else: ?>
                                    <span>Belum ada flyer</span>
                                <?php endif; ?>
                                <input type="file" name="flyer_file" accept=".jpg,.jpeg,.png,.webp,.pdf">
                            </td>
                            <td>
                                <input type="hidden" name="description" value="<?= html_escape($training['description']); ?>">
                                <input type="hidden" name="sort_order" value="<?= html_escape($training['sort_order']); ?>">
                                <label class="check"><input type="checkbox" name="is_active" value="1" <?= $training['is_active'] ? 'checked' : ''; ?>> Aktif</label>
                                <button type="submit">Update</button>
                                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_training/' . $training['id']); ?>" onclick="return confirm('Hapus training ini?')">Hapus</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<section class="crud-grid">
    <article class="crud-panel">
        <h2>Data Service</h2>
        <?php foreach ($services as $service): ?>
            <form class="mini-edit" method="post" action="<?= site_url('admin/save_service/' . $service['id']); ?>">
                <input name="name" value="<?= html_escape($service['name']); ?>">
                <input type="number" name="sort_order" value="<?= html_escape($service['sort_order']); ?>">
                <input type="hidden" name="description" value="<?= html_escape($service['description']); ?>">
                <label class="check"><input type="checkbox" name="is_active" value="1" <?= $service['is_active'] ? 'checked' : ''; ?>> Aktif</label>
                <button type="submit">Update</button>
                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_service/' . $service['id']); ?>" onclick="return confirm('Nonaktifkan service ini?')">Nonaktifkan</button>
            </form>
        <?php endforeach; ?>
    </article>

    <article class="crud-panel">
        <h2>Data Segment</h2>
        <?php foreach ($segments as $segment): ?>
            <form class="mini-edit" method="post" action="<?= site_url('admin/save_segment/' . $segment['id']); ?>">
                <input name="name" value="<?= html_escape($segment['name']); ?>">
                <input type="number" name="sort_order" value="<?= html_escape($segment['sort_order']); ?>">
                <input type="hidden" name="description" value="<?= html_escape($segment['description']); ?>">
                <label class="check"><input type="checkbox" name="is_active" value="1" <?= $segment['is_active'] ? 'checked' : ''; ?>> Aktif</label>
                <button type="submit">Update</button>
                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_segment/' . $segment['id']); ?>" onclick="return confirm('Nonaktifkan segment ini?')">Nonaktifkan</button>
            </form>
        <?php endforeach; ?>
    </article>
</section>
