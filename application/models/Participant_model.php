<?php

class Participant_model
{
    private $db;

    public function __construct()
    {
        $this->db = get_instance()->db;
        $this->ensure_tables();
    }

    public function all_enrollments()
    {
        return $this->db->query(
            'SELECT pp.*, p.full_name, p.institution, p.email, p.phone, p.is_active, pr.title AS selected_program, tr.title AS training_title
             FROM participant_programs pp
             JOIN participants p ON p.id = pp.participant_id
             LEFT JOIN programs pr ON pr.id = pp.program_id
             LEFT JOIN trainings tr ON tr.id = pp.training_id
             ORDER BY pp.created_at DESC, pp.id DESC'
        )->result_array();
    }

    public function find_enrollment($id)
    {
        return $this->db->query(
            'SELECT pp.*, p.full_name, p.institution, p.email, p.phone, p.phone_normalized, p.is_active
             FROM participant_programs pp
             JOIN participants p ON p.id = pp.participant_id
             WHERE pp.id = ?
             LIMIT 1',
            [$id]
        )->row_array();
    }

    public function find_by_phone($phone)
    {
        return $this->db->query(
            'SELECT * FROM participants WHERE phone_normalized = ? AND is_active = 1 LIMIT 1',
            [$this->normalize_phone($phone)]
        )->row_array();
    }

    public function find_any_by_phone($phone)
    {
        return $this->find_by_normalized_phone($this->normalize_phone($phone));
    }

    public function participant_programs($participant_id)
    {
        return $this->db->query(
            'SELECT pp.*, pr.title AS selected_program, tr.title AS training_title
             FROM participant_programs pp
             LEFT JOIN programs pr ON pr.id = pp.program_id
             LEFT JOIN trainings tr ON tr.id = pp.training_id
             WHERE pp.participant_id = ? AND pp.is_published = 1
             ORDER BY pp.attended_at DESC, pp.id DESC',
            [$participant_id]
        )->result_array();
    }

    public function find_participant($id)
    {
        return $this->db->query('SELECT * FROM participants WHERE id = ? LIMIT 1', [$id])->row_array();
    }

    public function save_from_admin(array $profile, array $program, $enrollment_id = null)
    {
        $profile['phone_normalized'] = $this->normalize_phone($profile['phone']);
        $password = $profile['password'] ?? '';
        unset($profile['password']);

        if ($password !== '') {
            $profile['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($enrollment_id) {
            $existing = $this->find_enrollment($enrollment_id);
            if (!$existing) {
                return null;
            }
            $participant_id = $existing['participant_id'];
            $profile['updated_at'] = date('Y-m-d H:i:s');
            $this->db->update('participants', $profile, ['id' => $participant_id]);
            $program['updated_at'] = date('Y-m-d H:i:s');
            $this->db->update('participant_programs', $program, ['id' => $enrollment_id]);
            return $enrollment_id;
        }

        $participant = $this->find_by_normalized_phone($profile['phone_normalized']);
        if ($participant) {
            $participant_id = $participant['id'];
            if (!isset($profile['password_hash'])) {
                unset($profile['password_hash']);
            }
            foreach (['full_name', 'institution', 'email'] as $field) {
                if (($profile[$field] ?? '') === '') {
                    unset($profile[$field]);
                }
            }
            $profile['updated_at'] = date('Y-m-d H:i:s');
            $this->db->update('participants', $profile, ['id' => $participant_id]);
        } else {
            $participant_id = $this->db->insert('participants', $profile);
        }

        $program['participant_id'] = $participant_id;
        return $this->db->insert('participant_programs', $program);
    }

    public function update_profile($participant_id, array $data)
    {
        if (isset($data['phone'])) {
            $data['phone_normalized'] = $this->normalize_phone($data['phone']);
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->update('participants', $data, ['id' => $participant_id]);
    }

    public function change_password($participant_id, $password)
    {
        $this->db->update('participants', [
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ], ['id' => $participant_id]);
    }

    public function delete_enrollment($id)
    {
        $this->db->delete('participant_programs', ['id' => $id]);
    }

    public function normalize_phone($phone)
    {
        $digits = preg_replace('/\D+/', '', (string) $phone);
        if (strpos($digits, '0') === 0) {
            return '62' . substr($digits, 1);
        }
        return $digits;
    }

    private function find_by_normalized_phone($phone)
    {
        return $this->db->query('SELECT * FROM participants WHERE phone_normalized = ? LIMIT 1', [$phone])->row_array();
    }

    private function ensure_tables()
    {
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS participants (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                full_name VARCHAR(160) NOT NULL,
                institution VARCHAR(180) NULL,
                email VARCHAR(160) NULL,
                phone VARCHAR(40) NOT NULL,
                phone_normalized VARCHAR(40) NOT NULL UNIQUE,
                password_hash VARCHAR(255) NOT NULL,
                is_active TINYINT(1) NOT NULL DEFAULT 1,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        $this->db->query(
            'CREATE TABLE IF NOT EXISTS participant_programs (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                participant_id INT UNSIGNED NOT NULL,
                program_id INT UNSIGNED NULL,
                training_id INT UNSIGNED NULL,
                program_name VARCHAR(220) NOT NULL,
                attended_at DATE NOT NULL,
                certificate_path VARCHAR(255) NOT NULL,
                is_published TINYINT(1) NOT NULL DEFAULT 0,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NULL,
                INDEX idx_participant_program_participant (participant_id),
                INDEX idx_participant_program_program (program_id),
                INDEX idx_participant_program_training (training_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }
}
