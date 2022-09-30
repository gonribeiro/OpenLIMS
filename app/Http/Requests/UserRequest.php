<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
            'name' => [
                Rule::requiredIf(!$this->restore),
                'string'
            ],
            'birthdate' => [
                Rule::requiredIf(!$this->restore),
                'date'
            ],
            'email' => [
                Rule::requiredIf(!$this->restore),
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'password' => [
                Rule::requiredIf(!$this->restore),
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'country' => [
                Rule::requiredIf(!$this->restore),
                'string'
            ],
            'city' => [
                Rule::requiredIf(!$this->restore),
                'string'
            ],
            'address' => [
                Rule::requiredIf(!$this->restore),
                'string'
            ],
            'postcode' => [
                Rule::requiredIf(!$this->restore),
                'string'
            ],
            'cellphone' => [
                'string'
            ],
            'remuneration' => [
                'numeric'
            ],
            'currency' => [
                'string'
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if (!Request::routeIs('user.*')) {
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
}
