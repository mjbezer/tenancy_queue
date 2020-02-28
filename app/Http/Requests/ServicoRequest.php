<?php

namespace AtitudeAgenda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoRequest extends FormRequest
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
            'ativo' => 'required|in:0,1',
            'descricao' => '',
            'valor' => 'required',
            'custo_direto'  => '',
            'iss_aliquota'  => '',
            'custo_total'   => '',
            'observacao'    => '',
            'cor_texto' => 'required',
            'cor_fundo' => 'required',
            'duracao'   => 'gt:0',
            'categoria_id'  => 'required',
            'sub_categoria_id'  => 'required',
        ];
    }
}
