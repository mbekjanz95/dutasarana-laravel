<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Kelurahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     $idDistrictList = District::pluck('id');

    //     foreach ($idDistrictList as $idDistrict) {
    //         $response = Http::withOptions(["verify" => false])
    //         ->get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/$idDistrict.json");

    //         if ($response->successful()) {
    //             $data = $response->json();

    //             foreach ($data as $kelurahan) {
    //                 // Simpan data district ke database
    //                 Kelurahan::create([
    //                     'id' => $kelurahan['id'],
    //                     'id_kecamatan' => $kelurahan['district_id'],
    //                     'name' => $kelurahan['name'],
    //                     'created_at' => now(),
    //                     'updated_at' => now(),
    //                 ]);
    //             }
    //         } else {
    //             $this->command->error("Failed to fetch data for id_kecamatan: $idDistrict");
    //         }
    //     }
    // }

    public function run(): void
    {
        $idDistrictList = District::pluck('id');

        foreach ($idDistrictList as $idDistrict) {
            // Cek apakah sudah ada data untuk id_kecamatan ini
            if (Kelurahan::where('id_kecamatan', $idDistrict)->exists()) {
                $this->command->info("Skipping id_kecamatan: $idDistrict, already processed.");
                continue;
            }

            $response = Http::withOptions(["verify" => false])
            ->get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/$idDistrict.json");

            if ($response->successful()) {
                $data = $response->json();

                foreach ($data as $kelurahan) {
                    Kelurahan::create([
                        'id' => $kelurahan['id'],
                        'id_kecamatan' => $kelurahan['district_id'],
                        'name' => $kelurahan['name'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            } else {
                $this->command->error("Failed to fetch data for id_kecamatan: $idDistrict");
            }
        }
    }
}
