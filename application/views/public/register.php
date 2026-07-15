<section class="page-hero register-hero">
    <p class="eyebrow">Konsultansi Nara-HR</p>
    <h1>Program Consultancy SDM Nara-HR</h1>
    <p>Tidak berhenti di pelatihan. Kami mendampingi Anda dalam mengimplementasikan perubahan di perusahaan kearah yang lebih baik untuk menunjang kemajuan bisnis dan mengoptimalkan sumber daya manusia yang terus berkembang.</p>
</section>

<!-- ========================================================================= -->
<!-- TANDA 1: SLIDER DENGAN TOMBOL PANAH YANG BISA OTOMATIS "OFF" -->
<!-- ========================================================================= -->
<section class="section product-slider-section" style="padding: 30px 0; background: #f4f0fa; text-align: center; position: relative;">
    
    
    <!-- Wrapper Utama Slider + Tombol Panah -->
    <div class="slider-outer-wrapper" style="position: relative; max-width: 1300px; margin: 0 auto; display: flex; align-items: center; padding: 0 50px;">
        
        <!-- Tombol Panah Kiri (Diberi id="prevBtn" dan default-nya "off") -->
        <button id="prevBtn" onclick="slideScroll(-410)" style="position: absolute; left: 0; z-index: 10; border: none; background: white; border-radius: 50%; width: 45px; height: 45px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 20px; color: #555; font-weight: bold; transition: all 0.3s ease; opacity: 0.3; pointer-events: none;">
            &#10094;
        </button>
        
        <!-- Container Slider -->
        <div id="programSlider" style="display: flex; gap: 24px; overflow-x: auto; scroll-behavior: smooth; padding: 15px 5px; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; width: 100%;">
            
            <!-- Card 1: Assessment -->
            <div class="slider-card" style="flex: 0 0 auto; width: 380px; scroll-snap-align: start; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); padding: 16px; border: 1px solid #f0f0f0; box-sizing: border-box; text-align: left;">
                <div style="width: 100%; height: 420px; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 12px; overflow: hidden;">
                    <img src="<?= base_url('assets/img/konsultansi/flayer konsultansi_assessment.png'); ?>" alt="Assessment Center" style="width: 100%; height: 100%; object-fit: contain; cursor: zoom-in;" onclick="openLightbox(this.src, this.alt)">
                </div>
                <a href="https://wa.me/6282261899131" target="_blank" style="display: inline-block; margin-top: 15px; color: #006644; font-weight: bold; text-decoration: none; font-size: 15px;">Konsultasi CS Nara-HR &gt; &gt;</a>
            </div>

            <!-- Card 2: HR Audit -->
            <div class="slider-card" style="flex: 0 0 auto; width: 380px; scroll-snap-align: start; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); padding: 16px; border: 1px solid #f0f0f0; box-sizing: border-box; text-align: left;">
                <div style="width: 100%; height: 420px; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 12px; overflow: hidden;">
                    <img src="<?= base_url('assets/img/konsultansi/flayer konsultansi_hr audit.png'); ?>" alt="HR Audit" style="width: 100%; height: 100%; object-fit: contain; cursor: zoom-in;" onclick="openLightbox(this.src, this.alt)">
                </div>
                <a href="https://wa.me/6282261899131" target="_blank" style="display: inline-block; margin-top: 15px; color: #006644; font-weight: bold; text-decoration: none; font-size: 15px;">Konsultasi CS Nara-HR &gt; &gt;</a>
            </div>

            <!-- Card 3: HR Teknologi -->
            <div class="slider-card" style="flex: 0 0 auto; width: 380px; scroll-snap-align: start; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); padding: 16px; border: 1px solid #f0f0f0; box-sizing: border-box; text-align: left;">
                <div style="width: 100%; height: 420px; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 12px; overflow: hidden;">
                    <img src="<?= base_url('assets/img/konsultansi/flayer konsultansi_hr teknologi.png'); ?>" alt="HR Teknologi" style="width: 100%; height: 100%; object-fit: contain; cursor: zoom-in;" onclick="openLightbox(this.src, this.alt)">
                </div>
                <a href="https://wa.me/6282261899131" target="_blank" style="display: inline-block; margin-top: 15px; color: #006644; font-weight: bold; text-decoration: none; font-size: 15px;">Konsultasi CS Nara-HR &gt; &gt;</a>
            </div>

            <!-- Card 4: HRS -->
            <div class="slider-card" style="flex: 0 0 auto; width: 380px; scroll-snap-align: start; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); padding: 16px; border: 1px solid #f0f0f0; box-sizing: border-box; text-align: left;">
                <div style="width: 100%; height: 420px; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 12px; overflow: hidden;">
                    <img src="<?= base_url('assets/img/konsultansi/flayer konsultansi_hrs.png'); ?>" alt="HRS" style="width: 100%; height: 100%; object-fit: contain; cursor: zoom-in;" onclick="openLightbox(this.src, this.alt)">
                </div>
                <a href="https://wa.me/6282261899131" target="_blank" style="display: inline-block; margin-top: 15px; color: #006644; font-weight: bold; text-decoration: none; font-size: 15px;">Konsultasi CS Nara-HR &gt; &gt;</a>
            </div>

            <!-- Card 5: Learning & Development -->
            <div class="slider-card" style="flex: 0 0 auto; width: 380px; scroll-snap-align: start; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); padding: 16px; border: 1px solid #f0f0f0; box-sizing: border-box; text-align: left;">
                <div style="width: 100%; height: 420px; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 12px; overflow: hidden;">
                    <img src="<?= base_url('assets/img/konsultansi/flayer konsultansi_learning development.png'); ?>" alt="Learning & Development" style="width: 100%; height: 100%; object-fit: contain; cursor: zoom-in;" onclick="openLightbox(this.src, this.alt)">
                </div>
                <a href="https://wa.me/6282261899131" target="_blank" style="display: inline-block; margin-top: 15px; color: #006644; font-weight: bold; text-decoration: none; font-size: 15px;">Konsultasi CS Nara-HR &gt; &gt;</a>
            </div>

            <!-- Card 6: Performance -->
            <div class="slider-card" style="flex: 0 0 auto; width: 380px; scroll-snap-align: start; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); padding: 16px; border: 1px solid #f0f0f0; box-sizing: border-box; text-align: left;">
                <div style="width: 100%; height: 420px; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 12px; overflow: hidden;">
                    <img src="<?= base_url('assets/img/konsultansi/flayer konsultansi_performance.png'); ?>" alt="Performance" style="width: 100%; height: 100%; object-fit: contain; cursor: zoom-in;" onclick="openLightbox(this.src, this.alt)">
                </div>
                <a href="https://wa.me/6282261899131" target="_blank" style="display: inline-block; margin-top: 15px; color: #006644; font-weight: bold; text-decoration: none; font-size: 15px;">Konsultasi CS Nara-HR &gt; &gt;</a>
            </div>

            <!-- Card 7: Talent Management -->
            <div class="slider-card" style="flex: 0 0 auto; width: 380px; scroll-snap-align: start; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); padding: 16px; border: 1px solid #f0f0f0; box-sizing: border-box; text-align: left;">
                <div style="width: 100%; height: 420px; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 12px; overflow: hidden;">
                    <img src="<?= base_url('assets/img/konsultansi/flayer konsultansi_talent mangement.png'); ?>" alt="Talent Management" style="width: 100%; height: 100%; object-fit: contain; cursor: zoom-in;" onclick="openLightbox(this.src, this.alt)">
                </div>
                <a href="https://wa.me/6282261899131" target="_blank" style="display: inline-block; margin-top: 15px; color: #006644; font-weight: bold; text-decoration: none; font-size: 15px;">Konsultasi CS Nara-HR &gt; &gt;</a>
            </div>

            <!-- Card 8: Workforce -->
            <div class="slider-card" style="flex: 0 0 auto; width: 380px; scroll-snap-align: start; background: #ffffff; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); padding: 16px; border: 1px solid #f0f0f0; box-sizing: border-box; text-align: left;">
                <div style="width: 100%; height: 420px; display: flex; align-items: center; justify-content: center; background: #fafafa; border-radius: 12px; overflow: hidden;">
                    <img src="<?= base_url('assets/img/konsultansi/flayer konsultansi_workfloce.png'); ?>" alt="Workforce" style="width: 100%; height: 100%; object-fit: contain; cursor: zoom-in;" onclick="openLightbox(this.src, this.alt)">
                </div>
                <a href="https://wa.me/6282261899131" target="_blank" style="display: inline-block; margin-top: 15px; color: #006644; font-weight: bold; text-decoration: none; font-size: 15px;">Konsultasi CS Nara-HR &gt; &gt;</a>
            </div>

        </div>
        
        <!-- Tombol Panah Kanan (Diberi id="nextBtn") -->
        <button id="nextBtn" onclick="slideScroll(410)" style="position: absolute; right: 0; z-index: 10; border: none; background: white; border-radius: 50%; width: 45px; height: 45px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 20px; color: #555; font-weight: bold; transition: all 0.3s ease;">
            &#10095;
        </button>
        
    </div>
</section>

<!-- ELEMEN MODAL LIGHTBOX -->
<div id="imageLightbox" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.85); align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;">
    <span style="position: absolute; top: 20px; right: 30px; color: #fff; font-size: 40px; font-weight: bold; cursor: pointer;" onclick="closeLightbox()">&times;</span>
    <img id="lightboxImg" style="max-width: 90%; max-height: 85%; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.5);">
    <div id="lightboxCaption" style="position: absolute; bottom: 20px; color: #fff; font-size: 18px; text-align: center; width: 100%;"></div>
</div>
<!-- ========================================================================= -->


<!-- SECTION UTAMA (AREA KUNING / REGISTER FORM) -->
<section class="section narrow register-section" style="padding-top: 50px; position: relative; z-index: 1;">

    <!-- ========================================================================= -->
    <!-- TANDA 2: HEADLINE NYATU DI DALAM SECTION FORM -->
    <!-- ========================================================================= -->
    <div class="headline-form-wrapper" style="margin-top: 20px; margin-bottom: 40px; text-align: center;">
        <h2>Hubungi tim Nara-HR sekarang</h2>
        <p style="max-width: 600px; margin: 15px auto 0 auto; line-height: 1.6;">Layanan ini sangat cocok bagi perusahaan yang ingin membangun sistem HR yang solid dan berkelanjutan dengan bantuan praktisi berpengalaman.</p>
    </div>
    <!-- ========================================================================= -->

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert success"><?= html_escape($this->session->flashdata('success')); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert error"><?= html_escape($this->session->flashdata('error')); ?></div>
    <?php endif; ?>

    <form class="form registration-panel" method="post" action="<?= site_url('daftar/simpan'); ?>">
        <label>Nama Lengkap<input name="full_name" value="<?= set_value('full_name'); ?>" required></label>
        <label>Email<input type="email" name="email" value="<?= set_value('email'); ?>" required></label>
        <label>Nomor WhatsApp<input name="phone" value="<?= set_value('phone'); ?>" required></label>
        <label>Instansi / Perusahaan<input name="institution" value="<?= set_value('institution'); ?>" required></label>
        <label>Jabatan<input name="position" value="<?= set_value('position'); ?>" required></label>
        <label>Jumlah Peserta<input type="number" min="1" name="participant_count" value="<?= set_value('participant_count', 1); ?>"></label>
        <label>Program
            <select name="program_id" required>
                <option value="">Pilih program</option>
                <?php foreach ($programs as $program): ?>
                    <option value="<?= html_escape($program['id']); ?>"><?= html_escape($program['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Training
            <select name="training_id">
                <option value="">Belum memilih training spesifik</option>
                <?php foreach ($trainings as $training): ?>
                    <option value="<?= html_escape($training['id']); ?>"><?= html_escape($training['program_title']); ?> - <?= html_escape($training['title']); ?> - <?= html_escape($training['schedule_label']); ?></option>
                <?php endforeach; ?>
            </select>
        </label> 

        <!--3.penambahan placeholder Konsutasi -->

        <label>Topik / Bidang Konsultasi
            <input type="text" name="konsultasi_topik" placeholder="Misal: Penyusunan KPI, SOP, dsb." required>
        </label>

        <label>Agenda
            <select name="agenda_id">
                <option value="">Belum memilih agenda khusus</option>
                <?php foreach ($agendas as $agenda): ?>
                    <option value="<?= html_escape($agenda['id']); ?>"><?= html_escape($agenda['title']); ?> - <?= html_escape($agenda['start_date']); ?><?= $agenda['flyer_path'] ? ' - flyer tersedia' : ''; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>Kebutuhan / Pesan<textarea name="message" rows="5"><?= set_value('message'); ?></textarea></label>
        <button class="btn primary" type="submit">Kirim Pesan Kamu</button> <!-- 4. Kata "Konsultasi" udah dihilangkan -->
    </form>
</section>

<!-- SCRIPT NAVIGASI PANAH (DENGAN LOGIKA DETEKSI LIMIT "OFF") & LIGHTBOX -->
<script>
const slider = document.getElementById("programSlider");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

// Fungsi deteksi batas scroll untuk menyalakan/mematikan tombol panah
function updateArrowButtons() {
    // Toleransi 5px untuk rounding desimal pada layar resolusi tertentu
    const isAtStart = slider.scrollLeft <= 5;
    const isAtEnd = slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 5;

    // Atur tombol Kiri
    if (isAtStart) {
        prevBtn.style.opacity = "0.3";
        prevBtn.style.pointerEvents = "none";
        prevBtn.style.cursor = "default";
    } else {
        prevBtn.style.opacity = "1";
        prevBtn.style.pointerEvents = "auto";
        prevBtn.style.cursor = "pointer";
    }

    // Atur tombol Kanan
    if (isAtEnd) {
        nextBtn.style.opacity = "0.3";
        nextBtn.style.pointerEvents = "none";
        nextBtn.style.cursor = "default";
    } else {
        nextBtn.style.opacity = "1";
        nextBtn.style.pointerEvents = "auto";
        nextBtn.style.cursor = "pointer";
    }
}

// Jalankan scroll secara mulus
function slideScroll(offset) {
    slider.scrollBy({ left: offset, behavior: 'smooth' });
}

// Pasang event listener saat slider di-scroll atau ukuran layar berubah
slider.addEventListener("scroll", updateArrowButtons);
window.addEventListener("resize", updateArrowButtons);

// Jalankan pengecekan pertama kali saat halaman berhasil dimuat
window.addEventListener("DOMContentLoaded", updateArrowButtons);


// Fungsi Lightbox Zoom
function openLightbox(src, alt) {
    const lightbox = document.getElementById("imageLightbox");
    const lightboxImg = document.getElementById("lightboxImg");
    const lightboxCaption = document.getElementById("lightboxCaption");
    
    lightboxImg.src = src;
    lightboxCaption.innerHTML = alt;
    lightbox.style.display = "flex";
    
    setTimeout(() => {
        lightbox.style.opacity = "1";
    }, 10);
}

function closeLightbox() {
    const lightbox = document.getElementById("imageLightbox");
    lightbox.style.opacity = "0";
    
    setTimeout(() => {
        lightbox.style.display = "none";
    }, 300);
}

document.getElementById("imageLightbox").addEventListener("click", function(e) {
    if (e.target !== document.getElementById("lightboxImg")) {
        closeLightbox();
    }
});
</script>

<!-- CSS PENDUKUNG UNTUK MENYEMBUNYIKAN SCROLLBAR BAWAAN SLIDER -->
<style>
#programSlider::-webkit-scrollbar {
    display: none;
}
#programSlider {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>