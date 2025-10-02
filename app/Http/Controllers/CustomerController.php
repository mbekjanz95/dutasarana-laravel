<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\District;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Mailgun\Mailgun;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data transaksi yang terkait dengan pengguna yang sedang login
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
            ->where('transaction.status', 'belum-dibayar')
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



        // Ambil data rincian transaksi berdasarkan order_id
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

        // Mengirimkan data ke view
        return view('dashboard', compact('transaction', 'rincian', 'orders'));
    }

    public function histori(Request $request)
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
            ->where('transaction.iduser', auth()->user()->id)
            ->where('transaction.status', 'belum-dibayar')
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
                'transaction.url_suratjalan',
                'customer.customername',
                'customer.address',
                'customer.phone',
                'provinces.province',
                'cities.name AS city_name',
                'district.name AS district_name',
                'kelurahan.name AS kelurahan_name',
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
                'transaction.url_suratjalan',
                'customer.customername',
                'customer.address',
                'customer.phone',
                'provinces.province',
                'cities.name',
                'district.name',
                'kelurahan.name',
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

        // Ambil data rincian transaksi berdasarkan order_id
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

        // Mengirimkan data ke view
        return view('historitransaksi', compact('transaction', 'rincian', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'customername' => 'required|string',
                'username' => 'required|string|max:10|unique:users,username',
                'phone' => 'required|unique:customer,phone',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|max:10'
            ]);
    
            // Mulai transaksi database
            DB::beginTransaction();
    
            // Simpan data ke tabel customer
            $customer = Customer::create([
                'customername' => $validated['customername'],
                'phone' => $validated['phone'],
            ]);
    
            // Simpan data ke tabel users dengan idcust dari tabel customer
            $user = User::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'idcust' => $customer->id, // Ambil ID dari customer
            ]);
    
            // Commit transaksi
            DB::commit();

            if ($user)
            {
                $token = Auth::guard('api')->login($user);
                return $this->responseWithToken($token, $user);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Error occured'
                ]);
            }

            return response()->json([
                'message' => 'Data successfully created',
                'customer' => $customer,
            ], 201);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        } /* catch (\Exception $e) {
            // Rollback jika terjadi kesalahan
            DB::rollBack();
            return response()->json(['error' => 'Failed to create data', 'message' => $e->getMessage()], 500);
        }  */
    }

    public function responseWithToken($token, $user)
    {
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'access_token' => $token,
            'type' => 'bearer'
        ]);
    }


    public function sendWithMailgun()
    {
        $mg = Mailgun::create(env('MAILGUN_SECRET'), 'https://api.mailgun.net'); 

        $mg->messages()->send(env('MAILGUN_DOMAIN'), [
            'from'    => 'mailgun@dutasarana.com',
            'to'      => 'rizkyyanuar@rocketmail.com',
            'subject' => 'Hello from Mailgun',
            'text'    => 'Testing some Mailgun awesomeness in Laravel!',
        ]);

        return 'Email sent with Mailgun API!';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function tampilAlamat()
    {
        $alamat=DB::table('customer')
                ->join('users', 'customer.id', '=', 'users.idcust')
                ->join('provinces', 'customer.province_id', '=', 'provinces.province_id')
                ->join('cities', 'customer.id_kabupaten', '=', 'cities.id_kabupaten')
                ->join('district', 'customer.id_kecamatan', '=', 'district.id')
                ->join('kelurahan', 'customer.id_kelurahan', '=', 'kelurahan.id')
                ->where('users.id', auth()->user()->id)
                ->select(
                'customer.customername',
                'customer.address',
                'provinces.province',
                'cities.name AS city_name',  
                'district.name AS district_name',
                'kelurahan.name AS kelurahan_name'
                )
                ->get();

        $alamatCheck =  DB::table('customer')
                        ->join('users', 'customer.id', '=', 'users.idcust')
                        ->where('users.id', auth()->user()->id)
                        ->select('customer.address')
                        ->first();

        return view('listalamat', compact('alamat','alamatCheck'));
    }

    public function selectValue()
    {
        $provinsi = Province::all();
        $kota = City::all(); 
        $kecamatan = District::all(); 
        $customerName = DB::table('customer')
                        ->join('users', 'customer.id', '=', 'users.idcust')
                        ->leftJoin('provinces', 'customer.province_id', '=', 'provinces.province_id')
                        ->leftJoin('cities', 'customer.id_kabupaten', '=', 'cities.id_kabupaten')
                        ->leftJoin('district', 'customer.id_kecamatan', '=', 'district.id')
                        ->leftJoin('kelurahan', 'customer.id_kelurahan', '=', 'kelurahan.id')
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
                        ->first();

        return view('tambahalamat', compact('provinsi','kota','kecamatan','customerName'));
    }

    public function areaList (Request $request)
    {
        $city = DB::table('cities')
                ->join('provinces', 'cities.id_provinsi', '=', 'provinces.province_id')
                ->where('cities.id_provinsi', $request->idprov)
                ->select('cities.name','cities.id_kabupaten')
                ->get();

        $district = DB::table('district')
                ->join('cities', 'cities.id_kabupaten', '=', 'district.id_kabupaten')
                ->where('district.id_kabupaten', $request->idCity)
                ->select('district.name','district.id')
                ->get();

        $kelurahan = DB::table('kelurahan')
                ->join('district', 'district.id', '=', 'kelurahan.id_kecamatan')
                ->where('kelurahan.id_kecamatan', $request->idDistrict)
                ->select('kelurahan.name','kelurahan.id')
                ->get();

        return response()->json([
            'city' => $city,
            'district' => $district,
            'kelurahan' => $kelurahan
        ]);
    }

    public function tambahAlamat(Request $request)
    {
        try {
            // Ambil user yang sedang login menggunakan session
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unauthorized'
                ], 401);
            }
    
            // Validasi input alamat
            $validated = $request->validate([
                'address' => 'required|string',
            ]);
    
            // Ambil data customer berdasarkan idcust dari user yang login
            $customer = DB::table('customer')->where('id', $user->idcust)->first();
    
            if (!$customer) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Customer not found'
                ], 404);
            }
    
            // Update alamat customer
            DB::table('customer')
                ->where('id', $user->idcust)
                ->update([
                    'address' => $validated['address'],
                    'province_id' => $request->idProv,
                    'id_kabupaten' => $request->idKota,
                    'id_kecamatan' => $request->idKecamatan,
                    'id_kelurahan' => $request->idKelurahan,
                    'postal_code' => $request->postal_code
                ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Alamat berhasil diperbarui',
            ], 200);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function servis(Request $request)
    {
        $status = $request->query('status', 'belum-dibayar');
        $service = DB::table('service')
            ->where('status', 'menunggu-konfirmasi')
            ->where('id_user', '=', auth()->user()->id)
            ->select(
                'no_so',
                'nama_teknisi', 
                'analisa_teknisi',  
                'solusi_saran', 
                'part_diganti', 
                'status_sparepart',
                'harga',
                'tanggal_masuk',
                'merk',
                'unit_diterima',
                'keluhan'
            )
            ->groupBy(
                'no_so',
                'nama_teknisi', 
                'analisa_teknisi',  
                'solusi_saran', 
                'part_diganti', 
                'status_sparepart',
                'harga',
                'tanggal_masuk',
                'merk',
                'unit_diterima',
                'keluhan'
            )
            ->get();

       $groupedData = DB::table('service')
                ->where('status', 'menunggu-konfirmasi')
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
                ->groupBy('no_so'); // Grouping by no_so
    
        return view('serviceuser', compact('service','groupedData'));
    }

    public function komplain(Request $request)
    {
        $orderId = $request->orderId;
        $tanggalPengiriman = $request->tanggalPengiriman;
        $namaProduk = $request->namaProduk;
        $kotaPengiriman = $request->kotaPengiriman;
        $kurir = $request->kurir;
        $sku = $request->sku;
        $qty = $request->qty;
        $biayaKurir = $request->biayaKurir;
        $fotoProduk = $request->fotoProduk;
        $harga = $request->harga;

        // Simpan ke session atau langsung redirect dengan data
        session([
            'orderIdKomplain' => $orderId,
            'tanggalPengiriman' => $tanggalPengiriman,
            'namaProduk' => $namaProduk,
            'kotaPengiriman' => $kotaPengiriman,
            'kurir' => $kurir,
            'sku' => $sku,
            'qty' => $qty,
            'biayaKurir' => $biayaKurir,
            'fotoProduk' => $fotoProduk,
            'harga' => $harga
        ]);

        // Redirect ke halaman lain atau kembalikan response JSON
        return response()->json(['status' => 'success']);
    }

    public function komplainShow(Request $request)
    {
        $orderId = session('orderIdKomplain');
        $tanggalPengiriman = session('tanggalPengiriman');
        $namaProduk = session('namaProduk');
        $kotaPengiriman = session('kotaPengiriman');
        $kurir = session('kurir');
        $sku = session('sku');
        $qty = session('qty');
        $biayaKurir = session('biayaKurir');
        $fotoProduk = session('fotoProduk');
        $harga = session('harga');

        return view('komplain', compact(
            'orderId','tanggalPengiriman',
            'namaProduk','kotaPengiriman',
            'kurir','sku',
            'qty','biayaKurir',
            'fotoProduk','harga'
        ));
    }

    public function ubahProfil(Request $request)
    {
        try {
            $validated = $request->validate([
                'customername' => 'required|string'
            ]);

            DB::table('customer')
                ->where('id', '=', auth()->user()->idcust)
                ->update([
                    'customername' => $validated['customername']
                ]);

            return response()->json([
                'message' => 'Data successfully updated'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function ubahUsername(Request $request)
    {
        try {
            $validated = $request->validate([
                'username' => 'required|string|max:10|unique:users,username,' . auth()->user()->id
            ]);

            DB::table('users')
                ->where('idcust', '=', auth()->user()->idcust)
                ->update([
                    'username' => $validated['username'],
                ]);

            return response()->json([
                'message' => 'Data successfully updated'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function ubahPhone(Request $request)
    {
        try {
            $validated = $request->validate([
                'phone' => 'required|unique:customer,phone'
            ]);

            DB::table('customer')
                ->where('id', '=', auth()->user()->idcust)
                ->update([
                    'phone' => $validated['phone']
                ]);

            return response()->json([
                'message' => 'Data successfully updated'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function ubahPassword(Request $request)
    {
        try {
            $validated = $request->validate([
                'password' => 'required|string|min:6|max:10'
            ]);

            DB::table('users')
                ->where('idcust', '=', auth()->user()->idcust)
                ->update([
                    'password' => Hash::make($validated['password'])
                ]);

            return response()->json([
                'message' => 'Data successfully updated'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }

    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}