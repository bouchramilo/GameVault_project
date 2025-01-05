<?php

require_once 'dataBase.Class.php';


class favoris extends dataBase
{
    
    private int $id_favoris;
    private int $id_user;
    private int $id_game;

    // fonction qui afficher toutes les favoris d'un user : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function showAllMesFavoris(){
        try {
            $sql = "SELECT f.id_favoris, f.id_game, f.id_user, g.title, g.genre, n.note FROM favoris f
             LEFT JOIN game g ON f.id_game = g.id_game
             LEFT JOIN notation n ON f.id_game = n.id_game
             WHERE f.id_user = :id_user;";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_user' => $_SESSION['ID_user']]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erreur lors de la récupération des favoris : " . $e->getMessage();
        }
    }
    
    // fonction qui supprimer from mes favoris : ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function deleteFromMesFavoris($id_favor) {
        try {
            $sql = "DELETE FROM favoris WHERE id_favoris = :id_favor;";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_favor' => $id_favor]);
    
            // if ($stmt->rowCount() > 0) {
            //     header('Location: mesFavoris.php');
            // }

            return $stmt->rowCount() ;
        } catch (Exception $e) {
            return "Erreur lors de la suppression from favoris : " . $e->getMessage();
        }
    }
    
    
    
    public function addToMesFavoris($id_game){
        try {
            $sql = "INSERT INTO favoris (id_user, id_game) VALUES (:id_user, :id_game);";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id_user' => $_SESSION['ID_user'],
                'id_game' => $id_game
            ]);
            return $stmt->rowCount() ;
        }
        catch(Exception $e){
            return "Erreur lors de l'ajout from favoris : " . $e->getMessage();
        }

    }
    public function nbrFavorisForGame(){}
}