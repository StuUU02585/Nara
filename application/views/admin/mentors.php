<section class="admin-head">
    <div>
        <p class="eyebrow">Data Mentor</p>
        <h1>Manajemen Mentor</h1>
        <p>Tambah, edit, dan hapus data mentor. Foto wajib diunggah saat membuat mentor baru.</p>
    </div>
</section>

<section id="crud-mentor" class="crud-panel">
    <h2>Tambah Mentor</h2>
    <form class="form form-row" method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_trainer'); ?>">
        <label>Nama<input name="name" placeholder="Nama mentor" required></label>
        <label>Role<input name="role" placeholder="Trainer / Konsultan"></label>
        <label>Keahlian<input name="expertise" placeholder="Leadership, HR, Industrial Relation"></label>
        <label>Foto<input type="file" name="photo_file" accept=".jpg,.jpeg,.png,.webp" required></label>
        <label>Urutan<input type="number" name="sort_order" value="0"></label>
        <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
        <label class="wide">Bio<textarea name="bio" rows="3"></textarea></label>
        <button class="btn primary" type="submit">Simpan Mentor</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Data Mentor</h2>
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Keahlian</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trainers as $trainer): ?>
                    <tr class="<?= !$trainer['is_active'] ? 'inactive-row' : ''; ?>">
                        <form method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_trainer/' . $trainer['id']); ?>">
                            <td>
                                <div class="admin-thumb portrait">
                                    <?php if ($trainer['photo_path']): ?>
                                        <img src="<?= base_url($trainer['photo_path']); ?>" alt="<?= html_escape($trainer['name']); ?>">
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="photo_file" accept=".jpg,.jpeg,.png,.webp">
                            </td>
                            <td><input name="name" value="<?= html_escape($trainer['name']); ?>" required></td>
                            <td><input name="role" value="<?= html_escape($trainer['role']); ?>"></td>
                            <td><input name="expertise" value="<?= html_escape($trainer['expertise']); ?>"></td>
                            <td><input type="number" name="sort_order" value="<?= html_escape($trainer['sort_order']); ?>"></td>
                            <td><label class="check"><input type="checkbox" name="is_active" value="1" <?= $trainer['is_active'] ? 'checked' : ''; ?>> Aktif</label></td>
                            <td>
                                <input type="hidden" name="bio" value="<?= html_escape($trainer['bio']); ?>">
                                <button type="submit">Update</button>
                                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_trainer/' . $trainer['id']); ?>" onclick="return confirm('Hapus mentor ini?')">Hapus</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
