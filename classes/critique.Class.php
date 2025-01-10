<?php

require_once 'dataBase.Class.php';


class Critique extends dataBase
{

    private int $id_critique;
    private int $id_user;
    private int $id_game;
    private string $content;
    private DateTime $create_at;

    // nbrCritique ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function nbrCritique($id_game)
    {
        $pdo = $this->getConnextion();
        $sql = "SELECT COUNT(id_game) AS nbrcritique FROM critique WHERE id_game = :id_jeu ;";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_jeu', $id_game);
        $stmt->execute();
        $nbrcritiques = $stmt->fetch();
        return $nbrcritiques;
    }


    // addCritique ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function addCritique($id_game, $content)
    {
        $pdo = $this->getConnextion();
        $sql = "INSERT INTO critique (id_game, id_user, content) VALUES (:id_game, :id_user, :content)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_game', $id_game);
        $stmt->bindParam(':id_user', $_SESSION['ID_user']);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
        $this->id_critique = $pdo->lastInsertId();
        return $this->id_critique;
    }

    // getAllCritiquesForGame ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getAllCritiquesForGame($id_game)
    {
        $pdo = $this->getConnextion();
        $sql = "SELECT c.*,
                    DATE_FORMAT(c.create_at, '%d/%m/%Y') AS create_at,
                    CONCAT(p.first_name, ' ', p.last_name) AS user_full_name,
                    p.photo
                FROM critique c 
                JOIN personne p ON c.id_user = p.id_user
                WHERE c.id_game = :id_game
                ORDER BY c.create_at DESC
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_game', $id_game);
        $stmt->execute();
        $critiques = $stmt->fetchAll();
        return $critiques;
    }

    // deleteCritique ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function deleteCritique($id_critic) {
        // echo "<script>alert('passe');</script>";
        try {
            $sql = "DELETE FROM critique WHERE id_critique = :id_critic;";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_critic' => $id_critic]);
            return $stmt->rowCount() ;

        } catch (Exception $e) {
            return "Erreur lors de la suppression from critique : " . $e->getMessage();
        }
    }

    // deleteCritique ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
}
