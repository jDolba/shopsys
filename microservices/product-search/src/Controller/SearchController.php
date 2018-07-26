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

        return new JsonResponse([
            'query' => $query,
            'domainId' => $domainId,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }
}
