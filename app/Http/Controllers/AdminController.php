<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stok;
use App\Models\Variations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $validated = $request->validate([
            'productname' => 'required|string',
            'productdesc' => 'required|string',
            'catname' => 'required|string',
            'berat' => 'required|numeric',
            'variations' => 'required|array',
            'variations.*.value' => 'required|string',
            'variations.*.sku' => 'required|string',
            'variations.*.pricebefore' => 'required|numeric',
            'variations.*.priceafter' => 'required|numeric',
            'variations.*.stok' => 'required|integer',
            'file' => 'required|file|image',
        ]);


        try {
            DB::statement('SET foreign_key_checks = 0');
            DB::beginTransaction();

            $category = DB::table('categories')->where('catname', $validated['catname'])->first();
            if (!$category) {
                $categoryId = DB::table('categories')->insertGetId(['catname' => $validated['catname']]);
            } else {
                $categoryId = $category->id;
            }

            $productId = DB::table('products')->insertGetId([
                'productname' => $validated['productname'],
                'productdesc' => $validated['productdesc'],
                'idcategory' => $categoryId,
                'berat' => $validated['berat'],
            ]);

            foreach ($validated['variations'] as $variation) {
                $variationId = DB::table('variations')->insertGetId([
                    'value' => $variation['value'],
                    'sku' => $variation['sku'],
                    'pricebefore' => $variation['pricebefore'],
                    'priceafter' => $variation['priceafter'],
                    'product_idproduct' => $productId,
                ]);

                DB::table('stok')->insert([
                    'idproduct' => $productId,
                    'idvar' => $variationId,
                    'stok' => $variation['stok'],
                    'kota' => auth()->user()->username,
                ]);
            }

            $fileName = session('fileName');
            if (!$fileName) {
                return response()->json(['error' => 'File not found in session'], 404);
            }

           /*  $tempPath = public_path('temp_uploads/' . $fileName);
            if (!file_exists($tempPath)) {
                return response()->json(['error' => 'File not found'], 404);
            } */

            $tempPath = storage_path('app/public/temp_uploads/' . $fileName);
            if (!Storage::exists('public/temp_uploads/' . $fileName)) {
                return response()->json(['error' => 'File not found'], 404);
            }
        
            $productImagePath = 'product-images/' . $fileName;
            rename($tempPath, $productImagePath);

            DB::table('product_images')->insert([
                'imagepath' => $productImagePath,
                'product_idproduct' => $productId,
            ]);

            DB::commit();
            DB::statement('SET foreign_key_checks = 1');

            return response()->json([
                'success' => true, 
                'message' => 'Produk berhasil ditambahkan',
                'productId' => $productId,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false, 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::table('products')
        ->where('productname', $request->namaProduk )
        ->delete();
    }

    public function updatedataJoin(Request $request)
    {
        DB::transaction(function () use ($request) {
    
            $hargaSesudah = str_replace('.', '', $request->hargasesudahValue);
            $hargaSebelum = str_replace('.', '', $request->hargasebelumValue);
            $productId = Variations::query()  
                        ->where('id', $request->variationsId)
                        ->pluck('product_idproduct');

            DB::table('stok')
                ->join('variations', 'stok.idvar', '=', 'variations.id')
                ->where('variations.id', '=', $request->variationsId)
                ->where('stok.kota', '=', auth()->user()->username)
                ->update([
                    'stok.stok' => $request->stokValue,
                ]);

            DB::table('variations')
                ->where('id', '=', $request->variationsId)
                ->update([
                    'sku' => $request->skuValue,
                    'priceafter' => $hargaSesudah,
                    'pricebefore' => $hargaSebelum,
                ]);

            DB::table('products')
                ->where('id', '=', $productId)
                ->update([
                    'productdesc' => $request->deskripsi
                ]);
        });

        return response()->json(['message' => 'Produk dan stok berhasil diperbarui']);
    }

    public function uploadTemp(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            session(['fileName' => $fileName]);

            // Simpan ke storage/app/public/temp_uploads/
            $filePath = $file->storeAs('public/temp_uploads', $fileName);

            return response()->json([
                'success' => true,
                'file_name' => $fileName,
                'file_url' => asset('storage/temp_uploads/' . $fileName),
            ]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function uploadTempVideo(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimetypes:video/mp4,video/quicktime|max:102400',
            ]);

            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            session(['videoKomplain' => $fileName]);

            // Simpan ke storage/app/public/temp_uploads/
            $filePath = $file->storeAs('public/temp_uploads', $fileName);

            return response()->json([
                'success' => true,
                'file_name' => $fileName,
                'file_url' => asset('storage/temp_uploads/' . $fileName),
            ]);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function uploadExcel(Request $request)
    {
        // Validasi file upload
        $request->validate([
        'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        try {
        DB::statement('SET foreign_key_checks = 0');

        // Looping untuk membaca setiap baris di Excel
            foreach ($sheetData as $index => $row) {
            if ($index == 1) continue; // Skip header

            // Ambil data dari kolom
            $productName = $row['A']; // nama_produk
            $variation = $row['B']; // variasi
            $priceBefore = $row['C']; // variasi
            $priceAfter = $row['D']; // harga
            $weight = $row['E']; // berat
            $sku = $row['F']; // sku
            $stock = $row['G']; // stok

            DB::table('stok')
            ->join('variations', 'stok.idvar', '=', 'variations.id')
            ->join('products', 'stok.idproduct', '=', 'products.id')
            ->where('products.productname', $productName)
            ->where('variations.value', $variation)
            ->where('stok.kota', '=', auth()->user()->username)
            ->update([
            'variations.pricebefore' => $priceBefore,
            'variations.priceafter' => $priceAfter,
            'products.berat' => $weight,
            'variations.sku' => $sku,
            'stok.stok' => $stock,
            ]);
        }
        DB::statement('SET foreign_key_checks = 1');

            return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupload dan diperbarui.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function editVariasi (Request $request)
    {
        DB::table('variations')
        ->where('id', '=', $request->idvar)
        ->update([
            'value' => $request->inputVariasi,
        ]);

        return response()->json(['message' => 'Berhasil mengubah nama variasi']);
    }

    public function fetchTransaction(Request $request)
    {
       $transaction = DB::table('transaction')
                ->join('product_images', 'transaction.idproduct', '=', 'product_images.product_idproduct')
                ->join('products', 'product_images.product_idproduct', '=', 'products.id')
                ->join('variations', 'transaction.idvar', '=', 'variations.id')
                ->join('users', 'transaction.iduser', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
                ->join('provinces', 'customer.province_id', '=', 'provinces.province_id')
                ->join('cities', 'customer.id_kabupaten', '=', 'cities.id_kabupaten')
                ->join('district', 'customer.id_kecamatan', '=', 'district.id')
                ->join('kelurahan', 'customer.id_kelurahan', '=', 'kelurahan.id')
                ->where('transaction.kota_pengiriman', auth()->user()->username)
                ->where('transaction.status', $request->status)
                ->select(
                    'product_images.imagepath',
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                    'transaction.status',
                    'transaction.order_id',
                    'transaction.created_at',
                    'transaction.updated_at',
                    'transaction.url_suratjalan',
                    'customer.customername',
                    'customer.address',
                    'customer.phone',
                    'provinces.province',
                    'cities.name AS city_name',
                    'district.name AS district_name',
                    'kelurahan.name AS kelurahan_name',
                    'transaction.no_resi',
                    'transaction.rating',
                    'transaction.url_komplain',
                    'transaction.keterangan_komplain'
                )
                ->groupBy(
                    'product_images.imagepath',
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                    'transaction.status',
                    'transaction.order_id',
                    'transaction.created_at',
                    'transaction.updated_at',
                    'transaction.url_suratjalan',
                    'customer.customername',
                    'customer.address',
                    'customer.phone',
                    'provinces.province',
                    'cities.name',
                    'district.name',
                    'kelurahan.name',
                    'transaction.no_resi',
                    'transaction.rating',
                    'transaction.url_komplain',
                    'transaction.keterangan_komplain'
                )
                ->get();

        $rincian = DB::table('transaction')
                ->join('product_images', 'transaction.idproduct', '=', 'product_images.product_idproduct')
                ->join('products', 'product_images.product_idproduct', '=', 'products.id')
                ->join('variations', 'transaction.idvar', '=', 'variations.id')
                ->join('users', 'transaction.iduser', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
                ->where('transaction.order_id', $request->orderId)
                ->where('status', $request->status)
                ->select(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                    'transaction.order_id'
                )
                ->groupBy(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                    'transaction.order_id'
                )
                ->get();
            
        return view('partials.transaction-admin-list', compact('transaction','rincian'));
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'imagepath' => 'nullable|string',
            'index' => 'required|integer|min:1|max:5',
        ]);

        $fileName = session('fileName');
        if (!$fileName) {
            return response()->json(['error' => 'File not found in session'], 404);
        }

        // Lokasi file sementara di storage
        $tempPath = storage_path('app/public/temp_uploads/' . $fileName);
        if (!file_exists($tempPath)) {
            return response()->json(['error' => 'Temp file not found'], 404);
        }

        // Lokasi baru di public/
        $newPath = 'product-images/' . $fileName;
        $destinationPath = public_path($newPath);

        // Pindahkan file dari storage ke public
        rename($tempPath, $destinationPath);

        // Tentukan kolom yang akan diupdate berdasarkan index
        $index = $request->index;
        $columnName = $index == 1 ? 'imagepath' : 'imagepath_' . $index;

        // Update path di database
        DB::table('product_images')
            ->where($columnName, $request->imagepath)
            ->where('product_idproduct', $request->idProduct)
            ->update([
                $columnName => $newPath,
            ]);

        return response()->json([
            'success' => true,
            'file_name' => $fileName,
            'file_url' => asset($newPath), // Perhatikan: tanpa 'storage/'
        ]);
    }



    public function fetchBuktiTransaksi (Request $request)
    {
        $buktiTransaksi = DB::table('bukti_transaksi')
                            ->where('order_id', $request->orderId)
                            ->first();

        $urlMidtrans = DB::table('transaction')
                        ->where('order_id', $request->orderId)
                        ->whereIn('status', ['diproses', 'dalam-pengiriman','selesai','dikomplain','dibatalkan'])
                        ->value('url_midtrans');

        
        return response()->json([
            'buktiTransaksi' => $buktiTransaksi,
            'urlMidtrans' => $urlMidtrans
        ]);
    }

    public function fetchRincian (Request $request)
    {
        $transaction = DB::table('transaction')
                ->join('product_images', 'transaction.idproduct', '=', 'product_images.product_idproduct')
                ->join('products', 'product_images.product_idproduct', '=', 'products.id')
                ->join('variations', 'transaction.idvar', '=', 'variations.id')
                ->join('users', 'transaction.iduser', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
                ->where('transaction.order_id', $request->orderId)
                ->select(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                    'transaction.order_id'
                )
                ->groupBy(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                    'transaction.order_id'
                )
                ->get();
            
       $orderId = DB::table('transaction')
                ->where('order_id', $request->orderId)
                ->pluck('order_id')
                ->first();

        return view('partials.rincian', compact('transaction','orderId'));
    }

    public function fetchRincianUser (Request $request)
    {
        $transaction = DB::table('transaction')
                ->join('product_images', 'transaction.idproduct', '=', 'product_images.product_idproduct')
                ->join('products', 'product_images.product_idproduct', '=', 'products.id')
                ->join('variations', 'transaction.idvar', '=', 'variations.id')
                ->join('users', 'transaction.iduser', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
                ->where('transaction.order_id', $request->orderId)
                ->select(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                    'transaction.order_id'
                )
                ->groupBy(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                    'transaction.order_id'
                )
                ->get();
            
       $orderId = DB::table('transaction')
                ->where('order_id', $request->orderId)
                ->pluck('order_id')
                ->first();

        return view('partials.rincian-user', compact('transaction','orderId'));
    }

    public function fetchDataPembeli (Request $request)
    {
        $transaction = DB::table('transaction')
                ->join('product_images', 'transaction.idproduct', '=', 'product_images.product_idproduct')
                ->join('products', 'product_images.product_idproduct', '=', 'products.id')
                ->join('variations', 'transaction.idvar', '=', 'variations.id')
                ->join('users', 'transaction.iduser', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
                ->join('provinces', 'customer.province_id', '=', 'provinces.province_id')
                ->join('cities', 'customer.id_kabupaten', '=', 'cities.id_kabupaten')
                ->join('district', 'customer.id_kecamatan', '=', 'district.id')
                ->join('kelurahan', 'customer.id_kelurahan', '=', 'kelurahan.id')
                ->where('transaction.order_id', $request->orderId)
                ->select(
                    'transaction.order_id',
                    'customer.customername',
                    'customer.address',
                    'customer.phone',
                    'provinces.province',
                    'cities.name AS city_name',
                    'district.name AS district_name',
                    'kelurahan.name AS kelurahan_name'
                )
                ->groupBy(
                    'transaction.order_id',
                    'customer.customername',
                    'customer.address',
                    'customer.phone',
                    'provinces.province',
                    'cities.name',
                    'district.name',
                    'kelurahan.name'
                )
                ->get();

        return view('partials.data-pembeli', compact('transaction'));
    }

     public function fetchDataPembeliResponsive (Request $request)
    {
        $transaction = DB::table('transaction')
                ->join('product_images', 'transaction.idproduct', '=', 'product_images.product_idproduct')
                ->join('products', 'product_images.product_idproduct', '=', 'products.id')
                ->join('variations', 'transaction.idvar', '=', 'variations.id')
                ->join('users', 'transaction.iduser', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
                ->join('provinces', 'customer.province_id', '=', 'provinces.province_id')
                ->join('cities', 'customer.id_kabupaten', '=', 'cities.id_kabupaten')
                ->join('district', 'customer.id_kecamatan', '=', 'district.id')
                ->join('kelurahan', 'customer.id_kelurahan', '=', 'kelurahan.id')
                ->where('transaction.order_id', $request->orderId)
                ->select(
                    'transaction.order_id',
                    'customer.customername',
                    'customer.address',
                    'customer.phone',
                    'provinces.province',
                    'cities.name AS city_name',
                    'district.name AS district_name',
                    'kelurahan.name AS kelurahan_name'
                )
                ->groupBy(
                    'transaction.order_id',
                    'customer.customername',
                    'customer.address',
                    'customer.phone',
                    'provinces.province',
                    'cities.name',
                    'district.name',
                    'kelurahan.name'
                )
                ->get();

        return view('partials.data-pembeli-responsive', compact('transaction'));
    }

     public function tarikData(Request $request)
    {
        // Bisa dikirim via query string ?kota=Surabaya; default Surabaya
        $kota = $request->get('kota', auth()->user()->username);

        $query = DB::table('stok as s')
            ->join('products as p', 's.idproduct', '=', 'p.id')
            ->join('variations as v', 's.idvar', '=', 'v.id')
            ->where('s.kota', $kota)
            ->select(
                'p.productname as nama_produk',
                'v.value as variasi',
                'v.pricebefore as harga_sebelum',
                'v.priceafter as harga_sesudah',
                'p.berat as berat',
                'v.sku as sku',
                's.stok as stok'
            )
            ->orderBy('p.productname');

        // --- Cara sederhana (jika data tidak terlalu besar) ---
        $rows = $query->get();

        $filename = 'stok_' . $kota . '_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        return response()->stream(function () use ($rows) {
            // Tambah BOM supaya Excel Windows baca UTF-8 dengan benar
            echo "\xEF\xBB\xBF";

            $handle = fopen('php://output', 'w');

            // Header kolom
            fputcsv($handle, ['nama_produk', 'variasi', 'harga_sebelum', 'harga_sesudah', 'berat', 'sku', 'stok']);

            foreach ($rows as $r) {
                fputcsv($handle, [
                    $r->nama_produk,
                    $r->variasi,
                    $r->harga_sebelum,
                    $r->harga_sesudah,     // bisa format sendiri jika mau tanpa titik/komma
                    $r->berat,
                    $r->sku,
                    $r->stok,
                ]);
            }
            fclose($handle);
        }, 200, $headers);
    }
}
