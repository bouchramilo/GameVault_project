<?php

require_once 'dataBase.Class.php';

class Game extends Database
{

    private int $id_game;
    private string $title;
    private string $genre;
    private string $details;
    private string $releaseDate;
    private float $averageScore;
    private string $screenshots;


    public function addGame() {}
    public function deleteGame() {}
    public function getDetails() {}
    public function updateGame() {}
    public function updateStatus() {}

    // fonction qui retourne toutes les game dans la base de données : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getAllGame(){
        $sql = "SELECT 
                    g.*, 
                    AVG(n.note) AS average_note, 
                    CONCAT(p.first_name, ' ', p.last_name) AS nom_admin 
                FROM 
                    game g
                LEFT JOIN 
                    notation n ON g.id_game = n.id_game
                LEFT JOIN 
                    personne p ON g.id_admin = p.id_user
                GROUP BY 
                    g.id_game, g.title, g.genre, g.id_admin, g.details, g.releaseDate, g.screenshots, g.averageScore, 
                    p.first_name, p.last_name;
                ";
        $pdo = $this->getConnextion();

        $query = $pdo->query($sql);
        return $query->fetchAll();
    }
}
