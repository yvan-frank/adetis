-- Migration : create_immigration_requests_table

CREATE TABLE immigration_requests (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name            VARCHAR(190) NOT NULL,
    email           VARCHAR(190) NOT NULL,
    phone           VARCHAR(50) NOT NULL,
    country         VARCHAR(120) NOT NULL,
    current_level   VARCHAR(100) NOT NULL,
    current_field   VARCHAR(190) NOT NULL,
    target_level    VARCHAR(100) NOT NULL,
    target_field    VARCHAR(190) NOT NULL,
    intake          VARCHAR(50) NOT NULL,
    language_level  VARCHAR(100) NULL,
    stage           VARCHAR(100) NOT NULL,
    message         TEXT NOT NULL,
    consent_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    created_at      TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
