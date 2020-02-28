<?php

namespace AtitudeAgenda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
        'nome_razao_social'   =>  'required',
        'nome_usual_fantasia' =>  'required',
        'cpf_cnpj'    =>  'required|unique:pessoas',
        'rg_ie'   =>  '',
        'data_nascimento_abertura' => 'required',
        'cep' =>  'required',
        'logradouro'  =>  'required',
        'numero'  =>  'required|gt:0|',
        'bairro'  =>  'required',
        'cidade'  =>  'required',
        'codigo_municipio'    =>  'required',
        'uf'  =>  'required',
        'telefone'    =>  '',
        'celular' =>  '',
        'email'   =>  'email',
        'tipo_cliente'    =>  '',
        'tipo_fornecedor' =>  '',
            ];
    }
}
