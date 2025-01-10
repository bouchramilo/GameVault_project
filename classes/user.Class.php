<?php

require_once 'dataBase.Class.php';
require_once 'personne.Class.php';

class User extends Personne
{

    private bool $banner;

    // isBanner : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function isBanner($id_user)
    {
        $pdo = $this->getConnextion();
        $sql = "SELECT banner FROM personne WHERE id_user = :id_user";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        $isbanner = $stmt->fetch(PDO::FETCH_ASSOC);
        return $isbanner;
    }

    // getStatistique : +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getStatistique()
    {
        try {
            $pdo = $this->getConnextion();

            // pour all Game d"un user
            $sqlLib = "SELECT COUNT(*) AS totalGames FROM library WHERE id_user = :id_user";
            $stmtLib = $pdo->prepare($sqlLib);
            $stmtLib->execute(['id_user' => $_SESSION['ID_user']]);
            $totalGames = $stmtLib->fetch(PDO::FETCH_ASSOC)['totalGames'];

            // pour all favoris d"un user
            $sqlFav = "SELECT COUNT(*) AS totalFavorites FROM favoris WHERE id_user = :id_user";
            $stmtFav = $pdo->prepare($sqlFav);
            $stmtFav->execute(['id_user' => $_SESSION['ID_user']]);
            $totalFavorites = $stmtFav->fetch(PDO::FETCH_ASSOC)['totalFavorites'];

            // pour all notation d"un user
            $sqlNotation = "SELECT COUNT(*) AS totalNota FROM notation WHERE id_user = :id_user";
            $stmtNotation = $pdo->prepare($sqlNotation);
            $stmtNotation->execute(['id_user' => $_SESSION['ID_user']]);
            $totalNota = $stmtNotation->fetch(PDO::FETCH_ASSOC)['totalNota'];

            // pour sum time d"un user
            $sqlTime = "SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(playTime))) AS totalPlayTime FROM library WHERE id_user = :id_user";
            $stmtTime = $pdo->prepare($sqlTime);
            $stmtTime->execute(['id_user' => $_SESSION['ID_user']]);
            $totalPlayTime = $stmtTime->fetch(PDO::FETCH_ASSOC)['totalPlayTime'] ?? 0;

            return [
                'totalGames' => $totalGames,
                'totalFavorites' => $totalFavorites,
                'totalNota' => $totalNota,
                'totalPlayTime' => $totalPlayTime
            ];
        } catch (Exception $e) {
            return "Erreur lors de la récupération des statistiques : " . $e->getMessage();
        }
    }
}
