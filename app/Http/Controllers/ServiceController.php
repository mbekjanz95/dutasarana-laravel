<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Produk;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Variations;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $customer = Customer::all();
        /* $customerName = DB::table('customer')
                        ->join('users', 'customer.id', '=', 'users.idcust')
                        ->join('provinces', 'customer.province_id', '=', 'provinces.province_id')
                        ->join('cities', 'customer.id_kabupaten', '=', 'cities.id_kabupaten')
                        ->join('district', 'customer.id_kecamatan', '=', 'district.id')
                        ->join('kelurahan', 'customer.id_kelurahan', '=', 'kelurahan.id')
                        ->where('users.id', auth()->user()->id)
                        ->select(
                        'customer.customername',
                        'customer.address',
                        'customer.postal_code',
                        'provinces.province',
                        'cities.name AS nama_kota',
                        'district.name AS nama_kecamatan',
                        'kelurahan.name AS nama_kelurahan'
                        )
                        ->first(); */

        return view('internalservice', compact('customer'));
    }

     public function phoneList (Request $request)
    {
        $customerName = DB::table('customer')
                ->where('id', $request->idCust)
                ->select('customername')
                ->first();

        return response()->json([
            'customerName' => $customerName
        ]);
    }

    public function teknisiList (Request $request)
    {
        $teknisiName = DB::table('service')
                ->where('serial_number', $request->value)
                ->select(
                    'nama_teknisi',
                    'analisa_teknisi',
                    'solusi_saran',
                    'part_diganti'
                )
                ->get();

        $serialNumber = DB::table('service')
                ->where('no_so', $request->noSO)
                ->select(
                    'serial_number',
                    'nama_teknisi',
                    'analisa_teknisi',
                    'solusi_saran',
                    'part_diganti'
                )
                ->get();

        return response()->json([
            'teknisiName' => $teknisiName,
            'serialNumber' => $serialNumber
        ]);
    }

    public function fetchService(Request $request)
    {
       $service = DB::table('service')
            ->join('users', 'service.id_user', '=', 'users.id')
            ->join('customer', 'users.idcust', '=', 'customer.id')
            ->when($request->status !== 'keseluruhan', function ($query) use ($request) {
                $query->where('service.status', $request->status);
            })
            ->select(
                'service.no_so',
                'customer.customername',
                'customer.phone',
                'customer.customername',
                'users.email',
                'service.keluhan',
                'service.merk',
                'service.tipe_barang',
                'service.serial_number',
                'service.unit_diterima',
                'service.status'
            )
            ->groupBy(
                'service.no_so',
                'customer.customername',
                'customer.phone',
                'customer.customername',
                'users.email',
                'service.keluhan',
                'service.merk',
                'service.tipe_barang',
                'service.serial_number',
                'service.unit_diterima',
                'service.status'
            )
            ->get();
    
        return view('partials.service-diperiksa-admin', compact('service'));
    }

   public function fetchServiceUser(Request $request)
    {
        $groupedData = DB::table('service')
            ->where('status', $request->status)
            ->where('id_user', '=', auth()->user()->id)
            ->select(
                'no_so',
                'serial_number',
                'nama_teknisi',
                'analisa_teknisi',
                'solusi_saran',
                'part_diganti',
                'status_sparepart',
                'merk',
                'tipe_barang',
                'keluhan',
                'harga'
            )
            ->get()
            ->groupBy('no_so');

        $html = view('partials.menunggu-konfirmasi-user', compact('groupedData'))->render();

        return response()->json([
            'html' => $html,
            'groupedData' => $groupedData
        ]);
    }

    public function store(Request $request)
    {
        try {
    // Validasi request
    $validated = $request->validate([
        'no_so' => 'required|numeric',
        'idcust' => 'required|numeric',
        'keluhan' =>  'required|string',
        'merk' =>  'required|string',
        'tipe_barang' =>  'required|string',
        'serial_number' =>  'required|string',
        'tanggal_masuk' =>  'required|date',
        'unit_diterima' =>  'required|string',
        'nama_teknisi' =>  'required|string'
    ]);

    // Cari user berdasarkan id
    $user = User::where('idcust', $validated['idcust'])->firstOrFail();

    // Simpan data service
    $customer = Service::create([
        'no_so' => $validated['no_so'],
        'id_user' => $user->id,
        'status' => $request->status,
        'keluhan' => $validated['keluhan'],
        'merk' => $validated['merk'],
        'tipe_barang' => $validated['tipe_barang'],
        'serial_number' => $validated['serial_number'],
        'tanggal_masuk' => $validated['tanggal_masuk'],
        'unit_diterima' => $validated['unit_diterima'],
        'nama_teknisi' => $validated['nama_teknisi']
    ]);

    // Berhasil
    return response()->json([
        'status' => 'success', 
        'message' => 'Data service berhasil disimpan',
        'data' => $customer
    ], 201);


    } 
        catch (\Illuminate\Validation\ValidationException $e) {
                $errors = $e->validator->errors()->all();
                return response()->json(['errors' => $errors], 422);
        }
    }

    public function storeBaru(Request $request)
    {
        try {
    // Validasi request
    $validated = $request->validate([
        'no_so' => 'required|numeric',
        'customername' =>  'required|string',
        'phone' => 'required|numeric',
        'email' => 'required|email',
        'keluhan' =>  'required|string',
        'merk' =>  'required|string',
        'tipe_barang' =>  'required|string',
        'serial_number' =>  'required|string',
        'tanggal_masuk' =>  'required|date',
        'unit_diterima' =>  'required|string',
        'nama_teknisi' =>  'required|string'
    ]);

    DB::statement('SET foreign_key_checks = 0');
    DB::beginTransaction();
    
        $customer = Customer::create([
            'customername' => $validated['customername'],
            'phone' => $validated['phone'],
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'idcust' => $customer->id, 
        ]);

        $service = Service::create([
            'no_so' => $validated['no_so'],
            'customername' => $validated['customername'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'id_user' => $user->id,
            'status' => $request->status,
            'keluhan' => $validated['keluhan'],
            'merk' => $validated['merk'],
            'tipe_barang' => $validated['tipe_barang'],
            'serial_number' => $validated['serial_number'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'unit_diterima' => $validated['unit_diterima'],
            'nama_teknisi' => $validated['nama_teknisi']
        ]);
    
            // Commit transaksi
    DB::commit();
    DB::statement('SET foreign_key_checks = 1');

            return response()->json([
                'status' => 'success', 
                'message' => 'Data successfully created',
                'customer' => $customer,
            ], 201);


    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->validator->errors()->all();
        return response()->json(['errors' => $errors], 422);
    } 
    }

    public function filterTanggal(Request $request)
    {
        $filterTanggal = DB::table('service')
            ->join('users', 'service.id_user', '=', 'users.id')
            ->join('customer', 'users.idcust', '=', 'customer.id')
            ->where('tanggal_masuk', $request->tanggal)
            ->select(
                'service.no_so',
                'customer.customername',
                'customer.phone',
                'customer.customername',
                'users.email',
                'service.keluhan',
                'service.merk',
                'service.tipe_barang',
                'service.serial_number',
                'service.unit_diterima',
                'service.status'
            )
            ->groupBy(
                'service.no_so',
                'customer.customername',
                'customer.phone',
                'customer.customername',
                'users.email',
                'service.keluhan',
                'service.merk',
                'service.tipe_barang',
                'service.serial_number',
                'service.unit_diterima',
                'service.status'
            )
            ->get();
            
        return response()->json($filterTanggal);
    }

    public function filterCustomer(Request $request)
    {
        $filterCustomer = DB::table('service')
            ->join('users', 'service.id_user', '=', 'users.id')
            ->join('customer', 'users.idcust', '=', 'customer.id')
            ->where('customer.customername', 'like', '%' . $request->nama . '%')
            ->select(
                'service.no_so',
                'customer.customername',
                'customer.phone',
                'customer.customername',
                'users.email',
                'service.keluhan',
                'service.merk',
                'service.tipe_barang',
                'service.serial_number',
                'service.unit_diterima',
                'service.status'
            )
            ->groupBy(
                'service.no_so',
                'customer.customername',
                'customer.phone',
                'customer.customername',
                'users.email',
                'service.keluhan',
                'service.merk',
                'service.tipe_barang',
                'service.serial_number',
                'service.unit_diterima',
                'service.status'
            )
            ->get();
            
        return response()->json($filterCustomer);
    }

     public function filterSO(Request $request)
    {
        $filterSO = DB::table('service')
            ->join('users', 'service.id_user', '=', 'users.id')
            ->join('customer', 'users.idcust', '=', 'customer.id')
            ->where('service.no_so', $request->no_so)
            ->select(
                'service.no_so',
                'customer.customername',
                'customer.phone',
                'customer.customername',
                'users.email',
                'service.keluhan',
                'service.merk',
                'service.tipe_barang',
                'service.serial_number',
                'service.unit_diterima',
                'service.status'
            )
            ->groupBy(
                'service.no_so',
                'customer.customername',
                'customer.phone',
                'customer.customername',
                'users.email',
                'service.keluhan',
                'service.merk',
                'service.tipe_barang',
                'service.serial_number',
                'service.unit_diterima',
                'service.status'
            )
            ->get();
            
        return response()->json($filterSO);
    }

    public function dataTeknisi(Request $request)
    {
        try 
        {
            $validated = $request->validate([
                'id' => 'required|numeric',
                'analisa_teknisi' => 'required|string',
                'solusi_saran' => 'required|string',
                'part_diganti' => 'required|string',
            ]);

        DB::table('service')
        ->where('id', $validated['id'] )
        ->update([
            'analisa_teknisi' => $validated['analisa_teknisi'],
            'solusi_saran' => $validated['solusi_saran'],
            'part_diganti' => $validated['part_diganti']
        ]);
         } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

   public function dataSparepart(Request $request)
    {
        try 
        {
            $validated = $request->validate([
                'data' => 'required|array',
                'data.*.serial_number' => 'required|string',
                'data.*.status_sparepart' => 'required|string',
                'harga' => 'required|numeric',
            ]);

            foreach ($validated['data'] as $unit) {
                DB::table('service')
                    ->where('serial_number', $unit['serial_number'])
                    ->update([
                        'status' => 'menunggu-konfirmasi',
                        'status_sparepart' => $unit['status_sparepart'],
                        'harga' => $validated['harga']
                    ]);
            }

            return response()->json(['message' => 'Berhasil disimpan'], 200);
            // return response()->json(['status' => 'success']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function dataKonfirmasi(Request $request)
    {
        try 
        {
            DB::table('service')
                ->where('no_so', $request->no_so)
                ->update([
                    'status' => 'diproses',
            ]);

            return response()->json(['message' => 'Berhasil disimpan'], 200);
            // return response()->json(['status' => 'success']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }


    public function storeMany(Request $request)
    {
        try {
            $validated = $request->validate([
                'no_so' => 'required|numeric',
                'idcust' => 'required|numeric',
                'tanggal_masuk' =>  'required|date',
                'nama_teknisi' =>  'required|string',

                'merk' => 'required|array',
                'merk.*' => 'required|string',
                
                'tipe_barang' => 'required|array',
                'tipe_barang.*' => 'required|string',
                
                'serial_number' => 'required|array',
                'serial_number.*' => 'required|string',

                'unit_diterima' => 'required|array',
                'unit_diterima.*' => 'required|string',

                'keluhan' => 'required|array',
                'keluhan.*' => 'required|string',
            ]);

            $user = User::where('idcust', $validated['idcust'])->firstOrFail();

            // Simpan data service untuk setiap barang
            foreach ($validated['merk'] as $index => $merk) {
                Service::create([
                    'no_so' => $validated['no_so'],
                    'id_user' => $user->id,
                    'status' => $request->status,
                    'merk' => $merk,
                    'tipe_barang' => $validated['tipe_barang'][$index],
                    'serial_number' => $validated['serial_number'][$index],
                    'tanggal_masuk' => $validated['tanggal_masuk'],
                    'unit_diterima' => $validated['unit_diterima'][$index],
                    'keluhan' => $validated['keluhan'][$index],
                    'nama_teknisi' => $validated['nama_teknisi']
                ]);
            }

            return response()->json(['status' => 'success']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function storeBaruMany(Request $request)
    {
        try {
            $validated = $request->validate([
                'no_so' => 'required|numeric',
                'customername' => 'required|string',
                'phone' => 'required|numeric',
                'email' => 'required|email',
                'tanggal_masuk' => 'required|date',
                'nama_teknisi' => 'required|string',

                'merk' => 'required|array',
                'merk.*' => 'required|string',
                
                'tipe_barang' => 'required|array',
                'tipe_barang.*' => 'required|string',
                
                'serial_number' => 'required|array',
                'serial_number.*' => 'required|string',

                'unit_diterima' => 'required|array',
                'unit_diterima.*' => 'required|string',

                'keluhan' => 'required|array',
                'keluhan.*' => 'required|string',
            ]);

            DB::statement('SET foreign_key_checks = 0');
            DB::beginTransaction();

            $customer = Customer::create([
                'customername' => $validated['customername'],
                'phone' => $validated['phone'],
            ]);

            $user = User::create([
                'email' => $validated['email'],
                'idcust' => $customer->id, 
            ]);

            foreach ($validated['merk'] as $index => $merk) {
                Service::create([
                    'no_so' => $validated['no_so'],
                    'customername' => $validated['customername'],
                    'phone' => $validated['phone'],
                    'email' => $validated['email'],
                    'id_user' => $user->id,
                    'status' => $request->status ?? 'menunggu-konfirmasi', // fallback jika status tidak ada
                    'merk' => $merk,
                    'tipe_barang' => $validated['tipe_barang'][$index],
                    'serial_number' => $validated['serial_number'][$index],
                    'tanggal_masuk' => $validated['tanggal_masuk'],
                    'unit_diterima' => $validated['unit_diterima'][$index],
                    'keluhan' => $validated['keluhan'][$index],
                    'nama_teknisi' => $validated['nama_teknisi']
                ]);
            }

            DB::commit();
            DB::statement('SET foreign_key_checks = 1');

            return response()->json(['status' => 'success']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            DB::statement('SET foreign_key_checks = 1');

            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

}
