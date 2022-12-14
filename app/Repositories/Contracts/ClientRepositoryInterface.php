<?php

namespace App\Repositories\Contracts;

use App\Models\Client\Client;
use Illuminate\Support\Collection;

interface ClientRepositoryInterface
{
    public function getClients(): Collection;

    public function storeClient(array $data): Client;

    public function verifyClientExists(string $id): void;
}
