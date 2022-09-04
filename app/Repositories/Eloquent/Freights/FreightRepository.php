<?php

namespace App\Repositories\Eloquent\Freights;

use App\Models\Freight\Freight;
use App\Repositories\Contracts\FreightRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class FreightRepository implements FreightRepositoryInterface
{
    protected Freight $entity;

    public function __construct(Freight $freights)
    {
        $this->entity = $freights;
    }

    public function getFreightsByClientId(string $clientId, int $perPage): LengthAwarePaginator
    {
        return $this->entity->where('client_id', $clientId)->paginate($perPage);
    }
}
