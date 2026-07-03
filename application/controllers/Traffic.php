<?php

class Traffic extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Poster_traffic_model');
    }

    public function poster()
    {
        if ($this->input->method() !== 'post') {
            show_404();
        }

        $type = strtolower(trim((string) $this->input->post('poster_type')));
        $key = trim((string) $this->input->post('poster_key'));
        $name = trim((string) $this->input->post('poster_name'));
        $page = trim((string) $this->input->post('page_path'));
        $allowed_types = ['why_us', 'program', 'training', 'certification', 'gallery'];

        if (!in_array($type, $allowed_types, true) || $key === '' || $name === '') {
            $this->json_response(['recorded' => false], 422);
        }

        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $user_agent = (string) ($_SERVER['HTTP_USER_AGENT'] ?? '');
        $visitor_hash = hash_hmac('sha256', $ip . '|' . $user_agent, (string) config_item('encryption_key'));
        $recorded = $this->Poster_traffic_model->record([
            'poster_type' => substr($type, 0, 40),
            'poster_key' => substr($key, 0, 190),
            'poster_name' => substr($name, 0, 220),
            'page_path' => substr($page ?: '/', 0, 255),
            'visitor_hash' => $visitor_hash,
            'user_agent' => substr($user_agent, 0, 255),
        ]);

        $this->json_response(['recorded' => $recorded]);
    }

    private function json_response(array $data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=UTF-8');
        header('Cache-Control: no-store');
        echo json_encode($data);
        exit;
    }
}
