<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Content_model');
        $this->load->model('Training_model');
    }

    public function index()
    {
        $this->render('public/home', [
            'title' => 'Nara-HR.com - We Make People Grow',
            'slides' => $this->Content_model->home_slides(),
            'clients' => $this->Content_model->clients(),
            'programs' => $this->Content_model->programs(),
            'trainings' => $this->Training_model->active_trainings(),
            'trainers' => $this->Content_model->trainers(),
            // Pengaman variabel agar view home tidak error (Render otomatis dilakukan via JS Fetch anti-cache)
            'articles' => $this->get_prolead_articles(4), 
            'why_us_images' => $this->image_directory('assets/img/whyus'),
        ]);
    }

    public function articles()
    {
        $this->render('public/articles', [
            'title' => 'Artikel & Insights',
            // Pengaman variabel agar view list artikel tidak error (Render otomatis dilakukan via JS Fetch anti-cache)
            'articles' => $this->get_prolead_articles(20), 
        ]);
    }

    /**
     * Fungsi Pengaman: Sengaja dikosongkan karena proses penarikan data 
     * kini dilakukan secara Async langsung dari browser lewat JavaScript (View)
     * demi menghindari error timeout / block SSL pada localhost php lo.
     * * Catatan: Pembaruan otomatis (anti-cache) dikontrol langsung pada URL Fetch JavaScript
     * di dalam file view terkait menggunakan parameter timestamp waktu nyata.
     */
    private function get_prolead_articles($limit = 4)
    {
        return []; 
    }

    private function image_directory($relative_directory)
    {
        $root = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, trim($relative_directory, '/'));
        if (!is_dir($root)) {
            return [];
        }

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $images = [];
        foreach (new DirectoryIterator($root) as $file) {
            if ($file->isDot() || !$file->isFile() || !in_array(strtolower($file->getExtension()), $allowed, true)) {
                continue;
            }

            $images[] = trim($relative_directory, '/') . '/' . $file->getFilename();
        }

        natsort($images);
        return array_values($images);
    }

    private function gallery_images()
    {
        $root = FCPATH . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'galery';
        if (!is_dir($root)) {
            return [];
        }

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $images = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (!$file->isFile() || !in_array(strtolower($file->getExtension()), $allowed, true)) {
                continue;
            }

            $relative = str_replace('\\', '/', substr($file->getPathname(), strlen(FCPATH)));
            $label = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            $label = trim(preg_replace('/[_-]+/', ' ', $label));
            $images[] = [
                'path' => $relative,
                'label' => $label ?: 'Dokumentasi Nara-HR',
            ];
        }

        usort($images, function ($a, $b) {
            return strnatcasecmp($a['label'], $b['label']);
        });

        return $images;
    }

    public function gallery()
    {
        $this->render('public/gallery', [
            'title' => 'Galeri Nara-HR',
            'gallery' => $this->gallery_images(),
        ]);
    }

    public function about()
    {
        $this->render('public/page', [
            'title' => 'Tentang Kami',
            'heading' => 'Partner strategis pengembangan SDM',
            'body' => [
                'Nara-HR.com hadir untuk menjawab kebutuhan pengembangan SDM yang semakin kompleks di era sekarang. Kami bukan sekadar penyedia pelatihan, melainkan partner strategis perusahaan dalam membangun fondasi manusia yang kuat.',
            ],
            'vision' => 'Menjadi katalisator pertumbuhan organisasi melalui pengembangan kompetensi SDM yang aplikatif, berbasis best practice dan sesuai dengan perkembangan bisnis di Indonesia.',
            'missions' => [
                'Memberdayakan praktisi HR dan leader agar menjadi lebih profesional.',
                'Membantu business owner membangun sistem HR yang scalable.',
                'Menyelenggarakan pelatihan dan sertifikasi yang langsung berdampak pada kinerja organisasi.',
            ],
            'points' => ['Praktis', 'Profesional', 'Progresif', 'Partner yang dapat diandalkan'],
            'address' => 'Gedung 18 Office Park Lantai 25, Suite A2, Jl. TB Simatupang No. 18, Kel. Kebagusan, Kec. Pasar Minggu, Kota Adm. Jakarta Selatan, Prov. DKI Jakarta',
        ]);
    }

    public function training()
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $current_period = new DateTimeImmutable('first day of this month');
        $next_period = $current_period->modify('+1 month');
        $periods = [$current_period, $next_period];
        $trainings = [];
        $seen_training_ids = [];
        $period_labels = [];

        foreach ($periods as $period) {
            $month_name = $months[(int) $period->format('n')];
            $year = (int) $period->format('Y');
            $period_labels[] = $month_name . ' ' . $year;

            foreach ($this->Training_model->active_trainings_by_schedule_month($month_name, $year) as $training) {
                $training_id = (int) $training['id'];
                if (!isset($seen_training_ids[$training_id])) {
                    $trainings[] = $training;
                    $seen_training_ids[$training_id] = true;
                }
            }
        }
// ========================================================
        // KODE BARU: AMBIL DATA FLYER JADWAL TRAINING DARI ADMIN
        // ========================================================
        $this->load->model('Jadwal_model');
        $jadwal_training_flyer = $this->Jadwal_model->get_all();
        // ========================================================

        $this->render('public/training', [
            'title' => 'Short Training',
            'trainings' => $trainings,
            'active_month_label' => implode(' dan ', $period_labels),
            // KODE BARU: Lempar datanya ke view public/training
            'jadwal_training_flyer' => $jadwal_training_flyer
        ]);
    }

    public function inhouse()
    {
        $this->render('public/page', [
            'title' => 'In-House Training',
            'heading' => 'Pelatihan eksklusif untuk kebutuhan perusahaan',
            'body' => [
                'Program pelatihan disesuaikan dengan tantangan, budaya, dan kebutuhan bisnis perusahaan Anda.',
                'Tim Nara-HR membantu mulai dari assessment kebutuhan, rancangan kurikulum, pelaksanaan, hingga evaluasi pasca-pelatihan.',
            ],
            'points' => ['Materi custom', 'Lokasi sesuai kebutuhan', 'Trainer senior sesuai topik', 'Pendampingan implementasi opsional'],
        ]);
    }

    // ==========================================
    // SINKRONISASI FLUSH DATA FLYER SERTIFIKASI PER KATEGORI
    // ==========================================
    public function certification()
    {
        // Load model sertifikasi yang menyimpan query result_array() kita
        $this->load->model('Sertifikasi_model');

        $this->render('public/certification', [
            'title' => 'Sertifikasi Profesional',
            'programs' => $this->Content_model->certification_programs(), // Kode asli temen lu tetap aman
            
            // Mengirim data flyer hasil upload admin untuk dieksekusi oleh filter kategori di View depan
            'sertifikasi_flyer' => $this->Sertifikasi_model->get_all()
        ]);
    }

    public function consulting()
    {
        $this->render('public/page', [
            'title' => 'Konsultansi SDM',
            'heading' => 'Pendampingan implementasi sistem HR',
            'body' => [
                'Kami mendampingi perusahaan dalam penyusunan SOP HR, struktur organisasi, performance management, industrial relations, hingga talent development.',
                'Layanan ini cocok bagi perusahaan yang ingin membangun sistem HR solid dan berkelanjutan dengan bantuan praktisi berpengalaman.',
            ],
            'points' => ['SOP HR', 'Struktur organisasi', 'Performance management', 'Industrial relations', 'Talent development'],
        ]);
    }

    public function trainers()
    {
        $this->render('public/trainers', [
            'title' => 'Trainer & Konsultan',
            'trainers' => $this->Content_model->trainers(),
        ]);
    }

    public function contact()
    {
        $this->render('public/contact', ['title' => 'Kontak & Konsultasi']);
    }
}