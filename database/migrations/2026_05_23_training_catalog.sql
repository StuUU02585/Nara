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

ALTER TABLE programs
  ADD COLUMN service_id INT UNSIGNED NULL AFTER id;

ALTER TABLE programs
  ADD CONSTRAINT fk_program_service FOREIGN KEY (service_id) REFERENCES services(id)
    ON UPDATE CASCADE ON DELETE SET NULL;

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

ALTER TABLE registrations
  ADD COLUMN training_id INT UNSIGNED NULL AFTER program_id;

ALTER TABLE registrations
  ADD CONSTRAINT fk_registration_training FOREIGN KEY (training_id) REFERENCES trainings(id)
    ON UPDATE CASCADE ON DELETE SET NULL;
