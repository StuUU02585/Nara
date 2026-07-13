CREATE TABLE IF NOT EXISTS admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS site_settings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(120) NOT NULL UNIQUE,
  setting_value TEXT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS home_slides (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(180) NOT NULL,
  image_path VARCHAR(255) NOT NULL,
  alt_text VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_home_slides_image (image_path)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS social_links (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  platform VARCHAR(120) NOT NULL,
  profile_url VARCHAR(255) NOT NULL,
  icon_path VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_social_links_platform (platform)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS clients (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(180) NOT NULL,
  logo_path VARCHAR(255) NULL,
  official_url VARCHAR(255) NULL,
  note VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  UNIQUE KEY uq_clients_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS trainers (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(180) NOT NULL,
  role VARCHAR(180) NULL,
  expertise VARCHAR(255) NULL,
  bio TEXT NULL,
  photo_path VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  UNIQUE KEY uq_trainers_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS services (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(160) NOT NULL,
  slug VARCHAR(180) NOT NULL UNIQUE,
  description TEXT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS market_segments (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(180) NOT NULL UNIQUE,
  description TEXT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS program_categories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(160) NOT NULL,
  slug VARCHAR(180) NOT NULL UNIQUE,
  description TEXT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS programs (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  service_id INT UNSIGNED NULL,
  category_id INT UNSIGNED NULL,
  category VARCHAR(180) NOT NULL,
  title VARCHAR(180) NOT NULL,
  slug VARCHAR(180) NOT NULL UNIQUE,
  description TEXT NULL,
  mode VARCHAR(80) NULL,
  flyer_path VARCHAR(255) NULL,
  price DECIMAL(12,2) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_program_service FOREIGN KEY (service_id) REFERENCES services(id)
    ON UPDATE CASCADE ON DELETE SET NULL,
  CONSTRAINT fk_program_category FOREIGN KEY (category_id) REFERENCES program_categories(id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS trainings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  program_id INT UNSIGNED NOT NULL,
  trainer_id INT UNSIGNED NULL,
  market_segment_id INT UNSIGNED NULL,
  title VARCHAR(220) NOT NULL,
  schedule_label VARCHAR(80) NULL,
  venue_method VARCHAR(120) NOT NULL DEFAULT 'Online',
  duration_minutes INT UNSIGNED NULL,
  flyer_path VARCHAR(255) NULL,
  description TEXT NULL,
  quota INT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL,
  UNIQUE KEY uq_training_program_title (program_id, title),
  CONSTRAINT fk_training_program FOREIGN KEY (program_id) REFERENCES programs(id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_training_trainer FOREIGN KEY (trainer_id) REFERENCES trainers(id)
    ON UPDATE CASCADE ON DELETE SET NULL,
  CONSTRAINT fk_training_segment FOREIGN KEY (market_segment_id) REFERENCES market_segments(id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS training_agendas (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  program_id INT UNSIGNED NOT NULL,
  title VARCHAR(180) NOT NULL,
  start_date DATE NULL,
  end_date DATE NULL,
  mode ENUM('Online','Offline','Hybrid') NOT NULL DEFAULT 'Online',
  location VARCHAR(180) NULL,
  flyer_path VARCHAR(255) NULL,
  quota INT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_agenda_title_date (title, start_date),
  CONSTRAINT fk_agenda_program FOREIGN KEY (program_id) REFERENCES programs(id)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS articles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(220) NOT NULL,
  summary TEXT NULL,
  external_url VARCHAR(255) NOT NULL,
  source VARCHAR(120) NOT NULL DEFAULT 'ProleadIndonesia.com',
  published_at DATE NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  UNIQUE KEY uq_articles_external_url (external_url)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS registrations (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  program_id INT UNSIGNED NOT NULL,
  training_id INT UNSIGNED NULL,
  agenda_id INT UNSIGNED NULL,
  full_name VARCHAR(160) NOT NULL,
  email VARCHAR(160) NOT NULL,
  phone VARCHAR(40) NOT NULL,
  institution VARCHAR(180) NOT NULL,
  position VARCHAR(120) NOT NULL,
  participant_count INT NOT NULL DEFAULT 1,
  message TEXT NULL,
  delivery_channel VARCHAR(80) NOT NULL DEFAULT 'Grup WhatsApp',
  status ENUM('baru','dihubungi','masuk_grup_wa','selesai','batal') NOT NULL DEFAULT 'baru',
  admin_note TEXT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NULL,
  CONSTRAINT fk_registration_program FOREIGN KEY (program_id) REFERENCES programs(id)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT fk_registration_training FOREIGN KEY (training_id) REFERENCES trainings(id)
    ON UPDATE CASCADE ON DELETE SET NULL,
  CONSTRAINT fk_registration_agenda FOREIGN KEY (agenda_id) REFERENCES training_agendas(id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS participants (
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
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS participant_programs (
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
  CONSTRAINT fk_participant_program_participant FOREIGN KEY (participant_id) REFERENCES participants(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_participant_program_program FOREIGN KEY (program_id) REFERENCES programs(id)
    ON UPDATE CASCADE ON DELETE SET NULL,
  CONSTRAINT fk_participant_program_training FOREIGN KEY (training_id) REFERENCES trainings(id)
    ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS contact_messages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(160) NOT NULL,
  email VARCHAR(160) NULL,
  institution VARCHAR(180) NULL,
  position VARCHAR(120) NULL,
  phone VARCHAR(40) NOT NULL,
  message TEXT NULL,
  status ENUM('baru','dihubungi','selesai') NOT NULL DEFAULT 'baru',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

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
