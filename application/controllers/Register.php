<?php

class Register extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Content_model');
        $this->load->model('Registration_model');
        $this->load->model('Training_model');
    }

    public function index()
    {
        $this->render('public/register', [
            'title' => 'Konsultasi Nara-HR',
            'programs' => $this->Content_model->programs(),
            'trainings' => $this->Training_model->active_trainings(),
            'agendas' => $this->Content_model->agendas(50),
        ]);
    }

    public function store()
    {
        if ($this->input->method() !== 'post') {
            redirect('daftar');
        }

        $required = ['full_name', 'email', 'phone', 'institution', 'position', 'program_id'];
        foreach ($required as $field) {
            if (trim((string) $this->input->post($field)) === '') {
                $this->session->set_flashdata('error', 'Mohon lengkapi nama, email, nomor WhatsApp, instansi, jabatan, dan program.');
                redirect('daftar');
            }
        }

        $training_id = $this->input->post('training_id') ?: null;
        $program_id = $this->input->post('program_id');
        if ($training_id) {
            $training = $this->Training_model->find_training($training_id);
            if ($training) {
                $program_id = $training['program_id'];
            }
        }

        $this->Registration_model->create([
            'program_id' => $program_id,
            'training_id' => $training_id,
            'agenda_id' => $this->input->post('agenda_id') ?: null,
            'full_name' => trim($this->input->post('full_name')),
            'email' => trim($this->input->post('email')),
            'phone' => trim($this->input->post('phone')),
            'institution' => trim($this->input->post('institution')),
            'position' => trim($this->input->post('position')),
            'participant_count' => (int) ($this->input->post('participant_count') ?: 1),
            'message' => trim($this->input->post('message')),
        ]);

        $this->session->set_flashdata('success', 'Permintaan konsultasi berhasil dikirim. Tim Nara-HR akan menghubungi Anda melalui WhatsApp.');
        redirect('daftar');
    }
}
