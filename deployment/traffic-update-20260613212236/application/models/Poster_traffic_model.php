<?php

class Poster_traffic_model
{
    private $db;

    public function __construct()
    {
        $this->db = get_instance()->db;
        $this->ensure_table();
    }

    public function record(array $data)
    {
        $recent = $this->db->query(
            'SELECT id FROM poster_clicks
             WHERE poster_key = ? AND visitor_hash = ? AND clicked_at >= DATE_SUB(NOW(), INTERVAL 3 SECOND)
             LIMIT 1',
            [$data['poster_key'], $data['visitor_hash']]
        )->row_array();

        if ($recent) {
            return false;
        }

        $this->db->insert('poster_clicks', $data);
        return true;
    }

    public function summary()
    {
        $row = $this->db->query(
            'SELECT
                COUNT(*) AS total_clicks,
                SUM(DATE(clicked_at) = CURDATE()) AS today_clicks,
                COUNT(DISTINCT visitor_hash) AS unique_visitors,
                SUM(YEAR(clicked_at) = YEAR(CURDATE()) AND MONTH(clicked_at) = MONTH(CURDATE())) AS month_clicks
             FROM poster_clicks'
        )->row_array();

        return [
            'total_clicks' => (int) ($row['total_clicks'] ?? 0),
            'today_clicks' => (int) ($row['today_clicks'] ?? 0),
            'unique_visitors' => (int) ($row['unique_visitors'] ?? 0),
            'month_clicks' => (int) ($row['month_clicks'] ?? 0),
        ];
    }

    public function top_posters($limit = 10)
    {
        return $this->db->query(
            'SELECT poster_type, poster_key, poster_name,
                    COUNT(*) AS total_clicks,
                    COUNT(DISTINCT visitor_hash) AS unique_visitors,
                    MAX(clicked_at) AS last_clicked_at
             FROM poster_clicks
             GROUP BY poster_type, poster_key, poster_name
             ORDER BY total_clicks DESC, last_clicked_at DESC
             LIMIT ' . (int) $limit
        )->result_array();
    }

    public function recent_clicks($limit = 8)
    {
        return $this->db->query(
            'SELECT poster_type, poster_name, page_path, clicked_at
             FROM poster_clicks
             ORDER BY clicked_at DESC
             LIMIT ' . (int) $limit
        )->result_array();
    }

    private function ensure_table()
    {
        $this->db->query(
            'CREATE TABLE IF NOT EXISTS poster_clicks (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                poster_type VARCHAR(40) NOT NULL,
                poster_key VARCHAR(190) NOT NULL,
                poster_name VARCHAR(220) NOT NULL,
                page_path VARCHAR(255) NOT NULL,
                visitor_hash CHAR(64) NOT NULL,
                user_agent VARCHAR(255) NULL,
                clicked_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_poster_clicks_key (poster_key),
                INDEX idx_poster_clicks_clicked_at (clicked_at),
                INDEX idx_poster_clicks_visitor (visitor_hash)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }
}
