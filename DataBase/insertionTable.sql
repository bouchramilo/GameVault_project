-- pour afficher les tables :
call AfficherTables ();

SELECT * FROM personne;

SELECT * FROM game;

SELECT * FROM library;

SELECT * FROM critique;

SELECT * FROM notation;

SELECT * FROM chat;

SELECT * FROM historique;

-- sypprimer les tables :

-- call supprimerTables();

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

INSERT INTO
    personne (
        email,
        password_hash,
        first_name,
        last_name,
        date_naissance,
        role,
        banner
    )
VALUES (
        'admin1@example.com',
        'hash12345',
        'Admin',
        'One',
        '1985-03-15',
        'admin',
        FALSE
    ),
    (
        'user1@example.com',
        'hash67890',
        'User',
        'One',
        '1990-07-22',
        'user',
        FALSE
    ),
    (
        'user2@example.com',
        'hash54321',
        'User',
        'Two',
        '1992-11-08',
        'user',
        TRUE
    ),
    (
        'admin2@example.com',
        'hash98765',
        'Admin',
        'Two',
        '1987-02-25',
        'admin',
        FALSE
    );

INSERT INTO
    game (
        title,
        genre,
        id_admin,
        details,
        releaseDate,
        averageScore
    )
VALUES (
        'The Legend of Zelda',
        'Action-Adventure',
        1,
        'An epic adventure game.',
        '2020-05-15',
        4.8
    ),
    (
        'Mario Kart',
        'Racing',
        1,
        'A fast-paced racing game.',
        '2019-10-12',
        4.5
    ),
    (
        'Minecraft',
        'Sandbox',
        4,
        'A sandbox building game.',
        '2011-11-18',
        4.7
    ),
    (
        'Elden Ring',
        'RPG',
        4,
        'An open-world RPG.',
        '2022-02-25',
        4.9
    );

INSERT INTO
    library (
        id_game,
        id_user,
        personalNote,
        status
    )
VALUES (1, 2, 2, 'Terminé'),
    (2, 2, 5, 'En cours'),
    (3, 3, 1, 'Abandonné'),
    (4, 3, 3, 'En cours');

INSERT INTO
    critique (id_game, id_user, content)
VALUES (
        1,
        2,
        'A timeless masterpiece!'
    ),
    (
        2,
        2,
        'Great fun but could use more maps.'
    ),
    (
        3,
        3,
        'Very creative but sometimes repetitive.'
    ),
    (
        4,
        3,
        'Incredible game design and difficulty.'
    );

INSERT INTO
    notation (id_game, id_user, note)
VALUES (1, 2, 5),
    (2, 2, 4),
    (3, 3, 3),
    (4, 3, 5);

INSERT INTO
    favoris (id_game, id_user)
VALUES (2, 6),
    (1, 6) ;

INSERT INTO
    chat (
        id_user,
        id_game,
        message_chat
    )
VALUES (
        2,
        1,
        'What’s your favorite part of this game?'
    ),
    (
        2,
        2,
        'Looking for players to join a race!'
    ),
    (
        3,
        3,
        'Anyone else building castles?'
    ),
    (
        3,
        4,
        'How do you beat the final boss?'
    );

INSERT INTO
    historique (id_game, id_user, action)
VALUES (1, 6, 'Added to library'),
    (1, 6, 'Marked as favorite');