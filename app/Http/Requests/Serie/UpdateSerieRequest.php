<?php

namespace App\Http\Requests\Serie;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSerieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|min:3|string',
            'categoria' => 'required|string',
            'streaming' => 'required|string',
            'status' => 'in:assitido,não-assitido',
        ];
    }
}
