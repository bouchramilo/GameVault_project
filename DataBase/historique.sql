-- le trigger d'ajout dans la table historique :++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-- drop trigger insert_into_biblio;

DELIMITER $$

CREATE TRIGGER insert_into_biblio
AFTER INSERT ON library
FOR EACH ROW
BEGIN
    DECLARE id_jeu INT ;
    DECLARE titre_game VARCHAR(100);
    SELECT g.title INTO titre_game from game g WHERE g.id_game = NEW.id_game ;
    INSERT INTO historique (id_user, action) VALUES (NEW.id_user, CONCAT("Vous avez ajoutez le game '",titre_game,"' dans votre library ."));
END$$

DELIMITER;


-- drop trigger insert_into_biblio;

-- le trigger de suppression dans la table historique : ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

DELIMITER $$

CREATE TRIGGER delete_from_biblio
AFTER DELETE ON library
FOR EACH ROW
BEGIN
    DECLARE titre_game VARCHAR(100);
    SELECT g.title INTO titre_game from game g WHERE g.id_game = OLD.id_game ;
INSERT INTO historique (id_user, action) VALUES (OLD.id_user, CONCAT("Vous avez supprimer le game '",titre_game,"' dans votre library ."));
END$$

DELIMITER;

-- drop trigger delete_from_biblio;


-- le trigger lors add des notation ou bien favoris dans la table historique :++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
DELIMITER $$

CREATE TRIGGER after_insert_notation
AFTER INSERT ON notation
FOR EACH ROW
BEGIN
    DECLARE titre_game VARCHAR(100);
    SELECT g.title INTO titre_game FROM game g WHERE g.id_game = NEW.id_game;
    INSERT INTO historique (id_user, action) 
    VALUES (NEW.id_user, CONCAT("Vous avez ajouté une notation pour le jeu '", titre_game, "'."));
END$$

DELIMITER ;


-- drop trigger after_insert_notation;


-- le trigger lors add des notation ou bien favoris dans la table historique :++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
DELIMITER $$

CREATE TRIGGER after_update_notation
AFTER UPDATE ON notation
FOR EACH ROW
BEGIN
    DECLARE titre_game VARCHAR(100);
    SELECT g.title INTO titre_game FROM game g WHERE g.id_game = NEW.id_game;
    INSERT INTO historique (id_user, action) 
    VALUES (NEW.id_user, CONCAT("Vous avez modifié la notation pour le jeu '", titre_game, "'."));
END$$

DELIMITER ;
-- drop trigger after_update_notation;


-- le trigger lors add un game à les favoris : ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
DELIMITER $$

CREATE TRIGGER insert_into_favoris
AFTER INSERT ON favoris
FOR EACH ROW
BEGIN
    DECLARE titre_game VARCHAR(100);
    SELECT g.title INTO titre_game FROM game g WHERE g.id_game = NEW.id_game;
    INSERT INTO historique (id_user, action) 
    VALUES (NEW.id_user, CONCAT("Vous avez ajouté le game '", titre_game, "' à votre favoris."));
END$$

DELIMITER ;


-- drop trigger insert_into_favoris;

-- le trigger lors delete un game à les favoris : ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

DELIMITER $$

CREATE TRIGGER delete_from_favoris
AFTER DELETE ON favoris
FOR EACH ROW
BEGIN
    DECLARE titre_game VARCHAR(100);
    SELECT g.title INTO titre_game FROM game g WHERE g.id_game = OLD.id_game;
    INSERT INTO historique (id_user, action) 
    VALUES (OLD.id_user, CONCAT("Vous avez retirer le jeu '", titre_game, "' dans votre favoris."));
END$$

DELIMITER ;

-- drop trigger delete_from_favoris;
