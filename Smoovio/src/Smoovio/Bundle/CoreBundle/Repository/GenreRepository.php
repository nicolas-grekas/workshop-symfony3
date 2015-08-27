<?php

namespace Smoovio\Bundle\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Smoovio\Bundle\CoreBundle\Entity\Genre;

class GenreRepository extends EntityRepository
{
    /**
     * Returns all genres ordered by title ascendant.
     *
     * @return Genre[]
     */
    public function getGenres()
    {
        return $this->findBy([], [ 'title' => 'ASC' ]);
    }
} 
