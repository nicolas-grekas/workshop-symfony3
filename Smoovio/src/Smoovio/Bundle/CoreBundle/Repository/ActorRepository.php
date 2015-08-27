<?php

namespace Smoovio\Bundle\CoreBundle\Repository;

class ActorRepository extends AbstractRepository
{
    public function findByName($name)
    {
        $results = $this
            ->createQueryBuilder('a')
            ->where('a.name LIKE :name')
            ->setParameter('name', "%$name%")
            ->getQuery()
            ->getResult()
        ;

        return count($results) ? $results[0] : null;
    }
}
