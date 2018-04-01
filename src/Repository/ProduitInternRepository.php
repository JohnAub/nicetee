<?php

namespace App\Repository;

use App\Entity\ProduitIntern;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProduitInternRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProduitIntern::class);
    }


    public function findByRandom($value)
    {
        return $this->createQueryBuilder('p')
            ->orderBy('ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findArray($array)
    {
        return $this->createQueryBuilder('p')
            ->Select('p')
            ->Where('p.id IN (:array)')
            ->setParameter('array', $array)
            ->getQuery()
            ->getResult()
        ;
    }

}
