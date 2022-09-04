<?php

namespace App\Models\Client;

use App\Models\Freight\Freight;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function freights()
    {
        return $this->hasMany(Freight::class, 'client_id');
    }
}
