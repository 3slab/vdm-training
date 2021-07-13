<?php

namespace App\Controller;

use App\Entity\CulturalSite;
use App\Helper\WebservicePaginationInterface;
use App\Manager\CulturalSiteManager;
use App\Repository\CulturalSiteRepository;
use Doctrine\ORM\Query\QueryException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class ApiController
 * @package App\Controller
 */
class ApiController
{
    /**
     * @var CulturalSiteManager
     */
    protected $manager;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * ApiController constructor.
     * @param CulturalSiteManager $manager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        CulturalSiteManager $manager,
        SerializerInterface $serializer
    ) {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/", name="cultural_site_list", methods={"GET"})
     *
     * @SWG\Get(
     *     path="/",
     *     tags={"CulturalSite"},
     *     summary="Get list of cultural site items",
     *     @SWG\Response(
     *         response=200,
     *         description="Returns the list of cultural site items",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref=@Model(type=CulturalSite::class))
     *         )
     *     ),
     *     @SWG\Parameter(
     *         name="currentPage",
     *         in="query",
     *         type="integer",
     *         default="1",
     *     ),
     *     @SWG\Parameter(
     *         name="itemsPerPage",
     *         in="query",
     *         type="integer",
     *         default="20",
     *     )
     * )
     *
     * @param Request $request
     * @param CulturalSiteRepository $repository
     * @return JsonResponse
     * @throws QueryException
     */
    public function list(Request $request, CulturalSiteRepository $repository): JsonResponse
    {
        $currentPage = $request->query->get(WebservicePaginationInterface::QUERY_PARAM_CURRENT_PAGE, 1);
        $itemsPerPage = $request->query->get(
            WebservicePaginationInterface::QUERY_PARAM_ITEMS_PER_PAGE,
            WebservicePaginationInterface::DEFAULT_ITEMS_PER_PAGE
        );

        $criteria = $this->manager->createCriteriaFromRequest($request);
        $paginator = $this->manager->list($criteria, $currentPage, $itemsPerPage);

        $items = $paginator->getItems();
        $total = $paginator->getTotalItemCount();
        $pageCount = (int)ceil($total / $itemsPerPage);

        $result = $this->serializer->normalize($items);

        $response = new JsonResponse($result);
        $response->headers->set(WebservicePaginationInterface::PAGINATION_TOTAL_COUNT, $total);
        $response->headers->set(WebservicePaginationInterface::PAGINATION_PAGE_COUNT, $pageCount);
        $response->headers->set(WebservicePaginationInterface::PAGINATION_CURRENT_PAGE, $currentPage);
        $response->headers->set(WebservicePaginationInterface::PAGINATION_PER_PAGE, $itemsPerPage);

        return $response;
    }
}
