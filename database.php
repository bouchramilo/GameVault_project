
<!-- had le fichier khaso ythayd hit rah ktabt le code dyalo f classes -->

<!-- <?php
class database{
    private $connexion;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'gamevault_db';
        $username = 'root';
        $password = '';

        try {
            $this->connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // ************signup*******
    public function sign_up($photo, $fname, $lname, $bdate, $email, $pass, $cpass) {
        if ($pass !== $cpass) {
            return ["error" => "Les mots de passe ne sont pas identiques !"];
        }
    
        try {
            $hashedPass = password_hash($pass, PASSWORD_BCRYPT);
    
            $sql = "INSERT INTO personne (email, password_hash, first_name, last_name, date_naissance, photo) 
                    VALUES (:email, :hashedPass, :fname, :lname, :bdate, :photo)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hashedPass', $hashedPass);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':bdate', $bdate);
            $stmt->bindParam(':photo', $photo);
    
            $stmt->execute();
    
            return ["success" => "Inscription réussie !"];
        } catch (PDOException $e) {
            return ["error" => "Erreur lors de l'inscription : " . $e->getMessage()];
        }
    }

    // ************login*******
    public function login($email, $password) {
        session_start(); 
    
        try {
            $sql = "SELECT * FROM personne WHERE email = :email";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['email'] = $user['email'];
    
                header("Location: index.php");
                exit;
            } else {
                return ["error" => "Email ou mot de passe incorrect !"];
            }
        } catch (PDOException $e) {
            return ["error" => "Une erreur s'est produite : " . htmlspecialchars($e->getMessage())];
        }
    }
    
    
}
?> -->