<?php

namespace App\Entity;




class PaymentPayPal
{
    private $id;

    public function __construct()
    {
        $this->id = array(
            'id' => 'Aaoc-FFd0s5iCusgsq6nFpPCz14z5qHW1G8tX8dZkzpCE0S2h0jF6mSANeOtvSXcU1qEr-B_6FJQoyx6',
            'secret' => 'EOcxRReaShk60FMEHIReX_QA4jcu8tvVFfBdi3Ff7jPBmGgpc8tnwuq3JPwZFJPVrlrl2Q5hphkc54bQ'
        );
    }

    /**
     * @return array
     */
    public function getId()
    {
        return $this->id;
    }
}
