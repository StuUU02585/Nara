<section class="admin-head">
    <div>
        <p class="eyebrow">Media Sosial</p>
        <h1>Manajemen Akun Media Sosial</h1>
        <p>Kelola akun media sosial yang tampil di footer website. Icon disimpan di <code>uploads/socials</code> agar tetap portable saat project dipindahkan.</p>
    </div>
</section>

<section class="crud-panel">
    <h2>Tambah Media Sosial</h2>
    <form class="form form-row" method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_social'); ?>">
        <label>Platform<input name="platform" placeholder="Instagram" required></label>
        <label>URL Profil<input type="url" name="profile_url" placeholder="https://instagram.com/..." required></label>
        <label>Icon<input type="file" name="icon_file" accept=".jpg,.jpeg,.png,.webp" required></label>
        <label>Urutan<input type="number" name="sort_order" value="0"></label>
        <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
        <button class="btn primary" type="submit">Simpan Media Sosial</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Data Media Sosial</h2>
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Platform</th>
                    <th>URL Profil</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($socials as $social): ?>
                    <tr class="<?= !$social['is_active'] ? 'inactive-row' : ''; ?>">
                        <form method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_social/' . $social['id']); ?>">
                            <td>
                                <div class="admin-thumb social">
                                    <?php if (!empty($social['icon_path'])): ?>
                                        <img src="<?= base_url($social['icon_path']); ?>" alt="<?= html_escape($social['platform']); ?>">
                                    <?php else: ?>
                                        <?= html_escape(substr($social['platform'], 0, 2)); ?>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="icon_file" accept=".jpg,.jpeg,.png,.webp">
                            </td>
                            <td><input name="platform" value="<?= html_escape($social['platform']); ?>" required></td>
                            <td><input type="url" name="profile_url" value="<?= html_escape($social['profile_url']); ?>" required></td>
                            <td><input type="number" name="sort_order" value="<?= html_escape($social['sort_order']); ?>"></td>
                            <td><label class="check"><input type="checkbox" name="is_active" value="1" <?= $social['is_active'] ? 'checked' : ''; ?>> Aktif</label></td>
                            <td>
                                <button type="submit">Update</button>
                                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_social/' . $social['id']); ?>" onclick="return confirm('Hapus media sosial ini?')">Hapus</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$socials): ?>
                    <tr><td colspan="6">Belum ada media sosial.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
