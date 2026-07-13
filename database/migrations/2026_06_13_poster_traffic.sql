CREATE TABLE IF NOT EXISTS poster_clicks (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
