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

    // fonction pour ajouter un game à la bibliothèque d'un user +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function updateTimeGame($id_libra, $newtime)
    {
        $pdo = $this->getConnextion();
        try {

            $sql = "UPDATE library SET playTime = :newtime WHERE id_lib = :id_lib";
            // $pdo->query($sql);
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':newtime', $newtime);
            $stmt->bindParam(':id_lib', $id_libra);
            $stmt->execute();
            return "Le   time game a été modifier avec succès.";
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }


    // fonction pour ajouter un game à la bibliothèque d'un user +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function updateStatusGame($id_libra, $newStatus)
    {
        $pdo = $this->getConnextion();
        try {

            $sql = "UPDATE library SET status = :newStatus WHERE id_lib = :id_lib";
            // $pdo->query($sql);
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':newStatus', $newStatus);
            $stmt->bindParam(':id_lib', $id_libra);
            $stmt->execute();
            return "Le  status game a été modifier avec succès.";
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    // fonction pour ajouter un game à la bibliothèque d'un user +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function updateNoteGame($id_jeu, $newNote)
    {
        $pdo = $this->getConnextion(); // Assurez-vous que cette méthode est correctement définie dans votre classe.
        try {
            $sqlSelect = "SELECT COUNT(*) as count FROM notation WHERE id_game = :id_game AND id_user = :id_user";
            $stmtSelect = $pdo->prepare($sqlSelect);
            $stmtSelect->execute([
                ':id_game' => $id_jeu,
                ':id_user' => $_SESSION['ID_user']
            ]);
            $result = $stmtSelect->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] > 0) {
                $sqlUpdate = "UPDATE notation SET note = :newNote WHERE id_game = :id_game AND id_user = :id_user";
                $stmtUpdate = $pdo->prepare($sqlUpdate);
                $stmtUpdate->execute([
                    ':newNote' => $newNote,
                    ':id_game' => $id_jeu,
                    ':id_user' => $_SESSION['ID_user']
                ]);
                return "La notation du jeu a été mise à jour avec succès.";
            } else {
                $sqlInsert = "INSERT INTO notation (id_user, id_game, note) VALUES (:id_user, :id_game, :note)";
                $stmtInsert = $pdo->prepare($sqlInsert);
                $stmtInsert->execute([
                    ':id_user' => $_SESSION['ID_user'],
                    ':id_game' => $id_jeu,
                    ':note' => $newNote
                ]);
                return "Une nouvelle notation a été ajoutée avec succès.";
            }
        } catch (PDOException $e) {
            return "Erreur lors de la mise à jour ou de l'insertion : " . $e->getMessage();
        }
    }


    // fonction pour ajouter un game à la bibliothèque d'un user +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function addGameToLibrary($id_jeu)
    {

        $pdo = $this->getConnextion();

        try {
            $sqlSelet = "SELECT * FROM library WHERE id_user = :id_user AND id_game = :id_game";
            $stmtSelect = $pdo->prepare($sqlSelet);
            $stmtSelect->bindParam(':id_user', $_SESSION['ID_user']);
            $stmtSelect->bindParam(':id_game', $id_jeu);
            $stmtSelect->execute();

            if ($stmtSelect->rowCount() > 0) {
                return "Le game est déjà dans votre bibliothèque.";
            }

            $sqlInsert = "INSERT INTO library (id_user, id_game, status) VALUES (:id_user, :id_game, 'En cours')";
            $stmtInsert = $pdo->prepare($sqlInsert);
            $stmtInsert->bindParam(':id_user', $_SESSION['ID_user']);
            $stmtInsert->bindParam(':id_game', $id_jeu);
            $stmtInsert->execute();

            return "Le game a été ajouté à votre bibliothèque avec succès.";
        } catch (PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }


    // fonction qui retourn toutes les game d'un bibliothèque d'un user +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getMyLibrary()
    {
        try {
            $sql = "SELECT 
                    lb.id_lib, 
                    lb.id_user, 
                    lb.id_game, 
                    lb.status, 
                    lb.playTime,
                    g.id_game AS game_id, 
                    g.title AS game_title, 
                    g.genre AS game_genre, 
                    lb.playTime AS Time_jouer,
                    g.releaseDate AS game_release_date, 
                    g.averageScore AS game_average_score,
                    CONCAT(p.first_name, ' ', p.last_name) AS admin_full_name,
                    f.id_favoris AS favoris_id, 
                    n.note AS note
                FROM 
                    library lb
                LEFT JOIN 
                    game g ON lb.id_game = g.id_game
                LEFT JOIN 
                    personne p ON g.id_admin = p.id_user
                LEFT JOIN 
                    favoris f ON lb.id_game = f.id_game AND lb.id_user = f.id_user
                LEFT JOIN 
                    notation n ON lb.id_game = n.id_game AND lb.id_user = n.id_user
                WHERE 
                    lb.id_user = :id_user;";


            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);

            $stmt->execute(['id_user' => $_SESSION['ID_user']]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Erreur lors de la récupération de la bibliothèque : " . $e->getMessage();
        }
    }


    // fonction qui supprimer un game from la bibliotheque d'un user +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function deleteFromMyLibrary($id_biblio)
    {
        try {
            $sql = "DELETE FROM library WHERE id_lib = :id_biblio;";
            $pdo = $this->getConnextion();
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id_biblio' => $id_biblio]);

            if ($stmt->rowCount() > 0) {
                header('Location: myLibrary.php');
            }
        } catch (Exception $e) {
            return "Erreur lors de la suppression from bibliotheque : " . $e->getMessage();
        }
    }
}
