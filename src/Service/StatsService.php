<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class StatsService{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getUsersCount(){
        return $this->manager->createQuery('SELECT COUNT(u) FROM App\Entity\User u')->getSingleScalarResult();
    }

    public function getSaleCarsCount()
    {
        return $this->manager->createQuery('SELECT COUNT(a) FROM App\Entity\SaleCars a')->getSingleScalarResult();
    }


}