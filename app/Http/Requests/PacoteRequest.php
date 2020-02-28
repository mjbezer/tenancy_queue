<?php

namespace AtitudeAgenda\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacoteRequest extends FormRequest
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
            'descricao' =>  'required',
            'valor' =>  'required|gt:0',
            'padrao'    =>  'required',
        ];
    }
}
