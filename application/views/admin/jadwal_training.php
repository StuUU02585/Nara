<section class="admin-head">
    <div>
        <p class="eyebrow">Data Jadwal Training</p>
        <h1>Manajemen Flyer Jadwal Training</h1>
        <p>Tambah dan hapus flyer jadwal training yang tampil di halaman publik.</p>
    </div>
</section>

<?php if ($this->session->flashdata('success')): ?>
    <div style="background: #d4edda; color: #155724; padding: 12px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #c3e6cb;">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 12px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #f5c6cb;">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php endif; ?>

<section id="crud-jadwal-training" class="crud-panel">
    <h2>Tambah Flyer Jadwal Training Baru</h2>
    <form class="form form-row" method="post" action="<?= site_url('admin/jadwal_training_tambah'); ?>" enctype="multipart/form-data">
        
        <label class="wide">
            Nama / Judul Training
            <input name="judul" placeholder="Contoh: Pelatihan Digital Marketing Batch 5" required>
        </label>

        <label class="wide">
            Kategori Training
            <select name="kategori" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">-- Pilih Kategori --</option>
                <option value="In-House Training">In-House Training</option>
                <option value="Short Training">Short Training</option>
            </select>
        </label>

        <label class="wide">
            Pilih File Flyer (JPG / PNG / JPEG)
            <input type="file" name="flyer" required style="padding: 5px 0;">
            <small style="color: #666; display: block; margin-top: 5px;">Maksimal ukuran file: 5MB</small>
        </label>
        
        <button class="btn primary" type="submit">Simpan Jadwal Training</button>
    </form>
</section>

<section class="crud-panel"><section class="crud-panel">
    <h2>Daftar Flyer Jadwal Training</h2>
    
    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama / Judul Training</th>
                    <th width="20%">Kategori</th>
                    <th width="25%">Preview Flyer</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($jadwal)): 
                    // 1. PENGELOMPOKAN DATA BERDASARKAN KATEGORI DI PHP
                    $grouped_jadwal = [];
                    foreach ($jadwal as $row) {
                        $kat = !empty($row['kategori']) ? $row['kategori'] : 'Lainnya';
                        $grouped_jadwal[$kat][] = $row;
                    }

                    $no = 1; 
                    // 2. LOOPING PER KATEGORI UTAMA
                    foreach($grouped_jadwal as $kategori_nama => $items) : 
                ?>
                        <tr class="category-header-row">
                            <td colspan="5" style="background-color: #f1f5f9; color: #1e293b; font-weight: bold; padding: 12px 15px; text-align: left;">
                                📁 Kategori: <?= html_escape($kategori_nama); ?> (<?= count($items); ?> Flyer)
                            </td>
                        </tr>

                        <?php foreach($items as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <strong><?= html_escape($row['judul']); ?></strong>
                            </td>
                            <td>
                                <span class="badge" style="background: #e2e8f0; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; color: #475569;">
                                    <?= html_escape($row['kategori']); ?>
                                </span>
                            </td>
                            <td>
                                <img src="<?= base_url('uploads/jadwal_training/'.$row['flyer']); ?>" width="120" style="border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.15);">
                            </td>
                            <td>
                                <a class="danger-link" href="<?= site_url('admin/jadwal_training_hapus/'.$row['id']); ?>" onclick="return confirm('Hapus flyer jadwal training ini?')" style="text-decoration: none; padding: 5px 10px; display: inline-block;">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: #888; padding: 20px;">Belum ada flyer jadwal training yang di-upload.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>