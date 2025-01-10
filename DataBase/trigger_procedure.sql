

show tables ;

-- pour afficher les tables : 
call AfficherTables();

-- sypprimer les tables :

call supprimerTables();



-- procedure pour afficher les données de toutes les tables : 

DELIMITER $$

CREATE PROCEDURE AfficherTables()
BEGIN
    SELECT * FROM personne;

    SELECT * FROM game;

    SELECT * FROM library;

    SELECT * FROM critique;

    SELECT * FROM notation;

    SELECT * FROM chat;

    SELECT * FROM historique;
END$$

DELIMITER ;

call AfficherTables();






-- procedure pour la suppression des tables : 

DELIMITER $$

CREATE PROCEDURE supprimerTables()
BEGIN

   DROP TABLE favoris;

   DROP TABLE historique;

   DROP TABLE chat;

   DROP TABLE notation;

   DROP TABLE critique;

   DROP TABLE library;

   DROP TABLE game;

   DROP TABLE personne;
END$$

DELIMITER ;


-- drop procedure supprimerTables;

call supprimerTables();

