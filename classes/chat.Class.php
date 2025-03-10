<?php

require_once 'dataBase.Class.php';

class Chat extends dataBase
{
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getMessage($id_game)
    {
        $query = "SELECT * FROM chat INNER JOIN personne ON chat.id_user=personne.id_user where chat.id_game=:id_game ORDER BY massage_at asc ";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_game', $id_game);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function sendMessage($id_game, $message_chat)
    {
        $query = "INSERT INTO chat (id_user,id_game,message_chat) values (:id_user,:id_game,:message_chat)";
        $pdo = $this->getConnextion();
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_user', $_SESSION['ID_user']);
        $stmt->bindParam(':id_game', $id_game);
        $stmt->bindParam(':message_chat', $message_chat);
        if ($stmt->execute()) {
            header("Location: details_game_User.php?id_game=$id_game");
            exit();
        } else {
            echo "Erreur de l envoie de msg !";
        }
    }
}
