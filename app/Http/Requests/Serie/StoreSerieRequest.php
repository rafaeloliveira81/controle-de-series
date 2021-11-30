<?php

namespace App\Http\Requests\Serie;

use Illuminate\Foundation\Http\FormRequest;

class StoreSerieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|min:3'
        ];
    }
}
