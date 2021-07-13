<?php

namespace App\Repository;

use App\Entity\CulturalSite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class CulturalSiteRepository
 * @package App\Repository
 */
class CulturalSiteRepository extends ServiceEntityRepository
{
    /**
     * CulturalSiteRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CulturalSite::class);
    }

    /**
     * @param Criteria $criteria
     * @return Query
     * @throws Query\QueryException
     */
    public function listQb(Criteria $criteria): Query
    {
        $qb = $this->createQueryBuilder('cs');

        $qb
            ->addCriteria($criteria)
            ->addOrderBy('cs.name', 'asc');

        return $qb->getQuery();
    }
}
