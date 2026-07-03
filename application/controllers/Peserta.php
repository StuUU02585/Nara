<?php

class Peserta extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Participant_model');
    }

    public function login()
    {
        if ($this->session->userdata('participant_id')) {
            redirect('peserta/dashboard');
        }

        if ($this->input->method() === 'post') {
            if ($this->login_is_locked('participant')) {
                $this->session->set_flashdata('error', 'Terlalu banyak percobaan login. Silakan coba kembali dalam 5 menit.');
                redirect('peserta/login');
            }

            $participant = $this->Participant_model->find_by_phone($this->input->post('phone'));
            if ($participant && password_verify((string) $this->input->post('password'), $participant['password_hash'])) {
                $this->clear_login_failures('participant');
                $this->session->regenerate();
                $this->session->set_userdata([
                    'participant_id' => $participant['id'],
                    'participant_name' => $participant['full_name'],
                ]);
                redirect('peserta/dashboard');
            }

            $this->record_login_failure('participant');
            $this->session->set_flashdata('error', 'Nomor HP atau password tidak sesuai.');
            redirect('peserta/login');
        }

        $this->load->view('participant/login', [
            'title' => 'Login Peserta',
            'site' => $this->site,
        ]);
    }

    public function dashboard()
    {
        $this->require_participant_login();
        $participant = $this->Participant_model->find_participant($this->session->userdata('participant_id'));
        if (!$participant) {
            $this->logout();
        }

        $this->load->view('participant/dashboard', [
            'title' => 'Dashboard Peserta',
            'site' => $this->site,
            'participant' => $participant,
            'programs' => $this->Participant_model->participant_programs($participant['id']),
        ]);
    }

    public function update_profile()
    {
        $this->require_participant_login();
        if ($this->input->method() !== 'post') {
            redirect('peserta/dashboard#profil');
        }

        $full_name = trim((string) $this->input->post('full_name'));
        $phone = trim((string) $this->input->post('phone'));
        if ($full_name === '' || $phone === '') {
            $this->session->set_flashdata('error', 'Nama dan nomor HP wajib diisi.');
            redirect('peserta/dashboard#profil');
        }

        $this->Participant_model->update_profile($this->session->userdata('participant_id'), [
            'full_name' => $full_name,
            'institution' => trim((string) $this->input->post('institution')),
            'email' => trim((string) $this->input->post('email')),
            'phone' => $phone,
        ]);
        $this->session->set_userdata('participant_name', $full_name);
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
        redirect('peserta/dashboard#profil');
    }

    public function change_password()
    {
        $this->require_participant_login();
        if ($this->input->method() !== 'post') {
            redirect('peserta/dashboard#keamanan');
        }

        $participant = $this->Participant_model->find_participant($this->session->userdata('participant_id'));
        $current_password = (string) $this->input->post('current_password');
        $new_password = (string) $this->input->post('new_password');

        if (!$participant || !password_verify($current_password, $participant['password_hash'])) {
            $this->session->set_flashdata('error', 'Password saat ini tidak sesuai.');
            redirect('peserta/dashboard#keamanan');
        }

        if (strlen($new_password) < 8) {
            $this->session->set_flashdata('error', 'Password baru minimal 8 karakter.');
            redirect('peserta/dashboard#keamanan');
        }

        $this->Participant_model->change_password($participant['id'], $new_password);
        $this->session->set_flashdata('success', 'Password berhasil diperbarui.');
        redirect('peserta/dashboard#keamanan');
    }

    public function download($id)
    {
        $this->require_participant_login();
        $program = $this->Participant_model->find_enrollment($id);
        if (!$program || (int) $program['participant_id'] !== (int) $this->session->userdata('participant_id') || !$program['is_published']) {
            show_404();
        }

        $path = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $program['certificate_path']);
        if (!is_file($path)) {
            show_404();
        }

        $filename = preg_replace('/[^a-z0-9]+/i', '-', $program['program_name']) . '-' . basename($program['certificate_path']);
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }

    public function logout()
    {
        $this->session->unset_userdata('participant_id');
        $this->session->unset_userdata('participant_name');
        redirect('peserta/login');
    }

    private function require_participant_login()
    {
        if (!$this->session->userdata('participant_id')) {
            redirect('peserta/login');
        }
    }
}
