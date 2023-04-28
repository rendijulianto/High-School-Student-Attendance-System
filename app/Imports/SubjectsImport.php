<?php

namespace App\Imports;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
// WithHeadingRow
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectsImport implements ToModel , WithValidation, WithHeadingRow
{

    // model
    public function model(array $row)
    {

       try {
            return new Subject([
                'name' => $row['name'],
            ]);
       } catch (\Throwable $th) {
              return null;
       }
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:subjects,name',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.required' => 'Nama mata pelajaran tidak boleh kosong',
            'name.unique' => 'Nama mata pelajaran sudah terdaftar',
        ];
    }
}
