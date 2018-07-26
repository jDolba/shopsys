<?php

namespace Shopsys\MicroserviceProductSearch\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function productIdsAction(Request $request, int $domainId): JsonResponse
    {
        $query = $request->query->get('query');
        $limit = $request->query->get('limit', null);
        $offset = $request->query->get('offset', 0);

        $productsIds = [
            1, 2, 3, 4, 5,
        ];

        return new JsonResponse([
            'productsIds' => $productsIds,
        ]);
    }
}
