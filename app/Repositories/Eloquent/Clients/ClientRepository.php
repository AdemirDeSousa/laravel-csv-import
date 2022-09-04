<?php

namespace App\Repositories\Eloquent\Clients;

use App\Models\Client\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    protected Client $entity;

    public function __construct(Client $clients)
    {
        $this->entity = $clients;
    }

    public function getClients(): Collection
    {
        return $this->entity->query()->get();
    }

    public function storeClient(array $data): Client
    {
        return $this->entity->create([
           'name' => $data['name']
        ]);
    }
}
