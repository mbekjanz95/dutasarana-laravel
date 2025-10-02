<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function show(Wishlist $wishlist)
    {
        $wishlist=DB::table('wishlist')->where('iduser', auth()->user()->id)->get();
        $produkQuery = Wishlist::query()  
        ->join('users', 'users.id', '=', 'wishlist.iduser')
        ->join('variations', 'variations.id', '=', 'wishlist.idvar')
        ->join('products', 'variations.product_idproduct', '=', 'products.id')
        ->join('product_images', 'product_images.id', '=', 'wishlist.idimage')
        ->where('wishlist.iduser', '=', auth()->user()->id)
        ->select('products.productname','variations.priceafter','product_images.imagepath','variations.value','variations.id');

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


        return view ('wishlist', compact('wishlist','produk','bestSeller1','bestSeller2','epson'));
    }

    public function store(Request $request)
    {
        $iduser = User::where('username', auth()->user()->username)->value('id');
        $idimage = ProductImage::where('imagepath', $request->imagepath)->value('id');

        Wishlist::create([
            'iduser' => $iduser,
            'idvar' => $request->idvar,
            'idimage' => $idimage,
        ]);

        return response()->json([
            'message' => 'Wishlist berhasil ditambahkan'
        ], 201);
    }

    public function destroy(Request $request)
    {
        $idvar = $request->idvar;

        $delete = DB::table('wishlist')
                ->join('variations', 'wishlist.idvar', '=', 'variations.id')
                ->where('wishlist.iduser', auth()->user()->id)
                ->where('wishlist.idvar', $idvar)
                ->delete();
        
        return $delete;
    }
}
