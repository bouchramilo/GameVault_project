
<?php

require_once 'dataBase.Class.php';
require_once 'personne.Class.php';


class Admin extends Personne
{

    // updateRole +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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

    // updateBanner +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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

    // deleteUser +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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

    // getUsers +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getUsers()
    {
        $query = "SELECT id_user, email, first_name, last_name, create_at, role,banner FROM personne";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // addGame +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function addGame($title, $genre, $details, $price, $photo, $time)
    {
        $query = "INSERT INTO game(title,genre,id_admin,details,price,photo,time_play) values (:title,:genre,:id_admin,:details,:price,:photo,:timeJeu)";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':timeJeu', $time);

        if ($stmt->execute()) {
            header("Location: gererGame.php");

            exit();
        } else {
            echo "Erreur lors de creation de game !";
        }
    }

    // afficherGames +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function afficherGames()
    {
        $query = "SELECT game.id_game,game.title,game.time_play,game.genre,game.details,game.releaseDate,game.photo,game.price,game.id_admin,personne.first_name,personne.last_name FROM game INNER JOIN personne ON game.id_admin=personne.id_user";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // deleteGame +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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



    // detailsGame +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function detailsGame($id_game)
    {
        $query = "SELECT game.id_game,game.title,game.genre,game.details,game.releaseDate,game.photo,game.price,game.id_admin,personne.first_name,personne.last_name FROM game INNER JOIN personne ON game.id_admin=personne.id_user where game.id_game=:id_game";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_game', $id_game);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // updateGame +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function updateGame($id_game, $title, $details, $price, $genre, $photo, $time)
    {
        $query = "UPDATE game SET title = :title, details=:details , price=:price ,genre=:genre,photo=:photo, time_play=:timeJeu WHERE id_game = :id_game";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_game', $id_game);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':timeJeu', $time);

        if ($stmt->execute()) {
            header("Location: gererGame.php");
            exit();
        } else {
            echo "Erreur  update game !";
        }
    }

    /*****************************************************************/
}
