<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScheduleRequest extends FormRequest
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
            'schedules' => 'required|array',
            'schedules.*.subject_id' => 'required|exists:subjects,id',
            'schedules.*.teacher_id' => 'required|exists:teachers,id',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'schedules.required' => 'Jadwal tidak boleh kosong',
            'schedules.*.subject_id.required' => 'Mata pelajaran tidak boleh kosong',
            'schedules.*.subject_id.exists' => 'Mata pelajaran tidak ditemukan',
            'schedules.*.teacher_id.required' => 'Guru tidak boleh kosong',
            'schedules.*.teacher_id.exists' => 'Guru tidak ditemukan',
        ];
    }
}
