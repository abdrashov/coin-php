<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Response;

class TransactionSetIcomeRequest extends FormRequest
{
    private const FLOAT_TO_INT = 100;

    public function rules()
    {
        return [
            'cash' => ['required', 'numeric', 'min:0'],
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

    protected function prepareForValidation()
    {
        $this->merge([
            'cash' => (int) (self::FLOAT_TO_INT * (float) $this->input('cash')),
        ]);
    }
}
