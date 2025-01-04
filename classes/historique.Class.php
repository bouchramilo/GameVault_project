<?php
require_once 'classes/dataBase.Class.php';


class Historique extends Database
{

    private int $id_history;
    private int $id_user;
    private int $id_game;


    // fonction qui retourner toutes les historique d'un utilisateur : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function consulter()
    {
        try {
            $sql = "SELECT * FROM historique WHERE id_user = :id_user;";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_user' => $_SESSION['ID_user']]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erreur lors de la récupération de l'historique : " . $e->getMessage();
        }
    }
}
