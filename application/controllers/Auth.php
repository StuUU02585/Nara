<?php

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function login()
    {
        if ($this->input->method() === 'post') {
            if ($this->login_is_locked('admin')) {
                $this->session->set_flashdata('error', 'Terlalu banyak percobaan login. Silakan coba kembali dalam 5 menit.');
                redirect('auth/login');
            }

            $admin = $this->Admin_model->find_by_email(trim($this->input->post('email')));
            if ($admin && password_verify($this->input->post('password'), $admin['password_hash'])) {
                $this->clear_login_failures('admin');
                $this->session->regenerate();
                $this->session->set_userdata([
                    'admin_id' => $admin['id'],
                    'admin_name' => $admin['name'],
                ]);
                redirect('admin');
            }
            $this->record_login_failure('admin');
            $this->session->set_flashdata('error', 'Email atau password admin tidak sesuai.');
            redirect('auth/login');
        }

        $this->load->view('admin/login', ['title' => 'Login Admin', 'site' => $this->site]);
    }

    public function logout()
    {
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('admin_name');
        redirect('auth/login');
    }
}
