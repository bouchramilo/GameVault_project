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
    public function register($photo, $first_name, $last_name, $bdate, $email, $pass, $cpass)
    {
        $validationResult = $this->valideDonnees($first_name, $last_name, $bdate, $email, $pass, $cpass);
        if ($validationResult !== true) {
            return $validationResult;
        }

        // insertion des utilisateurs : 
        try {

            $pass_hash = password_hash($pass, PASSWORD_BCRYPT);

            $sql = "INSERT INTO personne (first_name, last_name, email, date_naissance, password_hash, photo ) VALUES (:first_name, :last_name, :email, :bdate, :pass, :photo)";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'bdate' => $bdate,
                'pass' => $pass_hash,
                'photo' => $photo
            ]);
        } catch (Exception $e) {
            die("erreur lors de l'insertion des données de new user !!!");
        }

        header('Location: login.php');
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM personne WHERE email = :email AND password_hash = :passwd";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'email' => $email,
                'passwd' => $password
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // if ($user) {
            $_SESSION["user_id"] = $user['id_user'];
            // }
            header('Location: home.php');
        } catch (Exception $e) {
            die("Erreur lors de login !!!");
        }
    }

    public function getUser() {}
    public function updateProfile() {}
    public function deleteProfile() {}
    public function addFavorite() {}
    public function addGameToLib() {}
    public function addNote() {}
    public function deleteGameFromLib() {}
    public function showStatistique() {}
    public function discuter() {}
    public function getHistory() {}
}
