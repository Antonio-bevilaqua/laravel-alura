<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|min:2',
            'qtd_temporadas' => 'required|integer|min:1',
            'ep_por_temporada' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'required'              => "O campo :attribute é obrigatório",
            'nome:min'              => "O campo nome precisa ter pelo menos 2 caracteres",
            'qtd_temporadas:min'    => "Mínimo = 1",
            'ep_por_temporada:min'  => "Mínimo = 1"
        ];
    }
}
