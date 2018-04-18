<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Endroid\Pdf\Builder\PdfBuilder;


class Pdf
{
    private $pdfBuilder;

    public function __construct(PdfBuilder $pdfBuilder)
    {
        $this->pdfBuilder =  $pdfBuilder;
    }
}
