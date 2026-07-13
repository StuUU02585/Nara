<section class="admin-head">
    <div>
        <p class="eyebrow">Data Program Unggulan</p>
        <h1>Manajemen Program Unggulan</h1>
        <p>Kelola program utama seperti Short Training, In-House, BNSP, KAN - IAF, dan Consulting. Flyer wajib diunggah saat menambahkan program baru.</p>
    </div>
</section>

<section class="crud-grid">
    <article class="crud-panel">
        <h2>Tambah Kategori Program</h2>
        <form class="form compact" method="post" action="<?= site_url('admin/save_program_category'); ?>">
            <label>Kategori<input name="name" placeholder="Workshop HR" required></label>
            <label>Deskripsi<textarea name="description" rows="3"></textarea></label>
            <label>Urutan<input type="number" name="sort_order" value="0"></label>
            <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
            <button class="btn primary" type="submit">Simpan Kategori</button>
        </form>
    </article>

    <article class="crud-panel">
        <h2>Data Kategori</h2>
        <?php foreach ($categories as $category): ?>
            <form class="mini-edit" method="post" action="<?= site_url('admin/save_program_category/' . $category['id']); ?>">
                <input name="name" value="<?= html_escape($category['name']); ?>">
                <input type="number" name="sort_order" value="<?= html_escape($category['sort_order']); ?>">
                <input type="hidden" name="description" value="<?= html_escape($category['description']); ?>">
                <label class="check"><input type="checkbox" name="is_active" value="1" <?= $category['is_active'] ? 'checked' : ''; ?>> Aktif</label>
                <button type="submit">Update</button>
                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_program_category/' . $category['id']); ?>" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
            </form>
        <?php endforeach; ?>
    </article>
</section>

<section class="crud-panel">
    <h2>Tambah Program Unggulan</h2>
    <form class="form form-row" method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_program'); ?>">
        <label>Service
            <select name="service_id">
                <option value="">Tanpa service</option>
                <?php foreach ($services as $service): ?>
                    <option value="<?= html_escape($service['id']); ?>"><?= html_escape($service['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Kategori
            <select name="category_id" required>
                <option value="">Pilih kategori</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= html_escape($category['id']); ?>" data-slug="<?= html_escape($category['slug']); ?>"><?= html_escape($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="category_slug" value="short_training">
        </label>
        <label>Program<input name="title" placeholder="Human Resources Basic Training (HR for Non HR)" required></label>
        <label>Metode<input name="mode" placeholder="Online / Offline"></label>
        <label>Flyer Program<input type="file" name="program_flyer_file" accept=".jpg,.jpeg,.png,.webp,.pdf" required></label>
        <label>Urutan<input type="number" name="sort_order" value="0"></label>
        <label class="check"><input type="checkbox" name="is_active" value="1" checked> Aktif</label>
        <label class="wide">Deskripsi<textarea name="description" rows="3"></textarea></label>
        <button class="btn primary" type="submit">Simpan Program</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Data Program Unggulan</h2>
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th>Flyer</th>
                    <th>Service</th>
                    <th>Kategori</th>
                    <th>Program</th>
                    <th>Metode</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($programs as $program): ?>
                    <tr class="<?= !$program['is_active'] ? 'inactive-row' : ''; ?>">
                        <form method="post" enctype="multipart/form-data" action="<?= site_url('admin/save_program/' . $program['id']); ?>">
                            <td>
                                <div class="admin-thumb flyer">
                                    <?php if (!empty($program['flyer_path']) && strtolower(pathinfo($program['flyer_path'], PATHINFO_EXTENSION)) !== 'pdf'): ?>
                                        <img src="<?= base_url($program['flyer_path']); ?>" alt="<?= html_escape($program['title']); ?>">
                                    <?php elseif (!empty($program['flyer_path'])): ?>
                                        <span>PDF</span>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($program['flyer_path'])): ?>
                                    <a href="<?= base_url($program['flyer_path']); ?>" target="_blank" rel="noopener">Lihat flyer</a>
                                <?php endif; ?>
                                <input type="file" name="program_flyer_file" accept=".jpg,.jpeg,.png,.webp,.pdf">
                            </td>
                            <td>
                                <select name="service_id">
                                    <option value="">-</option>
                                    <?php foreach ($services as $service): ?>
                                        <option value="<?= html_escape($service['id']); ?>" <?= $service['id'] == $program['service_id'] ? 'selected' : ''; ?>><?= html_escape($service['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <select name="category_id">
                                    <option value="">-</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= html_escape($category['id']); ?>" data-slug="<?= html_escape($category['slug']); ?>" <?= $category['id'] == $program['category_id'] ? 'selected' : ''; ?>><?= html_escape($category['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="category_slug" value="<?= html_escape($program['category_slug'] ?: $program['category']); ?>">
                            </td>
                            <td>
                                <input name="title" value="<?= html_escape($program['title']); ?>" required>
                                <input type="hidden" name="description" value="<?= html_escape($program['description']); ?>">
                            </td>
                            <td><input name="mode" value="<?= html_escape($program['mode']); ?>"></td>
                            <td><input type="number" name="sort_order" value="<?= html_escape($program['sort_order']); ?>"></td>
                            <td><label class="check"><input type="checkbox" name="is_active" value="1" <?= $program['is_active'] ? 'checked' : ''; ?>> Aktif</label></td>
                            <td>
                                <button type="submit">Update</button>
                                <button class="danger-link" type="submit" formaction="<?= site_url('admin/delete_program/' . $program['id']); ?>" onclick="return confirm('Hapus program unggulan ini?')">Hapus</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
