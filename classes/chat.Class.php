<?php

require_once 'dataBase.Class.php';


class Chat extends dataBase
{

    private int $id_chat;
    private int $id_game;
    private int $id_user;
    private string $message;


    public function getMessage(){}
    public function sendMessage(){}
}
