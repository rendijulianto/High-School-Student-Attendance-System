<?php

namespace App\Imports;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
// WithHeadingRow
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TeachersImport implements ToModel , WithValidation, WithHeadingRow
{

    // model
    public function model(array $row)
    {

       try {
            return new Teacher([
                'name' => $row['nama_depan'] . ' ' . $row['nama_belakang'],
                'email' => $row['email'],
                'gender' => $row['jk'],
                'nip' => $row['nip'],
                'password' => bcrypt(12345678),
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
            'email' => 'required|unique:teachers,email',
            'jk' => 'required',
            'nip' => 'nullable|unique:teachers,nip',
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
            'nip.unique' => 'NIP sudah terdaftar',
        ];
    }
}
