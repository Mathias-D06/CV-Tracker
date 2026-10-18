-- Table used by AstonCV. Run this in phpMyAdmin or the MySQL client
-- against the database named in config.php.
CREATE TABLE IF NOT EXISTS cvs (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    name           VARCHAR(100) NOT NULL,
    email          VARCHAR(255) NOT NULL UNIQUE,
    password       VARCHAR(255) NOT NULL,      -- bcrypt hash from password_hash()
    keyprogramming VARCHAR(50)  DEFAULT NULL,  -- Java, Python, PHP, C++ or JavaScript
    profile        TEXT         DEFAULT NULL,
    education      TEXT         DEFAULT NULL,
    URLlinks       TEXT         DEFAULT NULL
);
