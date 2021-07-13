<?php

namespace App\Manager;

use App\Helper\RequestFilterHelper;
use App\Repository\CulturalSiteRepository;
use Doctrine\Common\Collections\Criteria;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CulturalSiteManager
 * @package App\Manager
 */
class CulturalSiteManager
{
    /**
     * @var CulturalSiteRepository
     */
    protected $repository;

    /**
     * @var PaginatorInterface
     */
    protected $paginator;

    /**
     * CulturalSiteManager constructor.
     * @param CulturalSiteRepository $repository
     * @param PaginatorInterface $paginator
     */
    public function __construct(
        CulturalSiteRepository $repository,
        PaginatorInterface $paginator
    ) {
        $this->repository = $repository;
        $this->paginator = $paginator;
    }

    /**
     * @param Criteria $criteria
     * @param int $page
     * @param int $itemPerPage
     * @return PaginationInterface
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function list(Criteria $criteria, int $page = 1, int $itemPerPage = 10): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->repository->listQb($criteria),
            $page,
            $itemPerPage
        );
    }

    /**
     * @param Request $request
     * @return Criteria
     * @throws \Exception
     */
    public function createCriteriaFromRequest(Request $request): Criteria
    {
        return RequestFilterHelper::extractFiltersFromRequest(
            $request,
            []
        );
    }
}
