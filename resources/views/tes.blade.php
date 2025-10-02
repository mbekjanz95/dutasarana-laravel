 public function kirim(Request $request)
    {

        $fileName = session('fileName');
        if (!$fileName) {
            return response()->json(['error' => 'File not found in session'], 404);
        }

        $tempPath = storage_path('app/public/temp_uploads/' . $fileName);
        if (!Storage::exists('public/temp_uploads/' . $fileName)) {
            return response()->json(['error' => 'File not found'], 404);
        }
    
        $productImagePath = 'surat-jalan/' . $fileName;
        rename($tempPath, $productImagePath);

        DB::table('transaction')
        ->where('order_id', $request->indexOrderId )
        ->where('kota_pengiriman', auth()->user()->username )
        ->update([
            'status' => 'dalam-pengiriman',
            'no_resi' => $request->noResi,
            'url_suratjalan' => $productImagePath
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

{{-- KODE DASHBOARD --}}
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DASHBOARD - {{auth()->user()->username}}</title>
    
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico?v=1.0')}}">

    <link rel="stylesheet" href="{{asset('style.css?v=2')}}">
    

    <link rel="stylesheet" href="{{asset('style2.css?v=2')}}">
    
    <link rel="stylesheet" href="{{asset('style3.css?v=2')}}">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a59b9b09ab.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

  <style>
        .stars-rating .star {
    font-size: 30px;
    color: #ccc; /* Warna default */
    cursor: pointer;
    transition: color 0.2s, opacity 0.2s;
}

.stars-rating .star.hovered,
.stars-rating .star.selected {
    color: #f39c12; /* Warna gold */
}

.stars-rating .star.dimmed {
    opacity: 0.3; /* Bintang sisanya jadi transparan */
}



      h1 {
            font-size: 24px;
            font-weight: bold;
        }
        .tab-menu {
            display: flex;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            padding: 5px;
        }
        .tab-menu a {
            flex: 1;
            text-align: center;
            padding: 10px;
            text-decoration: none;
            color: brown;
            font-weight: bold;
        }
        .tab-menu a.active {
            position: relative;
            padding-bottom: 5px; /* Beri ruang agar underline tidak terlalu dekat dengan teks */
        }
        .tab-menu a.active::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 3px; /* Ketebalan underline */
            background-color: brown; /* Warna underline */
        }
        .search-box {
            margin-top: 10px;
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            padding: 8px;
            border-radius: 10px;
        }
        .search-box input {
            border: none;
            outline: none;
            flex: 1;
            padding: 5px;
            font-size: 14px;
        }
        .search-box .icon {
            color: gray;
            margin-right: 8px;
        }
        .order-list {
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 200px;
            padding: 10px;
        }
        .status-card {
            border-radius: 12px;
            border: 1px solid #ccc;
            padding: 13px;
            white-space: nowrap;
            overflow-x: auto;
        }
        .status-item {
            display: inline-block;
            margin-right: 30px;
            font-size: 1rem;
            color: #962f28;
            cursor: pointer;
            position: relative;
        }
        .status-item.active::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 100%;
            height: 4px;
            background-color: #962f28;
        }
      </style>
  </head>
  <body>
    
@include('partials.navbar')

<div id="alert-pembayaran-sukses" class="fixed-top mt-5 alert alert-success text-center" role="alert" style="display: none">
    Pembayaran Sukses !<br>
    Silahkan cek di tab <span id="pesanan-diproses-text" style="color: blue; cursor: pointer;">Pesanan Diproses</span>
    <div id="tutup" class="mt-3" style="cursor: pointer">
        <u>Tutup</u>
    </div> 
</div>

<div style="display: none" id="delete-transaction-success" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
    Order ID sudah digunakan, silahkan lakukan checkout kembali !
</div>

<div id="dashboard-card" class="container d-flex" style="margin-left: 3em; padding-bottom: 100px;">
    <div class="card mt-5" style="width: 30%; 
        background-color: rgba(243, 240, 240, 0.7); border: none; 
        padding-bottom: 70px;">
        <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
        <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

        <h4 id="transaksi" class="mt-3 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Histori Transaksi</h4>
        <h4 id="servis" class="servis mt-5 ms-4" style="font-weight: 300; cursor: pointer">Servis</h4>
        <h4 id="alamat" class="alamat mt-5 ms-4" style="font-weight: 300; cursor: pointer">Alamat</h4>
        <h4 id="profil" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Profil</h4>
        {{-- <h4 id="tracking" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container">
        <h1 class="ms-3" style="font-weight: 300; margin-top: 80px;">Histori Transaksi</h1>
        <hr class="ms-3" style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
        {{-- <h2 class="text-center" style="font-weight: 300; margin-top: 80px;">Anda belum melakukan transaksi.</h2> --}}
        
          <div class="container ms-3 mt-4">
            <div class="tab-menu">
                <a href="#" data-status="belum-dibayar" class="tab-link active">Belum Dibayar</a>
                <a href="#" data-status="diproses" class="tab-link">Diproses</a>
                <a href="#" data-status="dalam-pengiriman" class="tab-link">Dalam Pengiriman</a>
                <a href="#" data-status="selesai" class="tab-link">Pesanan Selesai</a>
                <a href="#" data-status="dikomplain" class="tab-link">Dikomplain</a>
                <a href="#" data-status="dibatalkan" class="tab-link">Dibatalkan</a>
            </div>
              <div class="search-box">
                  <span class="icon"><i class="fas fa-search"></i></span>
                  <input type="text" placeholder="Cari Pesanan">
              </div>
              <div class="card mt-4">
                <div class="card-body">
                    <div class="container mt-3">
                        @php
                            $totalBelanjaPerOrder = [];
                            $sumBiayaKurir = 0; // Inisialisasi di luar loop utama
                            $layananKurir ="";
                            $biayaKurir = 0;
                            $totalBiayaKurir = 0;
                            $shownCourierServices = [];
                            $courierCounts = []; // Menyimpan jumlah kemunculan biaya kurir
                            $shownOrderIds = [];

                            // Hitung jumlah kemunculan setiap biaya kurir sebelum menampilkan
                            foreach ($transaction as $row) {
                                $courierKey = $row->courier_service . '|' . $row->courier_cost;
                                if (!isset($courierCounts[$courierKey])) {
                                    $courierCounts[$courierKey] = 0;
                                }
                                $courierCounts[$courierKey]++;
                            }

                            $orderIdCounts = [];
                                foreach ($transaction as $trx) {
                                    $orderIdCounts[$trx->order_id] = isset($orderIdCounts[$trx->order_id]) ? $orderIdCounts[$trx->order_id] + 1 : 1;
                                }
                            $orderIdSeen = [];
                        @endphp

                        @forelse ($transaction as $row)
                            @php
                                $sub_total = $row->priceafter * $row->qty;
                                $layananKurir = $row->courier_service;
                                $biayaKurir = $row->courier_cost;

                                $courierKey = $layananKurir . '|' . $biayaKurir;

                                $orderIdSeen[$row->order_id] = isset($orderIdSeen[$row->order_id]) ? $orderIdSeen[$row->order_id] + 1 : 1;

                                if (!isset($totalBelanjaPerOrder[$row->order_id])) {
                                    $totalBelanjaPerOrder[$row->order_id] = 0;
                                }
                                $totalBelanjaPerOrder[$row->order_id] += $sub_total;
                            @endphp

                            <div class="row mb-3 {{ !$loop->first ? 'mt-5' : '' }}">

                                {{-- TAMPILKAN HANYA SEKALI PER ORDER_ID --}}
                                @if (!in_array($row->order_id, $shownOrderIds))
                                    @php $shownOrderIds[] = $row->order_id; @endphp

                                    <div class="d-flex justify-content-between align-items-start flex-wrap">
                                        <div>
                                            <h3>Order ID : {{ $row->order_id }}</h3>
                                            <div style="font-size: 17px;">
                                                Tanggal Order : <b>{{ $row->updated_at }}</b>
                                            </div>
                                        </div>

                                        @if ($row->status !== 'belum-dibayar')
                                            <div class="d-flex align-items-center mt-2 mt-lg-0">
                                                <button class="btn-detail btn btn-success">Lihat Detail Transaksi</button>
                                            </div>
                                        @else
                                            <div class="wrap-order-belum-dibayar text-end" data-order-id="{{ $row->order_id }}">
                                                <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}" >

                                                <div class="dialog-confirm" style="display: none;">
                                                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
                                                        <div class="float-end close-dialog" style="cursor: pointer;">
                                                            <i class="fas fa-times"></i>
                                                        </div>
                                                        <h5 class="mt-4">Batalkan Transaksi?</h5>
                                                        <div class="mt-4 d-flex justify-content-center">
                                                            <button class="btn btn-danger btn-konfirmasi-batal">OK</button>
                                                            <button class="ms-2 btn btn-secondary btn-cancel-batal">CANCEL</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-column align-items-end gap-2 mt-2 mt-lg-0">
                                                    <button class="btn-detail btn btn-success">Lihat Detail Pembayaran</button>
                                                    <div class="btn-batal-transaksi" style="font-size: 17px; font-weight: 600; color: brown; cursor: pointer">
                                                        <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;BATALKAN TRANSAKSI
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                  

                                    <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}" >

                                    <div class="dialog-confirm-data-pembeli" style="display: none;">
                                        <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                                            <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>
                                    
                                            <div class="mt-4" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
                                                <div class="data-pembeli">
                                                    <div style="font-size: 18px; font-weight: bold; color: #333;">Detail Transaksi</div>
                                                    <div style="font-size: 12px; font-weight: bold; color: #6e6d6d;">(Order ID : {{ $row->order_id }})</div>

                                                    <div class="mt-3" style="font-size: 18px; font-weight: bold; color: #333;">Data Pembeli</div>
                                                    <ul style="list-style: none;">
                                                        <li>Nama Lengkap<span style="margin-left: 30px">:</span><b class="ms-2"> {{$row->customername}}</b></li>
                                                        <li>No. Telp/HP<span style="margin-left: 51px">:</span><b class="ms-2"> {{$row->phone}}</b></li>
                                                        <li>Alamat<span style="margin-left: 88px">:</span><b class="ms-2"> {{$row->address}}, {{$row->district_name}}, {{$row->kelurahan_name}}, {{$row->city_name}}, {{$row->province}}</b></li>
                                                    </ul>
                                                </div>

                                                <div class="tab-menu mt-3">
                                                    <a href="#" data-status="rincian-pesanan" class="tab-link-popup active">Rincian Pesanan</a>
                                                    <a href="#" data-status="bukti-transaksi" class="tab-link-popup">Bukti Transaksi</a>
                                                </div>
                                                <div class="rincian-pesanan" style="display: none">
                                                    @php
                                                        $groupedCart = [];
                                                        $grand_total_belanja = 0;
                                                        $grand_total_kurir = 0;
                                                    @endphp

                                                    @foreach ($rincian as $row)
                                                        @if (!isset($groupedCart[$row->kota_pengiriman])) 
                                                            @php
                                                                $groupedCart[$row->kota_pengiriman] = [
                                                                    'products' => [],
                                                                    'courier_cost' => $row->courier_cost,
                                                                    'courier_service' => $row->courier_service
                                                                ];
                                                            @endphp
                                                        @endif

                                                        @php
                                                            $groupedCart[$row->kota_pengiriman]['products'][] = $row;
                                                        @endphp
                                                    @endforeach

                                                    @forelse ($groupedCart as $kota => $data)
                                                        @php
                                                            $total_belanja_per_kota = 0;
                                                        @endphp

                                                        <h4 class="text-danger fw-bold mt-4">Lokasi Pengiriman : {{ $kota }}</h4>

                                                        <table class="table table-bordered mt-3" style="border: 1px solid rgba(0,0,0,0.5)">
                                                            <thead style="background-color: #920700;">
                                                                <tr style="color: white">
                                                                    <th class="text-center">Nama Produk</th>
                                                                    <th class="text-center">Harga @</th>
                                                                    <th class="text-center">Discount</th>
                                                                    <th class="text-center">Qty</th>
                                                                    <th class="text-center">Sub Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data['products'] as $row)
                                                                    @php
                                                                        $sub_total = $row->priceafter * $row->qty;
                                                                        $total_belanja_per_kota += $sub_total;
                                                                    @endphp
                                                                    <tr>
                                                                        <td style="max-width: 500px; width: 500px; word-wrap: break-word; word-break: break-word; padding-bottom: 20px;">
                                                                            {{ $row->productname }}<br>
                                                                            <b>(SKU : {{ $row->sku }})</b>
                                                                        </td>
                                                                        <td class="text-center">Rp {{ number_format($row->priceafter, 0, ',', '.') }}</td>                           
                                                                        <td class="text-center">0%</td>
                                                                        <td class="text-center">{{ $row->qty }}</td>
                                                                        <td class="text-center">Rp {{ number_format($sub_total, 0, ',', '.') }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="4"><b>Total Belanja</b></td>
                                                                    <td class="text-center"><b>Rp {{ number_format($total_belanja_per_kota, 0, ',', '.') }}</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <b>Biaya Pengiriman:</b> {{ $data['courier_service'] }}
                                                                    </td>
                                                                    <td class="text-center">Rp {{ number_format($data['courier_cost'], 0, ',', '.') }}</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                                                        @php
                                                            $grand_total_belanja += $total_belanja_per_kota;
                                                            $grand_total_kurir += $data['courier_cost'];
                                                        @endphp

                                                    @empty
                                                        <h1 class="text-center">Belum ada transaksi</h1>
                                                    @endforelse

                                                    {{-- TAMPILKAN GRAND TOTAL --}}
                                                    @if ($grand_total_belanja > 0 || $grand_total_kurir > 0)
                                                        <div class="mt-4">
                                                            <h4 class="text-end text-success">Total Pemasukan : <b>Rp {{ number_format($grand_total_belanja, 0, ',', '.') }}</b></h4>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mt-4 table-responsive bukti-transaksi" style="display: none">
                                                    <table class="table table-bordered align-middle w-100">
                                                        <tbody>
                                                            <tr>
                                                                <th>Bank Tujuan</th>
                                                                <td>BCA</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bank Asal</th>
                                                                <td>BCA</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nama Pemilik Rekening</th>
                                                                <td>Budi</td>
                                                            </tr>
                                                            <tr>
                                                                <th>No. Rekening Pemilik</th>
                                                                <td>789564646</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tanggal Pembayaran</th>
                                                                <td>11-05-2025</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Jumlah yang sudah dibayarkan</th>
                                                                <td>Rp 1.500.000,-</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bukti Pembayaran</th>
                                                                <td>resi.jpeg</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Keterangan</th>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                {{-- PRODUK --}}
                                <h4 class="text-danger fw-bold mt-5">Lokasi Pengiriman : {{$row->kota_pengiriman}}</h4>
                                <div class="col-md-2 mt-3">
                                    <img src="{{asset($row->imagepath)}}" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>{{$row->productname}}</h6>
                                    <p>{{$row->sku}}</p>
                                    <p>Qty : {{$row->qty}} pcs (@ Rp {{number_format($row->priceafter,0,',','.')}})</p>
                                </div>

                                @if ($row->status == 'dalam-pengiriman')
                                    <div class="col-md-4 text-end">
                                        @if (str_contains($row->courier_service, 'DSC'))
                                            <p>Kurir: {{ $layananKurir }}</p>
                                            <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                            <a href="{{$row->url_suratjalan}}" target="_blank">
                                                <button class="btn btn-primary">LINK SURAT JALAN</button>
                                            </a>
                                        @else
                                            <p>Kurir: {{ $layananKurir }}</p>
                                            <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                            <p><b>No. Resi : {{ $row->no_resi }}</b></p>
                                            <a href="https://parcelsapp.com " target="_blank">
                                                <button class="btn btn-primary">LINK CEK RESI</button>
                                            </a>
                                        @endif
                                    </div>
                                @elseif ($row->status == 'dikomplain')
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                        <p><b>No. Resi : {{ $row->no_resi }}</b></p>
                                    </div>
                                @elseif ($row->status == 'selesai')
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                        <p><b>No. Resi : {{ $row->no_resi }}</b></p>
                                    </div>
                                @elseif ($row->status == 'diproses')
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                        @if ($row->kota_pengiriman == 'Surabaya')
                                            <a href="https://api.whatsapp.com/send/?phone=6281901057788 " target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Malang')
                                            <a href="https://api.whatsapp.com/send/?phone=6287800157788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Kediri')
                                            <a href="https://api.whatsapp.com/send/?phone=6281882807788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Solo')
                                            <a href="https://api.whatsapp.com/send/?phone=6287801037788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Denpasar')
                                            <a href="https://api.whatsapp.com/send/?phone=628170027788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Yogyakarta')
                                            <a href="https://api.whatsapp.com/send/?phone=6281882897788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                    </div>
                                @endif

                                @if ($row->status == 'belum-dibayar')
                                    @if ($orderIdSeen[$row->order_id] === $orderIdCounts[$row->order_id])
                                        @if ($transaction->isNotEmpty())  
                                            <div class="me-auto mt-5">
                                                @if (isset($orders[$row->order_id]) && $orderIdSeen[$row->order_id] === $orderIdCounts[$row->order_id])
                                                        <h5 class="fw-bold">Total Bayar :</h5>
                                                        <p><strong>Rp. {{ number_format($orders[$row->order_id]['total_pembayaran'], 0, ',', '.') }}</strong></p>
                                                @endif
                                            </div>

                                            <div class="wrap-order" data-order-id="{{ $row->order_id }}">
                                                <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}">
                                                
                                                <div class="dialog-confirm" style="display: none;">
                                                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                                                    <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>
                                            
                                                    <h4 class="mt-5" style="font-weight: 300; font-family: 'Helvetica', sans-serif;">Pilih Metode pembayaran</h4>
                                                    <!-- Transfer Manual Section -->
                                                    <div class="mt-3 manual" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
                                                        <div style="font-size: 18px; font-weight: bold; color: #333;">Transfer Manual BCA / Mandiri (Bebas Biaya Admin)</div>
                                                        <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 10px;">
                                                            <img  src="{{asset('logo-bank/bca.png')}}" alt="BCA" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                            <img src="{{asset('logo-bank/mandiri.png')}}" alt="Mandiri" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                        </div>

                                                        @if (isset($orders[$row->order_id]) && $orderIdSeen[$row->order_id] === $orderIdCounts[$row->order_id])
                                                            <input type="hidden" class="gtotal" value="{{  $orders[$row->order_id]['total_pembayaran'] }}">
                                                            <input type="hidden" class="gtotal-midtrans" value="{{  $orders[$row->order_id]['total_pembayaran']+4000 }}">
                                                        @endif
                                                        {{-- <input type="hidden" class="gtotal" value="{{ $total_pembayaran }}"> --}}
                                                    </div>
                                            
                                                    <!-- QRIS / GoPay Section -->
                                                    {{-- <div id="midtrans" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; border-radius: 8px;">
                                                        <div style="font-size: 18px; font-weight: bold; color: #333; margin-bottom: 10px;">QRIS / GoPay (Include Biaya Admin)</div>
                                                        <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 10px;">
                                                            <img src="{{asset('qris.png')}}" alt="QRIS" style="height: 45px; padding: 10px;">
                                                            <img src="{{asset('dana.png')}}" alt="DANA" style="height: 45px; padding: 10px;">
                                                            <img src="{{asset('ovo.png')}}" alt="OVO" style="height: 40px;">
                                                            <img src="{{asset('gopay.png')}}" alt="GoPay" style="height: 45px; padding: 10px;">
                                                        </div>
                                                        <div class="mt-4" style="font-size: 16px; color: #555;"><img src="{{asset('via-midtrans.png')}}" alt="Midtrans" style="height: 20px; vertical-align: middle; margin-left: 5px;"></div>
                                                    </div> --}}

                                                    <div id="midtrans" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; border-radius: 8px;">
                                                        <div style="font-size: 18px; font-weight: bold; color: #333; margin-bottom: 10px;">Virtual Account BCA / Mandiri (Include Biaya Admin Rp 4.000,-)</div>
                                                        <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 10px;">
                                                            <img  src="{{asset('logo-bank/bca.png')}}" alt="BCA" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                            <img src="{{asset('logo-bank/mandiri.png')}}" alt="Mandiri" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                        </div>
                                                        <div class="mt-4" style="font-size: 16px; color: #555;"><img src="{{asset('via-midtrans.png')}}" alt="Midtrans" style="height: 20px; vertical-align: middle; margin-left: 5px;"></div>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="mt-5 text-center">
                                                    <button style="height: 40px; width: 50vw" class="btn btn-danger btn-bayar">BAYAR</button>
                                                </div>
                                            </div>

                                        @endif
                                    @endif
                                @endif

                                @php
                                    // Cek apakah semua status dari transaksi dengan order_id ini adalah 'dalam-pengiriman'
                                    $allSameStatus = true;
                                    foreach ($transaction as $t) {
                                        if ($t->order_id === $row->order_id && $t->status !== 'dalam-pengiriman') {
                                            $allSameStatus = false;
                                            break;
                                        }
                                    }
                                @endphp

                                @if ($row->status == 'dalam-pengiriman' && $allSameStatus)
                                    {{-- BUTTON KIRIM, DITAMPILKAN HANYA DI ROW TERAKHIR DARI order_id --}}
                                        @if ($transaction->isNotEmpty())  

                                            <div class="wrap-order-pengiriman" data-order-id="{{ $row->order_id }}">
                                                <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}">
                                                <input type="hidden" class="acuan-tanggal-order" value="{{ $row->updated_at }}">
                                                <input type="hidden" class="acuan-nama-produk" value="{{ $row->productname }}">
                                                <input type="hidden" class="acuan-kota-pengiriman" value="{{ $row->kota_pengiriman }}">
                                                <input type="hidden" class="acuan-kurir" value="{{ $row->courier_service }}">
                                                <input type="hidden" class="acuan-sku" value="{{ $row->sku }}">
                                                <input type="hidden" class="acuan-qty" value="{{ $row->qty }}">
                                                <input type="hidden" class="acuan-biaya-kurir" value="{{ $row->courier_cost }}">
                                                <input type="hidden" class="acuan-imagepath" value="{{ $row->imagepath }}">
                                                <input type="hidden" class="acuan-harga" value="{{ $row->priceafter }}">
                                                <input type="hidden" class="acuan-idproduct" value="{{ $row->idproduct }}">
                                                <input type="hidden" class="acuan-idvar" value="{{ $row->idvar }}">

                                                {{-- Dialog & Button --}}
                                                <div class="dialog-confirm" style="display: none;">
                                                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
                                                        <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>

                                                        <h4 class="mt-5">Cek kembali pesanan anda!</h4>

                                                        <div class="mt-3 konfirmasi" style="padding: 20px; margin-bottom: 20px;">
                                                            <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                                                                <button class="btn btn-selesai btn-success">Selesai</button>
                                                                <button class="btn btn-komplain btn-secondary">Ajukan Komplain</button>
                                                            </div>
                                                            {{-- <input type="hidden" class="gtotal" value="{{ $total_pembayaran }}"> --}}
                                                        </div>

                                                    
                                                    </div>
                                                </div>

                                                <div class="mt-3 text-center">
                                                    <button style="height: 40px; width: 50vw" class="mt-5 btn btn-danger btn-konfirmasi">BARANG SAMPAI</button>
                                                </div>
                                            </div>
                                        @endif
                                @endif

                                @php
                                    // Cek apakah semua status dari transaksi dengan order_id ini adalah 'dalam-pengiriman'
                                    $allSameStatus = true;
                                    foreach ($transaction as $t) {
                                        if ($t->order_id === $row->order_id && $t->status !== 'selesai') {
                                            $allSameStatus = false;
                                            break;
                                        }
                                    }
                                @endphp

                                @if ($row->status == 'selesai' && $allSameStatus)
                                    {{-- BUTTON KIRIM, DITAMPILKAN HANYA DI ROW TERAKHIR DARI order_id --}}
                                        @if ($transaction->isNotEmpty())  

                                            <div class="wrap-order-selesai" data-order-id="{{ $row->order_id }}">
                                                <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}">
                                                <input type="hidden" class="acuan-tanggal-order" value="{{ $row->updated_at }}">
                                                <input type="hidden" class="acuan-nama-produk" value="{{ $row->productname }}">
                                                <input type="hidden" class="acuan-kota-pengiriman" value="{{ $row->kota_pengiriman }}">
                                                <input type="hidden" class="acuan-kurir" value="{{ $row->courier_service }}">
                                                <input type="hidden" class="acuan-sku" value="{{ $row->sku }}">
                                                <input type="hidden" class="acuan-qty" value="{{ $row->qty }}">
                                                <input type="hidden" class="acuan-biaya-kurir" value="{{ $row->courier_cost }}">
                                                <input type="hidden" class="acuan-imagepath" value="{{ $row->imagepath }}">
                                                <input type="hidden" class="acuan-harga" value="{{ $row->priceafter }}">
                                                <input type="hidden" class="acuan-idproduct" value="{{ $row->idproduct }}">
                                                <input type="hidden" class="acuan-idvar" value="{{ $row->idvar }}">

                                                {{-- Dialog & Button --}}
                                                <div class="dialog-confirm" style="display: none;">
                                                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
                                                        <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>

                                                        <h3>Berikan Penilaian</h3>
                                                        <div class="stars-rating">
                                                            <span class="star" data-value="1">&#9733;</span>
                                                            <span class="star" data-value="2">&#9733;</span>
                                                            <span class="star" data-value="3">&#9733;</span>
                                                            <span class="star" data-value="4">&#9733;</span>
                                                            <span class="star" data-value="5">&#9733;</span>
                                                        </div>
                                                        <p><strong>Penilaian Anda: </strong><span class="rating-result">0</span></p>
                                                        <button class="btn-submit-rating" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">Kirim Penilaian</button>
                                                    </div>
                                                </div>
                                                @if ($row->rating == 0)       
                                                    <div class="mt-3 text-center">
                                                        <button class="btn btn-primary btn-review mt-5 w-100">NILAI PESANAN</button>
                                                    </div>
                                                @else
                                                    <div class="mt-3 text-center">
                                                        <p>
                                                            <strong>Penilaian Anda: </strong>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $row->rating)
                                                                    <span style="font-size: 32px; color: #f39c12; margin: 0 2px;">&#9733;</span>
                                                                @else
                                                                    <span style="font-size: 32px; color: #ccc; margin: 0 2px;">&#9733;</span>
                                                                @endif
                                                            @endfor
                                                        </p>
                                                    </div>
                                                @endif


                                                            </div>
                                                        @endif
                                                @endif
                    </div>
                            
                        @empty
                            <h1 class="text-center">Belum ada pesanan</h1>
                        @endforelse
                </div>
              </div>  
          </div>
    </div> 
</div>
</div>

<div id="dashboard-card-responsive" class="container-fluid">
    <div class="card mt-5" style=" background-color: rgba(243, 240, 240, 0.7); border: none; padding-bottom: 50px;">
        <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
        <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

        <h4 id="transaksi" class="mt-3 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Histori Transaksi</h4>
        <h4 id="servis" class="servis mt-4 ms-4" style="font-weight: 300; cursor: pointer;">Servis</h4>
        <h4 id="alamat" class="alamat mt-4 ms-4" style="font-weight: 300; cursor: pointer">Alamat</h4>
        <h4 id="profil" class="mt-4 ms-4" style="font-weight: 300; cursor: pointer">Profil</h4>
        {{-- <h4 id="tracking" class="mt-4 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container mt-5" style="padding-bottom: 300px">
        <h1 style="font-weight: 300;">Histori Transaksi</h1>
        <hr style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
        <div class="status-card shadow-sm bg-white">
          <a style="text-decoration: none" href="#" data-status="belum-dibayar" class="status-item active">Belum Dibayar</a>
          <a style="text-decoration: none" href="#" data-status="diproses" class="status-item">Diproses</a>
          <a style="text-decoration: none" href="#" data-status="dalam-pengiriman" class="status-item">Dalam Pengiriman</a>
          <a style="text-decoration: none" href="#" data-status="pesanan-selesai" class="status-item">Pesanan Selesai</a>
          <a style="text-decoration: none" href="#" data-status="dibatalkan" class="status-item">Dibatalkan</a>
        </div>
        <div class="search-box" style="padding: 1px">
            <span class="icon ms-2"><i class="fas fa-search"></i></span>
            <input type="text" placeholder="Cari Pesanan">
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <div class="container mt-3">
                        @php
                            $totalBelanjaPerOrder = [];
                            $sumBiayaKurir = 0; // Inisialisasi di luar loop utama
                            $layananKurir ="";
                            $biayaKurir = 0;
                            $totalBiayaKurir = 0;
                            $shownCourierServices = [];
                            $courierCounts = []; // Menyimpan jumlah kemunculan biaya kurir
                            $shownOrderIds = [];

                            // Hitung jumlah kemunculan setiap biaya kurir sebelum menampilkan
                            foreach ($transaction as $row) {
                                $courierKey = $row->courier_service . '|' . $row->courier_cost;
                                if (!isset($courierCounts[$courierKey])) {
                                    $courierCounts[$courierKey] = 0;
                                }
                                $courierCounts[$courierKey]++;
                            }

                            $orderIdCounts = [];
                                foreach ($transaction as $trx) {
                                    $orderIdCounts[$trx->order_id] = isset($orderIdCounts[$trx->order_id]) ? $orderIdCounts[$trx->order_id] + 1 : 1;
                                }
                            $orderIdSeen = [];
                        @endphp

                        @forelse ($transaction as $row)
                            @php
                                $sub_total = $row->priceafter * $row->qty;
                                $layananKurir = $row->courier_service;
                                $biayaKurir = $row->courier_cost;

                                $courierKey = $layananKurir . '|' . $biayaKurir;

                                $orderIdSeen[$row->order_id] = isset($orderIdSeen[$row->order_id]) ? $orderIdSeen[$row->order_id] + 1 : 1;

                                if (!isset($totalBelanjaPerOrder[$row->order_id])) {
                                    $totalBelanjaPerOrder[$row->order_id] = 0;
                                }
                                $totalBelanjaPerOrder[$row->order_id] += $sub_total;
                            @endphp

                            <div class="row mb-3 {{ !$loop->first ? 'mt-5' : '' }}">

                                {{-- TAMPILKAN HANYA SEKALI PER ORDER_ID --}}
                                @if (!in_array($row->order_id, $shownOrderIds))
                                    @php $shownOrderIds[] = $row->order_id; @endphp

                                    <div class="d-flex justify-content-between">
                                        <h3>Order ID : {{ $row->order_id }}</h3>

                                        {{-- TOMBOL DETAIL HANYA JIKA STATUS BUKAN 'belum-dibayar' --}}
                                        @if ($row->status !== 'belum-dibayar')
                                            <button class="btn-detail btn btn-success ms-5 mb-3">Lihat Detail Transaksi</button>
                                        @else
                                            <button class="btn-detail btn btn-success ms-5 mb-3">Lihat Detail Pembayaran</button>
                                        @endif

                                        @if ($row->status == 'belum-dibayar')
                                            <div class="ms-auto" style="font-size: 17px; font-weight: 600; color: brown; cursor: pointer">
                                                <i class="fas fa-trash-alt"></i>&nbsp;&nbsp;BATALKAN TRANSAKSI
                                            </div>
                                        @else

                                        @endif
                                    </div>

                                    <div style="font-size: 17px">Tanggal Order : <b>{{ $row->updated_at }}</b></div>

                                    <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}" >

                                    <div class="dialog-confirm-data-pembeli" style="display: none;">
                                        <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                                            <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>
                                    
                                            <div class="mt-4" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
                                                <div class="data-pembeli">
                                                    <div style="font-size: 18px; font-weight: bold; color: #333;">Detail Transaksi</div>
                                                    <div style="font-size: 12px; font-weight: bold; color: #6e6d6d;">(Order ID : {{ $row->order_id }})</div>

                                                    <div class="mt-3" style="font-size: 18px; font-weight: bold; color: #333;">Data Pembeli</div>
                                                    <ul style="list-style: none;">
                                                        <li>Nama Lengkap<span style="margin-left: 30px">:</span><b class="ms-2"> {{$row->customername}}</b></li>
                                                        <li>No. Telp/HP<span style="margin-left: 51px">:</span><b class="ms-2"> {{$row->phone}}</b></li>
                                                        <li>Alamat<span style="margin-left: 88px">:</span><b class="ms-2"> {{$row->address}}, {{$row->district_name}}, {{$row->kelurahan_name}}, {{$row->city_name}}, {{$row->province}}</b></li>
                                                    </ul>
                                                </div>

                                                <div class="tab-menu mt-3">
                                                    <a href="#" data-status="rincian-pesanan" class="tab-link-popup active">Rincian Pesanan</a>
                                                    <a href="#" data-status="bukti-transaksi" class="tab-link-popup">Bukti Transaksi</a>
                                                </div>
                                                <div class="rincian-pesanan" style="display: none">
                                                    @php
                                                        $groupedCart = [];
                                                        $grand_total_belanja = 0;
                                                        $grand_total_kurir = 0;
                                                    @endphp

                                                    @foreach ($rincian as $row)
                                                        @if (!isset($groupedCart[$row->kota_pengiriman])) 
                                                            @php
                                                                $groupedCart[$row->kota_pengiriman] = [
                                                                    'products' => [],
                                                                    'courier_cost' => $row->courier_cost,
                                                                    'courier_service' => $row->courier_service
                                                                ];
                                                            @endphp
                                                        @endif

                                                        @php
                                                            $groupedCart[$row->kota_pengiriman]['products'][] = $row;
                                                        @endphp
                                                    @endforeach

                                                    @forelse ($groupedCart as $kota => $data)
                                                        @php
                                                            $total_belanja_per_kota = 0;
                                                        @endphp

                                                        <h4 class="text-danger fw-bold mt-4">Lokasi Pengiriman : {{ $kota }}</h4>

                                                        <table class="table table-bordered mt-3" style="border: 1px solid rgba(0,0,0,0.5)">
                                                            <thead style="background-color: #920700;">
                                                                <tr style="color: white">
                                                                    <th class="text-center">Nama Produk</th>
                                                                    <th class="text-center">Harga @</th>
                                                                    <th class="text-center">Discount</th>
                                                                    <th class="text-center">Qty</th>
                                                                    <th class="text-center">Sub Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($data['products'] as $row)
                                                                    @php
                                                                        $sub_total = $row->priceafter * $row->qty;
                                                                        $total_belanja_per_kota += $sub_total;
                                                                    @endphp
                                                                    <tr>
                                                                        <td style="max-width: 500px; width: 500px; word-wrap: break-word; word-break: break-word; padding-bottom: 20px;">
                                                                            {{ $row->productname }}<br>
                                                                            <b>(SKU : {{ $row->sku }})</b>
                                                                        </td>
                                                                        <td class="text-center">Rp {{ number_format($row->priceafter, 0, ',', '.') }}</td>                           
                                                                        <td class="text-center">0%</td>
                                                                        <td class="text-center">{{ $row->qty }}</td>
                                                                        <td class="text-center">Rp {{ number_format($sub_total, 0, ',', '.') }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="4"><b>Total Belanja</b></td>
                                                                    <td class="text-center"><b>Rp {{ number_format($total_belanja_per_kota, 0, ',', '.') }}</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4">
                                                                        <b>Biaya Pengiriman:</b> {{ $data['courier_service'] }}
                                                                    </td>
                                                                    <td class="text-center">Rp {{ number_format($data['courier_cost'], 0, ',', '.') }}</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                                                        @php
                                                            $grand_total_belanja += $total_belanja_per_kota;
                                                            $grand_total_kurir += $data['courier_cost'];
                                                        @endphp

                                                    @empty
                                                        <h1 class="text-center">Belum ada transaksi</h1>
                                                    @endforelse

                                                    {{-- TAMPILKAN GRAND TOTAL --}}
                                                    @if ($grand_total_belanja > 0 || $grand_total_kurir > 0)
                                                        <div class="mt-4">
                                                            <h4 class="text-end text-success">Total Pemasukan : <b>Rp {{ number_format($grand_total_belanja, 0, ',', '.') }}</b></h4>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mt-4 table-responsive bukti-transaksi" style="display: none">
                                                    <table class="table table-bordered align-middle w-100">
                                                        <tbody>
                                                            <tr>
                                                                <th>Bank Tujuan</th>
                                                                <td>BCA</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bank Asal</th>
                                                                <td>BCA</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Nama Pemilik Rekening</th>
                                                                <td>Budi</td>
                                                            </tr>
                                                            <tr>
                                                                <th>No. Rekening Pemilik</th>
                                                                <td>789564646</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tanggal Pembayaran</th>
                                                                <td>11-05-2025</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Jumlah yang sudah dibayarkan</th>
                                                                <td>Rp 1.500.000,-</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Bukti Pembayaran</th>
                                                                <td>resi.jpeg</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Keterangan</th>
                                                                <td>-</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                {{-- PRODUK --}}
                                <h4 class="text-danger fw-bold mt-5">Lokasi Pengiriman : {{$row->kota_pengiriman}}</h4>
                                <div class="col-md-2 mt-3">
                                    <img src="{{asset($row->imagepath)}}" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>{{$row->productname}}</h6>
                                    <p>{{$row->sku}}</p>
                                    <p>Qty : {{$row->qty}} pcs (@ Rp {{number_format($row->priceafter,0,',','.')}})</p>
                                </div>

                                @if ($row->status == 'dalam-pengiriman')
                                    <div class="col-md-4 text-end">
                                        @if (str_contains($row->courier_service, 'DSC'))
                                            <p>Kurir: {{ $layananKurir }}</p>
                                            <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                            <a href="https://api.whatsapp.com/send/?phone=6281901057788 " target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @else
                                            <p>Kurir: {{ $layananKurir }}</p>
                                            <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                            <p><b>No. Resi : {{ $row->no_resi }}</b></p>
                                            <a href="https://parcelsapp.com " target="_blank">
                                                <button class="btn btn-primary">LINK CEK RESI</button>
                                            </a>
                                        @endif
                                    </div>
                                @elseif ($row->status == 'dikomplain')
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                        <p><b>No. Resi : {{ $row->no_resi }}</b></p>
                                    </div>
                                @elseif ($row->status == 'selesai')
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                        <p><b>No. Resi : {{ $row->no_resi }}</b></p>
                                    </div>
                                @elseif ($row->status == 'diproses')
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                        @if ($row->kota_pengiriman == 'Surabaya')
                                            <a href="https://api.whatsapp.com/send/?phone=6281901057788 " target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Malang')
                                            <a href="https://api.whatsapp.com/send/?phone=6287800157788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Kediri')
                                            <a href="https://api.whatsapp.com/send/?phone=6281882807788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Solo')
                                            <a href="https://api.whatsapp.com/send/?phone=6287801037788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Denpasar')
                                            <a href="https://api.whatsapp.com/send/?phone=628170027788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @elseif ($row->kota_pengiriman == 'Yogyakarta')
                                            <a href="https://api.whatsapp.com/send/?phone=6281882897788" target="_blank">
                                                <button class="btn btn-primary">CHAT PENJUAL</button>
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                    </div>
                                @endif

                                @if ($row->status == 'belum-dibayar')
                                    @if ($orderIdSeen[$row->order_id] === $orderIdCounts[$row->order_id])
                                        @if ($transaction->isNotEmpty())  
 --}}
                                            {{-- <div class="me-auto mt-5">
                                                <h5 class="fw-bold">Total Bayar :</h5>
                                                <p>Rp. {{number_format($total_pembayaran,0,',','.')}}</p>
                                            </div> --}}

                                            <div class="wrap-order" data-order-id="{{ $row->order_id }}">
                                                <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}">
                                                
                                                <div class="dialog-confirm" style="display: none;">
                                                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                                                    <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>
                                            
                                                    <h4 class="mt-5" style="font-weight: 300; font-family: 'Helvetica', sans-serif;">Pilih Metode pembayaran</h4>
                                                    <!-- Transfer Manual Section -->
                                                    <div class="mt-3 manual" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
                                                        <div style="font-size: 18px; font-weight: bold; color: #333;">Transfer Manual BCA / Mandiri (Bebas Biaya Admin)</div>
                                                        <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 10px;">
                                                            <img  src="{{asset('logo-bank/bca.png')}}" alt="BCA" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                            <img src="{{asset('logo-bank/mandiri.png')}}" alt="Mandiri" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                        </div>

                                                        {{-- <input type="hidden" class="gtotal" value="{{ $total_pembayaran }}"> --}}
                                                    </div>
                                            
                                                    <!-- QRIS / GoPay Section -->
                                                    <div id="midtrans" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; border-radius: 8px;">
                                                        <div style="font-size: 18px; font-weight: bold; color: #333; margin-bottom: 10px;">QRIS / GoPay (Include Biaya Admin)</div>
                                                        <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 10px;">
                                                            <img src="{{asset('qris.png')}}" alt="QRIS" style="height: 45px; padding: 10px;">
                                                            <img src="{{asset('dana.png')}}" alt="DANA" style="height: 45px; padding: 10px;">
                                                            <img src="{{asset('ovo.png')}}" alt="OVO" style="height: 40px;">
                                                            <img src="{{asset('gopay.png')}}" alt="GoPay" style="height: 45px; padding: 10px;">
                                                        </div>
                                                        <div class="mt-4" style="font-size: 16px; color: #555;"><img src="{{asset('via-midtrans.png')}}" alt="Midtrans" style="height: 20px; vertical-align: middle; margin-left: 5px;"></div>
                                                    </div>
                                                </div>
                                                </div>

                                                <div class="mt-3 text-center">
                                                    <button style="height: 40px; width: 50vw" class="btn btn-danger btn-bayar">BAYAR</button>
                                                </div>
                                            </div>

                                        @endif
                                    @endif
                                @endif

@php
    // Cek apakah semua status dari transaksi dengan order_id ini adalah 'dalam-pengiriman'
    $allSameStatus = true;
    foreach ($transaction as $t) {
        if ($t->order_id === $row->order_id && $t->status !== 'dalam-pengiriman') {
            $allSameStatus = false;
            break;
        }
    }
@endphp

@if ($row->status == 'dalam-pengiriman' && $allSameStatus)
    {{-- BUTTON KIRIM, DITAMPILKAN HANYA DI ROW TERAKHIR DARI order_id --}}
        @if ($transaction->isNotEmpty())  

            <div class="wrap-order-pengiriman" data-order-id="{{ $row->order_id }}">
                <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}">
                <input type="hidden" class="acuan-tanggal-order" value="{{ $row->updated_at }}">
                <input type="hidden" class="acuan-nama-produk" value="{{ $row->productname }}">
                <input type="hidden" class="acuan-kota-pengiriman" value="{{ $row->kota_pengiriman }}">
                <input type="hidden" class="acuan-kurir" value="{{ $row->courier_service }}">
                <input type="hidden" class="acuan-sku" value="{{ $row->sku }}">
                <input type="hidden" class="acuan-qty" value="{{ $row->qty }}">
                <input type="hidden" class="acuan-biaya-kurir" value="{{ $row->courier_cost }}">
                <input type="hidden" class="acuan-imagepath" value="{{ $row->imagepath }}">
                <input type="hidden" class="acuan-harga" value="{{ $row->priceafter }}">
                <input type="hidden" class="acuan-idproduct" value="{{ $row->idproduct }}">
                <input type="hidden" class="acuan-idvar" value="{{ $row->idvar }}">

                {{-- Dialog & Button --}}
                <div class="dialog-confirm" style="display: none;">
                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
                        <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>

                        <h4 class="mt-5">Cek kembali pesanan anda!</h4>

                        <div class="mt-3 konfirmasi" style="padding: 20px; margin-bottom: 20px;">
                            <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 20px;">
                                <button class="btn btn-selesai btn-success">Selesai</button>
                                <button class="btn btn-komplain btn-secondary">Ajukan Komplain</button>
                            </div>
                            {{-- <input type="hidden" class="gtotal" value="{{ $total_pembayaran }}"> --}}
                        </div>

                       
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <button style="height: 40px; width: 50vw" class="mt-5 btn btn-danger btn-konfirmasi">BARANG SAMPAI</button>
                </div>
            </div>
        @endif
@endif

@php
    // Cek apakah semua status dari transaksi dengan order_id ini adalah 'dalam-pengiriman'
    $allSameStatus = true;
    foreach ($transaction as $t) {
        if ($t->order_id === $row->order_id && $t->status !== 'selesai') {
            $allSameStatus = false;
            break;
        }
    }
@endphp

@if ($row->status == 'selesai' && $allSameStatus)
    {{-- BUTTON KIRIM, DITAMPILKAN HANYA DI ROW TERAKHIR DARI order_id --}}
        @if ($transaction->isNotEmpty())  

            <div class="wrap-order-selesai" data-order-id="{{ $row->order_id }}">
                <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}">
                <input type="hidden" class="acuan-tanggal-order" value="{{ $row->updated_at }}">
                <input type="hidden" class="acuan-nama-produk" value="{{ $row->productname }}">
                <input type="hidden" class="acuan-kota-pengiriman" value="{{ $row->kota_pengiriman }}">
                <input type="hidden" class="acuan-kurir" value="{{ $row->courier_service }}">
                <input type="hidden" class="acuan-sku" value="{{ $row->sku }}">
                <input type="hidden" class="acuan-qty" value="{{ $row->qty }}">
                <input type="hidden" class="acuan-biaya-kurir" value="{{ $row->courier_cost }}">
                <input type="hidden" class="acuan-imagepath" value="{{ $row->imagepath }}">
                <input type="hidden" class="acuan-harga" value="{{ $row->priceafter }}">
                <input type="hidden" class="acuan-idproduct" value="{{ $row->idproduct }}">
                <input type="hidden" class="acuan-idvar" value="{{ $row->idvar }}">

                {{-- Dialog & Button --}}
                <div class="dialog-confirm" style="display: none;">
                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
                        <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>

                        <h3>Berikan Penilaian</h3>
                        <div class="stars-rating">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                        </div>
                        <p><strong>Penilaian Anda: </strong><span class="rating-result">0</span></p>
                        <button class="btn-submit-rating" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">Kirim Penilaian</button>
                    </div>
                </div>
                @if ($row->rating == 0)       
                    <div class="mt-3 text-center">
                        <button class="btn btn-primary btn-review mt-5 w-100">NILAI PESANAN</button>
                    </div>
                @else
                    <div class="mt-3 text-center">
                        <p>
                            <strong>Penilaian Anda: </strong>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $row->rating)
                                    <span style="font-size: 32px; color: #f39c12; margin: 0 2px;">&#9733;</span>
                                @else
                                    <span style="font-size: 32px; color: #ccc; margin: 0 2px;">&#9733;</span>
                                @endif
                            @endfor
                        </p>
                    </div>
                @endif


                            </div>
                        @endif
                @endif
                            </div>
                            
                        @empty
                            <h1 class="text-center">Belum ada pesanan</h1>
                        @endforelse
                </div>
            </div> 
        </div>
        <div class="dialog-confirm-responsive" style="display: none;">
            <div class="dialog-content">
                <div id="close-dialog-responsive" class="float-end" style="cursor: pointer;"><i class="fas fa-times"></i></div>
        
                <h4 class="mt-5" style="font-weight: 300; font-family: 'Helvetica', sans-serif;">Pilih Metode pembayaran</h4>
                <!-- Transfer Manual Section -->
                <div id="manual-responsive" class="mt-3" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
                    <div style="font-size: 18px; font-weight: bold; color: #333;">Transfer Manual BCA / Mandiri (Bebas Biaya Admin)</div>
                    <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 10px;">
                        <img src="logo-bank/bca.png" alt="BCA" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <img src="logo-bank/mandiri.png" alt="Mandiri" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    </div>
                </div>
        
                <!-- QRIS / GoPay Section -->
                <div id="midtrans-responsive" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; border-radius: 8px;">
                    <div style="font-size: 18px; font-weight: bold; color: #333; margin-bottom: 10px;">QRIS / GoPay (Include Biaya Admin)</div>
                    <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 10px;">
                        <img src="qris.png" alt="QRIS" style="height: 45px; padding: 10px;">
                        <img src="dana.png" alt="DANA" style="height: 45px; padding: 10px;">
                    </div>
                    <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 10px;">
                        <img src="ovo.png" alt="OVO" style="height: 40px;">
                        <img src="gopay.png" alt="GoPay" style="height: 45px; padding: 10px;">
                    </div>
                    <div class="mt-4" style="font-size: 16px; color: #555;"><img src="via-midtrans.png" alt="Midtrans" style="height: 20px; vertical-align: middle; margin-left: 5px;"></div>
                </div>
            </div>
        </div>    
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
 $(document).ready(function(){
    var originalDialog = $('.dialog-confirm').html();

    if(localStorage.getItem("pembayaran-sukses"))
    {      
        localStorage.removeItem("pembayaran-sukses");     
        
        $('#alert-pembayaran-sukses').show();
    }

    $('#pesanan-diproses-text').on('click', function() {
        const tabLink = $('.tab-link[data-status="diproses"]');

        tabLink.trigger('click');
        tabLink.addClass('active');
        console.log(tabLink.text());
    });

    $('#tutup').on('click', function() {
        $('#alert-pembayaran-sukses').slideUp();
    });
 
    if(localStorage.getItem("delete-transaction"))
    {      
        localStorage.removeItem("delete-transaction");     
        $('#delete-transaction-success').slideDown(150);
        setTimeout(function() {
            $('#delete-transaction-success').slideUp(900);
            }, 5000);
    }

      // Ambil parameter 'status' dari URL
        let urlParams = new URLSearchParams(window.location.search);
        let status = urlParams.get('status');

        if (status) {
            // Hapus class 'active' dari semua tab
            $('.tab-link, .status-item').removeClass('active');

            // Cari tab yang sesuai dengan status dan tambahkan class 'active'
            $('.tab-link.status-item[data-status="' + status + '"]').addClass('active');
        }
        

    let url = "{{ route('histori') }}"

    $('#transaksi').on('click', function() {
      window.location.href = url;
    });
    $('.alamat').on('click', function() {
      window.location.href = '/dashboard/list-alamat';
    });
    $('#profil').on('click', function() {
      window.location.href = '/dashboard/editprofil';
    });

    $('#servis, .servis').on('click', function() {
      window.location.href = '/dashboard/servis';
    });

    $('#tracking').on('click', function() { 
      window.location.href = '/dashboard/tracking';
    });

    $('.btn-hapus').on('click', function() {
        let orderId = $('.acuan-order-id').val();

        $.ajax({
            url: "{{ route('delete.transaction') }}",
            type: 'post',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                _token: "{{ csrf_token() }}",
                _method: 'DELETE',
                orderId: orderId
            }),
            success: function(response){
                location.reload();
            }
        });
    });

    $(".btn-detail").click(function() {
            $('.data-pembeli').html('');

            $(this).closest('.row').find('.dialog-confirm-data-pembeli').fadeIn(); 
            var orderId = $(this).closest('.row').find('.acuan-order-id').val(); 
            var status = $(".tab-link.active").data("status");

            $.ajax({
                url: "{{ route('data.pembeli') }}",
                type: "GET",
                data: 
                { 
                    orderId: orderId
                },
                success: function(response) {
                    $(".data-pembeli").html(response);
                }
            });

            $.ajax({
                url: "{{ route('rincian.transaksi-user') }}",
                type: "GET",
                data: 
                { 
                    orderId: orderId,
                    status: status
                },
                success: function(response) {
                    $(".rincian-pesanan").html(response);
                }
            });

            $(".rincian-pesanan").show();
            $('.tab-link-popup[data-status="rincian-pesanan"]').addClass('active');
            $(".bukti-transaksi").hide();

                $(".tab-link-popup").click(function(e) {
                    e.preventDefault(); // mencegah reload jika href="#"

                    // Atur class aktif
                    $(".tab-link-popup").removeClass("active");
                    $(this).addClass("active");

                    // Cek nilai data-status
                    const status = $(this).data("status");
                    var statusTabLink = $(".tab-link.active").data("status");

                    if (status === "bukti-transaksi") {

                    $.ajax({
                        url: "{{ route('bukti.transaksi') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: 
                        {
                            orderId: orderId
                        },
                        success: function(response) {
                            let buktiTransaksi = response.buktiTransaksi;
                            
                            // Cek apakah buktiTransaksi ada dan bukan null
                            if (buktiTransaksi && buktiTransaksi.order_id !== null) {
                                let formatTotalBayar = buktiTransaksi.total_bayar.toLocaleString('id-ID', { minimumFractionDigits: 0 });

                                $(".bukti-transaksi").html('');
                                $(".bukti-transaksi").append(
                                    `
                                        <h3>Order ID : ${buktiTransaksi.order_id}</h3>
                                        <table class="table table-bordered align-middle w-100 mt-4">
                                            <tbody>
                                                <tr>
                                                    <th>Bank Tujuan</th>
                                                    <td>${buktiTransaksi.bank_tujuan}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bank Asal</th>
                                                    <td>${buktiTransaksi.bank_asal}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Pemilik Rekening</th>
                                                    <td>${buktiTransaksi.pemilik_rekening}</td>
                                                </tr>
                                                <tr>
                                                    <th>No. Rekening Pemilik</th>
                                                    <td>${buktiTransaksi.no_rekening_pemilik}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Pembayaran</th>
                                                    <td>${buktiTransaksi.tanggal_pembayaran}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah yang sudah dibayarkan</th>
                                                    <td>Rp. ${formatTotalBayar}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bukti Pembayaran</th>
                                                    <td>
                                                        <a href="${buktiTransaksi.url_resi}" target="_blank">
                                                            ${buktiTransaksi.url_resi}
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <td>${buktiTransaksi.keterangan ? buktiTransaksi.keterangan : '-'}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    `
                                );
                            } else {
                                $(".bukti-transaksi").html('');
                                $(".bukti-transaksi").append(
                                    `
                                        <div class="text-center">
                                            <h3 class="justify-content-center">Belum Melakukan Pembayaran</h3>
                                        </div>
                                    `
                                );
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                        $(".bukti-transaksi").show();
                        $(".rincian-pesanan").hide();
                    } else {

                        $.ajax({
                            url: "{{ route('rincian.transaksi-user') }}",
                            type: "GET",
                            data: 
                            {
                                orderId: orderId,
                                status: statusTabLink
                            },
                            success: function(response) {
                                $(".rincian-pesanan").html(response);
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });

                        $(".rincian-pesanan").show();
                        $(".bukti-transaksi").hide();
                    }
                });
        });

    $('.btn-bayar').on('click', function() {
        $(this).closest('.wrap-order').find('.dialog-confirm').fadeIn();
    });

    $('.btn-bayar-responsive').on('click', function() {
        $('.dialog-confirm-responsive').fadeIn(); 
    });

    $(document).off('click', '.btn-konfirmasi').on('click', '.btn-konfirmasi', function (e) {
        $(this).closest('.wrap-order-pengiriman').find('.dialog-confirm').fadeIn();
    });

    $(document).off('click', '.btn-selesai').on('click', '.btn-selesai', function (e) {
        e.preventDefault();

        var orderId = $(this).closest('.wrap-order-pengiriman').find('.acuan-order-id').val(); 
        var idProduct = $(this).closest('.wrap-order-pengiriman').find('.acuan-idproduct').val(); 
        var idVar = $(this).closest('.wrap-order-pengiriman').find('.acuan-idvar').val(); 
        var kota = $(this).closest('.wrap-order-pengiriman').find('.acuan-kota-pengiriman').val(); 

        $.ajax({
            url: "{{ route('selesai.transaksi') }}",
            method: 'PUT',
            data: {
                orderId: orderId,
                idProduct: idProduct,
                idVar: idVar,
                kota: kota,
                _token: '{{ csrf_token() }}' 
            },
            success: function (response) {
                $('.dialog-confirm').html('');
                $('.dialog-confirm').append
                (`
                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
                       <div style="width:5rem; height:5rem; border-width:0.6em;" class="spinner-border text-success" role="status"></div>
                    </div>
                `);
            },
            error: function (xhr) {
                console.log('Terjadi kesalahan:', xhr.responseText);
            }
        });
    });

   $(document).off('click', '.btn-komplain').on('click', '.btn-komplain', function (e) {
        e.preventDefault(); 

        var orderId = $(this).closest('.wrap-order-pengiriman').find('.acuan-order-id').val(); 
        var tanggalPengiriman = $(this).closest('.wrap-order-pengiriman').find('.acuan-tanggal-order').val();
        var namaProduk = $(this).closest('.wrap-order-pengiriman').find('.acuan-nama-produk').val();
        var kotaPengiriman = $(this).closest('.wrap-order-pengiriman').find('.acuan-kota-pengiriman').val(); 
        var kurir = $(this).closest('.wrap-order-pengiriman').find('.acuan-kurir').val();
        var sku = $(this).closest('.wrap-order-pengiriman').find('.acuan-sku').val();
        var qty = $(this).closest('.wrap-order-pengiriman').find('.acuan-qty').val();
        var biayaKurir = $(this).closest('.wrap-order-pengiriman').find('.acuan-biaya-kurir').val(); 
        var fotoProduk = $(this).closest('.wrap-order-pengiriman').find('.acuan-imagepath').val();
        var harga = $(this).closest('.wrap-order-pengiriman').find('.acuan-harga').val();
        
         $.ajax({
            url: '/komplain-data',
            method: 'POST',
            data: {
                orderId: orderId,
                tanggalPengiriman: tanggalPengiriman,
                namaProduk: namaProduk,
                kotaPengiriman: kotaPengiriman,
                kurir: kurir,
                sku: sku,
                qty: qty,
                biayaKurir: biayaKurir,
                fotoProduk: fotoProduk,
                harga: harga,
                _token: '{{ csrf_token() }}' // penting untuk proteksi CSRF Laravel
            },
            success: function (response) {
                window.location.href = '/komplain-show';
            },
            error: function (xhr) {
                console.log('Terjadi kesalahan:', xhr.responseText);
            }
        });
    });

    $(document).off('click', '.btn-review').on('click', '.btn-review', function (e) {
        e.preventDefault(); 

        var orderId = $(this).closest('.wrap-order-selesai').find('.acuan-order-id').val(); 
        var tanggalPengiriman = $(this).closest('.wrap-order-selesai').find('.acuan-tanggal-order').val();
        var namaProduk = $(this).closest('.wrap-order-selesai').find('.acuan-nama-produk').val();
        var kotaPengiriman = $(this).closest('.wrap-order-selesai').find('.acuan-kota-pengiriman').val(); 
        var kurir = $(this).closest('.wrap-order-selesai').find('.acuan-kurir').val();
        var sku = $(this).closest('.wrap-order-selesai').find('.acuan-sku').val();
        var qty = $(this).closest('.wrap-order-selesai').find('.acuan-qty').val();
        var biayaKurir = $(this).closest('.wrap-order-selesai').find('.acuan-biaya-kurir').val(); 
        var fotoProduk = $(this).closest('.wrap-order-selesai').find('.acuan-imagepath').val();
        var harga = $(this).closest('.wrap-order-selesai').find('.acuan-harga').val();

        $(this).closest('.wrap-order-selesai').find('.dialog-confirm').fadeIn();
        
         /* $.ajax({
            url: '/komplain-data',
            method: 'POST',
            data: {
                orderId: orderId,
                tanggalPengiriman: tanggalPengiriman,
                namaProduk: namaProduk,
                kotaPengiriman: kotaPengiriman,
                kurir: kurir,
                sku: sku,
                qty: qty,
                biayaKurir: biayaKurir,
                fotoProduk: fotoProduk,
                harga: harga,
                _token: '{{ csrf_token() }}' // penting untuk proteksi CSRF Laravel
            },
            success: function (response) {
                window.location.href = '/komplain-show';
            },
            error: function (xhr) {
                console.log('Terjadi kesalahan:', xhr.responseText);
            } 
        });*/
    });

    $(document).on('click', '.manual, .manual-responsive', function () { 
        let $wrap = $(this).closest('.wrap-order'); // cari wrapper order terdekat
        let gtotal = $wrap.find('.gtotal').val();
        let orderId = $wrap.find('.acuan-order-id').val();
        
        $.ajax({
            url: '/manual-payment',
            method: 'POST',
            data: {
                gtotal: gtotal,
                orderId: orderId,
                _token: '{{ csrf_token() }}' // penting untuk proteksi CSRF Laravel
            },
            success: function (response) {
                if (response.status === "success") {
                    window.location.href = '/manual-payment/index';
                } else {
                    alert('stok habis, silahkan checkout ulang !');
                    location.reload();
                }   
            },
            error: function (xhr) {
                console.log('Terjadi kesalahan:', xhr.responseText);
            }
        });
    });

    $('#midtrans, #midtrans-responsive').on('click', function() {
        
        let orderId = $('.acuan-order-id').val();
        let gtotal = $('.gtotal-midtrans').val();
        console.log(gtotal);
        console.log(orderId);

        // window.location.href='/maintenance';

        $.ajax({
                url: "{{ route('payment.midtrans') }}",
                type: 'post',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    grandTotal: gtotal,
                    orderId: orderId
                }),
                success: function(response){
                    if (response.status === 'error') {
                        if (response.message == '{"error_messages":["transaction_details.order_id has already been taken"]}' || response.message == '{"error_messages":["transaction_details.order_id sudah digunakan"]}')
                        {
                            $.ajax({
                                url: "{{ route('delete.transaction') }}",
                                type: 'post',
                                contentType: 'application/json',
                                dataType: 'json',
                                data: JSON.stringify({
                                    _token: "{{ csrf_token() }}",
                                    _method: 'DELETE',
                                    orderId: orderId
                                }),
                                success: function(response){
                                    console.log('Delete response:', response);
                                    location.reload();
                                    localStorage.setItem('delete-transaction', true);
                                }
                            });
                        } else
                        {
                            console.log('Error:', errorMessage);
                        }
                    } else {
                        window.location.href=response.redirect;
                    }
                },
        });  
    });

    /* $('#close-dialog, #close-dialog-responsive').on('click', function() {
        $('.dialog-confirm').fadeOut();
        $('.dialog-confirm').fadeOut();
    }); */

    $(document).on('click', '.close-dialog, #close-dialog-responsive', function () {
            $('.dialog-confirm').fadeOut();
            $('.dialog-confirm-responsive').fadeOut();
            $('.dialog-confirm-data-pembeli').fadeOut();
            $('.konfirmasi-pengiriman').fadeOut();

            $('.bukti-transaksi').hide();
            $('.tab-link-popup[data-status="bukti-transaksi"]').removeClass('active');
    });

    $(".tab-link, .status-item").click(function(e) {
            e.preventDefault();
            let ajaxRequest;
            let status = $(this).data("status");

            // Ganti class active
            $(".tab-link, .status-item").removeClass("active");
            $(this).addClass("active");

            ajaxRequest = $.ajax({
                url: "{{ route('transaction.fetch') }}",
                type: "GET",
                data: { status: status },
                success: function(response) {
                    $(".card-body").html(response);
                    ajaxRequest.abort();
                }
            });
    });

    let rating = 0;

    // Hover efek
    $('.stars-rating .star').hover(function() {
        let value = $(this).data('value');

        // Tambahkan kelas hovered untuk bintang sampai value
        $('.stars-rating .star').each(function() {
            if ($(this).data('value') <= value) {
                $(this).addClass('hovered').removeClass('dimmed');
            } else {
                $(this).removeClass('hovered').addClass('dimmed');
            }
        });

    }, function() {
        // Reset hover
        $('.stars-rating .star').removeClass('hovered dimmed');
    });

    // Klik untuk pilih rating
    $('.stars-rating .star').click(function() {
        rating = $(this).data('value');

        // Update tampilan bintang
        $('.stars-rating .star').each(function() {
            if ($(this).data('value') <= rating) {
                $(this).addClass('selected').removeClass('dimmed');
            } else {
                $(this).removeClass('selected').addClass('dimmed');
            }
        });

        // Update teks penilaian
        $('.rating-result').text(rating);
    });

    // Submit rating
    $('.btn-submit-rating').click(function() {
        if (rating === 0) {
            alert('Silakan pilih penilaian!');
            return;
        }

        let orderId = $(this).closest('.wrap-order-selesai').find('.acuan-order-id').val();
        let idProduct = $(this).closest('.wrap-order-selesai').find('.acuan-idproduct').val();
        let idVar = $(this).closest('.wrap-order-selesai').find('.acuan-idvar').val();
        let kota = $(this).closest('.wrap-order-selesai').find('.acuan-kota-pengiriman').val();

        $.ajax({
            url: "{{ route('rating') }}",
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                orderId: orderId,
                rating: rating,
                idProduct: idProduct,
                idVar: idVar,
                kota: kota
            },
            success: function(response) {
                alert('Penilaian berhasil disimpan!');                
                $('.dialog-confirm').fadeOut();

                $('.tab-link').removeClass('active');
                $('a[data-status="selesai"]').addClass('active');

                let status = "selesai";

                $.ajax({
                    url: "{{ route('transaction.fetch') }}",
                    type: "GET",
                    data: { status: status },
                    success: function(response) {
                        $(".card-body").html(response);
                    }
                }); 
            }
        });
    });

    $(document).on('click', '.btn-batal-transaksi', function() {
        $(this).closest('.wrap-order-belum-dibayar').find('.dialog-confirm').fadeIn(); 
    });

    $(document).on('click', '.btn-konfirmasi-batal' , function (e) {
        e.preventDefault(); 

        var orderId = $(this).closest('.wrap-order-belum-dibayar').find('.acuan-order-id').val(); 
         
        $.ajax({
            url: "{{ route('batal.transaksi') }}",
            method: 'PUT',
            data: {
                orderId: orderId,
                _token: '{{ csrf_token() }}' 
            },
            success: function (response) {
                alert('Berhasil Dibatalkan');
                location.reload();
            },
            error: function (xhr) {
                console.log('Terjadi kesalahan:', xhr.responseText);
            }
        });
    });

    $(document).on('click', '.btn-cancel-batal' , function (e) {
        e.preventDefault(); 

        $('.dialog-confirm').fadeOut(); 
    });
  });
</script>
  </body>
</html>