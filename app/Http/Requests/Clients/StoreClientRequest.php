<?php

namespace App\Http\Requests\Clients;

use App\Http\Requests\BaseRequest;

class StoreClientRequest extends BaseRequest
{
    protected string $message = 'Falha ao cadastrar cliente';

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:clients,name'
        ];
    }
}
