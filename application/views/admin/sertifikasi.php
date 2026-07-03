<section class="admin-head">
    <div>
        <p class="eyebrow">Data Sertifikasi</p>
        <h1>Manajemen Flyer Sertifikasi</h1>
        <p>Tambah, edit, dan hapus flyer sertifikasi yang tampil di halaman publik.</p>
    </div>
</section>

<?php if ($this->session->flashdata('success')): ?>
    <div style="background: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb;">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<section id="crud-sertifikasi" class="crud-panel">
    <h2>Tambah Flyer Sertifikasi Baru</h2>
    <form class="form form-row" method="post" action="<?= site_url('admin/sertifikasi_tambah'); ?>" enctype="multipart/form-data">
        <label class="wide">
            Nama / Judul Sertifikasi
            <input name="judul" placeholder="Contoh: Sertifikasi HR Profesional" required>
        </label>

        <label class="wide">
            Kategori Sertifikasi
            <select name="kategori" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Pilih Kategori --</option>
                <option value="Sertifikasi Nasional">Sertifikasi Nasional (BNSP)</option>
                <option value="Sertifikasi Internasional">Sertifikasi Internasional</option>
                <option value="Mini Course">Mini Course / Workshop</option>
            </select>
        </label>
        
        <label class="wide">
            Deskripsi / Ringkasan Program
            <textarea name="deskripsi" rows="3" placeholder="Jelaskan singkat tentang program sertifikasi ini..." required></textarea>
        </label>

        <label class="wide">
            Pilih File Flyer (JPG / PNG / JPEG)
            <input type="file" name="flyer" required style="padding: 5px 0;">
            <small style="color: #666; display: block; margin-top: 5px;">Maksimal ukuran file: 5MB</small>
        </label>

        <label class="check">
            <input type="checkbox" name="is_active" value="1" checked> Aktif (Tampilkan di Landing Page)
        </label>
        
        <button class="btn primary" type="submit">Simpan Sertifikasi</button>
    </form>
</section>

<section class="crud-panel">
    <h2>Daftar Flyer Sertifikasi</h2>
    
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Detail Sertifikasi</th>
                    <th width="15%">Kategori</th>
                    <th width="25%">Preview Flyer</th>
                    <th width="10%">Status</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($sertifikasi)): 
                    // 1. PENGELOMPOKAN DATA BERDASARKAN KATEGORI DI PHP
                    $grouped_sertifikasi = [];
                    foreach ($sertifikasi as $s) {
                        $kat = !empty($s['kategori']) ? $s['kategori'] : 'Lainnya';
                        $grouped_sertifikasi[$kat][] = $s;
                    }

                    $no = 1; 
                    // 2. LOOPING PER KATEGORI
                    foreach($grouped_sertifikasi as $kategori_nama => $items) : 
                ?>
                        <tr class="category-header-row">
                            <td colspan="6" style="background-color: #f1f5f9; color: #1e293b; font-weight: bold; padding: 12px 15px; text-align: left;">
                                📁 Kategori: <?= html_escape($kategori_nama); ?> (<?= count($items); ?> Flyer)
                            </td>
                        </tr>

                        <?php foreach($items as $s): ?>
                        <tr class="<?= !$s['is_active'] ? 'inactive-row' : ''; ?>">
                            <td><?= $no++; ?></td>
                            <td>
                                <strong><?= html_escape($s['judul']); ?></strong>
                                <p style="font-size: 13px; color: #666; margin-top: 5px; line-height: 1.4;"><?= html_escape($s['deskripsi']); ?></p>
                            </td>
                            <td><span class="badge"><?= html_escape($s['kategori']); ?></span></td>
                            <td>
                                <img src="<?= base_url('uploads/sertifikasi/'.$s['flyer']); ?>" width="120" style="border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.15);">
                            </td>
                            <td>
                                <?= $s['is_active'] ? '<span style="color: green; font-weight: bold;">Aktif</span>' : '<span style="color: red;">Nonaktif</span>'; ?>
                            </td>
                            <td>
                                <a class="danger-link" href="<?= site_url('admin/sertifikasi_hapus/'.$s['id']); ?>" onclick="return confirm('Hapus flyer ini?')" style="text-decoration: none; padding: 5px 10px; display: inline-block;">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: #888; padding: 20px;">Belum ada flyer sertifikasi yang di-upload.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>