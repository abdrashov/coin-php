<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ExpenseCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'max:36'],
            'icon' => ['required', 'max:64'],
            'color' => ['required', 'json'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Поля заполнены неправильно',
            'data'      => $validator->errors()
        ]));
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'color' => json_encode($this->get('color')),
        ]);
    }
}
