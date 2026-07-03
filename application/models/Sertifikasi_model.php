<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikasi_model
{
    // Mengambil semua data flyer sertifikasi (Menggunakan format array sesuai selera CI temen lu)
    public function get_all()
    {
        $db = get_instance()->db;
        return $db->query('SELECT * FROM sertifikasi ORDER BY id DESC')->result_array();
    }

    // Memasukkan data flyer baru
    public function insert_data(array $data)
    {
        $db = get_instance()->db;
        return $db->insert('sertifikasi', $data);
    }

    // Mencari 1 data flyer berdasarkan ID (Pake row_array biar sinkron)
    public function get_by_id($id)
    {
        $db = get_instance()->db;
        return $db->query('SELECT * FROM sertifikasi WHERE id = ? LIMIT 1', [$id])->row_array();
    }

    // Menghapus data dari database
    public function delete_data($id)
    {
        $db = get_instance()->db;
        return $db->delete('sertifikasi', ['id' => $id]);
    }
}