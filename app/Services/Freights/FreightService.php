<?php

namespace App\Services\Freights;

use App\Http\Resources\Freights\FreightsResource;
use App\Imports\FreightImport;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Repositories\Contracts\FreightRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FreightService
{
    private FreightRepositoryInterface $freightRepo;
    private ClientRepositoryInterface $clientRepo;

    public function __construct(
        FreightRepositoryInterface $freightRepo,
        ClientRepositoryInterface $clientRepo
    )
    {
        $this->freightRepo = $freightRepo;
        $this->clientRepo = $clientRepo;
    }

    public function getPaginatedFreights(string $clientId)
    {
        try {

            return FreightsResource::collection($this->freightRepo->getFreightsByClientId($clientId, 100));

        } catch (NotFoundHttpException $e) {

            return response()->json([
                'message' => 'Cliente não encontrado'
            ], 404);

        } catch (\Exception $e) {

            Log::info('Falha ao listar fretes', [$e->getMessage()]);

            return response()->json([
                'message' => 'Falha ao se comunicar com o servidor'
            ], 500);

        }
    }

    public function import(UploadedFile $attachment, string $clientId)
    {
        try {

            $this->clientRepo->verifyClientExists($clientId);

            Excel::import(new FreightImport($clientId), $attachment);

            return response()->json([
                'message' => 'Importação iniciada com sucesso'
            ], 200);

        } catch (NotFoundHttpException $e) {

            return response()->json([
                'message' => 'Cliente não encontrado'
            ], 404);

        } catch (\Exception $e) {

            Log::info('Falha ao iniciar importação', [$e->getMessage()]);

            return response()->json([
                'message' => 'Falha ao iniciar importação'
            ], 500);

        }
    }
}
