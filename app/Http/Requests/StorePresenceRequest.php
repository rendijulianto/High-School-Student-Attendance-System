<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePresenceRequest extends FormRequest
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
            'material' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'material.required' => 'Materi harus diisi',
            'material.max' => 'Materi tidak boleh lebih dari 255 karakter',
            'date.required' => 'Tanggal harus diisi',
            'date.date' => 'Tanggal harus berupa tanggal',
        ];
    }
}
