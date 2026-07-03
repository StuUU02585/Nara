<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model
{
    // Mengambil semua data flyer jadwal training (Format array)
    public function get_all()
    {
        $db = get_instance()->db;
        return $db->query('SELECT * FROM jadwal_training ORDER BY id DESC')->result_array();
    }

    // Memasukkan data flyer baru
    public function insert_data(array $data)
    {
        $db = get_instance()->db;
        return $db->insert('jadwal_training', $data);
    }

    // Mencari 1 data flyer berdasarkan ID (Pake row_array)
    public function get_by_id($id)
    {
        $db = get_instance()->db;
        return $db->query('SELECT * FROM jadwal_training WHERE id = ? LIMIT 1', [$id])->row_array();
    }

    // Menghapus data dari database
    public function delete_data($id)
    {
        $db = get_instance()->db;
        return $db->delete('jadwal_training', ['id' => $id]);
    }
}