<?php

require_once 'dataBase.Class.php';
require_once 'personne.Class.php';

class Admin extends Personne
{

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function updateRole($id_user, $role)
    {
        $query = "UPDATE personne SET role = :role WHERE id_user = :id_user";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id_user', $id_user);

        if ($stmt->execute()) {
            header("Location: gererUser.php");
            exit();
        } else {
            echo "Erreur  update role!";
        }
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function updateBanner($id_user, $banner)
    {
        $query = "UPDATE personne SET banner = :banner WHERE id_user = :id_user";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':banner', $banner);
        $stmt->bindParam(':id_user', $id_user);
        if ($stmt->execute()) {
            header("Location: gererUser.php");
            exit();
        } else {
            echo "Erreur  update bannissement!";
        }
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function deleteUser($id_user)
    {
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare("DELETE FROM personne WHERE id_user = :id_user");
        $stmt->bindParam(':id_user', $id_user);
        if ($stmt->execute()) {
            echo "Suppression bien effectue";
        } else {
            echo "Erreur delete user !";
        }
        header('Location: gererUser.php');
        exit();
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getUsers()
    {
        $query = "SELECT id_user, email, first_name, last_name, create_at, role,banner FROM personne";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function addGame($title, $genre, $details, $price, $time, $photo, $mimi)
    {
        $query = "INSERT INTO game(title,genre,id_admin,details,price,time_play,photo,mimi) values (:title,:genre,:id_admin,:details,:price,:time_play,:photo,:mimi)";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':mimi', $mimi);
        $stmt->bindParam(':time_play', $time);

        if ($stmt->execute()) {
            header("Location: gererGame.php");

            exit();
        } else {
            echo "Erreur lors de creation de game !";
        }
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function afficherGames()
    {
        $query = "SELECT game.id_game,
            game.title,
            game.genre,
            game.details,
            game.releaseDate,
            game.photo,
            game.mimi,
            game.time_play,
            game.price,
            game.id_admin,
            personne.first_name,
            personne.last_name 
        FROM game 
        INNER JOIN personne ON game.id_admin=personne.id_user 
        where game.id_admin=:id_admin";

        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function deleteGame($id_game)
    {
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare("DELETE FROM game WHERE id_game = :id_game");
        $stmt->bindParam(':id_game', $id_game);

        if ($stmt->execute()) {
            echo "Suppression bien effectue";
        } else {
            echo "Erreur delete user !";
        }
        header('Location: gererGame.php');
        exit();
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function detailsGame($id_game)
    {
        $query = "SELECT game.id_game,
            game.title,
            game.genre,
            game.details,
            game.releaseDate,
            game.photo,
            game.mimi,
            game.price,
            game.id_admin,
            personne.first_name,
            personne.last_name 
        FROM game 
        INNER JOIN personne ON game.id_admin=personne.id_user 
        where game.id_game=:id_game";

        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_game', $id_game);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function updateGame($id_game, $title, $details, $time_p_modif, $price, $genre, $photo, $mimi)
    {
        $query = "UPDATE game SET title = :title, 
        details=:details , 
        time_play=:time_p_modif , 
        price=:price,
        genre=:genre, 
        photo=:photo , 
        mimi=:mimi 
        WHERE id_game = :id_game";

        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_game', $id_game);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':time_p_modif', $time_p_modif);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':mimi', $mimi);

        if ($stmt->execute()) {
            header("Location: gererGame.php");
            exit();
        } else {
            echo "Erreur  update game !";
        }
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function allgames()
    {
        $query = "SELECT COUNT(*) AS allgames FROM game where id_admin=:id_admin";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['allgames'];
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function allusers()
    {
        $query = "SELECT COUNT(*) AS allusers FROM personne WHERE role = 'user'";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['allusers'];
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function allfavoris()
    {
        $query = "SELECT COUNT(*) AS allfavoris FROM favoris INNER JOIN game ON favoris.id_game=game.id_game where game.id_admin=:id_admin";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['allfavoris'];
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function allfavorisbygame()
    {
        $query = "SELECT COUNT(*) AS allfavoris FROM favoris INNER JOIN game ON favoris.id_game=game.id_game where game.id_admin=:id_admin GROUP BY favoris.id_game";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['allfavoris'];
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function allbib()
    {
        $query = "SELECT COUNT(*) AS allbib FROM library INNER JOIN game ON library.id_game=game.id_game where game.id_admin=:id_admin";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['allbib'];
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function allencours()
    {
        $query = "SELECT COUNT(*) AS allencours FROM library INNER JOIN game ON library.id_game=game.id_game WHERE game.id_admin=:id_admin AND library.status='En cours'";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['allencours'];
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function allabandonne()
    {
        $query = "SELECT COUNT(*) AS allabandonne FROM library INNER JOIN game ON library.id_game=game.id_game WHERE game.id_admin=:id_admin AND library.status='Abandonné'";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['allabandonne'];
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function alltermine()
    {
        $query = "SELECT COUNT(*) AS alltermine FROM library INNER JOIN game ON library.id_game=game.id_game WHERE game.id_admin=:id_admin AND library.status='Terminé'";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['alltermine'];
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function addScreenshot($id_game, $descri, $photo, $mimi)
    {
        $query = "INSERT INTO screenshorts (id_game,descri,photo,mimi) values (:id_game,:descri,:photo,:mimi)";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_game', $id_game);
        $stmt->bindParam(':descri', $descri);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':mimi', $mimi);
        if ($stmt->execute()) {
            header("Location: details_game.php?id_game=$id_game");

            exit();
        } else {
            echo "Erreur lors d ajout de screen !";
        }
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function afficherScreenshot($id_game)
    {
        $query = "SELECT * from screenshorts where id_game=:id_game";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_game', $id_game);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    /*****************************************************************/
}
