<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Response;

class AccountCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'max:36'],
            'icon' => ['required', 'max:64'],
            'color' => ['required'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::json([
            'success'   => false,
            'message'   => 'Поля заполнены неправильно',
            'data'      => $validator->errors()
        ], (new ValidationException($validator))->status));
    }
}
