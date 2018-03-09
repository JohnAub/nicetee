<?php

namespace App\Entity;


class Panier
{

    public function __construct()
    {
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['panier'])){
            $_SESSION['panier'] = array();
        }
    }

}