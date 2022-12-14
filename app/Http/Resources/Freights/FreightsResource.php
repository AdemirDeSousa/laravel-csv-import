<?php

namespace App\Http\Resources\Freights;

use Illuminate\Http\Resources\Json\JsonResource;

class FreightsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from_postcode' => $this->from_postcode,
            'to_postcode' => $this->to_postcode,
            'from_weight' => $this->from_weight,
            'to_weight' => $this->to_weight,
            'cost' => $this->cost,
        ];
    }
}
