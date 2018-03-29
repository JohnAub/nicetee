<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Panier
{

    public function __construct()
    {
        if (!isset($_SESSION)){

        }
        if (!($session->has('panier')))
        {
            $this->session->set('panier', array());
        }
    }





}