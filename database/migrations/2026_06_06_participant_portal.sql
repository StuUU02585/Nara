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
