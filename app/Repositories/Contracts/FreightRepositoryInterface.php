<?php

namespace App\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface FreightRepositoryInterface
{
    public function getFreightsByClientId(string $clientId, int $perPage): LengthAwarePaginator;
}
