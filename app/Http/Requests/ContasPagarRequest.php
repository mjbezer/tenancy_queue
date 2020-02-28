<?php

namespace AtitudeAgenda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContasPagarRequest extends FormRequest
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
            'pessoa_id' =>  'required|',
            'descricao' =>  '|',
            'documento_fiscal'  =>  '|',
            'data_documento_fiscal' =>  '|',
            'valor_original'    =>  '|',
            'especie'   =>  'required|',
            'data_vencimento'   =>  '|',
            'data_pagamento'    =>  '|',
            'valor_pago'    =>  '|',
            'observacao'    =>  '|',
            'categoria_id'  =>  'required|',
            'sub_categoria_id'  =>  'required|'
        ];
    }
}
