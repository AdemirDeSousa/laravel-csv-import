<?php

namespace App\Http\Controllers\Api\V1\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Services\Clients\ClientService;

class ClientController extends Controller
{
    private ClientService $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        return $this->clientService->getAllClients();
    }

    public function store(StoreClientRequest $request)
    {
        return $this->clientService->createClient($request->validated());
    }
}
