<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::factory()->count(200)->create();
        Teacher::factory()->count(1)->create([
            'name' => 'Rendi Julianto',
            'email' => 'ujangkomad@gmail.com',
            'password' => bcrypt('123'),
            'gender' => 'L',
            'nip' => '1234567890',
        ]);
    }
}
