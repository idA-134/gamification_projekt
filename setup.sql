CREATE DATABASE IF NOT EXISTS schnitzeljagd;
USE schnitzeljagd;

CREATE TABLE IF NOT EXISTS benutzer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    benutzername VARCHAR(50) NOT NULL UNIQUE,
    passwort VARCHAR(255) NOT NULL,
    rolle ENUM('Administrator', 'Benutzer') DEFAULT 'Benutzer'
);

INSERT INTO benutzer (benutzername, passwort, rolle) VALUES
('Kurt Dagel', 'Nudelsuppe', 'Administrator'),
('Admin',      'passwort',   'Benutzer'),
('Kurt',      'test1234',   'Benutzer'),
('Test',       'supertest',  'Benutzer'),
('Dudelsack',  'musik',      'Benutzer');