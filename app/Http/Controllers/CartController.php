<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductImage;
use App\Models\Stok;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function show()
    {
        $iduser = User::where('username', auth()->user()->username)->value('id');
        $cart=DB::table('cart')->where('iduser', auth()->user()->id)->get();
        $produkQuery = Cart::query()  
        ->join('users', 'users.id', '=', 'cart.iduser')
        ->join('stok', 'stok.id', '=', 'cart.idstok')
        ->join('variations', 'variations.id', '=', 'stok.idvar')
        ->join('products', 'products.id', '=', 'stok.idproduct')
        ->join('product_images', 'product_images.id', '=', 'cart.idimage')
        ->where('cart.iduser', '=', auth()->user()->id)
        ->select('products.productname',
        'variations.priceafter',
        'product_images.imagepath',
        'variations.value',
        'cart.qty',
        'stok.stok',
        'variations.id',
        'stok.kota');

        $produk = $produkQuery->paginate(20);

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

        
        $wishlistStatuses = [];

        foreach ($produk as $item) {
           $wishlistStatuses[$item->id] = Wishlist::where('idvar', $item->id)
            ->where('iduser', $iduser)
            ->exists();
        }
        

        return view('cart', compact('cart','produk','bestSeller1','bestSeller2','epson','wishlistStatuses'));
    }

    public function store(Request $request)
    {
        $iduser = User::where('username', auth()->user()->username)->value('id');
        $idstok = DB::table('stok')
                ->where('idvar', $request->idvar)
                ->where('kota', $request->kota)
                ->value('id');
        $idimage = ProductImage::where('imagepath', $request->imagepath)->value('id');
        $stok = DB::table('stok')
                ->where('idvar', $request->idvar)
                ->where('stok', $request->stok)
                ->value('stok');

        $qty = DB::table('cart')
               ->where('iduser', $iduser)
               ->where('idstok', $idstok)
               ->pluck('qty')
               ->first();

        // $stok = DB::table('stok')
        // ->join('variations', 'stok.idvar', '=', 'variations.id')
        // ->join('products', 'stok.idproduct', '=', 'products.id')
        // ->join('product_images', 'product_images.product_idproduct', '=', 'products.id')
        // ->select(
        //     'variations.value',
        //     'products.productname',
        //     'variations.priceafter',
        //     'variations.value',
        //     'product_images.imagepath') 
        // ->first();


        $req_qty = intval($request->qty);
        $qtyIncrement = $req_qty + $qty;

        if (Cart::where('idstok', $idstok)
        ->where('iduser', $iduser)
        ->exists())
        {
            if ($qty >= $stok || $qtyIncrement > $stok )
            {
                return response()->json('gagal', 422);
            } else 
            {
                DB::table('cart')
                ->where('iduser', $iduser )
                ->where('idstok', $idstok )
                ->increment('qty', $req_qty);
            }
        } else
        {
            Cart::create([
                'qty' => $req_qty,
                'iduser' => $iduser,
                'idstok' => $idstok,
                'idimage' => $idimage
                // 'qty' => Keranjang::where('nama_produk', $request->nama_produk )
                //          ->where('username', auth()->user()->username )
                //          ->max('qty')+1
                ]);
        }
    }

    public function destroy(Request $request)
    {
        $idvar = $request->idvar;
        $kota = $request->kota;

        DB::table('cart')
        ->join('stok', 'cart.idstok', '=', 'stok.id')
        ->join('variations', 'stok.idvar', '=', 'variations.id')
        ->where('variations.id', $idvar )
        ->where('cart.iduser', auth()->user()->id)
        ->where('stok.kota', $kota)
        ->delete();
    }

    public function qty_keranjang(Request $request)
    {
        $qty = intval($request->qty);

        DB::table('cart')
        ->join('stok', 'cart.idstok', '=', 'stok.id')
        ->join('variations', 'stok.idvar', '=', 'variations.id')
        ->where('variations.id', $request->idvar )
        ->where('cart.iduser', auth()->user()->id )
        ->update(['cart.qty' => $qty]);
    }

    public function destroyAll(Request $request)
    {
        DB::table('cart')
        ->where('iduser', auth()->user()->id)
        ->delete();
    }
}
