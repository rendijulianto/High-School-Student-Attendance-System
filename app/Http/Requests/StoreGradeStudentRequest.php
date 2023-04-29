<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeStudentRequest extends FormRequest
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
            'student_id' => 'required|array',
            'student_id.*' => 'required|integer|exists:students,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'student_id.required' => 'Siswa harus diisi',
            'student_id.*.required' => 'Siswa harus diisi',
            'student_id.*.integer' => 'Siswa harus berupa angka',
            'student_id.*.exists' => 'Siswa tidak ditemukan',
        ];
    }
}
