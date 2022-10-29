<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ResultRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'results' => 'required|array',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if (!Request::routeIs('result.*')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data'    => $validator->errors()
            ]));
        }

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

    public function messages()
    {
        return [
            'results.required' => 'Update or Storage results has not been sent.',
        ];
    }
}
