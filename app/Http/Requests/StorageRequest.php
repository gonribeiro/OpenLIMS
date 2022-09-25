<?php

namespace App\Http\Requests;

use App\Enums\StorageType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StorageRequest extends FormRequest
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
                'string',
                Rule::unique('storages', 'name')->ignore($this->storage),
            ],
            'type' => [
                Rule::requiredIf(!$this->restore),
                Rule::in(StorageType::getValues())
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if (!Request::routeIs('storage.*')) {
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
