<?php

class Admin_model
{
    private $db;

    public function __construct()
    {
        $this->db = get_instance()->db;
    }

    public function find_by_email($email)
    {
        return $this->db->query('SELECT * FROM admins WHERE email = ? AND is_active = 1 LIMIT 1', [$email])->row_array();
    }

    public function stats()
    {
        $total = $this->count('registrations');
        $new = $this->count_where("SELECT COUNT(*) AS total FROM registrations WHERE status = 'baru'");
        $contacted = $this->count_where("SELECT COUNT(*) AS total FROM registrations WHERE status = 'dihubungi'");
        $wa_group = $this->count_where("SELECT COUNT(*) AS total FROM registrations WHERE status = 'masuk_grup_wa'");
        $finished = $this->count_where("SELECT COUNT(*) AS total FROM registrations WHERE status = 'selesai'");
        $cancelled = $this->count_where("SELECT COUNT(*) AS total FROM registrations WHERE status = 'batal'");
        $today = $this->count_where("SELECT COUNT(*) AS total FROM registrations WHERE DATE(created_at) = CURDATE()");
        $this_month = $this->count_where("SELECT COUNT(*) AS total FROM registrations WHERE YEAR(created_at) = YEAR(CURDATE()) AND MONTH(created_at) = MONTH(CURDATE())");

        return [
            'total' => $total,
            'new' => $new,
            'contacted' => $contacted,
            'wa_group' => $wa_group,
            'finished' => $finished,
            'cancelled' => $cancelled,
            'today' => $today,
            'this_month' => $this_month,
            'programs' => $this->count_where('SELECT COUNT(*) AS total FROM programs WHERE is_active = 1'),
            'trainings' => $this->count_where('SELECT COUNT(*) AS total FROM trainings WHERE is_active = 1'),
            'trainers' => $this->count_where('SELECT COUNT(*) AS total FROM trainers WHERE is_active = 1'),
            'clients' => $this->count_where('SELECT COUNT(*) AS total FROM clients WHERE is_active = 1'),
        ];
    }

    public function status_breakdown()
    {
        $rows = $this->db->query('SELECT status, COUNT(*) AS total FROM registrations GROUP BY status')->result_array();
        $statuses = ['baru', 'dihubungi', 'masuk_grup_wa', 'selesai', 'batal'];
        $breakdown = array_fill_keys($statuses, 0);

        foreach ($rows as $row) {
            $breakdown[$row['status']] = (int) $row['total'];
        }

        return $breakdown;
    }

    public function asset_summary()
    {
        $trainer_total = $this->count_where('SELECT COUNT(*) AS total FROM trainers WHERE is_active = 1');
        $trainer_photo = $this->count_where("SELECT COUNT(*) AS total FROM trainers WHERE is_active = 1 AND photo_path IS NOT NULL AND photo_path <> ''");
        $client_total = $this->count_where('SELECT COUNT(*) AS total FROM clients WHERE is_active = 1');
        $client_logo = $this->count_where("SELECT COUNT(*) AS total FROM clients WHERE is_active = 1 AND logo_path IS NOT NULL AND logo_path <> ''");
        $training_total = $this->count_where('SELECT COUNT(*) AS total FROM trainings WHERE is_active = 1');
        $training_flyer = $this->count_where("SELECT COUNT(*) AS total FROM trainings WHERE is_active = 1 AND flyer_path IS NOT NULL AND flyer_path <> ''");

        return [
            'trainer_photo' => ['done' => $trainer_photo, 'total' => $trainer_total],
            'client_logo' => ['done' => $client_logo, 'total' => $client_total],
            'training_flyer' => ['done' => $training_flyer, 'total' => $training_total],
        ];
    }

    public function training_pipeline()
    {
        return $this->db->query(
            'SELECT s.name AS service_name, p.title AS program_title, COUNT(tr.id) AS training_total
             FROM programs p
             LEFT JOIN services s ON s.id = p.service_id
             LEFT JOIN trainings tr ON tr.program_id = p.id AND tr.is_active = 1
             WHERE p.is_active = 1
             GROUP BY p.id, s.name, p.title
             ORDER BY s.sort_order, p.sort_order, p.title
             LIMIT 8'
        )->result_array();
    }

    public function latest_registrations($limit = 6)
    {
        return $this->db->query(
            'SELECT r.*, p.title AS program_title, tr.title AS training_title
             FROM registrations r
             LEFT JOIN programs p ON p.id = r.program_id
             LEFT JOIN trainings tr ON tr.id = r.training_id
             ORDER BY r.created_at DESC
             LIMIT ' . (int) $limit
        )->result_array();
    }

    private function count($table)
    {
        return $this->count_where('SELECT COUNT(*) AS total FROM ' . $table);
    }

    private function count_where($sql)
    {
        $row = $this->db->query($sql)->row_array();
        return (int) ($row['total'] ?? 0);
    }
}
