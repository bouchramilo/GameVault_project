<?php

require_once 'dataBase.Class.php';


class Notation extends dataBase
{

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getNoteGame($id_jeu)
    {
        $pdo = $this->getConnextion();
        $sql = "SELECT note FROM notation WHERE id_game = :id_jeu;";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_jeu', $id_jeu);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
