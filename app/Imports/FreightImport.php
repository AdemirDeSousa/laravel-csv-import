<?php

namespace App\Imports;

use App\Models\Freight;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Validators\Failure;

class FreightImport implements ToCollection, WithChunkReading, WithHeadingRow, ShouldQueue, WithValidation, WithEvents, SkipsOnFailure, WithBatchInserts
{
    private string $clientId;

    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

    public function collection(Collection $rows)
    {
        $records = [];
        $clientId = $this->clientId;

        DB::disableQueryLog();

        foreach ($rows as $row)
        {

            $records = [
                ...$records,
                [
                    'from_postcode' => $row['from_postcode'],
                    'to_postcode' => $row['to_postcode'],
                    'from_weight' => $row['from_weight'],
                    'to_weight' => $row['to_weight'],
                    'cost' => $row['cost'],
                    'client_id' => $clientId,
                ]
            ];
        }

        DB::table('freights')->insert($records);
    }

    public function chunkSize(): int
    {
        return 5000;
    }

    public function batchSize(): int
    {
        return 5000;
    }

    public function rules(): array
    {
        return [
            'from_postcode' => 'required',
            '*.from_postcode' => 'required',
            'to_postcode' => 'required',
            '*.to_postcode' => 'required',
            'from_weight' => 'required',
            '*.from_weight' => 'required',
            'to_weight' => 'required',
            '*.to_weight' => 'required',
            'cost' => 'required',
            '*.cost' => 'required',
        ];
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function(BeforeImport $event){
                Log::info('Importacão iniciada');
            },

            ImportFailed::class => function(ImportFailed $event) {
                Log::info('Falha na importação do frete:', [$event->getException()]);
            },

            AfterImport::class => function(AfterImport $event){
                Log::info('Importacão finalizada');
            }
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure){
            Log::info("Falha ao importar linha [{$failure->row()}]", $failure->errors());
        }
    }
}
