<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Produk; // 
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/generate-sitemap', function () {
    $sitemap = Sitemap::create();

    // Mengambil semua produk dari database
    $products = Produk::all(); // Sesuaikan dengan model dan field yang Anda gunakan

    foreach ($products as $product) {
        $sitemap->add(Url::create('/' . $product->productname)
        ->setLastModificationDate($product->updated_at ?: now()) // Jika null, gunakan waktu sekarang
            ->setPriority(0.64)
        );
    }

    // Menyimpan sitemap.xml ke public folder
    $sitemap->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap generated!';
});

/* Route::get('/welcome', function () {
    return view('welcome');
}); */

Route::get('/', [PageController::class,'bestSeller'])->name('home');

Route::get('/payment/finish', [TransactionController::class, 'handleFinish'])->name('payment.finish');

Route::get('/login', [LoginController::class,'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class,'authenticate'])->middleware('auth.guard:web');
Route::post('/logout', [LoginController::class,'logout'])->name('logout');

Route::view('/sign-up', 'registration')->middleware('guest');
Route::view('/registration', 'otp')->middleware('guest')->name('page-daftar');
Route::post('/registration', [CustomerController::class,'create'])->name('daftar');

Route::get('/reset-password/{token}', function (Request $request, $token) {
    return view('auth.reset-password', [
        'request' => $request,
        'token' => $token,
    ]);
})->middleware('guest')->name('password.reset');

Route::get('/auth/google/redirect', [SocialiteController::class,'redirect']); 
Route::get('/auth/google/callback', [SocialiteController::class,'callback']);

Route::get('/send-mailgun', [CustomerController::class, 'sendWithMailgun']);

Route::view('/faq', 'faq');

Route::middleware('auth')->prefix('dashboard')->group(function () {
    
    Route::get('/', [CustomerController::class, 'index'])->name('dashboard');
    Route::get('/histori-transaksi', [CustomerController::class, 'histori'])->name('histori');
    Route::get('/transaction/fetch', [TransactionController::class, 'fetchTransaction'])->name('transaction.fetch');
    Route::get('/transaction-responsive/fetch', [TransactionController::class, 'fetchTransactionResponsive'])->name('transaction-responsive.fetch');
    Route::get('/transaction-admin/fetch', [AdminController::class, 'fetchTransaction'])->name('transaction-admin.fetch');
    Route::get('/transaction/fetch/cari', [TransactionController::class, 'cariPesananUser'])->name('cari.pesanan-user');
    Route::get('/transaction/fetch/cari-responsive', [TransactionController::class, 'cariPesananUserResponsive'])->name('cari.pesanan-user-responsive');

    Route::get('/list-alamat', [CustomerController::class, 'tampilAlamat']);  
    Route::get('/servis', [CustomerController::class, 'servis']);
    Route::view('/editprofil', 'editprofil');

    Route::put('/ubahnama', [CustomerController::class, 'ubahProfil'])->name('ubah.nama');
    Route::put('/ubahusername', [CustomerController::class, 'ubahUsername'])->name('ubah.username');
    Route::put('/ubahtelp', [CustomerController::class, 'ubahPhone'])->name('ubah.telepon');
    Route::put('/ubahpassword', [CustomerController::class, 'ubahPassword'])->name('ubah.password');

    Route::view('/tracking', 'tracking');
    Route::get('/tambah-alamat', [CustomerController::class, 'selectValue']);
    Route::put('/tambahalamat', [CustomerController::class, 'tambahAlamat'])->name('tambah.alamat');
});

Route::middleware('auth')->group(function () {
    

    Route::get('/wishlist', [WishlistController::class,'show']);
    Route::post('/addwishlist', [WishlistController::class,'store']);
    Route::delete('delete/wishlist', 
    [WishlistController::class,'destroy']);

    Route::get('/cart', [CartController::class,'show']);
    Route::post('/addcart', [CartController::class,'store']);
    Route::delete('/delete/keranjang', [CartController::class,'destroy'])->name('delete.keranjang');
    Route::delete('/delete/keranjangall', [CartController::class,'destroyAll'])->name('delete.keranjang-all');
    Route::put('/qty', [CartController::class,'qty_keranjang'])->name('qty.keranjang');

    Route::get('/cekstokcabang', [ProdukController::class, 'cekStokCabang']);
    Route::post('check-ongkir', [TransactionController::class,'tampil_ongkir'])->name('check-ongkir');
    Route::post('/arearequest', [CustomerController::class,'areaList'])->name('area.request');

    Route::get('/checkout', function () {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }
    
        // Cek apakah keranjang kosong
        $cart = DB::table('cart')->where('cart.iduser', Auth::id())->exists();
    
        if (!$cart) {
            return redirect('/cart')->with('error', 'Keranjang belanja Anda masih kosong !');
        }
    
        return app()->call('App\Http\Controllers\PageController@checkout');
    })->name('checkout');

    Route::post('/set-order-preview-access', function (Request $request) {
        session(['order_preview_access' => true]);
        return response()->json(['status' => 'success']);
    })->name('set.order.preview.access');

    Route::post('/storeorderpreview', [TransactionController::class,'storeOrderPreview'])->name('store.orderpreview');
   /*  Route::get('/order-preview', function () {
        if (!session('order_preview_access')) {
            return redirect('/checkout')->with('error', 'Silahkan selesaikan proses checkout terlebih dahulu !');
        }
    
        // Hapus session setelah diakses agar tidak bisa diakses ulang dengan refresh
        session()->forget('order_preview_access');
    
        return app()->call('App\Http\Controllers\TransactionController@orderPreview');
    })->name('order.preview');
 */
    Route::get('/order-preview', [TransactionController::class, 'orderPreview'])->name('order.preview');
    Route::post('/manual-payment', [TransactionController::class, 'gtotalValue']);
    Route::get('/manual-payment/index', [TransactionController::class, 'index']);
    Route::get('/manual-payment/konfirmasi-pembayaran', [TransactionController::class, 'konfirmasiPembayaran']);

    Route::post('/komplain-data', [CustomerController::class, 'komplain']);
    Route::get('/komplain-show', [CustomerController::class, 'komplainShow']);

    Route::post('/payment', [TransactionController::class, 'storeTransaction'])->name('payment');
    Route::post('/payment-midtrans', [TransactionController::class, 'paymentMidtrans'])->name('payment.midtrans');
    Route::get('/url-midtrans', [TransactionController::class, 'urlMidtrans'])->name('midtrans.url');
    Route::delete('/delete-transaction', [TransactionController::class, 'delete'])->name('delete.transaction');
    // Route::get('{nama_produk}', [ProdukController::class,'link']);

    Route::put('/insertdatauser', [ServiceController::class,'dataKonfirmasi'])->name('insert.data-user');
    Route::get('/service-user/fetch', [ServiceController::class, 'fetchServiceUser'])->name('service-user.fetch');
    Route::post('/bukti-transaksi', [TransactionController::class,'storePembayaran'])->name('pembayaran.store');
    Route::post('/komplain-transaksi', [TransactionController::class,'storeKomplain'])->name('komplain.store');

    Route::get('/fetch-rincian-pesanan-user', [AdminController::class,'fetchRincianUser'])->name('rincian.transaksi-user'); 
    
    Route::get('/fetch-data-pembeli', [AdminController::class,'fetchDataPembeli'])->name('data.pembeli'); 
    Route::get('/fetch-data-pembeli-responsive', [AdminController::class,'fetchDataPembeliResponsive'])->name('data.pembeli-responsive'); 
    Route::get('/fetch-bukti-transaksi', [AdminController::class,'fetchBuktiTransaksi'])->name('bukti.transaksi'); 
    Route::get('/fetch-rincian-pesanan', [AdminController::class,'fetchRincian'])->name('rincian.transaksi'); 

    Route::post('/uploadtemp', [AdminController::class,'uploadTemp'])->name('upload.temp'); 
    Route::post('/uploadtempvideo', [AdminController::class,'uploadTempVideo'])->name('upload.temp-video'); 

    Route::put('/transaksi-selesai', [TransactionController::class, 'selesai'])->name('selesai.transaksi');

    Route::put('/transaksi-batal', [TransactionController::class, 'batalTransaksi'])->name('batal.transaksi');
    Route::put('/rating', [TransactionController::class, 'rating'])->name('rating');
});

Route::view('/tes', 'tes');

Route::view('/about-us', 'about');

Route::view('/branch-store', 'branchstore');

Route::view('/our-marketplace', 'marketplace');

Route::view('/our-award', 'award');

Route::get('/pricelist', [PageController::class,'priceList']);

Route::view('/all-promo','promo');

$validCategories = [
    'semua-kategori', 'LAPTOP', 'PERSONAL COMPUTER', 'PRINTER', 'CARTRIDGE', 'TABLET', 
    'PROJECTOR', 'TONER', 'SCANNER', 'STORAGE', 'CCTV', 'KEYBOARD', 'PRINTHEAD', 
    'UPS', 'AKSESORIS', 'TINTA', 'DOCUMENT READER', 'SCANNER BARCODE', 'KABEL', 
    'KERTAS', 'PRO', 'HEADSET', 'MOUSE', 'MICROPHONE'
];

Route::get('/{kategori?}/{cari?}', [ProdukController::class, 'cari'])
    ->where('kategori', implode('|', array_map('strtolower', $validCategories)));

Route::get('/cari-responsive', [ProdukController::class,'cariResponsive']); 

Route::get('/dropdown', [ProdukController::class,'dropdown']);

Route::get('/list-produk', [ProdukController::class,'show']);

Route::get('/top-categories', [PageController::class,'topCategories']);

Route::view('/maintenance', 'maintenance');

Route::view('/whatsapp-contact', 'whatsapp');

Route::middleware(['auth', 'admin.access'])->group(function () {
    Route::view('/admin/tambah-produk', 'tambahproduk');
    Route::get('/admin', [PageController::class,'admin']);
    Route::get('/statistik', [PageController::class,'statistik']);
    Route::get('/pesanan', [PageController::class,'pesanan']);
    Route::get('/cari-produk-admin', [ProdukController::class,'cariAdmin'])->name('cari'); 
    Route::get('/admin/{productname}', [PageController::class,'editProduk']);
    Route::put('/variasidata', [ProdukController::class,'variasiData'])->name('variasi.data'); 
    Route::put('/updatedatajoin', [AdminController::class,'updatedataJoin'])->name('update.join'); 
    Route::put('/editvariasi', [AdminController::class,'editVariasi'])->name('edit.variasi'); 
    Route::post('/massupdate', [AdminController::class,'uploadExcel'])->name('mass.update'); 
    Route::post('/addproduct', [AdminController::class,'store'])->name('products.store');
    Route::delete('/delete/produk', [AdminController::class,'destroy'])->name('delete.produk'); 
    Route::put('/update-productimage', [AdminController::class,'updateImage'])->name('update.productimage'); 

    Route::put('/kirim-transaksi', [TransactionController::class, 'kirim'])->name('kirim.transaksi');

    Route::get('/export-stok', [AdminController::class, 'tarikData'])
     ->name('tarik.data');

     Route::get('/transaction/fetch/cari-admin', [AdminController::class, 'cariPesananAdmin'])->name('cari.pesanan-admin');

});

Route::middleware(['auth', 'service.access'])->group(function () {
    Route::get('/internal-service', [ServiceController::class, 'index']);
    Route::get('/filter-tanggal', [ServiceController::class, 'filterTanggal'])->name('filter.tanggal');
    Route::get('/filter-customer', [ServiceController::class, 'filterCustomer'])->name('filter.customer');
    Route::get('/filter-so', [ServiceController::class, 'filterSO'])->name('filter.so');
    Route::post('/phonerequest', [ServiceController::class,'phoneList'])->name('customername.request');
    Route::post('/teknisirequest', [ServiceController::class,'teknisiList'])->name('teknisiname.request');
    Route::post('/storedataservis', [ServiceController::class,'store'])->name('store.data-servis');
    Route::post('/storedataservismany', [ServiceController::class,'storeMany'])->name('store.data-servis-many');
    Route::post('/storedataservisbaru', [ServiceController::class,'storeBaru'])->name('store.data-servis-baru');
    Route::post('/storedataservisbarumany', [ServiceController::class,'storeBaruMany'])->name('store.data-servis-baru-many');
    Route::put('/insertdatateknisi', [ServiceController::class,'dataTeknisi'])->name('insert.data-teknisi');
    Route::put('/insertdatasparepart', [ServiceController::class,'dataSparepart'])->name('insert.data-sparepart');
    Route::get('/internal-service/status', [PageController::class,'statusService']);
    Route::get('/internal-service/teknisi', [PageController::class,'teknisiService']);
    Route::get('/internal-service/sparepart', [PageController::class,'sparePart']);
    Route::get('/service/fetch', [ServiceController::class, 'fetchService'])->name('service.fetch');
});

Route::post('/forgot-password', [CustomerController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [CustomerController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [CustomerController::class, 'reset'])->name('password.update');

Route::get('{productname}', [ProdukController::class, 'index'])->name('product.index');
Route::put('', [ProdukController::class,'variasiHarga'])->name('variasi.harga');

Route::post('/lokasi-store', [PageController::class, 'store'])->name('lokasi.store');
/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */
