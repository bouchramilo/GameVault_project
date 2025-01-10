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

    // fonction qui retourne toutes les game dans la base de données : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getAllGame()
    {
        $sql = "SELECT 
                    g.*, 
                    DATE_FORMAT(g.releaseDate, '%d/%m/%Y') AS releaseDate , 
                    AVG(n.note) AS average_note, 
                    CONCAT(p.first_name, ' ', p.last_name) AS nom_admin,
                    COUNT(f.id_favoris) AS Nbr_Favoris_total
                FROM 
                    game g
                LEFT JOIN 
                    notation n ON g.id_game = n.id_game
                LEFT JOIN 
                    personne p ON g.id_admin = p.id_user
                LEFT JOIN 
                    favoris f ON g.id_game = f.id_game
                GROUP BY 
                    g.id_game, 
                    p.first_name, 
                    p.last_name
                ";
        $pdo = $this->getConnextion();

        $query = $pdo->query($sql);
        return $query->fetchAll();
    }

    public function addGame() {
        // dans la class admin 
    }
    public function deleteGame() {
        // dans la class admin 
    }
    public function getDetails() {
        // dans la class admin 
    }
    public function updateGame() {
        // dans la class admin 
    }
}
