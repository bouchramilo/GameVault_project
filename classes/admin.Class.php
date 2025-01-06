
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
        $query = "SELECT id_user, email, first_name, last_name, create_at, role FROM personne";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function bannerUser(){}
    public function moderateContent(){}
}
