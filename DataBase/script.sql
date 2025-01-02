-- Active: 1733819346903@@127.0.0.1@3306@gamevault_db


-- création de la base de données : ===============================================================

CREATE DATABASE IF NOT EXISTS GAMEVAULT_DB ;

-- utiliser la base de données : ===============================================================

USE GAMEVAULT_DB ;


-- La création des tables : ====================================================================
-- Table personne :

CREATE TABLE personne (
    id_user INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_naissance TIMESTAMP DEFAULT NULL,
    photo BLOB DEFAULT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    banner BOOLEAN DEFAULT FALSE
);


-- Table game :

CREATE TABLE game (
    id_game INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    genre VARCHAR(100) NOT NULL,
    id_admin INT NOT NULL,
    details VARCHAR(255),
    releaseDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    screenshots LONGBLOB,
    averageScore FLOAT DEFAULT 0,
    FOREIGN KEY (id_admin) REFERENCES personne(id_user) ON DELETE CASCADE
);

-- Table Library :

CREATE TABLE library (
    id_lib INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_game INT NOT NULL,
    id_user INT NOT NULL,
    isFavorite BOOLEAN DEFAULT FALSE,
    personalNote VARCHAR(255),
    playTime TIMESTAMP  DEFAULT CURRENT_TIMESTAMP,
    status ENUM('En cours', 'Terminé', 'Abandonné') NOT NULL,
    FOREIGN KEY (id_game) REFERENCES game(id_game) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES personne(id_user) ON DELETE CASCADE,
    UNIQUE (id_user, id_game)
);

-- Table Critique :

CREATE TABLE critique (
    id_critique INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_game INT NOT NULL,
    id_user INT NOT NULL,
    content VARCHAR(255) NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_game) REFERENCES game(id_game) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES personne(id_user) ON DELETE CASCADE
);


-- Table Notation : 

CREATE TABLE notation (
    id_notation INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_game INT NOT NULL,
    id_user INT NOT NULL,
    note INT DEFAULT 0 CHECK (note >= 0 AND note <= 5),
    FOREIGN KEY (id_game) REFERENCES game(id_game) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES personne(id_user) ON DELETE CASCADE,
    UNIQUE (id_user, id_game)
);


-- Table chat :

CREATE TABLE chat (
    id_chat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    id_game INT NOT NULL,
    message_chat VARCHAR(255),
    massage_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_game) REFERENCES game(id_game) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES personne(id_user) ON DELETE CASCADE
);

-- Table historique : 

CREATE TABLE historique (
    id_historique INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_game INT NOT NULL,
    id_user INT NOT NULL,
    action VARCHAR(255),
    action_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_game) REFERENCES game(id_game) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES personne(id_user) ON DELETE CASCADE
);