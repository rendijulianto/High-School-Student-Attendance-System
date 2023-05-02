<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePresenceDetailRequest extends FormRequest
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
            'presences' => 'required|array',
            'presences.*.student_id' => 'required|exists:students,id',
            'presences.*.status' => 'required|in:H,I,A,S',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'presences.required' => 'Presensi tidak boleh kosong',
            'presences.*.student_id.required' => 'Siswa tidak boleh kosong',
            'presences.*.student_id.exists' => 'Siswa tidak ditemukan',
            'presences.*.status.required' => 'Status tidak boleh kosong',
            'presences.*.status.in' => 'Status tidak valid',
        ];
    }

}
