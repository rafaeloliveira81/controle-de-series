<?php

namespace App\Http\Requests\Episodio;

use Illuminate\Foundation\Http\FormRequest;

class StoreEpisodioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [  
            'temporada_id' => 'exists:temporadas,id|required|int',
            'nome' => 'required|min:3'
        ];
    }
}
