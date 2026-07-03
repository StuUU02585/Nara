<section class="admin-hero">
    <div>
        <p class="eyebrow">Dashboard Administrator</p>
        <h1>Pusat Operasional Sahabat Nara</h1>
        <p>Pantau pendaftaran peserta, follow-up WhatsApp, kesiapan katalog training, dan kelengkapan aset website dari satu halaman kerja.</p>
    </div>
    <div class="admin-actions">
        <a class="btn primary" href="<?= site_url('daftar'); ?>">Buka Form Publik</a>
        <a class="btn" href="<?= site_url('admin/training_catalog'); ?>">Kelola Training</a>
    </div>
</section>

<section class="kpi-grid">
    <article class="kpi-card accent-green">
        <span>Total Pendaftaran</span>
        <strong><?= html_escape($stats['total']); ?></strong>
        <small><?= html_escape($stats['this_month']); ?> bulan ini</small>
    </article>
    <article class="kpi-card accent-gold">
        <span>Perlu Follow-up</span>
        <strong><?= html_escape($stats['new']); ?></strong>
        <small><?= html_escape($stats['today']); ?> masuk hari ini</small>
    </article>
    <article class="kpi-card accent-blue">
        <span>Sudah Dihubungi</span>
        <strong><?= html_escape($stats['contacted']); ?></strong>
        <small><?= html_escape($stats['wa_group']); ?> masuk grup WA</small>
    </article>
    <article class="kpi-card accent-ink">
        <span>Katalog Aktif</span>
        <strong><?= html_escape($stats['trainings']); ?></strong>
        <small><?= html_escape($stats['programs']); ?> program</small>
    </article>
</section>

<section class="kpi-grid traffic-kpi-grid" aria-label="Ringkasan trafik poster">
    <article class="kpi-card accent-blue">
        <span>Total Klik Poster</span>
        <strong><?= html_escape($traffic_summary['total_clicks']); ?></strong>
        <small>Seluruh poster yang dipantau</small>
    </article>
    <article class="kpi-card accent-green">
        <span>Klik Hari Ini</span>
        <strong><?= html_escape($traffic_summary['today_clicks']); ?></strong>
        <small>Aktivitas sejak pukul 00.00</small>
    </article>
    <article class="kpi-card accent-gold">
        <span>Pengunjung Unik</span>
        <strong><?= html_escape($traffic_summary['unique_visitors']); ?></strong>
        <small>Identitas tersimpan secara anonim</small>
    </article>
    <article class="kpi-card accent-ink">
        <span>Klik Bulan Ini</span>
        <strong><?= html_escape($traffic_summary['month_clicks']); ?></strong>
        <small><?= html_escape(date('F Y')); ?></small>
    </article>
</section>

<?php
    $poster_type_labels = [
        'why_us' => 'Why Us',
        'program' => 'Program Unggulan',
        'training' => 'Training',
        'certification' => 'Sertifikasi',
        'gallery' => 'Galeri',
    ];
?>
<section class="dashboard-grid poster-traffic-grid" aria-label="Analitik trafik poster">
    <article class="dashboard-panel">
        <div class="panel-title">
            <div>
                <p class="eyebrow">Trafik Poster</p>
                <h2>Poster Paling Banyak Dilihat</h2>
            </div>
        </div>
        <div class="table-wrap traffic-table">
            <table>
                <thead>
                    <tr>
                        <th>Poster</th>
                        <th>Jenis</th>
                        <th>Klik</th>
                        <th>Unik</th>
                        <th>Terakhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($top_posters as $poster): ?>
                        <tr>
                            <td><strong><?= html_escape($poster['poster_name']); ?></strong></td>
                            <td><?= html_escape($poster_type_labels[$poster['poster_type']] ?? $poster['poster_type']); ?></td>
                            <td><strong><?= html_escape($poster['total_clicks']); ?></strong></td>
                            <td><?= html_escape($poster['unique_visitors']); ?></td>
                            <td><?= html_escape(date('d-m-Y H:i', strtotime($poster['last_clicked_at']))); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (!$top_posters): ?>
                        <tr><td colspan="5">Belum ada klik poster yang tercatat.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </article>

    <article class="dashboard-panel">
        <div class="panel-title">
            <div>
                <p class="eyebrow">Aktivitas Terbaru</p>
                <h2>Klik Poster Terakhir</h2>
            </div>
        </div>
        <div class="traffic-recent-list">
            <?php foreach ($recent_poster_clicks as $click): ?>
                <div class="traffic-recent-item">
                    <span><?= html_escape($poster_type_labels[$click['poster_type']] ?? $click['poster_type']); ?></span>
                    <strong><?= html_escape($click['poster_name']); ?></strong>
                    <small><?= html_escape(date('d-m-Y H:i', strtotime($click['clicked_at']))); ?> · <?= html_escape($click['page_path']); ?></small>
                </div>
            <?php endforeach; ?>
            <?php if (!$recent_poster_clicks): ?>
                <p class="empty-state">Aktivitas klik poster akan tampil di sini.</p>
            <?php endif; ?>
        </div>
    </article>
</section>

<section class="dashboard-grid">
    <article class="dashboard-panel">
        <div class="panel-title">
            <div>
                <p class="eyebrow">Status Peserta</p>
                <h2>Follow-up Pendaftaran</h2>
            </div>
        </div>
        <?php $total = max(1, (int) $stats['total']); ?>
        <?php foreach ($status_breakdown as $status => $count): ?>
            <?php $percent = round(($count / $total) * 100); ?>
            <div class="progress-row">
                <div>
                    <strong><?= html_escape(str_replace('_', ' ', $status)); ?></strong>
                    <span><?= html_escape($count); ?> peserta</span>
                </div>
                <div class="progress-track"><span style="width: <?= html_escape($percent); ?>%"></span></div>
            </div>
        <?php endforeach; ?>
    </article>

    <article class="dashboard-panel">
        <div class="panel-title">
            <div>
                <p class="eyebrow">Manajemen Data</p>
                <h2>Akses Cepat</h2>
            </div>
        </div>
        <div class="admin-shortcuts">
            <a href="<?= site_url('admin/programs'); ?>">Data Program Unggulan</a>
            <a href="<?= site_url('admin/training_catalog'); ?>">Data Trainning</a>
            <a href="<?= site_url('admin/mentors'); ?>">Data Mentor</a>
            <a href="<?= site_url('admin/articles'); ?>">Data Artikel</a>
            <a href="<?= site_url('admin/clients'); ?>">Data Perusahaan</a>
            <a href="<?= site_url('admin/socials'); ?>">Media Sosial</a>
        </div>
    </article>
</section>

<section class="dashboard-grid wide-left">
    <article class="dashboard-panel">
        <div class="panel-title">
            <div>
                <p class="eyebrow">Pendaftaran Terbaru</p>
                <h2>Peserta Masuk</h2>
            </div>
        </div>
        <div class="activity-list">
            <?php foreach ($latest_registrations as $item): ?>
                <div class="activity-item">
                    <div class="activity-avatar"><?= html_escape(strtoupper(substr($item['full_name'], 0, 1))); ?></div>
                    <div>
                        <strong><?= html_escape($item['full_name']); ?></strong>
                        <span><?= html_escape($item['program_title']); ?><?= $item['training_title'] ? ' - ' . html_escape($item['training_title']) : ''; ?></span>
                        <small><?= html_escape($item['institution']); ?> · <?= html_escape($item['created_at']); ?></small>
                    </div>
                    <span class="status-pill status-<?= html_escape($item['status']); ?>"><?= html_escape(str_replace('_', ' ', $item['status'])); ?></span>
                </div>
            <?php endforeach; ?>
            <?php if (!$latest_registrations): ?>
                <p class="empty-state">Belum ada pendaftaran baru.</p>
            <?php endif; ?>
        </div>
    </article>

    <article class="dashboard-panel">
        <div class="panel-title">
            <div>
                <p class="eyebrow">Katalog</p>
                <h2>Program & Training</h2>
            </div>
        </div>
        <div class="catalog-list">
            <?php foreach ($training_pipeline as $program): ?>
                <div>
                    <span><?= html_escape($program['service_name'] ?: 'Tanpa service'); ?></span>
                    <strong><?= html_escape($program['program_title']); ?></strong>
                    <small><?= html_escape($program['training_total']); ?> training aktif</small>
                </div>
            <?php endforeach; ?>
        </div>
    </article>
</section>

<section id="pendaftaran" class="dashboard-panel">
    <div class="panel-title">
        <div>
            <p class="eyebrow">Work Queue</p>
            <h2>Kelola Pendaftaran Peserta</h2>
        </div>
        <span class="panel-note">Materi tetap diarahkan melalui grup WhatsApp</span>
    </div>

    <form class="admin-filter" method="get" action="<?= site_url('admin'); ?>">
        <label>
            <span>Status</span>
            <select name="status">
                <option value="">Semua status</option>
                <?php foreach (['baru', 'dihubungi', 'masuk_grup_wa', 'selesai', 'batal'] as $status): ?>
                    <option value="<?= $status; ?>" <?= ($filters['status'] ?? '') === $status ? 'selected' : ''; ?>><?= html_escape(str_replace('_', ' ', $status)); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>
            <span>Cari</span>
            <input name="keyword" value="<?= html_escape($filters['keyword'] ?? ''); ?>" placeholder="Nama, WA, email, instansi, program">
        </label>
        <button type="submit">Terapkan Filter</button>
        <a href="<?= site_url('admin'); ?>">Reset</a>
    </form>

    <?php $export_query = http_build_query(array_filter($filters ?? [], function ($value) {
        return $value !== '' && $value !== null;
    })); ?>
    <div class="export-actions">
        <a href="<?= site_url('admin/export_registrations/excel') . ($export_query ? '?' . $export_query : ''); ?>">Unduh Excel</a>
        <a class="pdf" href="<?= site_url('admin/export_registrations/pdf') . ($export_query ? '?' . $export_query : ''); ?>">Unduh PDF</a>
    </div>

    <div class="table-wrap admin-table-modern">
        <table>
            <thead>
                <tr>
                    <th>Peserta</th>
                    <th>Program & Training</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    <th>Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registrations as $registration): ?>
                    <tr>
                        <td>
                            <strong><?= html_escape($registration['full_name']); ?></strong>
                            <span><?= html_escape($registration['institution']); ?> · <?= html_escape($registration['position']); ?></span>
                            <small><?= html_escape($registration['participant_count']); ?> peserta</small>
                        </td>
                        <td>
                            <strong><?= html_escape($registration['program_title']); ?></strong>
                            <span><?= html_escape($registration['training_title'] ?: 'Tanpa training spesifik'); ?></span>
                            <small><?= html_escape($registration['agenda_title'] ?: 'Tanpa agenda khusus'); ?></small>
                        </td>
                        <td>
                            <a class="wa-link" href="https://wa.me/<?= preg_replace('/\D+/', '', $registration['phone']); ?>" target="_blank" rel="noopener"><?= html_escape($registration['phone']); ?></a>
                            <span><?= html_escape($registration['email']); ?></span>
                        </td>
                        <td><span class="status-pill status-<?= html_escape($registration['status']); ?>"><?= html_escape(str_replace('_', ' ', $registration['status'])); ?></span></td>
                        <td>
                            <form method="post" action="<?= site_url('admin/update_registration/' . $registration['id']); ?>" class="inline-form">
                                <input type="hidden" name="return_to" value="<?= html_escape('admin?' . http_build_query($filters)); ?>">
                                <select name="status">
                                    <?php foreach (['baru', 'dihubungi', 'masuk_grup_wa', 'selesai', 'batal'] as $status): ?>
                                        <option value="<?= $status; ?>" <?= $registration['status'] === $status ? 'selected' : ''; ?>><?= str_replace('_', ' ', $status); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <textarea name="admin_note" rows="2" placeholder="Catatan follow-up"><?= html_escape($registration['admin_note']); ?></textarea>
                                <div class="quick-actions">
                                    <button type="submit">Simpan</button>
                                    <a href="https://wa.me/<?= preg_replace('/\D+/', '', $registration['phone']); ?>?text=Halo%20<?= rawurlencode($registration['full_name']); ?>,%20kami%20dari%20Sahabat%20Nara%20ingin%20menindaklanjuti%20pendaftaran%20Anda." target="_blank" rel="noopener">Chat WA</a>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (!$registrations): ?>
                    <tr><td colspan="5">Belum ada pendaftaran.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
