<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use App\Models\Stok;
use App\Models\Variations;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productname)
    {
        $produk = Produk::query()
        ->join('categories', 'products.idcategory', '=', 'categories.id')
        ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
        ->joinSub(
            DB::table('variations')
                ->select(
                    'product_idproduct', 
                    DB::raw('MIN(priceafter) as min_priceafter'),
                    DB::raw('MIN(pricebefore) as min_pricebefore'),
                    )
                ->groupBy('product_idproduct'),
            'min_variations',
            'products.id',
            '=',
            'min_variations.product_idproduct'
        )
        ->where('products.productname', $productname)
        ->select(
            'products.id',
            'products.productname',
            'products.berat',
            'product_images.imagepath',
            'product_images.imagepath_2',
            'product_images.imagepath_3',
            'product_images.imagepath_4',
            'product_images.imagepath_5',
            'categories.catname',
            'products.productdesc',
            'min_variations.min_priceafter as priceafter',
            'min_variations.min_pricebefore as pricebefore'
        )
        ->first();
    

        $variasi = Produk::query()  
        ->join('variations', 'products.id', '=', 'variations.product_idproduct')
        ->where('products.productname', $productname)
        ->select('variations.value', 'variations.id', 'variations.pricebefore', 'variations.priceafter')
        ->get();

        $hargaSesudah = Produk::query()  
        ->join('variations', 'products.id', '=', 'variations.product_idproduct')
        ->where('products.productname', $productname)
        ->select('variations.priceafter')
        ->first();

        $produkIds = Produk::query()  
        ->join('categories', 'products.idcategory', '=', 'categories.id')
        ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
        ->join('variations', 'products.id', '=', 'variations.product_idproduct')
        ->where('products.productname', $productname)
        ->select('products.id')
        ->first();

        $totalStok = Stok::query()  
        ->join('products', 'stok.idproduct', '=', 'products.id')
        ->whereIn('products.id', $produkIds) 
        ->sum('stok.stok');

        // $totalStok = Stok::query()
        // ->join('products', 'stok.idproduct', '=', 'products.id')
        // ->whereIn('products.id', $produkIds)
        // ->select('stok.kota', 'stok.idvar', DB::raw('SUM(stok.stok) as total_stok'))
        // ->groupBy('stok.kota', 'stok.idvar')
        // ->orderByRaw("FIELD(stok.kota, 'Surabaya', 'Kediri', 'Malang', 'Jogja', 'Solo', 'Denpasar')")
        // ->get();


        // $userId = auth()->user()->id; // Dapatkan iduser berdasarkan user yang login
        // $wishlistItems = DB::table('wishlist')
        //     ->where('iduser', $userId)
        //     ->pluck('idvar')
        //     ->toArray();

        return view ('produk', compact('produk','variasi','totalStok','hargaSesudah')); 
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $produkQuery = Produk::query()  
                ->join('categories', 'products.idcategory', '=', 'categories.id')
                ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
                ->join('variations', 'variations.product_idproduct', '=', 'products.id')
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
        $produkResponsive = $produkQuery->paginate(8);
        return view ('listproduk', compact('produk','produkResponsive')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }

    public function cari($kategori = null, $cari = null)
    {
        $hasil = Produk::query()
            ->join('categories', 'products.idcategory', '=', 'categories.id')
            ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
            ->join('variations', 'variations.product_idproduct', '=', 'products.id')
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

        // Filter berdasarkan kategori (jika ada)
        if ($kategori && $kategori !== 'semua-kategori') {
            $hasil = $hasil->where('categories.catname', $kategori);
        } 

        // Filter berdasarkan kata kunci pencarian (jika ada)
        if ($cari) {
            $keywords = explode(' ', $cari);
            $hasil = $hasil->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where(function ($subQuery) use ($keyword) {
                        $subQuery->where('products.productname', 'like', '%' . $keyword . '%')
                            ->orWhere('categories.catname', 'like', '%' . $keyword . '%');
                    });
                }
            });
        }

        $hasil = $hasil->paginate(20)->withQueryString(); // Tetap menyertakan parameter di query string untuk pagination

        return view('cari', compact('hasil'));
    }


    public function cariResponsive(Request $request)
    {
        $hasil = Produk::query()  
        ->join('categories', 'products.idcategory', '=', 'categories.id')
        ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
        ->join('variations', 'variations.product_idproduct', '=', 'products.id')
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

        if ($request->has('cari') && !empty($request->cari)) {
            $keywords = explode(' ', $request->cari);

            $hasil = $hasil->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where(function ($subQuery) use ($keyword) {
                        $subQuery->where('products.productname', 'like', '%' . $keyword . '%')
                                    ->orWhere('categories.catname', 'like', '%' . $keyword . '%');
                    });
                }
            });
        }

        if ($request->has('kategori') && !empty($request->kategori) && $request->kategori !== 'Semua Kategori') {
            $hasil = $hasil->where('catname', '=', $request->kategori);  
        }

        $hasil = $hasil->paginate(8)->appends(['cari' => $request->cari,'kategori' => $request->kategori]);

        return view ('cari', compact('hasil'));
    }

    public function dropdown(Request $request)
    {
        $hasil = Produk::query()  
                ->join('categories', 'products.idcategory', '=', 'categories.id')
                ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
                ->join('variations', 'variations.product_idproduct', '=', 'products.id')
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

        if ($request->has('cari') && !empty($request->cari)) {
            $keywords = explode(' ', $request->cari);
        
            $hasil = $hasil->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->where(function ($subQuery) use ($keyword) {
                        $subQuery->where('products.productname', 'like', '%' . $keyword . '%')
                                    ->orWhere('categories.catname', 'like', '%' . $keyword . '%');
                    });
                }
            });
        }

        if ($request->has('kategori') && !empty($request->kategori) && $request->kategori !== 'Semua Kategori') {
            $hasil = $hasil->where('catname', '=', $request->kategori);  
        }

        $hasil = $hasil->paginate(20)->appends(['cari' => $request->cari,'kategori' => $request->kategori]);
        
        return view ('cari', compact('hasil'));
    }

    public function variasiHarga(Request $request)
    {
        $hargaVariasi = Variations::query()
        ->where('id', $request->id_produk)
        ->value('priceafter');

        $hargaSebelum = Variations::query()
        ->where('id', $request->id_produk)
        ->value('pricebefore');

        $stokSby = Variations::query()
        ->join('stok', 'stok.idvar', '=', 'variations.id')
        ->where('variations.id', $request->id_produk)
        ->where('stok.kota', 'Surabaya')
        ->value('stok.stok');

        $stokMalang = Variations::query()
        ->join('stok', 'stok.idvar', '=', 'variations.id')
        ->where('variations.id', $request->id_produk)
        ->where('stok.kota', 'Malang')
        ->value('stok.stok');

        $stokKediri = Variations::query()
        ->join('stok', 'stok.idvar', '=', 'variations.id')
        ->where('variations.id', $request->id_produk)
        ->where('stok.kota', 'Kediri')
        ->value('stok.stok');

        $stokSolo = Variations::query()
        ->join('stok', 'stok.idvar', '=', 'variations.id')
        ->where('variations.id', $request->id_produk)
        ->where('stok.kota', 'Solo')
        ->value('stok.stok');

        $stokJogja = Variations::query()
        ->join('stok', 'stok.idvar', '=', 'variations.id')
        ->where('variations.id', $request->id_produk)
        ->where('stok.kota', 'Yogyakarta')
        ->value('stok.stok');

        $stokBali = Variations::query()
        ->join('stok', 'stok.idvar', '=', 'variations.id')
        ->where('variations.id', $request->id_produk)
        ->where('stok.kota', 'Denpasar')
        ->value('stok.stok');
    
        $wishlist = Wishlist::query()
        ->join('variations', 'variations.id', '=', 'wishlist.idvar')
        ->where('variations.value', $request->variasiVal)
        ->where('wishlist.iduser', auth()->user()->id)
        ->value('variations.value');

        // $totalStok = Stok::query()
        // ->join('products', 'stok.idproduct', '=', 'products.id')
        // ->whereIn('products.id', $request->idProduct)
        // ->select('stok.kota', 'stok.idvar', DB::raw('SUM(stok.stok) as total_stok'))
        // ->groupBy('stok.kota', 'stok.idvar')
        // ->orderByRaw("FIELD(stok.kota, 'Surabaya', 'Kediri', 'Malang', 'Jogja', 'Solo', 'Denpasar')")
        // ->get()
        // ->toArray();

        return response()->json([
           'hargavariasi' => $hargaVariasi,
           'hargasebelum' => $hargaSebelum,
           'wishlist' => $wishlist,
           'cards' => [
                ['name' => 'DSC Surabaya (Pusat)', 'stock' => $stokSby],
                ['name' => 'DSC Malang', 'stock' => $stokMalang],
                ['name' => 'DSC Kediri', 'stock' => $stokKediri],
                ['name' => 'DSC Solo', 'stock' => $stokSolo],
                ['name' => 'DSC Yogyakarta', 'stock' => $stokJogja],
                ['name' => 'DSC Denpasar', 'stock' => $stokBali],
        ]
        ]);
    }

    public function variasiData(Request $request)
    {
        $skuVariasi = Variations::query()  
                ->where('id', $request->id_produk) 
                ->value('sku');

        $hargaSebelum = Variations::query()
        ->where('id', $request->id_produk)
        ->value('pricebefore');

        $hargaSesudah = Variations::query()
        ->where('id', $request->id_produk)
        ->value('priceafter');

        $stokVariasi = Variations::query()  
                ->join('stok', 'stok.idvar', '=', 'variations.id')
                ->where('variations.id', $request->id_produk)
                ->where('stok.kota', auth()->user()->username)
                ->value('stok.stok');

        $productId = Variations::query()  
                ->where('id', $request->id_produk)
                ->pluck('product_idproduct');

        $deskripsi = Produk::query()
                ->where('id', $productId)
                ->value('productdesc');

        return response()->json([
            'deskripsi' => $deskripsi,
            'skuVariasi' => $skuVariasi,
            'hargaSebelum' => $hargaSebelum,
            'hargaSesudah' => $hargaSesudah,
            'stokVariasi' => $stokVariasi,
        ]);
    }

    public function cariAdmin(Request $request)
    {
        $keywords = explode(' ', $request->cari);

        $hasil = Produk::query()
        ->join('categories', 'products.idcategory', '=', 'categories.id')
        ->join('product_images', 'products.id', '=', 'product_images.product_idproduct')
        ->join('variations', 'products.id', '=', 'variations.product_idproduct')
        ->leftJoin(
            DB::raw('(SELECT idproduct, kota, SUM(stok) as total_stok FROM stok GROUP BY idproduct, kota) as stok_summary'),
            function ($join) {
                $join->on('stok_summary.idproduct', '=', 'products.id')
                    ->where('stok_summary.kota', '=', auth()->user()->username);
            }
        )
        ->select(
            'products.productname',
            DB::raw("CONCAT('" . asset('') . "', product_images.imagepath) as imagepath"),
            'categories.catname',
            DB::raw('MIN(variations.pricebefore) as pricebefore'),
            DB::raw('MIN(variations.priceafter) as priceafter'),
            DB::raw('COALESCE(stok_summary.total_stok, 0) as total_stok') 
        )
        ->where(function ($query) use ($keywords) {
            foreach ($keywords as $keyword) {
                $query->where(function ($subQuery) use ($keyword) {
                    $subQuery->where('products.productname', 'like', '%' . $keyword . '%')
                            ->orWhere('categories.catname', 'like', '%' . $keyword . '%');
                });
            }
        })
        ->groupBy(
            'products.productname',
            'product_images.imagepath',
            'categories.catname',
            'stok_summary.total_stok'
        )
        ->get();


        return response()->json($hasil);
    }

    public function cekStokCabang(Request $request)
    {
        $cart = Cart::query()
        ->join('stok', 'cart.idstok', '=', 'stok.id')
        ->join('variations', 'variations.id', '=', 'stok.idvar')
        ->where('variations.id', $request->idvar)
        ->where('cart.iduser', auth()->user()->id)
        ->where('stok.kota', $request->kota)
        ->value('variations.value');

        return response()->json([
            'cart' => $cart
        ]);
    }
}
