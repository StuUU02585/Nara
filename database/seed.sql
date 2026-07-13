INSERT INTO site_settings (setting_key, setting_value) VALUES
('site_name', 'Sahabat Nara'),
('whatsapp_number', '+62 856-8837-800'),
('tagline', 'Nara-HR.com - We Make People Grow')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

INSERT INTO home_slides (title, image_path, alt_text, sort_order) VALUES
('Dokumentasi Kegiatan Pelatihan', 'uploads/slides/headline-utama-1.jpg', 'Dokumentasi kegiatan pelatihan Nara-HR', 1),
('Dokumentasi Peserta dan Trainer', 'uploads/slides/headline-utama-2.jpg', 'Dokumentasi peserta dan trainer Nara-HR', 2)
ON DUPLICATE KEY UPDATE title = VALUES(title), alt_text = VALUES(alt_text), sort_order = VALUES(sort_order), is_active = 1;

INSERT INTO programs (category, title, slug, description, mode, sort_order) VALUES
('short_training', 'Training Singkat Online', 'training-singkat-online', 'Pelatihan singkat intensif dengan materi padat, praktis, dan langsung diterapkan.', 'Online / Offline', 1),
('in_house', 'In-House Training', 'in-house-training', 'Program pelatihan eksklusif yang disesuaikan dengan kebutuhan dan budaya perusahaan.', 'Online / Offline', 2),
('bnsp', 'Sertifikasi Nasional BNSP', 'sertifikasi-bnsp', 'Sertifikasi resmi untuk meningkatkan kredibilitas dan kompetensi profesional HR.', 'Online / Offline', 3),
('kan_iaf', 'Sertifikasi Internasional KAN - IAF', 'sertifikasi-kan-iaf', 'Program internasional seperti IHCM dan ITM untuk penguatan kompetensi global.', 'Online / Offline', 4),
('consulting', 'Program Konsultansi HR', 'konsultansi-hr', 'Pendampingan SOP HR, struktur organisasi, performance management, dan talent development.', 'Konsultasi', 5)
ON DUPLICATE KEY UPDATE description = VALUES(description), mode = VALUES(mode);

INSERT INTO services (name, slug, description, sort_order) VALUES
('HR Training', 'hr-training', 'Layanan pelatihan Human Resources untuk staf HR maupun non-HR.', 1)
ON DUPLICATE KEY UPDATE description = VALUES(description);

INSERT INTO market_segments (name, description, sort_order) VALUES
('HRD Staff / Non HR', 'Peserta dari tim HRD staff maupun fungsi non-HR yang membutuhkan pemahaman HR dasar.', 1)
ON DUPLICATE KEY UPDATE description = VALUES(description);

INSERT INTO program_categories (name, slug, sort_order) VALUES
('Short Training', 'short_training', 1),
('In-House', 'in_house', 2),
('BNSP', 'bnsp', 3),
('KAN - IAF', 'kan_iaf', 4),
('Consulting', 'consulting', 5)
ON DUPLICATE KEY UPDATE name = VALUES(name), sort_order = VALUES(sort_order), is_active = 1;

INSERT INTO programs (service_id, category, title, slug, description, mode, sort_order)
SELECT id, 'short_training', 'Human Resources Basic Training (HR for Non HR)', 'human-resources-basic-training-hr-for-non-hr', 'Program dasar HR untuk peserta HRD Staff dan non-HR.', 'Online', 10
FROM services
WHERE slug = 'hr-training'
ON DUPLICATE KEY UPDATE service_id = VALUES(service_id), description = VALUES(description), mode = VALUES(mode);

UPDATE programs
SET service_id = (SELECT id FROM services WHERE slug = 'hr-training')
WHERE slug IN ('training-singkat-online', 'human-resources-basic-training-hr-for-non-hr');

INSERT IGNORE INTO training_agendas (program_id, title, start_date, end_date, mode, location, quota)
SELECT id, 'HR Staff Competency Short Training', '2026-06-15', '2026-06-16', 'Online', 'Zoom Meeting', 50 FROM programs WHERE slug = 'training-singkat-online'
UNION ALL
SELECT id, 'HR Supervisor Certification Preparation', '2026-07-08', '2026-07-10', 'Hybrid', 'Jakarta / Online', 40 FROM programs WHERE slug = 'sertifikasi-bnsp'
UNION ALL
SELECT id, 'International Human Capital Masterclass', '2026-08-12', '2026-08-14', 'Online', 'Zoom Meeting', 35 FROM programs WHERE slug = 'sertifikasi-kan-iaf';

INSERT IGNORE INTO trainers (name, role, expertise, bio, sort_order) VALUES
('Anton Pranowo', 'Trainer Human Resources', 'Human Resource Management Generalist', 'Trainer HR untuk penguatan kompetensi dasar manajemen SDM.', 0),
('Dr. Dasep Suryanto Ph.D', 'Chairman PT. Nara Pratama Nusantara', 'HR Strategist, Leadership Communication, HR Business Partner', 'Praktisi dan konsultan pengembangan organisasi serta kepemimpinan.', 1),
('Kiagus Rifdan Anshori S.Psi, MM', 'Direktur Utama PT. Nara Pratama Nusantara', 'Learning and Development, Project Direction', 'Berpengalaman dalam pengembangan program learning dan akademi profesional.', 2),
('Ahmad Bayhaqi S.Psi M.Psi Psikolog', 'Psikolog Industri dan Organisasi', 'Recruitment and Selection', 'Konsultan asesmen, rekrutmen, dan seleksi berbasis kompetensi.', 3),
('EY Eka Kurniawan S.Psi M.Psi Psikolog', 'Department Head Human Resources', 'Organization Development', 'Praktisi HR untuk pengembangan organisasi dan sistem SDM.', 4),
('Angga Liberty Pratama S.Pd, M.Pd', 'Direktur Utama Garis Kreasi', 'HR Information and Multimedia', 'Spesialis informasi, multimedia, dan pembelajaran digital HR.', 5),
('Prof. Dr. Pribadiono Ir, M.S', 'Founder PT. Quantum HRM International', 'Organization and People Development', 'Pakar pengembangan organisasi dan manusia.', 6),
('Brett Mc Guire', 'Business and Legal Consultant', 'Business, Legal, Commercial', 'Konsultan bisnis dan legal berpengalaman di kawasan Asia.', 7),
('Kimble Nicholes', 'Educator, Trainer, Consultant', 'Training Design, Project Risk Analysis', 'Trainer dan konsultan desain pelatihan serta analisis risiko proyek.', 8);

INSERT INTO trainings (program_id, trainer_id, market_segment_id, title, schedule_label, venue_method, duration_minutes, sort_order)
SELECT p.id, t.id, ms.id, 'Human Resource Management Generalist', 'Juni 2026', 'Online', 150, 1
FROM programs p, trainers t, market_segments ms
WHERE p.slug = 'human-resources-basic-training-hr-for-non-hr'
  AND t.name = 'Anton Pranowo'
  AND ms.name = 'HRD Staff / Non HR'
ON DUPLICATE KEY UPDATE trainer_id = VALUES(trainer_id), market_segment_id = VALUES(market_segment_id), schedule_label = VALUES(schedule_label), venue_method = VALUES(venue_method), duration_minutes = VALUES(duration_minutes);

INSERT INTO trainings (program_id, trainer_id, market_segment_id, title, schedule_label, venue_method, duration_minutes, sort_order)
SELECT p.id, t.id, ms.id, 'Interviewing Skill', 'Juni 2026', 'Online', 150, 2
FROM programs p, trainers t, market_segments ms
WHERE p.slug = 'human-resources-basic-training-hr-for-non-hr'
  AND t.name = 'Kiagus Rifdan Anshori S.Psi, MM'
  AND ms.name = 'HRD Staff / Non HR'
ON DUPLICATE KEY UPDATE trainer_id = VALUES(trainer_id), market_segment_id = VALUES(market_segment_id), schedule_label = VALUES(schedule_label), venue_method = VALUES(venue_method), duration_minutes = VALUES(duration_minutes);

INSERT INTO trainings (program_id, trainer_id, market_segment_id, title, schedule_label, venue_method, duration_minutes, sort_order)
SELECT p.id, t.id, ms.id, 'Psikodiagnostik & Character Analysis', 'Juni 2026', 'Online', 150, 3
FROM programs p, trainers t, market_segments ms
WHERE p.slug = 'human-resources-basic-training-hr-for-non-hr'
  AND t.name = 'Ahmad Bayhaqi S.Psi M.Psi Psikolog'
  AND ms.name = 'HRD Staff / Non HR'
ON DUPLICATE KEY UPDATE trainer_id = VALUES(trainer_id), market_segment_id = VALUES(market_segment_id), schedule_label = VALUES(schedule_label), venue_method = VALUES(venue_method), duration_minutes = VALUES(duration_minutes);

INSERT INTO trainings (program_id, trainer_id, market_segment_id, title, schedule_label, venue_method, duration_minutes, sort_order)
SELECT p.id, t.id, ms.id, 'Career Plan', 'Juni 2026', 'Online', 150, 4
FROM programs p, trainers t, market_segments ms
WHERE p.slug = 'human-resources-basic-training-hr-for-non-hr'
  AND t.name = 'Dr. Dasep Suryanto Ph.D'
  AND ms.name = 'HRD Staff / Non HR'
ON DUPLICATE KEY UPDATE trainer_id = VALUES(trainer_id), market_segment_id = VALUES(market_segment_id), schedule_label = VALUES(schedule_label), venue_method = VALUES(venue_method), duration_minutes = VALUES(duration_minutes);

INSERT IGNORE INTO clients (name, note, sort_order) VALUES
('UIN Jakarta Faculty of Psychology', 'Logo resmi fakultas', 1),
('YARSI University Faculty of Medical', 'Logo universitas', 2),
('Permata Bank', 'Logo terbaru', 3),
('Alfamart', 'Logo resmi', 4),
('Ace Hardware Indonesia', 'Rebrand ke Azko di beberapa tempat', 5),
('Toys Kingdom', 'Logo resmi', 6),
('Office 1 Superstore', 'Vector', 7),
('Informa', 'Situs resmi', 8),
('Takenaka Indonesia, PT', 'https://takenaka.asia/indonesia/contact', 9),
('BPJS Ketenagakerjaan', 'Logo resmi', 10),
('Kemenkeu RI', 'Logo resmi', 11),
('Directorate General of Customs and Excise', 'Bea Cukai', 12),
('Ciputra Group', 'Logo resmi', 13),
('Huawei Indonesia', 'Logo resmi', 14),
('PLN', 'Perusahaan Listrik Negara', 15),
('Krakatau Steel', NULL, 16),
('Bina Sarana Informatika University', 'bsi.ac.id', 17),
('JNE Expedition', 'Logo resmi', 18),
('Grab Indonesia', NULL, 19),
('Panasonic', NULL, 20);

INSERT IGNORE INTO articles (title, summary, external_url, published_at) VALUES
('PT Pan Brothers Tbk dan Group Buka Lowongan Strategis di Tangerang', 'Informasi peluang karir strategis untuk profesional industri manufaktur.', 'https://proleadindonesia.com/2026/05/17/pt-pan-brothers-tbk-dan-group-buka-lowongan-strategis-di-tangerang-cari-profesional-berpengalaman-di-industri-manufaktur/', '2026-05-17'),
('Disiplin Sehat Ala Pemimpin Pintar', 'Cara melatih diri menyukai makanan sehat sebagai bagian dari disiplin kepemimpinan.', 'https://proleadindonesia.com/2026/05/08/disiplin-sehat-ala-pemimpin-pintar-cara-melatih-diri-menyukai-makanan-sehat/', '2026-05-08'),
('Cara Membangun Jiwa Pemimpin Saat Masih Jadi Bawahan', 'Insight praktis membangun leadership sebelum memegang jabatan formal.', 'https://proleadindonesia.com/2026/03/31/cara-membangun-jiwa-pemimpin-saat-masih-jadi-bawahan/', '2026-03-31'),
('Kepemimpinan yang Ditakuti Tak Membangun Wibawa', 'Mengapa rasa hormat lebih kuat daripada rasa takut dalam kepemimpinan.', 'https://proleadindonesia.com/2026/04/13/kepemimpinan-yang-ditakuti-tak-membangun-wibawa-mengapa-rasa-hormat-lebih-kuat-daripada-rasa-takut/', '2026-04-13');
