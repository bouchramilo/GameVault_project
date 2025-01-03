<?php
require_once 'dataBase.Class.php';



class Historique extends Database
{

    private int $id_history;
    private int $id_user;
    private int $id_game;


    // fonction qui retourner toutes les historique d'un utilisateur : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function consulter()
    {
        $sql = "SELECT * FROM historique ;";
        $pdo = $this->getConnextion();

        $query = $pdo->query($sql);
        return $query->fetchAll();
    }
}
