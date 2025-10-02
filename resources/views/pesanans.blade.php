<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pesanan</title>

    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico?v=1.0')}}">

    <link rel="stylesheet" href="{{asset('style.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style2.css?v=2')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <style>
           .icon-menu {
          width: 40px;  /* Sesuaikan dengan ukuran ikon sebelumnya */
          height: 40px;
          margin-bottom: 6px;
          cursor: pointer;  /* Agar tetap bisa diklik */
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
      </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div style="margin-top: 10vh; margin-left: 2vh; font-size: 23px; font-weight: 600">
            <i class="fas fa-user"></i>&nbsp;&nbsp;Admin {{auth()->user()->username}}
        </div>
        <ul>

            <li id="home"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</li>
            <li style="background: rgba(255, 255, 255, 0.4); cursor: default"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;PESANAN</li>
            <li id="statistik"><i class="far fa-chart-bar"></i>&nbsp;&nbsp;STATISTIK</li>
            <li>
                <form action="/logout" method="post">
                    @csrf
                    <button style="border: none; background: none; color: inherit" type="submit">
                        <i class="fas fa-power-off"></i>&nbsp;&nbsp;LOG OUT
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="nav-admin">
        <span class="toggle-btn"><img src="jempol.png" class="icon-menu">
          <span id="sembunyikan-menu" style="font-size: 20px">< Sembunyikan Menu</span>
          <span id="tampilkan-menu" style="font-size: 20px">Tampilkan Menu ></span>
        </span>
        <span style="font-size: 22px; font-weight: 500">Admin Panel (Data Stok, List Order & More)</span>
    </div>
    <div class="content" id="content">
        <div class="container ms-3 mt-4">
            <h1>List Pesanan - {{ auth()->user()->username }}</h1>
            <div class="tab-menu">
                <a href="#" data-status="diproses" class="tab-link active">Pesanan Masuk</a>
                <a href="#" data-status="dalam-pengiriman" class="tab-link">Dalam Pengiriman</a>
                <a href="#" data-status="selesai" class="tab-link">Pesanan Selesai</a>
                <a href="#" data-status="dikomplain" class="tab-link">Dikomplain</a>
                <a href="#" data-status="dibatalkan" class="tab-link">Dibatalkan</a>
            </div>
              <div class="search-box">
                  <span class="icon"><i class="fas fa-search"></i></span>
                  <input id="cari-pesanan" type="text" placeholder="Cari Pesanan">
              </div>
              <div class="card mt-4">
                <div class="card-body">
                    <div class="container mt-3">
                        @php
                            $total_belanja = 0;
                            $sumBiayaKurir = 0; // Inisialisasi di luar loop utama
                            $layananKurir ="";
                            $biayaKurir = 0;
                            $totalBiayaKurir = 0;
                            $shownCourierServices = [];
                            $courierCounts = []; // Menyimpan jumlah kemunculan biaya kurir
                            $shownOrderIds = [];
                            $shownDscCourierOrderIds = [];

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
                                $total_belanja += $sub_total;
                                $layananKurir = $row->courier_service;
                                $biayaKurir = $row->courier_cost;

                                $courierKey = $layananKurir . '|' . $biayaKurir;

                                $orderIdSeen[$row->order_id] = isset($orderIdSeen[$row->order_id]) ? $orderIdSeen[$row->order_id] + 1 : 1;

                                $layananKurirKey = $row->order_id . '|' . $row->courier_service;
                            @endphp

                            <div class="row mb-3 {{ !$loop->first ? 'mt-5' : '' }}">

                                {{-- TAMPILKAN HANYA SEKALI PER ORDER_ID --}}
                                @if (!in_array($row->order_id, $shownOrderIds))
                                    @php $shownOrderIds[] = $row->order_id; @endphp

                                    <div class="d-flex">
                                        <h3>Order ID : {{ $row->order_id }}</h3>
                                        <button class="btn-detail btn btn-success ms-5 mb-3">Lihat Detail Transaksi</button>
                                        <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}" >
                                    </div>

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

                                    <div style="font-size: 17px">Tanggal Order : <b>{{ $row->updated_at }}</b></div>
                                @endif

                                {{-- PRODUK --}}
                                <div class="col-md-2 mt-3">
                                    <img src="{{$row->imagepath}}" class="img-fluid" alt="">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <h6>{{$row->productname}}</h6>
                                    <p>{{$row->sku}}</p>
                                    <p>Qty : {{$row->qty}} pcs (@ Rp {{number_format($row->priceafter,0,',','.')}})</p>
                                </div>

                                {{-- KURIR --}}
                              {{--   @if (!in_array($courierKey, $shownCourierServices))
                                    @php $shownCourierServices[] = $courierKey; @endphp
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})
                                            @if ($courierCounts[$courierKey] > 1)
                                                x {{ $courierCounts[$courierKey] }}
                                            @endif
                                        </p>
                                    </div>
                                @endif --}}

                                @php
                                    $courierKey = $row->order_id . '|' . $layananKurir . '|' . $biayaKurir;
                                @endphp

                                @if ($row->status == 'dalam-pengiriman')
                                    <div class="col-md-4 text-end">
                                        @if (str_contains($row->courier_service, 'DSC'))
                                            <p>Kurir: {{ $layananKurir }}</p>
                                            <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
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
                                        <p>
                                            <b>Penilaian : 
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $row->rating)
                                                        <span style="color: rgb(255, 153, 0); font-size: 20px">&#9733;</span> {{-- Bintang penuh --}}
                                                    @else
                                                        <span style="color: #ccccccd5; font-size: 20px">&#9734;</span> {{-- Bintang kosong --}}
                                                    @endif
                                                @endfor
                                            </b>
                                        </p>
                                    </div>
                                {{-- @elseif ($row->status == 'diproses')
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
                                    </div> --}}
                                @else
                                    <div class="col-md-4 text-end">
                                        <p>Kurir: {{ $layananKurir }}</p>
                                        <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
                                    </div>
                                @endif

                                <div class="konfirmasi-pengiriman" style="display: none">
                                    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                                        <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>

                                        @if (str_contains($row->courier_service, 'DSC') !== false && !in_array($row->order_id, $shownDscCourierOrderIds))
                                            @php 
                                                $shownDscCourierOrderIds[] = $row->order_id; 
                                            @endphp
                                            
                                            <h5 class="mt-4">Konfirmasi Pengiriman</h5>
                                            <div class="mt-3 d-flex justify-content-center gap-2">
                                                <button class="btn btn-danger btn-konfirmasi-kirim">KIRIM</button>
                                                <button class="btn btn-secondary btn-batal-kirim">BATAL</button>
                                            </div>
                                        @else
                                            <h5 class="mt-4">Masukkan No. Resi</h5>
                                            <input type="text" class="no-resi" placeholder="No. Resi">
                                            <div class="mt-3 d-flex justify-content-center gap-2">
                                                <button class="btn btn-danger btn-konfirmasi-kirim">KIRIM</button>
                                                <button class="btn btn-secondary btn-batal-kirim">BATAL</button>
                                            </div>
                                        @endif

                                        <input type="hidden" class="index-order-id" value="{{ $row->order_id }}">
                                    </div>
                                </div>    

                                @if ($row->status == 'diproses')
                                    {{-- BUTTON KIRIM, DITAMPILKAN HANYA DI ROW TERAKHIR DARI order_id --}}
                                    @if ($orderIdSeen[$row->order_id] === $orderIdCounts[$row->order_id])
                                    <div class="wrap-batal-pengiriman" data-order-id="{{ $row->order_id }}">
                                        <input type="hidden" class="acuan-order-id" value="{{ $row->order_id }}" >

                                        <div class="dialog-confirm" style="display: none">
                                            <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                                                <div class="float-end close-dialog" style="cursor: pointer;"><i class="fas fa-times"></i></div>
                                            
                                                    <h5 class="mt-4">Batalkan Pengiriman</h5>
                                                    <div class="mt-3 d-flex justify-content-center gap-2">
                                                        <button class="btn btn-danger btn-ok-batal">YA</button>
                                                        <button class="btn btn-secondary btn-cancel-batal">CANCEL</button>
                                                    </div>
                                            
                                                <input type="hidden" class="index-order-id" value="{{ $row->order_id }}">
                                            </div>
                                        </div>  

                                        <div class="mt-5 text-center">
                                            <button style="height: 40px; width: 25vw" class="btn btn-danger btn-kirim">KIRIM</button>
                                            <button style="height: 40px; width: 25vw" class="ms-2 btn btn-secondary btn-konfirmasi-batal-kirim">BATALKAN</button>
                                        </div>
                                    </div>
                                    @endif
                                @else
                                    
                                @endif

                            </div>
                        @empty
                            <h1 class="text-center">Belum ada pesanan</h1>
                        @endforelse


                            @if ($transaction->isNotEmpty())  
                                @php
                                    $grandTotal = $total_belanja + $totalBiayaKurir;
                                @endphp

                                {{-- <div class="me-auto mt-5">
                                    <h5 class="fw-bold">Pemasukan :</h5>
                                    <p>Rp. {{number_format($grandTotal,0,',','.')}}</p>
                                </div> --}}
                            @endif
                                </div>
                    </div>
                </div>
        </div>  
    </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#cari-pesanan").val('');

        var originalDialog = $('.dialog-confirm').html();

        $('#tampilkan-menu').hide();
        $(".rincian-pesanan").html('');

        if (localStorage.getItem('showSuccess')) {
            // Jalankan efek slideDown
            $('#sukses').slideDown(150);

            // Hapus status dari localStorage agar tidak terus berulang
            localStorage.removeItem('showSuccess');

            // Sembunyikan elemen setelah beberapa detik
            setTimeout(function() {
                $('#sukses').slideUp();
            }, 6000);
        }

        $('#home').on('click', function() {
            window.location.href = '/admin';
        });

        $('#statistik').on('click', function() {
            window.location.href = '/statistik';
        });

        $('.toggle-btn').on('click', function() {
        if ($('#sidebar').hasClass('hide')) {
            $('#sidebar').removeClass('hide');
            $('#content').removeClass('full');
            $('#sembunyikan-menu').show();
            $('#tampilkan-menu').hide();
        } else {
            $('#sidebar').addClass('hide');
            $('#content').addClass('full');
            $('#sembunyikan-menu').hide();
            $('#tampilkan-menu').show();
        }
        });

        $(".tab-link").click(function(e) {
            e.preventDefault();
            let status = $(this).data("status");
            var orderId = $(this).closest('.row').find('.acuan-order-id').val(); 

            // Ganti class active
            $(".tab-link").removeClass("active");
            $(this).addClass("active");

            console.log('Order ID:', orderId);
            console.log('Status:', status);

            // Ambil data via AJAX
            $.ajax({
                url: "{{ route('transaction-admin.fetch') }}",
                type: "GET",
                data: 
                { 
                    orderId: orderId,
                    status: status
                },
                success: function(response) {
                    $(".card-body").html(response);
                    $('.toggle-btn').on('click', function() {
                        if ($('#sidebar').hasClass('hide')) {
                            $('#sidebar').removeClass('hide');
                            $('#content').removeClass('full');
                            $('#sembunyikan-menu').show();
                            $('#tampilkan-menu').hide();
                        } else {
                            $('#sidebar').addClass('hide');
                            $('#content').addClass('full');
                            $('#sembunyikan-menu').hide();
                            $('#tampilkan-menu').show();
                        }
                    });
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
                            let urlMidtrans = response.urlMidtrans;
                            
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
                            }  else if (urlMidtrans !== null) {
                                $(".bukti-transaksi").html('');
                                $(".bukti-transaksi").append(
                                    `
                                        <div class="text-center">
                                            <h5 class="justify-content-center copy-text" style="cursor:pointer;" title="Klik untuk copy">${urlMidtrans}</h5>
                                        </div>
                                    `
                                );

                                 $(".copy-text").on("click", function() {
                                    let text = $(this).text();
                                    navigator.clipboard.writeText(text).then(() => {
                                        alert("Tersalin: " + text);
                                    }).catch(err => {
                                        console.error("Gagal menyalin: ", err);
                                    });
                                });
                            } 
                            else {
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

        $(document).on('click', '.close-dialog', function () {
            $('.dialog-confirm').fadeOut();
            $('.dialog-confirm-data-pembeli').fadeOut();
            $('.konfirmasi-pengiriman').fadeOut();

            $('.bukti-transaksi').hide();
            $('.tab-link-popup[data-status="bukti-transaksi"]').removeClass('active');
        });

        $(document).on('click', '.btn-kirim', function () {

            var index = $(".btn-kirim").index($(this));
            var orderId = $(".acuan-order-id").eq(index).val();

                $(this).closest('.row').find('.konfirmasi-pengiriman').fadeIn();

                    $(document).off('click', '.btn-konfirmasi-kirim').on('click', '.btn-konfirmasi-kirim', function () {
                        var index = $(".btn-konfirmasi-kirim").index($(this));
                        var indexOrderId = $(".index-order-id").eq(index).val();
                        var noResi = $(".no-resi").eq(index).val();

                        if (noResi === "") {
                            alert("No. Resi tidak boleh kosong!");
                            return; // hentikan eksekusi
                        } else {
                            $.ajax({
                                url: "{{ route('kirim.transaksi') }}",
                                type: "PUT",
                                data: 
                                { 
                                    _token: "{{ csrf_token() }}",
                                    indexOrderId: indexOrderId,
                                    noResi: noResi
                                },
                                success: function(response) {
                                    // $(".rincian-pesanan").html(response);
                                    location.reload();
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });

                    $(document).off('click', '.btn-batal-kirim').on('click', '.btn-batal-kirim', function () {
                        $('.konfirmasi-pengiriman').fadeOut();

                        $('.bukti-transaksi').hide();
                        $('.tab-link-popup[data-status="bukti-transaksi"]').removeClass('active');
                    });
        });

        $(document).off('click', '.btn-konfirmasi-batal-kirim').on('click', '.btn-konfirmasi-batal-kirim', function () {
            $(this).closest('.wrap-batal-pengiriman').find('.dialog-confirm').fadeIn();
        });

        $(document).off('click', '.btn-cancel-batal').on('click', '.btn-cancel-batal', function () {
            $('.dialog-confirm').fadeOut();
        });

        $(document).off('click', '.btn-ok-batal').on('click', '.btn-ok-batal', function () {
            var orderId = $(this).closest('.wrap-batal-pengiriman').find('.acuan-order-id').val(); 

            $.ajax({
                url: "{{ route('batal.transaksi') }}",
                type: "PUT",
                data: 
                { 
                    _token: "{{ csrf_token() }}",
                    orderId: orderId,
                },
                success: function(response) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $('#cari-pesanan').on('change', function(e) {
            e.preventDefault();

            $("#back-to-first").remove();

            let productName = $('#cari-pesanan').val();

            $('.tab-menu').hide();
            $('.search-box').append(
            `
                <button id="back-to-first" class="btn btn-danger">KEMBALI</button>
            `
            );

            $('#back-to-first').on('click', function() {
                location.reload();
            });

            $.ajax({
                url: "{{ route('cari.pesanan-admin') }}",
                type: "GET",
                data: { productName: productName },
                beforeSend: function() {
                    $(".card-body").html(`
                        <div class="d-flex justify-content-center p-3">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    `);
                },
                success: function(response) {
                    setTimeout(function() {
                        $(".card-body").html(response);
                    }, 400); 
                },
            });
        });
    });
</script>
</body>
</html>