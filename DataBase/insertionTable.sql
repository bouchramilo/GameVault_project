-- pour afficher les tables :
call AfficherTables ();

SELECT * FROM personne;

SELECT * FROM game;

SELECT * FROM library;

SELECT * FROM critique;

SELECT * FROM notation;

SELECT * FROM chat;

SELECT * FROM historique;

SELECT * FROM favoris;

-- sypprimer les tables :

-- call supprimerTables();


SELECT
    lb.id_lib,
    lb.id_user,
    lb.id_game,
    lb.personalNote AS note,
    lb.status,
    lb.playTime,
    g.id_game AS game_id,
    g.title AS game_title,
    g.genre AS game_genre,
    g.releaseDate AS game_release_date,
    g.averageScore AS game_average_score,
    CONCAT(
        p.first_name,
        ' ',
        p.last_name
    ) AS admin_full_name,
    f.id_favoris AS favoris_id
FROM
    library lb
    LEFT JOIN game g ON lb.id_game = g.id_game
    LEFT JOIN personne p ON g.id_admin = p.id_user
    LEFT JOIN favoris f ON lb.id_game = f.id_game
    AND lb.id_user = f.id_user
WHERE
    lb.id_user = 3;

SELECT
    lb.*,
    g.title AS game_title,
    g.genre AS game_genre,
    g.releaseDate AS game_release_date,
    g.averageScore AS game_average_score,
    p.first_name AS admin_first_name,
    p.last_name AS admin_last_name,
    f.id_favoris AS favoris_id,
    n.note AS user_note
FROM
    library lb
    LEFT JOIN game g ON lb.id_game = g.id_game
    LEFT JOIN personne p ON g.id_admin = p.id_user
    LEFT JOIN favoris f ON lb.id_game = f.id_game
    AND lb.id_user = f.id_user
    LEFT JOIN notation n ON lb.id_game = n.id_game
    AND lb.id_user = n.id_user
WHERE
    lb.id_user = 6;

delete from personne where id_user > 0;

SELECT g.*, AVG(n.note) AS average_note, CONCAT(
        p.first_name, ' ', p.last_name
    ) AS nom_admin
FROM
    game g
    LEFT JOIN notation n ON g.id_game = n.id_game
    LEFT JOIN personne p ON g.id_admin = p.id_user
GROUP BY
    g.id_game,
    g.title,
    g.genre,
    g.id_admin,
    g.details,
    g.releaseDate,
    g.screenshots,
    g.averageScore,
    p.first_name,
    p.last_name;

--

select *
from
    library lb
    left JOIN game g on lb.id_game = g.id_game
    left JOIN notation n on g.id_game = n.id_game
    left join personne p on g.id_admin = p.id_user
    left join favoris f on g.id_game = f.id_game
where
    lb.id_user = 2;