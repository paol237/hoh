-- =======================================================================
-- ÉTAPE 1 : CRÉATION DE LA BASE DE DONNÉES ET DE L'UTILISATEUR D'APPLICATION
-- =======================================================================

-- Crée la base de données si elle n'existe pas (NOM : hoh_db)
CREATE DATABASE IF NOT EXISTS hoh_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Sélectionne la base de données pour les commandes suivantes (important pour les tables)
USE hoh_db;

-- Crée l'utilisateur 'ong' avec le mot de passe 'handonheart' pour l'accès local
-- C'est l'utilisateur défini dans votre db_connect.php
CREATE USER IF NOT EXISTS 'ong'@'localhost' IDENTIFIED BY 'handonheart';

-- Accorde tous les droits à l'utilisateur 'ong' sur la base de données 'hoh_db'
GRANT ALL PRIVILEGES ON hoh_db.* TO 'ong'@'localhost';

-- Actualise les privilèges pour que les changements soient immédiatement appliqués
FLUSH PRIVILEGES;


-- =======================================================================
-- ÉTAPE 2 : CRÉATION DES TABLES DANS LA BASE 'hoh_db'
-- =======================================================================

-- 1. Table des Administrateurs (pour la connexion)
CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(50) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'editeur') DEFAULT 'editeur',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion de l'administrateur initial (mot de passe en clair : 'handonheart')
INSERT INTO utilisateurs (nom_utilisateur, mot_de_passe, role) 
VALUES 
('ong', 'handonheart', 'admin'); 


-- 2. Table des Événements
CREATE TABLE IF NOT EXISTS evenements (
    id_evenement INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    date_evenement DATE NOT NULL,
    heure_evenement TIME,
    lieu VARCHAR(255),
    image_url VARCHAR(255),
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);


-- 3. Table des Blogs (Articles)
CREATE TABLE IF NOT EXISTS blogs (
    id_blog INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT,
    image_url VARCHAR(255),
    date_publication TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id)
);