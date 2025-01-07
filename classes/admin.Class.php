
<?php

require_once 'dataBase.Class.php';
require_once 'personne.Class.php';


class Admin extends Personne {
    
    public function updateRole($id_user, $role) {
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


    public function updateBanner($id_user, $banner) {
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
    
    public function deleteUser($id_user) {
        
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
    
    public function getUsers() {
        $query = "SELECT id_user, email, first_name, last_name, create_at, role,banner FROM personne";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function addGame($title,$genre,$details,$price,$photo) {
        $query = "INSERT INTO game(title,genre,id_admin,details,price,photo) values (:title,:genre,:id_admin,:details,:price,:photo)";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':genre', $genre);
        $stmt->bindParam(':id_admin', $_SESSION['ID_user']);
        $stmt->bindParam(':details', $details);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':photo', $photo);

        if ($stmt->execute()) {
            header("Location: gererGame.php"); 

            exit();
        } else {
            echo "Erreur lors de creation de game !";
        }
    }   
    public function afficherGames(){
        $query = "SELECT id_game,title,genre,id_admin,details,releaseDate,photo,price FROM game";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteGame($id_game){
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



    public function detailsGame($id_game){
        $query = "SELECT id_game,title,genre,id_admin,details,releaseDate,photo,price FROM game where id_game=:id_game";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_game', $id_game);
        
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }
    
    
    
    public function moderateContent(){}
}
