<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeachRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'subject_id' => ['required', 'array'],
            'subject_id.*' => ['required', 'integer', 'exists:subjects,id'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'subject_id.required' => 'Mata pelajaran harus diisi',
            'subject_id.*.required' => 'Mata pelajaran harus diisi',
            'subject_id.*.integer' => 'Mata pelajaran harus berupa angka',
            'subject_id.*.exists' => 'Mata pelajaran tidak ditemukan',
        ];
    }
}
