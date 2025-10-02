<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Province;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $idCityList = City::pluck('id_kabupaten');

        foreach ($idCityList as $idCity) {
            $response = Http::withOptions(["verify" => false])
            ->get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/$idCity.json");

            if ($response->successful()) {
                $data = $response->json();

                foreach ($data as $district) {
                    // Simpan data district ke database
                    District::create([
                        'id' => $district['id'],
                        'id_kabupaten' => $district['regency_id'],
                        'name' => $district['name'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } else {
                $this->command->error("Failed to fetch data for id_provinsi: $idCity");
            }
        }
    }
}