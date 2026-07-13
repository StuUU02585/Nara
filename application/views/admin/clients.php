<section class="admin-head">
    <div>
        <p class="eyebrow">Data Perusahaan</p>
        <h1>Manajemen Perusahaan</h1>
        <p>Tambah, edit, dan hapus data perusahaan/mitra. Logo wajib diunggah saat membuat data baru.</p>
    </div>
</section>

<section id="crud-perusahaan" class="crud-panel">
    <h2>Tambah Perusahaan</h2>
    <form class="form form-row" method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_client'); ?>">
        <label>Nama Perusahaan<input name="name" placeholder="Nama perusahaan" required></label>
        <label>Website<input type="url" name="official_url" placeholder="https://..."></label>
        <label>Logo<input type="file" name="logo_file" accept=".jpg,.jpeg,.png,.webp" required></label>
        <label>Urutan<input type="number" name="sort_order" value="0"></label>
        <label class="wide">Catatan<input name="note" placeholder="Catatan singkat"></label>
        <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
        <button class="btn primary" type="submit">Simpan Perusahaan</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Data Perusahaan</h2>
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nama</th>
                    <th>Website</th>
                    <th>Catatan</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr class="<?= !$client['is_active'] ? 'inactive-row' : ''; ?>">
                        <form method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_client/' . $client['id']); ?>">
                            <td>
                                <div class="admin-thumb logo">
                                    <?php if ($client['logo_path']): ?>
                                        <img src="<?= base_url($client['logo_path']); ?>" alt="<?= html_escape($client['name']); ?>">
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </div>
                                <input type="file" name="logo_file" accept=".jpg,.jpeg,.png,.webp">
                            </td>
                            <td><input name="name" value="<?= html_escape($client['name']); ?>" required></td>
                            <td><input name="official_url" value="<?= html_escape($client['official_url']); ?>"></td>
                            <td><input name="note" value="<?= html_escape($client['note']); ?>"></td>
                            <td><input type="number" name="sort_order" value="<?= html_escape($client['sort_order']); ?>"></td>
                            <td><label class="check"><input type="checkbox" name="is_active" value="1" <?= $client['is_active'] ? 'checked' : ''; ?>> Aktif</label></td>
                            <td>
                                <button type="submit">Update</button>
                                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_client/' . $client['id']); ?>" onclick="return confirm('Hapus perusahaan ini?')">Hapus</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
