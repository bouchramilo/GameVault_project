<?php

require_once 'dataBase.Class.php';


class Critique extends dataBase
{

    private int $id_critique;
    private int $id_user;
    private int $id_game;
    private string $content;
    private DateTime $create_at;


    public function addCritique(){}
    public function deleteCritique(){}
    public function getCritiqueById(){}
    public function updateCritique(){}
}
