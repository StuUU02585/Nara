# ERD Sistem Informasi Sahabat Nara

```mermaid
erDiagram
    SERVICES ||--o{ PROGRAMS : memiliki
    PROGRAMS ||--o{ TRAININGS : memiliki
    TRAINERS ||--o{ TRAININGS : mengajar
    MARKET_SEGMENTS ||--o{ TRAININGS : ditargetkan
    PROGRAMS ||--o{ REGISTRATIONS : dipilih
    TRAININGS ||--o{ REGISTRATIONS : dipilih_opsional
    PROGRAMS ||--o{ TRAINING_AGENDAS : legacy_agenda
    CLIENTS {
        int id PK
        varchar name
        varchar logo_path
    }
    TRAINERS {
        int id PK
        varchar name
        varchar photo_path
    }
    SERVICES {
        int id PK
        varchar name
        varchar slug
    }
    PROGRAMS {
        int id PK
        int service_id FK
        varchar title
        varchar slug
    }
    TRAININGS {
        int id PK
        int program_id FK
        int trainer_id FK
        int market_segment_id FK
        varchar title
        varchar schedule_label
        varchar venue_method
        int duration_minutes
        varchar flyer_path
    }
    MARKET_SEGMENTS {
        int id PK
        varchar name
    }
    REGISTRATIONS {
        int id PK
        int program_id FK
        int training_id FK
        varchar full_name
        varchar phone
        enum status
    }
```

Catatan:

- `services` menyimpan kelompok layanan seperti `HR Training`.
- `programs` menyimpan nama program seperti `Human Resources Basic Training (HR for Non HR)`.
- `trainings` menyimpan topik/kelas yang benar-benar dipilih peserta, termasuk trainer, waktu, metode, durasi, segment pasar, dan flyer.
- `registrations` tetap menjadi pusat proses pendaftaran peserta ke admin.
