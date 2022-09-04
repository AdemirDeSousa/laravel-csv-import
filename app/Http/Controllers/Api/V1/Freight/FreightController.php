<?php

namespace App\Http\Controllers\Api\V1\Freight;

use App\Http\Controllers\Controller;
use App\Http\Requests\Freights\ImportFreightRequest;
use App\Services\Freights\FreightService;

class FreightController extends Controller
{
    private FreightService $freightService;

    public function __construct(FreightService $freightService)
    {
        $this->freightService = $freightService;
    }

    public function index(string $clientId)
    {
        return $this->freightService->getPaginatedFreights($clientId);
    }

    public function import(ImportFreightRequest $request)
    {
        return $this->freightService->import($request->attachment, $request->client_id);
    }
}
