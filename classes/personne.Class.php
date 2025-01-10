<?php

require_once 'dataBase.Class.php';

class Personne extends Database
{

    protected int $id_user;
    protected string $first_name;
    protected string $last_name;
    protected string $email;
    protected string $photo;
    protected DateTime $date_naissance;
    protected DateTime $create_at;

    // fonction de validation des données (les entrées de form de signup) : ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function valideDonnees($first_name, $last_name, $bdate, $email, $pass, $cpass)
    {
        if (empty($first_name) || empty($last_name) || empty($email) || empty($pass) || empty($cpass) || empty($bdate)) {
            return "Erreur : Les champs ne peuvent pas être vides.";
        }

        if (!preg_match('/^[a-zA-Z\s]+$/', $first_name) || !preg_match('/^[a-zA-Z\s]+$/', $last_name)) {
            return "Erreur : Les champs prénom et nom ne doivent contenir que des lettres.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'L\'email n\'est pas valide!!!';
        }

        if (!preg_match("/^[a-zA-Z0-9$*-+*.&#:?!;,]{8,}$/", $pass)) {
            return 'Le mot de passe doit contenir au moins 8 caractères, avec des lettres et des chiffres.';
        }

        if ($pass !== $cpass) {
            return 'Les mots de passe ne correspondent pas.';
        }

        return true;
    }

    // fonction de signup : ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function register($photo, $first_name, $last_name, $bdate, $email, $pass, $cpass,$mimi)
    {
        $validationResult = $this->valideDonnees($first_name, $last_name, $bdate, $email, $pass, $cpass);
        if ($validationResult !== true) {
            return $validationResult;
        }

        // insertion des utilisateurs : 
        try {

            $pass_hash = password_hash($pass, PASSWORD_BCRYPT);

            $sql = "INSERT INTO personne (first_name, last_name, email, date_naissance, password_hash, photo, mimi ) VALUES (:first_name, :last_name, :email, :bdate, :pass, :photo , :mimi)";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'bdate' => $bdate,
                'pass' => $pass_hash,
                'photo' => $photo,
                'mimi' => $mimi
            ]);
        } catch (Exception $e) {
            die("erreur lors de l'insertion des données de new user !!!");
        }

        header('Location: login.php');
    }

    // fonction de login : ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM personne WHERE email = :email";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                session_start();
                $_SESSION['ID_user'] = $user['id_user'];
                header('Location: home.php');
                exit;
            } else {
                return "Email ou mot de passe incorrect.";
            }
        } catch (Exception $e) {
            return "Erreur lors de login : " . $e->getMessage();
        }
    }

    // fonction de logout : ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function logout()
    {
        try {
            unset($_SESSION['ID_user']);
            session_unset();
            session_destroy();
            header("Location: home.php");
            exit();
        } catch (Exception $e) {
            return "Erreur lors de logout : " . $e->getMessage();
        }
    }

    // fonction qui retourne le role d'un user (admin/user) : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getRole()
    {
        try {
            $sql = "SELECT role FROM personne WHERE id_user = :id_user";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_user' => $_SESSION['ID_user']]);
            $role = $stmt->fetch(PDO::FETCH_ASSOC);
            return $role['role'];
        } catch (Exception $e) {
            return "Erreur lors de récupération du role : " . $e->getMessage();
        }
    }
    
    // fonction qui retourne le nom de user (admin/user) : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getNameP()
    {
        try {
            $sql = "SELECT CONCAT(first_name, ' ' , last_name) AS full_name FROM personne WHERE id_user = :id_user";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_user' => $_SESSION['ID_user']]);
            $name = $stmt->fetch(PDO::FETCH_ASSOC);
            return $name['full_name'];
        } catch (Exception $e) {
            return "Erreur lors de récupération du full_name : " . $e->getMessage();
        }
    }
    
    // fonction qui retourne photo de user (admin/user) : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getPhoto()
    {
        try {
            $sql = "SELECT photo FROM personne WHERE id_user = :id_user";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_user' => $_SESSION['ID_user']]);
            $photo = $stmt->fetch(PDO::FETCH_ASSOC);
            return $photo['photo'];
        } catch (Exception $e) {
            return "Erreur lors de récupération du photo : " . $e->getMessage();
        }
    }


    // fonction qui retourne user infos_______ : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getUser() {
        $query = "SELECT id_user, first_name, last_name, email, create_at, date_naissance,photo,mimi FROM personne WHERE id_user = :id_user";
        $pdo = $this->getConnextion();
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id_user', $_SESSION['ID_user']);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    // 
    
    public function updateUser($first_name, $last_name, $email, $date_naissance) {
        try {
            $query = "UPDATE personne SET first_name = :first_name, last_name = :last_name, email = :email, date_naissance = :date_naissance WHERE id_user = :id_user";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':date_naissance', $date_naissance);
            $stmt->bindParam(':id_user', $_SESSION['ID_user']);

            if ($stmt->execute()) {
                return "Les informations de user ont ete mises a jour avec succes";
            } else {
                return "Erreur !";
            }
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
    
    public function updatephoto($photo,$mimi) {
        $query = "UPDATE personne SET photo = :photo, mimi=:mimi where id_user=:id_user ";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $_SESSION['ID_user']);
        $stmt->bindParam(':photo', $photo);
        $stmt->bindParam(':mimi', $mimi);
        if ($stmt->execute()) {
            header("Location: profil.php"); 
            exit();
        } else {
            echo "Erreur  update game !";
        }
        
    
    }

    public function deleteProfile() {}
    // public function addFavorite() {}
    // public function addGameToLib() {}
    // public function addNote() {}
    // public function deleteGameFromLib() {}
    // public function showStatistique() {}
    // public function discuter() {}
    // public function getHistory() {}
}
