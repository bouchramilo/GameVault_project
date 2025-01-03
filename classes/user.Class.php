<?php

require_once 'dataBase.Class.php';
require_once 'personne.Class.php';

class User extends Personne {
    
    private bool $banner;

    public function __construct(bool $banner) {
        $this->banner = $banner;
    }
}