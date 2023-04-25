<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(100)->create();
        User::create([
            'name' => 'Rendi Julianto',
            'email' => 'rendijulianto37@gmail.com',
            'password' => bcrypt('rendi123'),
        ]);
    }
}
