<section class="admin-head">
    <div>
        <p class="eyebrow">Slide Beranda</p>
        <h1>Manajemen Foto Slider</h1>
        <p>Kelola foto slider halaman utama. Semua file disimpan di folder <code>uploads/slides</code> agar tetap portable saat project dicopy ke komputer lain.</p>
    </div>
</section>

<section class="crud-panel">
    <h2>Tambah Slide</h2>
    <form class="form form-row" method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_slide'); ?>">
        <label>Judul<input name="title" placeholder="Dokumentasi Training" required></label>
        <label>Alt Text<input name="alt_text" placeholder="Deskripsi singkat foto"></label>
        <label>Foto Slide<input type="file" name="slide_file" accept=".jpg,.jpeg,.png,.webp" required></label>
        <label>Urutan<input type="number" name="sort_order" value="0"></label>
        <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
        <button class="btn primary" type="submit">Simpan Slide</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Data Slide</h2>
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Judul</th>
                    <th>Alt Text</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($slides as $slide): ?>
                    <tr class="<?= !$slide['is_active'] ? 'inactive-row' : ''; ?>">
                        <form method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_slide/' . $slide['id']); ?>">
                            <td>
                                <div class="admin-thumb slide">
                                    <img src="<?= base_url($slide['image_path']); ?>" alt="<?= html_escape($slide['alt_text'] ?: $slide['title']); ?>">
                                </div>
                                <input type="file" name="slide_file" accept=".jpg,.jpeg,.png,.webp">
                            </td>
                            <td><input name="title" value="<?= html_escape($slide['title']); ?>" required></td>
                            <td><input name="alt_text" value="<?= html_escape($slide['alt_text']); ?>"></td>
                            <td><input type="number" name="sort_order" value="<?= html_escape($slide['sort_order']); ?>"></td>
                            <td><label class="check"><input type="checkbox" name="is_active" value="1" <?= $slide['is_active'] ? 'checked' : ''; ?>> Aktif</label></td>
                            <td>
                                <button type="submit">Update</button>
                                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_slide/' . $slide['id']); ?>" onclick="return confirm('Hapus slide ini?')">Hapus</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$slides): ?>
                    <tr><td colspan="6">Belum ada slide.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
