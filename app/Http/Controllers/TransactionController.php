<?php

namespace App\Http\Controllers;

use App\Models\BuktiTransaksi;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Transaction;
use App\Models\Variations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{

    public function gtotalValue(Request $request)
    {
        $gtotal = $request->input('gtotal');
        $orderId = $request->orderId;

        // Simpan ke session atau langsung redirect dengan data
        session([
            'gtotal' => $gtotal,
            'orderId' => $orderId
        ]);

        $stokTerbaru = null; 

        $results = DB::table('transaction')
            ->where('order_id', '=', $orderId)
            ->select('idproduct', 'idvar', 'qty', 'kota_pengiriman')
            ->get();

        foreach ($results as $result) {
            $idproduct = $result->idproduct;
            $idvar = $result->idvar;
            $qty = $result->qty;
            $kota_pengiriman = $result->kota_pengiriman;

            $stokTerbaru = DB::table('stok')
                ->where('idproduct', $idproduct)
                ->where('idvar', $idvar)
                ->where('kota', $kota_pengiriman)
                ->value('stok');

            if ($stokTerbaru == 0) {
                DB::table('transaction')
                ->where('order_id', '=', $orderId)
                ->delete();

                return response()->json([
                    'status' => 'failed', 
                ]);

            } else {
                return response()->json([
                    'status' => 'success'
                ]);
            }
        }       
    }

    public function index()
    {
        $gtotal = session('gtotal');
        $orderId = session('orderId');
        return view('manualpayment', compact('gtotal','orderId'));
    }

    public function konfirmasiPembayaran()
    {
        $gtotal = session('gtotal');
        $orderId = session('orderId');
        return view('konfirmasipembayaran', compact('gtotal','orderId'));
    }

    public function storePembayaran(Request $request)
    {
        try {
            $validated = $request->validate([
                'iduser' => 'required|numeric',
                'order_id' => 'required|numeric|unique:bukti_transaksi,order_id',
                'bank_tujuan' => 'required|string',
                'bank_asal' => 'required|string',
                'pemilik_rekening' => 'required|string',
                'no_rekening_pemilik' => 'required|numeric',
                'tanggal_pembayaran' => 'required|date',
                'total_bayar' => 'required|numeric',
            ]);

            $fileName = session('fileName');
            if (!$fileName) {
                return response()->json(['error' => 'File not found in session'], 404);
            }

            $tempPath = storage_path('app/public/temp_uploads/' . $fileName);
            if (!Storage::exists('public/temp_uploads/' . $fileName)) {
                return response()->json(['error' => 'File not found'], 404);
            }
        
            $productImagePath = 'resi/' . $fileName;
            rename($tempPath, $productImagePath);

            BuktiTransaksi::create([
                'iduser' => $validated['iduser'],
                'order_id' => $validated['order_id'],
                'url_resi' => $productImagePath,
                'bank_tujuan' => $validated['bank_tujuan'],
                'bank_asal' => $validated['bank_asal'],
                'pemilik_rekening' => $validated['pemilik_rekening'],
                'no_rekening_pemilik' => $validated['no_rekening_pemilik'],
                'tanggal_pembayaran' => $validated['tanggal_pembayaran'],
                'total_bayar' => $validated['total_bayar'],
                'keterangan' => $request->keterangan
            ]);

            $stokTerbaru = null; 

            $results = DB::table('transaction')
                ->where('order_id', '=', $validated['order_id'])
                ->select('idproduct', 'idvar', 'qty', 'kota_pengiriman')
                ->get();

            foreach ($results as $result) {
                $idproduct = $result->idproduct;
                $idvar = $result->idvar;
                $qty = $result->qty;
                $kota_pengiriman = $result->kota_pengiriman;

                $stokTerbaru = DB::table('stok')
                    ->where('idproduct', $idproduct)
                    ->where('idvar', $idvar)
                    ->where('kota', $kota_pengiriman)
                    ->value('stok');

                if ($stokTerbaru == 0) {
                    DB::table('transaction')
                    ->where('order_id', '=', $validated['order_id'])
                    ->delete();

                    return response()->json([
                        'status' => 'failed', 
                    ]);

                } else {
                    DB::table('stok')
                        ->where('idproduct', $idproduct)
                        ->where('idvar', $idvar)
                        ->where('kota', $kota_pengiriman)
                        ->decrement('stok', $qty);
    
                    DB::table('transaction')
                    ->where('order_id', '=', $validated['order_id'])
                    ->update([
                        'status' => 'diproses',
                    ]);
    
                    return response()->json([
                        'status' => 'success', 
                        'message' => 'berhasil diupload'
                    ]);
                }
            }       

        } catch (\Illuminate\Validation\ValidationException $e) {
                $errors = $e->validator->errors()->all();
                return response()->json(['errors' => $errors], 422);
        }
    }
    
    public function tampil_ongkir(Request $request)
    {
        // Daftar kecamatan dengan ongkir gratis
        $gratisOngkirKecamatan = [
            'TAMBAKSARI', 'GUBENG', 'RUNGKUT', 'TENGGILIS MEJOYO', 
            'GUNUNG ANYAR', 'SUKOLILO', 'MULYOREJO'
        ];

        if ($request->courier === 'dsc') {

            $biayaOngkir = in_array($request->kecamatan, $gratisOngkirKecamatan) ? 0 : 30000;
            
            return response()->json([
                'surabaya_costs' => [
                    [
                        'service' => 'DSC Kurir',
                        'description' => 'Pengiriman khusus Surabaya',
                        'etd' => '1 Hari',
                        'cost' => $biayaOngkir
                    ]
                ]
            ]);
        } else {
            $kecamatanReplace = str_replace(' ', '%20', $request->kecamatan);
            $kecamatan = $request->kecamatan;
            $kelurahan = $request->kelurahan;
            $kotaCust = str_replace(['KOTA ', 'KABUPATEN '], '', $request->kotaCust);
    
            $kota = $request->kota;
            $originMap = [
                'Surabaya' => '69242',
                'Malang' => '46749',
                'Kediri' => '34056',
                'Solo' => '61643',
                'Denpasar' => '26035',
                'Yogyakarta' => '31599',
            ];
    
            $origin = $originMap[$kota] ?? null;
    
            $data = Http::withHeaders([
                'key' =>  'key'])
                ->withOptions(["verify"=>false])
                ->get("https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=$kecamatanReplace&limit=50&offset=0");
            
            $result = $data->json();
    
            // dd([
            //     'kecamatan replace' => $kecamatanReplace,
            //     'kecamatan' => $kecamatan,
            //     'kelurahan_input' => $kelurahan,
            //     'kotaCust_input' => $kotaCust,
            //     'city_names_in_api' => collect($result['data'])->pluck('city_name')->unique(),
            //     'subdistrict_names_in_api' => collect($result['data'])->pluck('subdistrict_name')->unique(),
            //     'district_names_in_api' => collect($result['data'])->pluck('district_name')->unique(),
            // ]);
            
    
            if (!isset($result['data']) || !is_array($result['data']) || count($result['data']) == 0) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }
    
            $filteredData = collect($result['data'])->firstWhere(function ($item) use ($kelurahan, $kotaCust) {
                $cleanCityName = str_replace(['KOTA ', 'KABUPATEN '], '', $item['city_name']);
            
                // Pencarian LIKE untuk kelurahan
                $isKelurahanMatch = Str::contains(strtolower($item['subdistrict_name']), strtolower($kelurahan));
                $isKotaMatch = strcasecmp($cleanCityName, $kotaCust) === 0;
            
                return $isKelurahanMatch && $isKotaMatch;
            });
            
            
            $destinationId = $filteredData['id'];
    
            // // // Jika data ditemukan, ambil "id", jika tidak kirimkan pesan error
            // if ($filteredData) {
            //     return response()->json(['id' => $destinationId]);
            // } else {
            //     return response()->json(['message' => 'Data tidak ditemukan'], 404);
            // }
    
            $ongkir = Http::withHeaders([
                    'key' =>  'key',
                    'content-type' => 'application/x-www-form-urlencoded'])
                        ->withOptions(["verify"=>false])
                        ->asForm()->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                    'origin'      => $origin,
                    'destination' => $destinationId,
                    'weight'      => $request->weight,
                    'courier'     => $request->courier]);
        
            $result = $ongkir->json(); // Convert JSON response to array
    
            if (!isset($result['data']) || !is_array($result['data']) || count($result['data']) == 0) {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }
            
            // Mengambil hanya isi dari "data"
            return response()->json([
                'shipping_costs' => $result['data'] // Memasukkan isi "data" ke response
            ]);
        }
       
                
        // return response($response->body(), $response->status())
        // ->header('Content-Type', 'application/json');
    }

    public function storeOrderPreview(Request $request)
    {
      $orderData = [
            'nama' => $request->nama,
            'phone' => $request->phone,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'provinsi' => $request->provinsi,
            'courier' => $request->listCourier,
            'weight' => $request->listWeight,
            'listProduk' => $request->listProduk,
            'listLayanan' => $request->listLayanan
        ];

        session(['order_preview' => $orderData]);

        return response()->json(['success' => true, 'redirect' => route('order.preview')]); 

        // dd($orderData);
    }

    public function orderPreview (Request $request)
    {
        $orderData = session('order_preview');

        if (!$orderData) {
            return redirect()->route('checkout')->with('error', 'Tidak ada order yang ditemukan.');
        }

        $prefix = now()->format('ym'); // hasil: 2507 (untuk Juli 2025)

        // Ambil angka urutan terakhir berdasarkan prefix bulan
        $lastNumber = DB::table('transaction')
            ->where('order_id', 'like', $prefix . '%')
            ->select(DB::raw('MAX(CAST(SUBSTRING(order_id, 5) AS UNSIGNED)) as last_number'))
            ->value('last_number');

        // Hitung nomor berikutnya
        $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

        // Gabungkan prefix dan nomor
        $orderId = $prefix . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
    
        return view('orderpreview', compact('orderData','orderId'));
    }

    public function storeTransaction (Request $request)
    {

        $idUser = auth()->user()->id;

        $transactions = [];
        
        $listProductName = $request->listProductName;
        $listSku = $request->listSku;
        $listQty = $request->listQty;
        $listCourierCost = $request->listCourierCost;
        $kurirDesc = $request->kurirDesc;
        
        foreach ($request->kota as $indexKota => $kotaName) {
            foreach ($listProductName as $index => $fullProductName) {
                // Ambil produk sesuai dengan kota
                if (Str::endsWith($fullProductName, ',' . $kotaName)) {
                    $productName = Str::before($fullProductName, ','); // Hapus kota dari nama produk
        
                    $idProduct = Produk::where('productname', $productName)->value('id');
                    $idVar = Variations::where('sku', $listSku[$index])->value('id');
                    $orderId = str_pad($request->orderId, 4, '0', STR_PAD_LEFT);
        
                    // Pastikan ID produk dan variasi ditemukan
                    if ($idProduct && $idVar) {
                        // Cek apakah transaksi sudah ada
                        $existingTransaction = Transaction::where([
                            'order_id' => $orderId,
                            'iduser' => $idUser,
                            'idproduct' => $idProduct,
                            'idvar' => $idVar,
                            'kota_pengiriman' => $kotaName,
                            'qty' => $listQty[$index] ?? 1,
                            'courier_service' => $kurirDesc[$indexKota] ?? '',
                        ])->exists(); // Cek apakah sudah ada
                        
                        // Jika tidak ada, tambahkan ke array transaksi
                        if (!$existingTransaction) {
                            $transactions[] = [
                                'order_id' => $orderId,
                                'iduser' => $idUser,
                                'idproduct' => $idProduct,
                                'idvar' => $idVar,
                                'courier_service' => $kurirDesc[$indexKota] ?? '',
                                'courier_cost' => $listCourierCost[$indexKota] ?? 0,
                                'kota_pengiriman' => $kotaName,
                                'qty' => $listQty[$index] ?? 1,
                                'discount' => '0',
                                'status' => 'belum-dibayar',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }
                    }
                }
            }
        }
        
        // Insert batch untuk efisiensi database jika ada transaksi baru
        if (!empty($transactions)) {
            Transaction::insert($transactions);
        }
        
        // Ambil transaksi terakhir yang dibuat oleh pelanggan
        $lastTransaction = Transaction::where('iduser', $idUser)
                                      ->orderBy('created_at', 'desc')
                                      ->first();
        
        if ($lastTransaction) {

        DB::table('cart')
                ->where('iduser', '=', auth()->user()->id)
                ->delete();

        return response()->json([
            'success' => true,
            'redirect_url' => route('dashboard'),
        ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada transaksi baru yang diproses.',
            ]);
        }
                                     
    }
    
    public function handleFinish(Request $request)
    {
        // Ambil parameter dari request
        $orderId = $request->query('order_id');
        $transactionStatus = $request->query('transaction_status');
    
        // Cari semua transaksi berdasarkan order_id
        $transactions = Transaction::where('order_id', $orderId)->get();
    
        if ($transactions->isNotEmpty()) {
            foreach ($transactions as $transaction) {
                // Update status transaksi sesuai dengan status pembayaran dari Midtrans
                if ($transactionStatus === 'settlement') {
                    $transaction->status = 'diproses';
                } elseif ($transactionStatus === 'pending') {
                    $transaction->status = 'belum-dibayar';
                } elseif ($transactionStatus === 'expire' || $transactionStatus === 'cancel') {
                    $transaction->status = 'dibatalkan';
                }
    
                // Simpan perubahan di database
                $transaction->save();
            }
        }
    
        // Ambil status dari transaksi terakhir atau default ke 'belum-dibayar'
        $lastStatus = $transactions->last()->status ?? 'belum-dibayar';
    
        // Redirect ke halaman dengan status transaksi terakhir
        return redirect()->route('dashboard', ['status' => $lastStatus ?? 'belum-dibayar']);
    }


    public function paymentMidtrans(Request $request)
    {
        $resp = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            ])->withOptions(['verify' => false])
            ->withBasicAuth('xxx', '')
            ->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
                'transaction_details' => [
                    'order_id' => $request->orderId,
                    'gross_amount' => $request->grandTotal
                ]
            ]);
        
        if ($resp->status() == 201 || $resp->status() == 200) 
        {
        /*  $vaNumbers = $resp->json('va_numbers');
        
        if (empty($vaNumbers) || !is_array($vaNumbers)) {
            return response()->json(['message' => $resp['status_message']], 500);
        }
        
        // Ambil va_number dari elemen pertama array
        $vaNumber = $vaNumbers[0]['va_number'] ?? null;
        
        if (!$vaNumber) {
            return response()->json(['message' => 'VA Number not found'], 500);
        } */

        DB::table('transaction')
        ->where('order_id', '=', $request->orderId)
        ->update([
            'url_midtrans' => $resp->json('redirect_url')
        ]);
        
        return response()->json(['redirect' => $resp->json('redirect_url')]);
        }
        
        return response()->json(['status' => 'error', 'message' => $resp->body()], 200);
    }

    public function fetchTransaction(Request $request)
    {
        // $status = $request->query('status', 'belum-dibayar');
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
                ->where('transaction.iduser', auth()->user()->id)
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
                    'transaction.idproduct',
                    'transaction.idvar',
                    'transaction.rating'
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
                    'transaction.idproduct',
                    'transaction.idvar',
                    'transaction.rating'
                )
                ->get();

                $orders = []; // untuk menyimpan total per order_id

foreach ($transaction as $row) {
    $orderId = $row->order_id;
    $kota = $row->kota_pengiriman;

    // Inisialisasi order_id jika belum ada
    if (!isset($orders[$orderId])) {
        $orders[$orderId] = [
            'per_kota' => [],
            'total_belanja' => 0,
            'total_kurir' => 0,
            'total_pembayaran' => 0
        ];
    }

    // Inisialisasi kota di dalam order ini
    if (!isset($orders[$orderId]['per_kota'][$kota])) {
        $orders[$orderId]['per_kota'][$kota] = [
            'subtotal' => 0,
            'courier_cost' => $row->courier_cost
        ];
    }

    // Hitung subtotal produk
    $subtotal = $row->priceafter * $row->qty;

    // Tambahkan subtotal ke kota
    $orders[$orderId]['per_kota'][$kota]['subtotal'] += $subtotal;
}

// Hitung total per order_id
foreach ($orders as $orderId => &$orderData) {
    foreach ($orderData['per_kota'] as $kota => $data) {
        $orderData['total_belanja'] += $data['subtotal'];
        $orderData['total_kurir'] += $data['courier_cost'];
    }
    $orderData['total_pembayaran'] = $orderData['total_belanja'] + $orderData['total_kurir'];
}

        $rincian = DB::table('transaction')
                ->join('product_images', 'transaction.idproduct', '=', 'product_images.product_idproduct')
                ->join('products', 'product_images.product_idproduct', '=', 'products.id')
                ->join('variations', 'transaction.idvar', '=', 'variations.id')
                ->join('users', 'transaction.iduser', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
                ->where('transaction.order_id', $request->orderId)
                ->where('status', 'diproses')
                ->select(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                )
                ->groupBy(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                )
                ->get();

    
        return view('partials.transaction-list', compact('transaction', 'rincian', 'orders'));
    }

    public function fetchTransactionResponsive(Request $request)
    {
        // $status = $request->query('status', 'belum-dibayar');
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
                ->where('transaction.iduser', auth()->user()->id)
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
                    'transaction.idproduct',
                    'transaction.idvar',
                    'transaction.rating'
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
                    'transaction.idproduct',
                    'transaction.idvar',
                    'transaction.rating'
                )
                ->get();

                 $orders = []; // untuk menyimpan total per order_id

foreach ($transaction as $row) {
    $orderId = $row->order_id;
    $kota = $row->kota_pengiriman;

    // Inisialisasi order_id jika belum ada
    if (!isset($orders[$orderId])) {
        $orders[$orderId] = [
            'per_kota' => [],
            'total_belanja' => 0,
            'total_kurir' => 0,
            'total_pembayaran' => 0
        ];
    }

    // Inisialisasi kota di dalam order ini
    if (!isset($orders[$orderId]['per_kota'][$kota])) {
        $orders[$orderId]['per_kota'][$kota] = [
            'subtotal' => 0,
            'courier_cost' => $row->courier_cost
        ];
    }

    // Hitung subtotal produk
    $subtotal = $row->priceafter * $row->qty;

    // Tambahkan subtotal ke kota
    $orders[$orderId]['per_kota'][$kota]['subtotal'] += $subtotal;
}

// Hitung total per order_id
foreach ($orders as $orderId => &$orderData) {
    foreach ($orderData['per_kota'] as $kota => $data) {
        $orderData['total_belanja'] += $data['subtotal'];
        $orderData['total_kurir'] += $data['courier_cost'];
    }
    $orderData['total_pembayaran'] = $orderData['total_belanja'] + $orderData['total_kurir'];
}

        $rincian = DB::table('transaction')
                ->join('product_images', 'transaction.idproduct', '=', 'product_images.product_idproduct')
                ->join('products', 'product_images.product_idproduct', '=', 'products.id')
                ->join('variations', 'transaction.idvar', '=', 'variations.id')
                ->join('users', 'transaction.iduser', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
                ->where('transaction.order_id', $request->orderId)
                ->where('status', 'diproses')
                ->select(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                )
                ->groupBy(
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'transaction.qty',
                    'transaction.courier_service',
                    'transaction.courier_cost',
                    'transaction.kota_pengiriman',
                )
                ->get();

    
        return view('partials.transaction-list-responsive', compact('transaction', 'rincian', 'orders'));
    }
    
    public function delete(Request $request)
    {
        DB::table('transaction')
        ->where('order_id', $request->orderId )
        ->where('iduser', auth()->user()->id)
        ->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Transaction deleted successfully'
        ]);
    }

    public function kirim(Request $request)
    {
        $fileName = session('fileName');
        $hasFile = false;
        $productImagePath = null;

        // Cek apakah fileName tersedia di session
        if ($fileName) {
            $tempPath = storage_path('app/public/temp_uploads/' . $fileName);

            // Cek apakah file benar-benar ada di storage
            if (Storage::exists('public/temp_uploads/' . $fileName)) {
                $productImagePath = 'surat-jalan/' . $fileName;
                rename($tempPath, $productImagePath);
                $hasFile = true;
            }
        }

        // Siapkan data yang akan diupdate
        $updateData = [
            'status' => 'dalam-pengiriman',
            'no_resi' => $request->noResi,
        ];

        // Jika ada file, tambahkan ke update data
        if ($hasFile) {
            $updateData['url_suratjalan'] = $productImagePath;
        }

        // Lakukan update ke database
        DB::table('transaction')
            ->where('order_id', $request->indexOrderId)
            ->where('kota_pengiriman', auth()->user()->username)
            ->update($updateData);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function selesai(Request $request)
    {
        DB::table('transaction')
        ->where('order_id', $request->orderId )
        ->where('idproduct', $request->idProduct )
        ->where('idvar', $request->idVar )
        ->where('kota_pengiriman', $request->kota )
        ->update([
            'status' => 'selesai'
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function rating(Request $request)
    {
        DB::table('transaction')
        ->where('order_id', $request->orderId )
        ->where('idproduct', $request->idProduct )
        ->where('idvar', $request->idVar )
        ->where('kota_pengiriman', $request->kota )
        ->update([
            'rating' => $request->rating
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function batalTransaksi(Request $request)
    {
        DB::table('transaction')
        ->where('order_id', $request->orderId )
        ->update([
            'status' => 'dibatalkan'
        ]);

        // Mengambil seluruh baris yang sesuai dengan order_id
        $results = DB::table('transaction')
            ->where('order_id', $request->orderId)
            ->select('idproduct', 'idvar', 'qty', 'kota_pengiriman')
            ->get();

        // Melakukan iterasi untuk setiap baris yang ditemukan
        foreach ($results as $result) {
            $idproduct = $result->idproduct;
            $idvar = $result->idvar;
            $qty = $result->qty;
            $kota_pengiriman = $result->kota_pengiriman;

            // Update stok dengan mengurangi qty sesuai kondisi
            DB::table('stok')
                ->where('idproduct', $idproduct)
                ->where('idvar', $idvar)
                ->where('kota', $kota_pengiriman)
                ->increment('stok', $qty);  // Menambah stok, jika ingin mengurangi gunakan 'decrement'
        }

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function storeKomplain(Request $request)
    {
        try {
            $validated = $request->validate([
                'order_id' => 'required|numeric',
                'keterangan_komplain' => 'required|string',
                'nama_produk' => 'required|string',
                'sku' => 'required|string'
            ]);

            $product = \App\Models\Produk::where('productname', $validated['nama_produk'])->first();
            $variation = \App\Models\Variations::where('sku', $validated['sku'])->first();

            $productId = $product->id;
            $variationId = $variation->id;

            $fileName = session('videoKomplain');
            if (!$fileName) {
                return response()->json(['error' => 'File not found in session'], 404);
            }

            $tempPath = storage_path('app/public/temp_uploads/' . $fileName);
            if (!Storage::exists('public/temp_uploads/' . $fileName)) {
                return response()->json(['error' => 'File not found'], 404);
            }
        
            $videoKomplainPath = 'video-komplain/' . $fileName;
            rename($tempPath, $videoKomplainPath);

            DB::table('transaction')
                ->where('order_id', '=', $validated['order_id'])
                ->where('idproduct', '=', $productId)
                ->where('idvar', '=', $variationId)
                ->update([
                    'status' => 'dikomplain',
                    'url_komplain' => $videoKomplainPath,
                    'keterangan_komplain' => $validated['keterangan_komplain']
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'berhasil diupload'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
                $errors = $e->validator->errors()->all();
                return response()->json(['errors' => $errors], 422);
        }
    }

    public function urlMidtrans(Request $request)
    {
        $url = DB::table('transaction')
                ->where('order_id', '=', $request->orderId)
                ->value('url_midtrans');

        return response()->json(['url' => $url]);   
    }
}