<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name'    => 'required|string|min:5|max:255',
            'email'   => 'required|string|email|max:255',
            'company' => 'required|string|min:5',
            'data'    => 'required|string|min:5',
            'bairro'  => 'required|string|min:5',
        ];
    }
}
