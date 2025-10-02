<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $idProvinceList = Province::pluck('province_id');

        foreach ($idProvinceList as $idProvince) {
            $response = Http::withOptions(["verify" => false])
            ->get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/$idProvince.json");

            if ($response->successful()) {
                $data = $response->json();

                foreach ($data as $city) {
                    // Simpan data district ke database
                    City::create([
                        'id_kabupaten' => $city['id'],
                        'id_provinsi' => $city['province_id'],
                        'name' => $city['name'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } else {
                $this->command->error("Failed to fetch data for id_provinsi: $idProvince");
            }
        }
    }
}
