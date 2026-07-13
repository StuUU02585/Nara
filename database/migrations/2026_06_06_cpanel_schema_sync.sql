-- Sinkronisasi struktur database cPanel dengan schema lokal Nara-HR.
-- Dibuat dari perbandingan struktur-database-cpanel.sql.sql dan schema.sql.
-- Tidak menghapus atau mengubah isi data.

SET @old_foreign_key_checks = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 1;

-- Hentikan migrasi jika ditemukan relasi data yang tidak valid.
DROP PROCEDURE IF EXISTS nara_hr_validate_relations;

DELIMITER $$

CREATE PROCEDURE nara_hr_validate_relations()
BEGIN
    IF EXISTS (
        SELECT 1
        FROM programs p
        LEFT JOIN program_categories pc ON pc.id = p.category_id
        WHERE p.category_id IS NOT NULL AND pc.id IS NULL
        LIMIT 1
    ) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Migrasi dihentikan: programs.category_id memiliki data tanpa kategori yang valid.';
    END IF;

    IF EXISTS (
        SELECT 1
        FROM participant_programs pp
        LEFT JOIN participants p ON p.id = pp.participant_id
        WHERE p.id IS NULL
        LIMIT 1
    ) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Migrasi dihentikan: participant_programs memiliki participant_id yang tidak valid.';
    END IF;

    IF EXISTS (
        SELECT 1
        FROM participant_programs pp
        LEFT JOIN programs p ON p.id = pp.program_id
        WHERE pp.program_id IS NOT NULL AND p.id IS NULL
        LIMIT 1
    ) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Migrasi dihentikan: participant_programs memiliki program_id yang tidak valid.';
    END IF;

    IF EXISTS (
        SELECT 1
        FROM participant_programs pp
        LEFT JOIN trainings t ON t.id = pp.training_id
        WHERE pp.training_id IS NOT NULL AND t.id IS NULL
        LIMIT 1
    ) THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Migrasi dihentikan: participant_programs memiliki training_id yang tidak valid.';
    END IF;
END$$

DELIMITER ;

CALL nara_hr_validate_relations();
DROP PROCEDURE nara_hr_validate_relations;

ALTER TABLE programs
    MODIFY category VARCHAR(180) NOT NULL,
    ADD CONSTRAINT fk_program_category
        FOREIGN KEY (category_id) REFERENCES program_categories(id)
        ON UPDATE CASCADE ON DELETE SET NULL;

ALTER TABLE participant_programs
    ADD CONSTRAINT fk_participant_program_participant
        FOREIGN KEY (participant_id) REFERENCES participants(id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    ADD CONSTRAINT fk_participant_program_program
        FOREIGN KEY (program_id) REFERENCES programs(id)
        ON UPDATE CASCADE ON DELETE SET NULL,
    ADD CONSTRAINT fk_participant_program_training
        FOREIGN KEY (training_id) REFERENCES trainings(id)
        ON UPDATE CASCADE ON DELETE SET NULL;

SET FOREIGN_KEY_CHECKS = @old_foreign_key_checks;
