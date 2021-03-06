<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFcmTokenRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => [
                'required',
                'string'
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
