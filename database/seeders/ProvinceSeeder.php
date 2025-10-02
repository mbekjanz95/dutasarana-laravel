<?php

namespace Database\Seeders;

use App\Models\Province;
use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::withOptions(["verify"=>false])
            ->get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
        
        $data = $response->json(); 

        foreach ($data as $province) {
            Province::create([
                'province_id'=>  $province['id'],
                'province'=>  $province['name'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
