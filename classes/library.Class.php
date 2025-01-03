<?php

require_once 'dataBase.Class.php';


class library extends dataBase
{

    private int $id_lib;
    private int $id_user;
    private int $id_game;
    private bool $isFavorite;
    private string $personalNote;
    private string $status;
    private DateTime $playTime;


    public function ajouter() {}
    public function content() {}

    // fonction qui retourn toutes les game d'un bibliothèque d'un user +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getMyLibrary($id_user)
    {
        $sql = "select * from library lb 
                left JOIN game g on lb.id_game = g.id_game
                left JOIN notation n on g.id_game = n.id_game
                left join personne p on g.id_admin = p.id_user
                left join favoris f on g.id_game = f.id_game
                where lb.id_user = :id_user ;
        ";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($sql);
        $stmt->bindparam(":id_user", $id_user);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}
