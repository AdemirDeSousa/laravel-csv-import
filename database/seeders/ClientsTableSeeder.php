<?php

namespace Database\Seeders;

use App\Models\Client\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::query()->create([
            'name' => 'Empresa de testes 01'
        ]);

        Client::query()->create([
            'name' => 'Empresa de testes 02'
        ]);

    }
}
