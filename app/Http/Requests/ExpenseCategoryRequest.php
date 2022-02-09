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
            'name' => ['required', 'max:36']
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
}
