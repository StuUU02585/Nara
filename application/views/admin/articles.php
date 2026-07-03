<section class="admin-head">
    <div>
        <p class="eyebrow">Data Artikel</p>
        <h1>Manajemen Artikel</h1>
        <p>Tambah, edit, dan hapus artikel insight yang tampil di halaman publik.</p>
    </div>
</section>

<section id="crud-artikel" class="crud-panel">
    <h2>Tambah Artikel</h2>
    <form class="form form-row" method="post" action="<?= site_url('admin/save_article'); ?>">
        <label>Judul<input name="title" placeholder="Judul artikel" required></label>
        <label>Sumber<input name="source" value="ProleadIndonesia.com"></label>
        <label>Tanggal Publikasi<input type="date" name="published_at"></label>
        <label class="wide">URL Artikel<input type="url" name="external_url" placeholder="https://..." required></label>
        <label class="wide">Ringkasan<textarea name="summary" rows="3"></textarea></label>
        <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
        <button class="btn primary" type="submit">Simpan Artikel</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Data Artikel</h2>
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th>Artikel</th>
                    <th>URL</th>
                    <th>Sumber</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr class="<?= !$article['is_active'] ? 'inactive-row' : ''; ?>">
                        <form method="post" action="<?= site_url('admin/save_article/' . $article['id']); ?>">
                            <td>
                                <input name="title" value="<?= html_escape($article['title']); ?>" required>
                                <textarea name="summary" rows="2"><?= html_escape($article['summary']); ?></textarea>
                            </td>
                            <td><input type="url" name="external_url" value="<?= html_escape($article['external_url']); ?>" required></td>
                            <td><input name="source" value="<?= html_escape($article['source']); ?>"></td>
                            <td><input type="date" name="published_at" value="<?= html_escape($article['published_at']); ?>"></td>
                            <td><label class="check"><input type="checkbox" name="is_active" value="1" <?= $article['is_active'] ? 'checked' : ''; ?>> Aktif</label></td>
                            <td>
                                <button type="submit">Update</button>
                                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_article/' . $article['id']); ?>" onclick="return confirm('Hapus artikel ini?')">Hapus</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
