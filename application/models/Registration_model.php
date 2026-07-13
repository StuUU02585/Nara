<?php

class Registration_model
{
    private $db;

    public function __construct()
    {
        $this->db = get_instance()->db;
    }

    public function create(array $data)
    {
        $data['status'] = 'baru';
        $data['delivery_channel'] = 'Grup WhatsApp';
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('registrations', $data);
    }

    public function all(array $filters = [])
    {
        $sql = 'SELECT r.*, p.title AS program_title, tr.title AS training_title, a.title AS agenda_title
                FROM registrations r
                LEFT JOIN programs p ON p.id = r.program_id
                LEFT JOIN trainings tr ON tr.id = r.training_id
                LEFT JOIN training_agendas a ON a.id = r.agenda_id
                WHERE 1 = 1';
        $params = [];

        if (!empty($filters['status'])) {
            $sql .= ' AND r.status = ?';
            $params[] = $filters['status'];
        }

        if (!empty($filters['keyword'])) {
            $keyword = '%' . $filters['keyword'] . '%';
            $sql .= ' AND (r.full_name LIKE ? OR r.email LIKE ? OR r.phone LIKE ? OR r.institution LIKE ? OR p.title LIKE ? OR tr.title LIKE ?)';
            $params = array_merge($params, [$keyword, $keyword, $keyword, $keyword, $keyword, $keyword]);
        }

        $sql .= ' ORDER BY r.created_at DESC';
        return $this->db->query($sql, $params)->result_array();
    }

    public function find($id)
    {
        return $this->db->query('SELECT * FROM registrations WHERE id = ? LIMIT 1', [$id])->row_array();
    }

    public function update_status($id, $status, $admin_note)
    {
        $this->db->update('registrations', [
            'status' => $status,
            'admin_note' => $admin_note,
            'updated_at' => date('Y-m-d H:i:s'),
        ], ['id' => $id]);
    }
}
