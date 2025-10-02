<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Usman',
            'email' => 'usman@dutasarana.com',
            'idcust' => '12',
            'password' => Hash::make('dscservice'), // penting!
        ]);
    }
}
