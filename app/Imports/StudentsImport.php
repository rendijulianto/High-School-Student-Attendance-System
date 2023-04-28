<?php

namespace App\Imports;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
// WithHeadingRow
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel , WithValidation, WithHeadingRow
{

    // model
    public function model(array $row)
    {

       try {
            return new Student([
                'name' => $row['nama_depan'] . ' ' . $row['nama_belakang'],
                'email' => $row['email'],
                'gender' => $row['jk'],
                'nis' => $row['nis'],
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
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'email' => 'required|unique:students,email',
            'nis' => 'required|unique:students,nis',
            'jk' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama_depan.required' => 'Nama Depan tidak boleh kosong',
            'nama_belakang.required' => 'Nama Belakang tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'jk.required' => 'Jenis Kelamin tidak boleh kosong',
            'nis.unique' => 'NIS sudah terdaftar',
        ];
    }
}
