<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\Customer;
use App\Models\Produk;
use App\Models\Stok;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    public function binder()
    {
    //     $response = Http::withHeaders([
    //         'api_key' =>  'api_key',
    //         'id_kabupaten' =>  '11.71'])
    //         ->withOptions(["verify"=>false])
    //         ->get('URL');

        $destinationId = Http::withHeaders([
            'key' =>  'key'])
            ->withOptions(["verify"=>false])
            ->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination?search=gubeng&limit=50&offset=0');

        // return response($destinationId->body(), $destinationId->status())
        // ->header('Content-Type', 'application/json');

         $data = $destinationId->json('data'); 

        return response()->json($data);

        // return response()->json($destinationId);
    }

    public function admin()
    {
        $produkQuery = Produk::query()  
        ->join('categories', 'products.idcategory', '=', 'categories.id')
        ->join('variations', 'variations.product_idproduct', '=', 'products.id')
        ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
        ->select(
            'products.id',
            'products.productname', 
            'product_images.imagepath',
            'categories.catname',
            DB::raw('MIN(variations.pricebefore) as pricebefore'),
            DB::raw('MIN(variations.priceafter) as priceafter')
        )
        ->groupBy(
            'products.id',
            'products.productname', 
            'product_images.imagepath', 
            'categories.catname'
        );

        $produk = $produkQuery->paginate(20);

        $produkStok = Stok::query()
            ->join('products', 'stok.idproduct', '=', 'products.id')
            ->whereIn('products.id', $produkQuery->pluck('id')) 
            ->where('stok.kota', auth()->user()->username)
            ->get()
            ->groupBy('idproduct') 
            ->map(function($stokGroup) {
                return $stokGroup->sum('stok'); 
        });

        if (auth()->user()->username !== 'Surabaya') {
            return view('admins', compact('produk', 'produkStok'));
        }

            return view('admin', compact('produk', 'produkStok'));
    }

    public function editProduk($productname)
    {
        $produk = Produk::query()  
        ->join('categories', 'products.idcategory', '=', 'categories.id')
        ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
        ->join('variations', 'products.id', '=', 'variations.product_idproduct')
        ->where('products.productname', $productname)
        ->select('products.*', 
        'product_images.imagepath', 
        'product_images.imagepath_2',  
        'product_images.imagepath_3', 
        'product_images.imagepath_4', 
        'product_images.imagepath_5',
        'product_images.product_idproduct',
        'variations.value', 
        'categories.catname', 
        'variations.sku', 
        'variations.priceafter')
        ->first();

        $variasi = Produk::query()  
        ->join('variations', 'products.id', '=', 'variations.product_idproduct')
        ->where('products.productname', $productname)
        ->select('variations.*')
        ->get();


        if (auth()->user()->username !== 'Surabaya') {
            return view('produkedits', compact('produk', 'variasi'));
        }


        return view ('produkedit', compact('produk','variasi')); 
    }

    public function bestSeller()
    {
        $brands1 = ['pg-810', 'e410', 'cl-811', 'gi-790'];  
        $brands2 = ['%l3210%', '%HP%2875%', '%g1010%']; 

        $bestSeller1 = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
            ->join('variations', 'products.id', '=', 'variations.product_idproduct')
            ->join('categories', 'products.idcategory', '=', 'categories.id')
            ->where(function($query) use ($brands1) {
                foreach ($brands1 as $brand) {
                    $query->orWhere('products.productname', 'like', '%' . $brand . '%');
                }
            })
            ->select(
                'products.id',
                'products.productname', 
                'product_images.imagepath', 
                'categories.catname', 
                DB::raw('MIN(variations.pricebefore) as pricebefore'),
                DB::raw('MIN(variations.priceafter) as priceafter')
            )
            ->groupBy(
                'products.id',
                'products.productname', 
                'product_images.imagepath', 
                'categories.catname'
            )
            ->get();

        $bestSeller2 = DB::table('products')
        ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
        ->join('variations', 'products.id', '=', 'variations.product_idproduct')
        ->join('categories', 'products.idcategory', '=', 'categories.id')
        ->where(function($query) use ($brands2) {
            foreach ($brands2 as $brand) {
                $query->orWhere('products.productname', 'like',  $brand);
            }
        })
        ->select(
            'products.id',
            'products.productname', 
            'product_images.imagepath', 
            'categories.catname', 
            DB::raw('MIN(variations.pricebefore) as pricebefore'),
            DB::raw('MIN(variations.priceafter) as priceafter')
        )
        ->groupBy(
            'products.id',
            'products.productname', 
            'product_images.imagepath', 
            'categories.catname'
        )
        ->get();

        $epson = DB::table('products')
        ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
        ->join('variations', 'products.id', '=', 'variations.product_idproduct')
        ->join('categories', 'products.idcategory', '=', 'categories.id')
        ->where(function($query) use ($brands2) {
            foreach ($brands2 as $brand) {
                $query->orWhere('products.productname', '=',  'EPSON PRINTER L121');
            }
        })
        ->select(
            'products.id',
            'products.productname', 
            'product_images.imagepath', 
            'categories.catname', 
            DB::raw('MIN(variations.pricebefore) as pricebefore'),
            DB::raw('MIN(variations.priceafter) as priceafter')
        )
        ->groupBy(
            'products.id',
            'products.productname', 
            'product_images.imagepath', 
            'categories.catname'
        )
        ->get();
        

        return view('layouts.main', compact('bestSeller1','bestSeller2','epson'));
    }

    public function topCategories(Request $request) 
    {
        $produkQuery = Produk::query()  
            ->join('categories', 'products.idcategory', '=', 'categories.id')
            ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
            ->join('variations', 'variations.product_idproduct', '=', 'products.id');

        if (strtoupper($request->nama_produk) === 'LAINNYA') {
            $produkQuery->whereNotIn('categories.catname', ['LAPTOP', 'PERSONAL COMPUTER', 'PRINTER']);
        } else {
            $produkQuery->where('categories.catname', 'like', '%' . $request->nama_produk . '%');
        }

        $produkQuery->select( 
            'products.id',
            'products.productname', 
            'product_images.imagepath', 
            'categories.catname',
            DB::raw('MIN(variations.pricebefore) as pricebefore'),
            DB::raw('MIN(variations.priceafter) as priceafter')
        )
        ->groupBy(
            'products.id',
            'products.productname', 
            'product_images.imagepath', 
            'categories.catname'
        );  

        $produk = (clone $produkQuery)->paginate(20)->appends(['nama_produk' => $request->nama_produk]);
        $produkResponsive = (clone $produkQuery)->paginate(8)->appends(['nama_produk' => $request->nama_produk]);
        
        return view('listproduk', compact('produk', 'produkResponsive')); 
    }

    public function priceList()
    {
        $path = public_path('brosur');
        $files = File::files($path);
    
        $images = collect($files)->filter(function ($file) {
            $extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
            return in_array(strtolower($file->getExtension()), $extensions);
        });
    
        $currentPage = request()->get('page', 1);
        $perPage = 5;
        $paginatedImages = new LengthAwarePaginator(
            $images->forPage($currentPage, $perPage),
            $images->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );
    
    
        return view('pricelist', compact('paginatedImages'));
    }

    public function checkout()
    {
        $cart = DB::table('cart')
                ->join('stok', 'cart.idstok', '=', 'stok.id')
                ->join('product_images', 'cart.idimage', '=', 'product_images.id')
                ->join('products', 'stok.idproduct', '=', 'products.id')
                ->join('variations', 'stok.idvar', '=', 'variations.id')
                ->where('cart.iduser', auth()->user()->id)
                ->select(
                    'product_images.imagepath',
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'cart.qty',
                    'products.berat',
                    'stok.kota'
                )
                ->groupBy(
                    'product_images.imagepath',
                    'products.productname', 
                    'variations.priceafter', 
                    'variations.sku',
                    'cart.qty',
                    'products.berat',
                    'stok.kota'
                )
                ->get();

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
                'customer.phone',
                'provinces.province',
                'cities.name AS city_name',
                'district.name AS district_name',
                'kelurahan.name AS kelurahan_name'
                )
                ->get();

        // $listCabang = DB::table('cart')
        // ->join('stok', 'cart.idstok', '=', 'stok.id')
        // ->where('cart.iduser', auth()->user()->id)
        // ->select('stok.kota')
        // ->get();

        return view('checkout', compact('cart','alamat'));
    }

    public function statistik()
    {
        // Ambil data visitor harian
        $visitors = Visitor::selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return view('statistik', compact('visitors'));
    }

    public function pesanan(Request $request)
    {
        $status = $request->query('status', 'diproses');
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
                ->where('transaction.status', $status)
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
                    'kelurahan.name AS kelurahan_name'
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
                    'kelurahan.name'
                )
                ->get();

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

        if (auth()->user()->username !== 'Surabaya') {
            return view('pesanans', compact('transaction','rincian'));
        }

        return view('pesanan', compact('transaction','rincian'));
    }

    public function store(Request $request)
    {
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');

        // Simpan ke database, atau gunakan langsung ke Grab Express API

        return response()->json([
            'latitude' => $lat,
            'longitude' => $lng,
        ]);
    }

    public function statusService(Request $request)
    {
         $service = DB::table('service')
                ->join('users', 'service.id_user', '=', 'users.id')
                ->join('customer', 'users.idcust', '=', 'customer.id')
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

        return view('statusservice', compact('service'));
    }

    public function teknisiService(Request $request)
    {
        $service = DB::table('service')
                ->where('status', 'barang-diperiksa')
                ->whereNull('analisa_teknisi')
                ->select(
                    'id',
                    'serial_number',
                    'nama_teknisi'
                )
                ->get();

        return view('teknisiservice', compact('service'));
    }

     public function sparePart(Request $request)
    {
        $service = DB::table('service')
                ->where('status', 'barang-diperiksa')
                ->whereNotNull('analisa_teknisi')
                ->select(
                    'id',
                    'no_so',
                    'serial_number',
                    'nama_teknisi',
                    'analisa_teknisi',
                    'solusi_saran',
                    'part_diganti'
                )
                ->get();

        $validNoSo = DB::table('service')
                ->select('no_so')
                ->groupBy('no_so')
                ->havingRaw('COUNT(*) = COUNT(analisa_teknisi)')
                ->pluck('no_so'); 

        $service = DB::table('service')
                ->select(
                    DB::raw('MIN(id) as id'), // ambil id terkecil sebagai wakil
                    'no_so',
                    DB::raw('MIN(serial_number) as serial_number'),
                    DB::raw('MIN(nama_teknisi) as nama_teknisi'),
                    DB::raw('MIN(analisa_teknisi) as analisa_teknisi'),
                    DB::raw('MIN(solusi_saran) as solusi_saran'),
                    DB::raw('MIN(part_diganti) as part_diganti')
                )
                ->where('status', 'barang-diperiksa')
                ->whereIn('no_so', $validNoSo)
                ->whereNotNull('analisa_teknisi')
                ->groupBy('no_so') // <-- kunci utama
                ->get();

        $groupedData = DB::table('service')
                ->where('status', 'barang-diperiksa')
                ->whereNotNull('analisa_teknisi')
                ->select(
                    'no_so',
                    'serial_number',
                    'nama_teknisi',
                    'analisa_teknisi',
                    'solusi_saran',
                    'part_diganti'
                )
                ->get()
                ->groupBy('no_so'); // Grouping by no_so

        return view('sparepartservice', compact('service','validNoSo','groupedData'));
    }
}
