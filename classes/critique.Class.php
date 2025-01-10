<?php

require_once 'dataBase.Class.php';


class Critique extends dataBase
{

    private int $id_critique;
    private int $id_user;
    private int $id_game;
    private string $content;
    private DateTime $create_at;


    public function addCritique($id_game, $content){
        // echo "addCritique addCritique addCritique addCritique addCritique addCritique addCritique addCritique ";
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
    public function getAllCritiquesForGame($id_game){
        $pdo = $this->getConnextion();
        $sql = "SELECT c.*,
                    DATE_FORMAT(c.create_at, '%d/%m/%Y') AS create_at,
                    CONCAT(p.first_name, ' ', p.last_name) AS user_full_name
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
    public function deleteCritique(){}
    public function updateCritique(){}
}
