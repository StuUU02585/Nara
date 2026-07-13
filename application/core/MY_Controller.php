<?php

class MY_Controller extends CI_Controller
{
    protected $site;

    public function __construct()
    {
        parent::__construct();
        if ($this->input->method() === 'post' && !$this->session->validate_csrf($this->input->post('_csrf'))) {
            show_403();
        }
        $this->load->database();
        $settings = $this->db->query('SELECT setting_key, setting_value FROM site_settings')->result_array();
        $site_settings = [];
        foreach ($settings as $setting) {
            $site_settings[$setting['setting_key']] = $setting['setting_value'];
        }

        $this->site = [
            'name' => ($site_settings['site_name'] ?? config_item('site_name')) ?: 'Sahabat Nara',
            'whatsapp' => ($site_settings['whatsapp_number'] ?? config_item('whatsapp_number')) ?: '6281234567890',
            'social_links' => $this->social_links(),
        ];
    }

    private function social_links()
    {
        $table = $this->db->query("SHOW TABLES LIKE 'social_links'")->row_array();
        if (!$table) {
            return [];
        }

        return $this->db->query('SELECT * FROM social_links WHERE is_active = 1 ORDER BY sort_order, platform')->result_array();
    }

    protected function render($view, array $data = [])
    {
        $data['site'] = $this->site;
        $data['content'] = $this->load->view($view, $data, true);
        $this->load->view('layouts/public', $data);
    }

    protected function render_admin($view, array $data = [])
    {
        $this->require_login();
        $data['site'] = $this->site;
        $data['content'] = $this->load->view($view, $data, true);
        $this->load->view('layouts/admin', $data);
    }

    protected function require_login()
    {
        if (!$this->session->userdata('admin_id')) {
            redirect('auth/login');
        }
    }

    protected function login_is_locked($scope)
    {
        $state = $this->session->userdata('_login_limit_' . $scope);
        return is_array($state) && (int) ($state['locked_until'] ?? 0) > time();
    }

    protected function record_login_failure($scope)
    {
        $key = '_login_limit_' . $scope;
        $state = $this->session->userdata($key);
        $state = is_array($state) ? $state : ['attempts' => 0, 'locked_until' => 0];
        $state['attempts'] = (int) $state['attempts'] + 1;
        if ($state['attempts'] >= 5) {
            $state = ['attempts' => 0, 'locked_until' => time() + 300];
        }
        $this->session->set_userdata($key, $state);
    }

    protected function clear_login_failures($scope)
    {
        $this->session->unset_userdata('_login_limit_' . $scope);
    }
}
