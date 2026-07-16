<?php

require_once APPPATH . 'libraries/Registration_exporter.php';

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Admin_model');
        $this->load->model('Registration_model');
        $this->load->model('Content_model');
        $this->load->model('Training_model');
        $this->load->model('Participant_model');
        $this->load->model('Poster_traffic_model');
    }

    public function index()
    {
        $filters = [
            'status' => trim((string) ($_GET['status'] ?? '')),
            'keyword' => trim((string) ($_GET['keyword'] ?? '')),
        ];

        $this->render_admin('admin/dashboard', [
            'title' => 'Dashboard Admin',
            'stats' => $this->Admin_model->stats(),
            'status_breakdown' => $this->Admin_model->status_breakdown(),
            'asset_summary' => $this->Admin_model->asset_summary(),
            'training_pipeline' => $this->Admin_model->training_pipeline(),
            'latest_registrations' => $this->Admin_model->latest_registrations(6),
            'traffic_summary' => $this->Poster_traffic_model->summary(),
            'top_posters' => $this->Poster_traffic_model->top_posters(10),
            'recent_poster_clicks' => $this->Poster_traffic_model->recent_clicks(8),
            'registrations' => $this->Registration_model->all($filters),
            'filters' => $filters,
        ]);
    }

    public function update_registration($id)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin');
        }

        $this->Registration_model->update_status($id, $this->input->post('status'), $this->input->post('admin_note'));
        $this->session->set_flashdata('success', 'Status peserta berhasil diperbarui.');
        redirect($this->input->post('return_to') ?: 'admin');
    }

    public function export_registrations($format = 'excel')
    {
        $this->require_login();

        $filters = [
            'status' => trim((string) ($_GET['status'] ?? '')),
            'keyword' => trim((string) ($_GET['keyword'] ?? '')),
        ];
        $rows = $this->Registration_model->all($filters);
        $format = strtolower((string) $format);

        if ($format === 'pdf') {
            $content = Registration_exporter::pdf($rows, $filters);
            $filename = Registration_exporter::filename('pdf');
            $content_type = 'application/pdf';
        } elseif ($format === 'excel' || $format === 'xls') {
            $content = Registration_exporter::excel($rows, $filters);
            $filename = Registration_exporter::filename('xls');
            $content_type = 'application/vnd.ms-excel; charset=utf-8';
        } else {
            header('HTTP/1.1 404 Not Found');
            echo 'Format export tidak tersedia.';
            exit;
        }

        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: ' . $content_type);
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . strlen($content));
        echo $content;
        exit;
    }

    public function assets()
    {
        redirect('admin');
    }

    public function content_manager()
    {
        redirect('admin/mentors');
    }

    public function mentors()
    {
        $this->render_admin('admin/mentors', [
            'title' => 'Data Mentor',
            'trainers' => $this->Content_model->all_trainers(),
        ]);
    }

    public function articles()
    {
        $this->render_admin('admin/articles', [
            'title' => 'Data Artikel',
            'articles' => $this->Content_model->all_articles(),
        ]);
    }

    public function clients()
    {
        $this->render_admin('admin/clients', [
            'title' => 'Data Perusahaan',
            'clients' => $this->Content_model->all_clients(),
        ]);
    }

    public function slides()
    {
        $this->render_admin('admin/slides', [
            'title' => 'Slide Beranda',
            'slides' => $this->Content_model->all_home_slides(),
        ]);
    }

    public function socials()
    {
        $this->render_admin('admin/socials', [
            'title' => 'Media Sosial',
            'socials' => $this->Content_model->all_social_links(),
        ]);
    }

    public function programs()
    {
        $this->render_admin('admin/programs', [
            'title' => 'Data Program Unggulan',
            'services' => $this->Training_model->services(),
            'categories' => $this->Training_model->program_categories(),
            'programs' => $this->Training_model->programs(),
        ]);
    }

    public function training_catalog()
    {
        $this->render_admin('admin/training_catalog', [
            'title' => 'Data Trainning',
            'services' => $this->Training_model->services(),
            'programs' => $this->Training_model->programs(),
            'trainings' => $this->Training_model->trainings(),
            'segments' => $this->Training_model->segments(),
            'trainers' => $this->Content_model->all_trainers(),
        ]);
    }

    public function participants()
    {
        $this->render_admin('admin/participants', [
            'title' => 'Data Peserta Alumni',
            'participants' => $this->Participant_model->all_enrollments(),
            'programs' => $this->Training_model->programs(),
            'trainings' => $this->Training_model->trainings(),
        ]);
    }

    public function save_service($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/programs');
        }

        $data = [
            'name' => trim($this->input->post('name')),
            'description' => trim($this->input->post('description')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        $id ? $this->Training_model->update_service($id, $data) : $this->Training_model->create_service($data);
        $this->session->set_flashdata('success', 'Service berhasil disimpan.');
        redirect('admin/training_catalog');
    }

    public function delete_service($id)
    {
        $this->require_post();
        $this->Training_model->update_service($id, ['name' => $this->input->post('name') ?: 'service-' . $id, 'description' => '', 'sort_order' => 999, 'is_active' => 0]);
        $this->session->set_flashdata('success', 'Service dinonaktifkan.');
        redirect('admin/training_catalog');
    }

    public function save_segment($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/training_catalog');
        }

        $data = [
            'name' => trim($this->input->post('name')),
            'description' => trim($this->input->post('description')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        $id ? $this->Training_model->update_segment($id, $data) : $this->Training_model->create_segment($data);
        $this->session->set_flashdata('success', 'Segment pasar berhasil disimpan.');
        redirect('admin/training_catalog');
    }

    public function delete_segment($id)
    {
        $this->require_post();
        $this->Training_model->update_segment($id, ['is_active' => 0]);
        $this->session->set_flashdata('success', 'Segment pasar dinonaktifkan.');
        redirect('admin/training_catalog');
    }

    public function save_program($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/training_catalog');
        }

        $data = [
            'service_id' => $this->input->post('service_id') ?: null,
            'category_id' => $this->input->post('category_id') ?: null,
            'category' => $this->input->post('category_slug') ?: 'short_training',
            'title' => trim($this->input->post('title')),
            'description' => trim($this->input->post('description')),
            'mode' => trim($this->input->post('mode')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        if (!empty($_FILES['program_flyer_file']) && $_FILES['program_flyer_file']['error'] === UPLOAD_ERR_OK) {
            $data['flyer_path'] = $this->handle_upload('program_flyer_file', 'uploads/flyers', ['jpg', 'jpeg', 'png', 'webp', 'pdf'], 'admin/programs');
        } elseif (!$id) {
            $this->session->set_flashdata('error', 'Flyer wajib diunggah saat menambahkan program unggulan.');
            redirect('admin/programs');
        }

        $id ? $this->Training_model->update_program($id, $data) : $this->Training_model->create_program($data);
        $this->session->set_flashdata('success', 'Program berhasil disimpan.');
        redirect('admin/programs');
    }

    public function save_program_category($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/programs');
        }

        $data = [
            'name' => trim($this->input->post('name')),
            'description' => trim($this->input->post('description')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        $id ? $this->Training_model->update_program_category($id, $data) : $this->Training_model->create_program_category($data);
        $this->session->set_flashdata('success', 'Kategori program berhasil disimpan.');
        redirect('admin/programs');
    }

    public function save_slide($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/slides');
        }

        $data = [
            'title' => trim($this->input->post('title')),
            'alt_text' => trim($this->input->post('alt_text')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        if (!empty($_FILES['slide_file']) && $_FILES['slide_file']['error'] === UPLOAD_ERR_OK) {
            $data['image_path'] = $this->handle_upload('slide_file', 'uploads/slides', ['jpg', 'jpeg', 'png', 'webp'], 'admin/slides');
        } elseif (!$id) {
            $this->session->set_flashdata('error', 'Foto slide wajib diunggah saat menambahkan slide beranda.');
            redirect('admin/slides');
        }

        $id ? $this->Content_model->update_home_slide($id, $data) : $this->Content_model->create_home_slide($data);
        $this->session->set_flashdata('success', 'Slide beranda berhasil disimpan.');
        redirect('admin/slides');
    }

    public function delete_slide($id)
    {
        $this->require_post();
        $this->Content_model->delete_home_slide($id);
        $this->session->set_flashdata('success', 'Slide beranda berhasil dihapus.');
        redirect('admin/slides');
    }

    public function save_social($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/socials');
        }

        $data = [
            'platform' => trim($this->input->post('platform')),
            'profile_url' => trim($this->input->post('profile_url')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        if (!empty($_FILES['icon_file']) && $_FILES['icon_file']['error'] === UPLOAD_ERR_OK) {
            $data['icon_path'] = $this->handle_upload('icon_file', 'uploads/socials', ['jpg', 'jpeg', 'png', 'webp'], 'admin/socials');
        } elseif (!$id) {
            $this->session->set_flashdata('error', 'Icon media sosial wajib diunggah saat menambahkan data.');
            redirect('admin/socials');
        }

        $id ? $this->Content_model->update_social_link($id, $data) : $this->Content_model->create_social_link($data);
        $this->session->set_flashdata('success', 'Media sosial berhasil disimpan.');
        redirect('admin/socials');
    }

    public function delete_social($id)
    {
        $this->require_post();
        $this->Content_model->delete_social_link($id);
        $this->session->set_flashdata('success', 'Media sosial berhasil dihapus.');
        redirect('admin/socials');
    }

    public function delete_program_category($id)
    {
        $this->require_post();
        $this->Training_model->delete_program_category($id);
        $this->session->set_flashdata('success', 'Kategori program berhasil dihapus.');
        redirect('admin/programs');
    }

    public function delete_program($id)
    {
        $this->require_post();
        $this->Training_model->delete_program($id);
        $this->session->set_flashdata('success', 'Program berhasil dihapus.');
        redirect('admin/programs');
    }

    public function save_training($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/training_catalog');
        }

        $data = [
            'program_id' => $this->input->post('program_id'),
            'trainer_id' => $this->input->post('trainer_id') ?: null,
            'market_segment_id' => $this->input->post('market_segment_id') ?: null,
            'title' => trim($this->input->post('title')),
            'schedule_label' => trim($this->input->post('schedule_label')),
            'venue_method' => trim($this->input->post('venue_method')),
            'duration_minutes' => (int) $this->input->post('duration_minutes'),
            'description' => trim($this->input->post('description')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        if (!empty($_FILES['flyer_file']) && $_FILES['flyer_file']['error'] === UPLOAD_ERR_OK) {
            $data['flyer_path'] = $this->handle_upload('flyer_file', 'uploads/flyers', ['jpg', 'jpeg', 'png', 'webp', 'pdf'], 'admin/training_catalog');
        } elseif (!$id) {
            $this->session->set_flashdata('error', 'Flyer wajib diunggah saat menambahkan data training.');
            redirect('admin/training_catalog');
        }

        $id ? $this->Training_model->update_training($id, $data) : $this->Training_model->create_training($data);
        $this->session->set_flashdata('success', 'Training berhasil disimpan.');
        redirect('admin/training_catalog');
    }

    public function delete_training($id)
    {
        $this->require_post();
        $this->Training_model->delete_training($id);
        $this->session->set_flashdata('success', 'Training berhasil dihapus.');
        redirect('admin/training_catalog');
    }

    public function save_participant($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/participants');
        }

        $existing = $id ? $this->Participant_model->find_enrollment($id) : null;
        if ($id && !$existing) {
            $this->session->set_flashdata('error', 'Data peserta tidak ditemukan.');
            redirect('admin/participants');
        }

        $phone = trim((string) $this->input->post('phone'));
        $existing_participant = (!$id && $phone !== '') ? $this->Participant_model->find_any_by_phone($phone) : null;
        if (!$id && $this->input->post('existing_only') && !$existing_participant) {
            $this->session->set_flashdata('error', 'Nomor HP belum terdaftar. Gunakan form Peserta Baru untuk membuat akun peserta.');
            redirect('admin/participants');
        }

        $password = trim((string) $this->input->post('password'));
        if (!$id && !$existing_participant && $password === '') {
            $this->session->set_flashdata('error', 'Password wajib diisi saat membuat akun peserta baru.');
            redirect('admin/participants');
        }
        if ($password !== '' && strlen($password) < 8) {
            $this->session->set_flashdata('error', 'Password peserta minimal 8 karakter.');
            redirect('admin/participants');
        }

        $certificate_path = $existing['certificate_path'] ?? null;
        if (!empty($_FILES['certificate_file']) && $_FILES['certificate_file']['error'] === UPLOAD_ERR_OK) {
            $certificate_path = $this->handle_upload('certificate_file', 'uploads/certificates', ['pdf', 'jpg', 'jpeg', 'png', 'webp'], 'admin/participants');
        } elseif (!$id) {
            $this->session->set_flashdata('error', 'Sertifikat wajib diunggah saat menambahkan peserta.');
            redirect('admin/participants');
        }

        $program_id = $this->input->post('program_id') ?: null;
        $training_id = $this->input->post('training_id') ?: null;
        $program_name = trim((string) $this->input->post('program_name'));
        if ($program_name === '') {
            $program_name = $this->resolve_program_name($program_id, $training_id);
        }

        $profile = [
            'full_name' => trim((string) $this->input->post('full_name')),
            'institution' => trim((string) $this->input->post('institution')),
            'email' => trim((string) $this->input->post('email')),
            'phone' => $phone,
            'password' => $password,
            'is_active' => ($this->input->post('is_active') || $existing_participant) ? 1 : 0,
        ];

        $program = [
            'program_id' => $program_id,
            'training_id' => $training_id,
            'program_name' => $program_name,
            'attended_at' => $this->input->post('attended_at') ?: date('Y-m-d'),
            'certificate_path' => $certificate_path,
            'is_published' => $this->input->post('is_published') ? 1 : 0,
        ];

        if (!$id && !$existing_participant && $profile['full_name'] === '') {
            $this->session->set_flashdata('error', 'Nama wajib diisi untuk peserta baru.');
            redirect('admin/participants');
        }

        if ($profile['phone'] === '' || $program['program_name'] === '') {
            $this->session->set_flashdata('error', 'Nomor HP dan program wajib diisi.');
            redirect('admin/participants');
        }

        $this->Participant_model->save_from_admin($profile, $program, $id);
        $this->session->set_flashdata('success', 'Data peserta dan sertifikat berhasil disimpan.');
        redirect('admin/participants');
    }

    public function delete_participant_program($id)
    {
        $this->require_post();
        $this->Participant_model->delete_enrollment($id);
        $this->session->set_flashdata('success', 'Data program peserta berhasil dihapus.');
        redirect('admin/participants');
    }

    public function download_certificate($id)
    {
        $this->require_login();
        $program = $this->Participant_model->find_enrollment($id);
        if (!$program) {
            show_404();
        }

        $this->output_certificate_file($program['certificate_path'], $program['program_name']);
    }

    public function save_trainer($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/mentors#crud-mentor');
        }

        $data = [
            'name' => trim($this->input->post('name')),
            'role' => trim($this->input->post('role')),
            'expertise' => trim($this->input->post('expertise')),
            'bio' => trim($this->input->post('bio')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        if (!empty($_FILES['photo_file']) && $_FILES['photo_file']['error'] === UPLOAD_ERR_OK) {
            $data['photo_path'] = $this->handle_upload('photo_file', 'uploads/trainers', ['jpg', 'jpeg', 'png', 'webp'], 'admin/mentors#crud-mentor');
        } elseif (!$id) {
            $this->session->set_flashdata('error', 'Foto wajib diunggah saat menambahkan data mentor.');
            redirect('admin/mentors#crud-mentor');
        }

        $id ? $this->Content_model->update_trainer($id, $data) : $this->Content_model->create_trainer($data);
        $this->session->set_flashdata('success', 'Data mentor berhasil disimpan.');
        redirect('admin/mentors#crud-mentor');
    }

    public function delete_trainer($id)
    {
        $this->require_post();
        $this->Content_model->delete_trainer($id);
        $this->session->set_flashdata('success', 'Mentor berhasil dihapus.');
        redirect('admin/mentors#crud-mentor');
    }

    public function save_client($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/clients#crud-perusahaan');
        }

        $data = [
            'name' => trim($this->input->post('name')),
            'official_url' => trim($this->input->post('official_url')),
            'note' => trim($this->input->post('note')),
            'sort_order' => (int) $this->input->post('sort_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        if (!empty($_FILES['logo_file']) && $_FILES['logo_file']['error'] === UPLOAD_ERR_OK) {
            $data['logo_path'] = $this->handle_upload('logo_file', 'uploads/logos', ['jpg', 'jpeg', 'png', 'webp'], 'admin/clients#crud-perusahaan');
        } elseif (!$id) {
            $this->session->set_flashdata('error', 'Logo wajib diunggah saat menambahkan data perusahaan.');
            redirect('admin/clients#crud-perusahaan');
        }

        $id ? $this->Content_model->update_client($id, $data) : $this->Content_model->create_client($data);
        $this->session->set_flashdata('success', 'Data perusahaan berhasil disimpan.');
        redirect('admin/clients#crud-perusahaan');
    }

    public function delete_client($id)
    {
        $this->require_post();
        $this->Content_model->delete_client($id);
        $this->session->set_flashdata('success', 'Perusahaan berhasil dihapus.');
        redirect('admin/clients#crud-perusahaan');
    }

    public function save_article($id = null)
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/articles#crud-artikel');
        }

        $data = [
            'title' => trim($this->input->post('title')),
            'summary' => trim($this->input->post('summary')),
            'external_url' => trim($this->input->post('external_url')),
            'source' => trim($this->input->post('source')) ?: 'ProleadIndonesia.com',
            'published_at' => $this->input->post('published_at') ?: null,
            'is_active' => $this->input->post('is_active') ? 1 : 0,
        ];

        $id ? $this->Content_model->update_article($id, $data) : $this->Content_model->create_article($data);
        $this->session->set_flashdata('success', 'Artikel berhasil disimpan.');
        redirect('admin/articles#crud-artikel');
    }

    public function delete_article($id)
    {
        $this->require_post();
        $this->Content_model->delete_article($id);
        $this->session->set_flashdata('success', 'Artikel berhasil dihapus.');
        redirect('admin/articles#crud-artikel');
    }

    public function upload_trainer_photo($id)
    {
        $path = $this->handle_upload('asset_file', 'uploads/trainers', ['jpg', 'jpeg', 'png', 'webp'], 'admin/mentors#crud-mentor');
        $this->Content_model->update_trainer_photo($id, $path);
        $this->session->set_flashdata('success', 'Foto trainer berhasil disimpan.');
        redirect('admin/mentors#crud-mentor');
    }

    public function upload_client_logo($id)
    {
        $path = $this->handle_upload('asset_file', 'uploads/logos', ['jpg', 'jpeg', 'png', 'webp'], 'admin/clients#crud-perusahaan');
        $this->Content_model->update_client_logo($id, $path);
        $this->session->set_flashdata('success', 'Logo mitra berhasil disimpan.');
        redirect('admin/clients#crud-perusahaan');
    }

    public function upload_agenda_flyer($id)
    {
        $path = $this->handle_upload('asset_file', 'uploads/flyers', ['jpg', 'jpeg', 'png', 'webp', 'pdf'], 'admin/training_catalog');
        $this->Content_model->update_agenda_flyer($id, $path);
        $this->session->set_flashdata('success', 'Flyer agenda berhasil disimpan.');
        redirect('admin/training_catalog');
    }

    public function upload_training_flyer($id)
    {
        $path = $this->handle_upload('asset_file', 'uploads/flyers', ['jpg', 'jpeg', 'png', 'webp', 'pdf'], 'admin/training_catalog');
        $this->Training_model->update_training_flyer($id, $path);
        $this->session->set_flashdata('success', 'Flyer training berhasil disimpan.');
        redirect('admin/training_catalog');
    }

    private function handle_upload($field, $target_dir, array $allowed, $return_to = 'admin')
    {
        $this->require_login();

        if (empty($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
            $this->session->set_flashdata('error', 'File belum dipilih atau gagal diunggah.');
            redirect($return_to);
        }

        $original = $_FILES[$field]['name'];
        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed, true)) {
            $this->session->set_flashdata('error', 'Format file tidak didukung.');
            redirect($return_to);
        }

        $mime = '';
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = (string) finfo_file($finfo, $_FILES[$field]['tmp_name']);
            finfo_close($finfo);
        }

        $allowed_mimes = [
            'jpg' => ['image/jpeg'],
            'jpeg' => ['image/jpeg'],
            'png' => ['image/png'],
            'webp' => ['image/webp'],
            'pdf' => ['application/pdf'],
        ];
        if ($mime !== '' && !in_array($mime, $allowed_mimes[$ext] ?? [], true)) {
            $this->session->set_flashdata('error', 'Isi file tidak sesuai dengan format yang dipilih.');
            redirect($return_to);
        }

        if ($ext !== 'pdf' && @getimagesize($_FILES[$field]['tmp_name']) === false) {
            $this->session->set_flashdata('error', 'File gambar tidak valid.');
            redirect($return_to);
        }

        if ($_FILES[$field]['size'] > 5 * 1024 * 1024) {
            $this->session->set_flashdata('error', 'Ukuran file maksimal 5 MB.');
            redirect($return_to);
        }

        $absolute_dir = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $target_dir);
        if (!is_dir($absolute_dir)) {
            mkdir($absolute_dir, 0755, true);
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $ext;
        $destination = $absolute_dir . DIRECTORY_SEPARATOR . $filename;

        if (!move_uploaded_file($_FILES[$field]['tmp_name'], $destination)) {
            $this->session->set_flashdata('error', 'File gagal dipindahkan ke folder upload.');
            redirect($return_to);
        }

        return trim($target_dir, '/') . '/' . $filename;
    }

    private function require_post()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }
    }

    private function resolve_program_name($program_id, $training_id)
    {
        if ($training_id) {
            $training = $this->db->query('SELECT title FROM trainings WHERE id = ? LIMIT 1', [$training_id])->row_array();
            if ($training) {
                return $training['title'];
            }
        }

        if ($program_id) {
            $program = $this->db->query('SELECT title FROM programs WHERE id = ? LIMIT 1', [$program_id])->row_array();
            if ($program) {
                return $program['title'];
            }
        }

        return '';
    }

    private function output_certificate_file($certificate_path, $program_name)
    {
        $path = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $certificate_path);
        if (!is_file($path)) {
            show_404();
        }

        $filename = preg_replace('/[^a-z0-9]+/i', '-', $program_name) . '-' . basename($certificate_path);
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }

    // ==========================================
    // FITUR MANAJEMEN SERTIFIKASI (FLYER) - FIX SINKRONISASI TOTAL
    // ==========================================

    public function sertifikasi()
    {
        $this->load->model('Sertifikasi_model');
        
        // Menggunakan render_admin agar layout dashboard & sidebar menyatu sempurna
        $this->render_admin('admin/sertifikasi', [
            'title' => 'Data Sertifikasi',
            'sertifikasi' => $this->Sertifikasi_model->get_all(),
            'current_path' => 'admin/sertifikasi'
        ]);
    }

    public function sertifikasi_tambah()
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/sertifikasi');
        }

        $this->load->model('Sertifikasi_model');
        
        // Menangkap data baru sesuai mode Gambar 2
        $judul     = trim((string) $this->input->post('judul'));
        $kategori  = trim((string) $this->input->post('kategori'));
        $deskripsi = trim((string) $this->input->post('deskripsi'));
        $is_active = $this->input->post('is_active') ? 1 : 0;

        $data = [
            'judul'     => $judul,
            'kategori'  => $kategori,
            'deskripsi' => $deskripsi,
            'is_active' => $is_active
        ];

        if (!empty($_FILES['flyer']) && $_FILES['flyer']['error'] === UPLOAD_ERR_OK) {
            $uploaded_path = $this->handle_upload('flyer', 'uploads/sertifikasi', ['jpg', 'jpeg', 'png'], 'admin/sertifikasi');
            $data['flyer'] = basename($uploaded_path);
        } else {
            $this->session->set_flashdata('error', 'File flyer wajib diunggah.');
            redirect('admin/sertifikasi');
        }

        $this->Sertifikasi_model->insert_data($data);
        $this->session->set_flashdata('success', 'Flyer sertifikasi berhasil disimpan dengan data lengkap.');
        redirect('admin/sertifikasi');
    }

    public function sertifikasi_hapus($id)
    {
        $this->load->model('Sertifikasi_model');
        $data = $this->Sertifikasi_model->get_by_id($id);
        
        if ($data) {
            $file_path = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'sertifikasi' . DIRECTORY_SEPARATOR . $data->flyer;
            if (is_file($file_path)) {
                unlink($file_path);
            }
        }
        
        $this->Sertifikasi_model->delete_data($id);
        $this->session->set_flashdata('success', 'Flyer sertifikasi berhasil dihapus.');
        redirect('admin/sertifikasi');
    }
    // ==========================================
    // FITUR MANAJEMEN JADWAL TRAINING (FLYER)
    // ==========================================

    public function jadwal_training()
    {
        $this->load->model('Jadwal_model');
        
        $this->render_admin('admin/jadwal_training', [
            'title' => 'Data Jadwal Training',
            'jadwal' => $this->Jadwal_model->get_all(),
            'current_path' => 'admin/jadwal_training'
        ]);
    }

    public function jadwal_training_tambah()
    {
        if ($this->input->method() !== 'post') {
            redirect('admin/jadwal_training');
        }

        $this->load->model('Jadwal_model');
        $judul    = trim((string) $this->input->post('judul'));
        $kategori = trim((string) $this->input->post('kategori'));

        $data = [
            'judul'    => $judul,
            'kategori' => $kategori
        ];

        if (!empty($_FILES['flyer']) && $_FILES['flyer']['error'] === UPLOAD_ERR_OK) {
            $uploaded_path = $this->handle_upload('flyer', 'uploads/jadwal_training', ['jpg', 'jpeg', 'png'], 'admin/jadwal_training');
            $data['flyer'] = basename($uploaded_path);
        } else {
            $this->session->set_flashdata('error', 'File flyer wajib diunggah.');
            redirect('admin/jadwal_training');
        }

        // CUMA ADA INI SEKARANG, DIJAMIN AMAN
        $this->Jadwal_model->insert_data($data);
        
        $this->session->set_flashdata('success', 'Flyer jadwal training berhasil disimpan.');
        redirect('admin/jadwal_training');
    }

    public function jadwal_training_hapus($id)
    {
        $this->load->model('Jadwal_model');
        $data = $this->Jadwal_model->get_by_id($id);
        
        if ($data) {
            $file_path = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'jadwal_training' . DIRECTORY_SEPARATOR . $data->flyer;
            if (is_file($file_path)) {
                unlink($file_path);
            }
        }
        
        $this->Jadwal_model->delete_data($id);
        $this->session->set_flashdata('success', 'Flyer jadwal training berhasil dihapus.');
        redirect('admin/jadwal_training');
    }
}
