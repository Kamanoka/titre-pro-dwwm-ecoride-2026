CREATE DATABASE ecoride CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE ecoride;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(120) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    credits INT DEFAULT 20,
    role ENUM('visiteur', 'utilisateur', 'chauffeur', 'passager', 'admin') DEFAULT 'utilisateur',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    marque VARCHAR(50),
    modele VARCHAR(50),
    energie ENUM('essence', 'diesel', 'electrique', 'hybride') NOT NULL,
    places INT NOT NULL,
    plaque VARCHAR(20),
    couleur VARCHAR(30),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE trajets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chauffeur_id INT NOT NULL,
    vehicule_id INT NOT NULL,
    depart_ville VARCHAR(100) NOT NULL,
    arrivee_ville VARCHAR(100) NOT NULL,
    date_depart DATE NOT NULL,
    heure_depart TIME NOT NULL,
    prix DECIMAL(6,2) NOT NULL,
    places_restantes INT NOT NULL,
    ecologique TINYINT(1) DEFAULT 0,  -- 1 si véhicule électrique
    statut ENUM('ouvert', 'en_cours', 'termine', 'annule') DEFAULT 'ouvert',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chauffeur_id) REFERENCES users(id),
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(id)
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trajet_id INT NOT NULL,
    passager_id INT NOT NULL,
    statut ENUM('en_attente', 'confirme', 'refuse') DEFAULT 'en_attente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trajet_id) REFERENCES trajets(id),
    FOREIGN KEY (passager_id) REFERENCES users(id)
);

CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trajet_id INT NOT NULL,
    auteur_id INT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    commentaire TEXT,
    valide TINYINT(1) DEFAULT 0,  -- validé par employé
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trajet_id) REFERENCES trajets(id),
    FOREIGN KEY (auteur_id) REFERENCES users(id)
);

-- Données test
INSERT INTO users (pseudo, email, password, role) VALUES
('chauffeur1', 'ch1@test.fr', '$2y$10$exemplehashici', 'chauffeur'),
('passager1', 'p1@test.fr', '$2y$10$exemplehashici', 'utilisateur');

-- Mot de passe test : password123 (utilise password_hash en vrai)
