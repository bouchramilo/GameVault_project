


-- pour afficher les tables : 
call AfficherTables();

-- sypprimer les tables :

call supprimerTables();

























-- trigger qui vérifier si l'insertion est le premier dans la table personne : si oui, le personne doit inserer comme un admin, sinon, le personne inserer comme les données de formulaire : 
DELIMITER $$

CREATE TRIGGER before_insert_personne
BEFORE INSERT ON personne
FOR EACH ROW
BEGIN
    IF (SELECT COUNT(*) FROM personne) = 0 THEN
        SET NEW.role = 'admin';
    END IF;
END$$

DELIMITER ;




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

   DROP TABLE historique;

   DROP TABLE chat;

   DROP TABLE notation;

   DROP TABLE critique;

   DROP TABLE library;

   DROP TABLE game;

   DROP TABLE personne;
END$$

DELIMITER ;



call supprimerTables();