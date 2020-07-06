<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ActorsRepository extends EntityRepository
{
    public function filterStatus($status)
    {

        $dql = "SELECT a 
                FROM App\Entity\Actors a
                WHERE a.statusActors=:statusActors";

        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('statusActors', $status);

        return $query->getArrayResult();
    }
}
