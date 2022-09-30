<?php

namespace App\Http\Requests;

use App\Enums\SampleType;
use App\Enums\UnitMeasurement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SampleRequest extends FormRequest
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
            'samples.*.externalId' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                'string',
            ],
            'samples.*.sample_type' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                Rule::in(SampleType::getValues())
            ],
            'samples.*.tests' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                'array'
            ],
            'samples.*.customer_id' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                'int'
            ],
            'samples.*.received_date' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                'date'
            ],
            'samples.*.received_by_id' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                'int'
            ],
            'samples.*.storage_id' => 'nullable|int',
            'samples.*.collected_date' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                'date'
            ],
            'samples.*.collected_by_id' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                'int'
            ],
            'samples.*.value_unit' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                'numeric'
            ],
            'samples.*.unit' => [
                Rule::requiredIf('samples.*.restore' == 'restore'),
                Rule::in(UnitMeasurement::getValues())
            ],
            'samples.*.discarded_date' => 'date|nullable',
            'samples.*.discarded_by_id' => 'int|nullable',
            'samples.*.description' => 'string|nullable'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if (!Request::routeIs('sample.*')) {
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
