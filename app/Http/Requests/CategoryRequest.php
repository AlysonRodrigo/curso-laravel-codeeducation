<?php

namespace CookieSoftCommerce\Http\Requests;

use CookieSoftCommerce\Http\Requests\Request;

class CategoryRequest extends Request
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
            'name' => 'required|max:60',
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatorio',
            'description.required' => 'A descricao é obrigatoria'
        ];
    }


}
