-- Migration : create_contact_messages_table

CREATE TABLE contact_messages (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(190) NOT NULL,
    email      VARCHAR(190) NOT NULL,
    phone      VARCHAR(50) NULL,
    subject    VARCHAR(100) NOT NULL,
    message    TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
