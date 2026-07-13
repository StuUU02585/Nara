<?php

class Training_model
{
    private $db;

    public function __construct()
    {
        $this->db = get_instance()->db;
    }

    public function services()
    {
        return $this->db->query('SELECT * FROM services ORDER BY sort_order, name')->result_array();
    }

    public function active_services()
    {
        return $this->db->query('SELECT * FROM services WHERE is_active = 1 ORDER BY sort_order, name')->result_array();
    }

    public function segments()
    {
        return $this->db->query('SELECT * FROM market_segments ORDER BY sort_order, name')->result_array();
    }

    public function programs()
    {
        return $this->db->query('SELECT p.*, s.name AS service_name, pc.name AS category_name, pc.slug AS category_slug FROM programs p LEFT JOIN services s ON s.id = p.service_id LEFT JOIN program_categories pc ON pc.id = p.category_id ORDER BY s.sort_order, p.sort_order, p.title')->result_array();
    }

    public function program_categories()
    {
        return $this->db->query('SELECT * FROM program_categories ORDER BY sort_order, name')->result_array();
    }

    public function trainings()
    {
        return $this->db->query(
            'SELECT tr.*, p.title AS program_title, p.service_id, s.name AS service_name, t.name AS trainer_name, ms.name AS segment_name
             FROM trainings tr
             JOIN programs p ON p.id = tr.program_id
             LEFT JOIN services s ON s.id = p.service_id
             LEFT JOIN trainers t ON t.id = tr.trainer_id
             LEFT JOIN market_segments ms ON ms.id = tr.market_segment_id
             ORDER BY s.sort_order, p.sort_order, tr.sort_order, tr.id DESC'
        )->result_array();
    }

    public function active_trainings()
    {
        return $this->db->query(
            'SELECT tr.*, p.title AS program_title, s.name AS service_name, t.name AS trainer_name, ms.name AS segment_name
             FROM trainings tr
             JOIN programs p ON p.id = tr.program_id
             LEFT JOIN services s ON s.id = p.service_id
             LEFT JOIN trainers t ON t.id = tr.trainer_id
             LEFT JOIN market_segments ms ON ms.id = tr.market_segment_id
             WHERE tr.is_active = 1 AND p.is_active = 1
             ORDER BY s.sort_order, p.sort_order, tr.sort_order, tr.id DESC'
        )->result_array();
    }

    public function active_trainings_by_schedule_month($month_name, $year)
    {
        return $this->db->query(
            'SELECT tr.*, p.title AS program_title, s.name AS service_name, t.name AS trainer_name, ms.name AS segment_name
             FROM trainings tr
             JOIN programs p ON p.id = tr.program_id
             LEFT JOIN services s ON s.id = p.service_id
             LEFT JOIN trainers t ON t.id = tr.trainer_id
             LEFT JOIN market_segments ms ON ms.id = tr.market_segment_id
             WHERE tr.is_active = 1
               AND p.is_active = 1
               AND LOWER(COALESCE(tr.schedule_label, "")) LIKE ?
               AND COALESCE(tr.schedule_label, "") LIKE ?
             ORDER BY s.sort_order, p.sort_order, tr.sort_order, tr.id DESC',
            ['%' . strtolower($month_name) . '%', '%' . (int) $year . '%']
        )->result_array();
    }

    public function find_training($id)
    {
        return $this->db->query('SELECT * FROM trainings WHERE id = ? LIMIT 1', [$id])->row_array();
    }

    public function create_service(array $data)
    {
        $data['slug'] = $this->unique_slug('services', $data['name']);
        return $this->db->insert('services', $data);
    }

    public function update_service($id, array $data)
    {
        $data['slug'] = $this->unique_slug('services', $data['name'], $id);
        $this->db->update('services', $data, ['id' => $id]);
    }

    public function delete_service($id)
    {
        $this->db->delete('services', ['id' => $id]);
    }

    public function create_segment(array $data)
    {
        return $this->db->insert('market_segments', $data);
    }

    public function update_segment($id, array $data)
    {
        $this->db->update('market_segments', $data, ['id' => $id]);
    }

    public function delete_segment($id)
    {
        $this->db->delete('market_segments', ['id' => $id]);
    }

    public function create_program(array $data)
    {
        $data['slug'] = $this->unique_slug('programs', $data['title']);
        return $this->db->insert('programs', $data);
    }

    public function update_program($id, array $data)
    {
        $data['slug'] = $this->unique_slug('programs', $data['title'], $id);
        $this->db->update('programs', $data, ['id' => $id]);
    }

    public function delete_program($id)
    {
        // 1. Hapus data foreign key di tabel training_agendas terlebih dahulu
        $this->db->delete('training_agendas', ['program_id' => $id]);

        // 2. Hapus juga data foreign key di tabel registrations agar tidak RESTRICT
        $this->db->delete('registrations', ['program_id' => $id]);

        // 3. Baru hapus data utama di tabel programs
        $this->db->delete('programs', ['id' => $id]);
    }

    public function create_program_category(array $data)
    {
        $data['slug'] = $this->unique_slug('program_categories', $data['name']);
        return $this->db->insert('program_categories', $data);
    }

    public function update_program_category($id, array $data)
    {
        $data['slug'] = $this->unique_slug('program_categories', $data['name'], $id);
        $this->db->update('program_categories', $data, ['id' => $id]);
    }

    public function delete_program_category($id)
    {
        $this->db->delete('program_categories', ['id' => $id]);
    }

    public function create_training(array $data)
    {
        return $this->db->insert('trainings', $data);
    }

    public function update_training($id, array $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->update('trainings', $data, ['id' => $id]);
    }

    public function delete_training($id)
    {
        $this->db->delete('trainings', ['id' => $id]);
    }

    public function update_training_flyer($id, $flyer_path)
    {
        $this->db->update('trainings', ['flyer_path' => $flyer_path, 'updated_at' => date('Y-m-d H:i:s')], ['id' => $id]);
    }

    private function slug($text)
    {
        $slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $text), '-'));
        return $slug ?: 'item-' . date('YmdHis');
    }

    private function unique_slug($table, $text, $except_id = null)
    {
        $base = $this->slug($text);
        $slug = $base;
        $counter = 2;

        while ($this->slug_exists($table, $slug, $except_id)) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function slug_exists($table, $slug, $except_id = null)
    {
        $allowed_tables = ['services', 'programs', 'program_categories'];
        if (!in_array($table, $allowed_tables, true)) {
            throw new InvalidArgumentException('Tabel slug tidak didukung.');
        }

        $sql = 'SELECT id FROM ' . $table . ' WHERE slug = ?';
        $params = [$slug];
        if ($except_id !== null) {
            $sql .= ' AND id <> ?';
            $params[] = (int) $except_id;
        }
        $sql .= ' LIMIT 1';

        return (bool) $this->db->query($sql, $params)->row_array();
    }
}