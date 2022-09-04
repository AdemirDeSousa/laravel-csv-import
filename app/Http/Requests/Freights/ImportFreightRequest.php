<?php

namespace App\Http\Requests\Freights;

use App\Http\Requests\BaseRequest;

class ImportFreightRequest extends BaseRequest
{
    protected string $message = 'Falha ao importar fretes';

    public function rules()
    {
        return [
            'attachment' => 'required|mimes:csv,txt',
            'client_id' => 'required'
        ];
    }
}
