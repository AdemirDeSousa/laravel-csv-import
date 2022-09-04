<?php

namespace App\Services\Clients;

use App\Http\Resources\Clients\ClientsResource;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ClientService
{
    private ClientRepositoryInterface $clientRepo;

    public function __construct(ClientRepositoryInterface $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    public function getAllClients()
    {
        try {

            return ClientsResource::collection($this->clientRepo->getClients());

        } catch (\Exception $e) {

            Log::info('Falha ao listar clientes', [$e->getMessage()]);

            return response()->json([
                'Falha ao se comunicar com o servidor'
            ], 500);

        }
    }

    public function createClient(array $data)
    {
        try {

            $this->clientRepo->storeClient($data);

            return response()->json([
               'message' => 'Cliente cadastrado com sucesso'
            ], 201);

        } catch (\Exception $e){

            Log::info('Falha ao cadastrar cliente', [$e->getMessage()]);

            return response()->json([
                'Falha ao se comunicar com o servidor'
            ], 500);
        }
    }

}
