<?php

class Content_model
{
    private $db;

    public function __construct()
    {
        $this->db = get_instance()->db;
    }

    public function clients()
    {
        return $this->db->query('SELECT * FROM clients WHERE is_active = 1 ORDER BY sort_order, name')->result_array();
    }

    public function all_clients()
    {
        return $this->db->query('SELECT * FROM clients ORDER BY sort_order, name')->result_array();
    }

    public function trainers()
    {
        return $this->db->query('SELECT * FROM trainers WHERE is_active = 1 ORDER BY sort_order, name')->result_array();
    }

    public function all_trainers()
    {
        return $this->db->query('SELECT * FROM trainers ORDER BY sort_order, name')->result_array();
    }

    public function programs()
    {
        return $this->db->query('SELECT p.*, pc.name AS category_name, pc.slug AS category_slug FROM programs p LEFT JOIN program_categories pc ON pc.id = p.category_id WHERE p.is_active = 1 ORDER BY p.sort_order, p.id')->result_array();
    }

    public function certification_programs()
    {
        return $this->db->query(
            'SELECT p.*, pc.name AS category_name, pc.slug AS category_slug
             FROM programs p
             LEFT JOIN program_categories pc ON pc.id = p.category_id
             WHERE p.is_active = 1
               AND (
                    p.category IN (\'bnsp\', \'kan_iaf\')
                    OR pc.slug IN (\'bnsp\', \'kan-iaf\', \'sertifikasi\', \'sertifikasi-bnsp\', \'sertifikasi-kan-iaf\')
                    OR LOWER(COALESCE(pc.name, \'\')) LIKE \'%sertifikasi%\'
                    OR LOWER(p.title) LIKE \'%sertifikasi%\'
               )
             ORDER BY p.sort_order, p.id'
        )->result_array();
    }

    public function home_slides()
    {
        return $this->db->query('SELECT * FROM home_slides WHERE is_active = 1 ORDER BY sort_order, id')->result_array();
    }

    public function all_home_slides()
    {
        return $this->db->query('SELECT * FROM home_slides ORDER BY sort_order, id')->result_array();
    }

    public function social_links()
    {
        return $this->db->query('SELECT * FROM social_links WHERE is_active = 1 ORDER BY sort_order, platform')->result_array();
    }

    public function all_social_links()
    {
        return $this->db->query('SELECT * FROM social_links ORDER BY sort_order, platform')->result_array();
    }

    public function create_social_link(array $data)
    {
        return $this->db->insert('social_links', $data);
    }

    public function update_social_link($id, array $data)
    {
        $this->db->update('social_links', $data, ['id' => $id]);
    }

    public function delete_social_link($id)
    {
        $this->db->delete('social_links', ['id' => $id]);
    }

    public function create_home_slide(array $data)
    {
        return $this->db->insert('home_slides', $data);
    }

    public function update_home_slide($id, array $data)
    {
        $this->db->update('home_slides', $data, ['id' => $id]);
    }

    public function delete_home_slide($id)
    {
        $this->db->delete('home_slides', ['id' => $id]);
    }

    public function agendas($limit = 12)
    {
        return $this->db->query('SELECT a.*, p.title AS program_title FROM training_agendas a LEFT JOIN programs p ON p.id = a.program_id WHERE a.is_active = 1 ORDER BY a.start_date ASC LIMIT ' . (int) $limit)->result_array();
    }

    public function all_agendas()
    {
        return $this->db->query('SELECT a.*, p.title AS program_title FROM training_agendas a LEFT JOIN programs p ON p.id = a.program_id ORDER BY a.start_date ASC, a.id DESC')->result_array();
    }

    public function update_trainer_photo($id, $photo_path)
    {
        $this->db->update('trainers', ['photo_path' => $photo_path], ['id' => $id]);
    }

    public function update_client_logo($id, $logo_path)
    {
        $this->db->update('clients', ['logo_path' => $logo_path], ['id' => $id]);
    }

    public function update_agenda_flyer($id, $flyer_path)
    {
        $this->db->update('training_agendas', ['flyer_path' => $flyer_path], ['id' => $id]);
    }

    public function articles($limit = 6)
    {
        return $this->db->query('SELECT * FROM articles WHERE is_active = 1 ORDER BY published_at DESC LIMIT ' . (int) $limit)->result_array();
    }

    public function all_articles()
    {
        return $this->db->query('SELECT * FROM articles ORDER BY published_at DESC, id DESC')->result_array();
    }

    public function create_trainer(array $data)
    {
        return $this->db->insert('trainers', $data);
    }

    public function update_trainer($id, array $data)
    {
        $this->db->update('trainers', $data, ['id' => $id]);
    }

    public function delete_trainer($id)
    {
        $this->db->delete('trainers', ['id' => $id]);
    }

    public function create_client(array $data)
    {
        return $this->db->insert('clients', $data);
    }

    public function update_client($id, array $data)
    {
        $this->db->update('clients', $data, ['id' => $id]);
    }

    public function delete_client($id)
    {
        $this->db->delete('clients', ['id' => $id]);
    }

    public function create_article(array $data)
    {
        return $this->db->insert('articles', $data);
    }

    public function update_article($id, array $data)
    {
        $this->db->update('articles', $data, ['id' => $id]);
    }

    public function delete_article($id)
    {
        $this->db->delete('articles', ['id' => $id]);
    }

    public function settings()
    {
        $rows = $this->db->query('SELECT setting_key, setting_value FROM site_settings')->result_array();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }
}
