<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Toko Komputer, PC, Printer, Aksesoris terbaik di Surabaya, Malang, Kediri, Solo, Denpasar, Jogja (Yogyakarta) - Canon, Epson. HP , Brother , Asus">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DUTA SARANA COMPUTER - PRICE LIST</title>
    
    <link rel="icon" type="image/x-icon" href="favicon.ico?v=1.0">

    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="style2.css?v=2">
    <link rel="stylesheet" href="style3.css?v=2">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a59b9b09ab.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

  </head>
  <body>

<div class="container">
    @if(session('order_preview'))
    @php
          // Ambil data kota dari session
        $kotaList = collect(session('order_preview.listProduk'))->map(fn($list) => json_decode($list, true))
                      ->flatten(1) // Menggabungkan semua produk menjadi satu array
                      ->pluck('kota') // Ambil semua kota dari produk
                      ->unique(); // Hilangkan kota yang duplikat

        $courierList =  session('order_preview.courier');
                        if (!is_array($courierList)) {
                            $courierList = json_decode($courierList, true) ?? [];
                        }

        $layananList =  session('order_preview.listLayanan');
                        if (!is_array($layananList)) {
                            $layananList = json_decode($layananList, true) ?? [];
                        }

                        $layananListTrim = array_map(fn($layanan) => preg_replace('/, \d+$/', '', $layanan), $layananList);

                        $harga = array_map(function ($layanan) {
                            preg_match('/\d+$/', $layanan, $matches);
                            return $matches[0] ?? null; // Ambil hasil pertama, jika ada
                        }, $layananList);


        // Decode semua data listProduk dari JSON ke array
        $listProduk = collect(session('order_preview.listProduk'))
                      ->map(fn($list) => json_decode($list, true))
                      ->flatten(1); // Gabungkan semua produk dalam satu array
    @endphp

    
    <h2 class="mt-5" style="margin-bottom: 5px">Rincian Pesanan</h2>
    <div style="font-size: 18px;"><i>* Cek kembali data pesanan dan data pembeli !</i></div>
    
    <h4 class="mt-5">Order ID: {{ $orderId }}</h4>
    <input type="hidden" id="order-id" value="{{ $orderId }}">

    @foreach($kotaList as $kota)
    <p style="font-size: 25px; color: #920700" class="text-center" data-kota={{$kota}}>
        <b>Lokasi Pengiriman : {{$kota}}</b>
    </p>
    <input type="hidden" class="kota" value="{{$kota}}">

    <div class="table-responsive">
        <table class="table table-bordered" style="border: 1px solid rgba(0,0,0,0.5)">
            <thead style="background-color: #920700;">
                <tr style="color: white">
                    <th class="text-center w-100">Nama Produk</th>
                    <th class="text-center">Harga @</th>
                    <th class="text-center">Discount</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $grand_total = [];
                    $total_belanja_kota = [];
                    $total_belanja_all = [];
                @endphp

                @foreach($listProduk as $produk)
                    @php
                        $sub_total = $produk['priceafter'] * $produk['qty'];
                        $total_belanja_all[] = $sub_total;
                    @endphp
            
                    @if($produk['kota'] == $kota) 
                        @php
                            // Simpan subtotal berdasarkan kota dalam array
                            if (!isset($total_belanja_kota[$produk['kota']])) {
                                $total_belanja_kota[$produk['kota']] = 0;
                            }
                            $total_belanja_kota[$produk['kota']] += $sub_total;
                        @endphp
                        <tr>
                            <td class="w-100" style="padding-bottom: 20px;">
                                {{ $produk['productname'] }}<br>
                                <b>(SKU : {{ $produk['sku'] }})</b>
                                <input type="hidden" class="list-sku" value="{{ $produk['sku'] }}"> 
                                <input type="hidden" class="list-productname" value="{{ $produk['productname'] }},{{ $produk['kota'] }}"> 
                            </td>
                            <td class="text-center">Rp. {{number_format($produk['priceafter'],0,',','.')}}
                            <input type="hidden" class="harga" value="{{ $produk['priceafter'] }}">
                            </td>                           

                            <td class="text-center">0%</td>
                            
                            <td class="text-center">{{ $produk['qty'] }}</td>
                            <input type="hidden" class="qty" value="{{$produk['qty']}}">

                            <td class="text-center">Rp. {{number_format($sub_total,0,',','.')}}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><b>Sub Total</b></td>
                    <td class="text-center">Rp. {{ number_format(array_sum($total_belanja_kota), 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Biaya Pengiriman :  </b>{{ $courierList[$loop->index] ?? '-' }} - {{ $layananListTrim[$loop->index] ?? '-' }}
                    </td>
                    <td class="text-center">Rp. {{number_format($harga[$loop->index],0,',','.')}}</td>
                </tr>
            </tfoot>
            @php
                $grand_total = array_sum($total_belanja_all) + array_sum($harga);
            @endphp
        </table>
    </div>
    @endforeach

    @foreach ( $courierList as $row)
        <input type="hidden" class="list-kurir" value="{{$row}}">
    @endforeach

    @foreach ( $layananListTrim as $row)
        <input type="hidden" class="list-layanan" value="{{$row}}">
    @endforeach

    @foreach ( $harga as $row)
        <input type="hidden" class="list-couriercost" value="{{$row}}">
    @endforeach

    <p style="font-size: 25px; color: #920700; margin-top: 100px;"><b>Total Pembayaran</b></p>
    <div class="table-responsive">
        <table class="table table-bordered" style="width: 100%; table-layout: fixed; border: 1px solid rgba(0,0,0,0.5)">
            <tbody>
                    <tr>
                        @php
                            $grandTotalPlusAdmin = $grand_total
                        @endphp   
                        <td style="white-space: nowrap;"><b>Grand Total</b></td>
                        <td style="white-space: nowrap;"><b>Rp. {{number_format($grandTotalPlusAdmin,0,',','.')}}</b>
                        <input type="hidden" class="gtotal" value="{{$grandTotalPlusAdmin}}">
                        </td>
                    </tr>
            </tbody>
           
        </table>
    </div>

    <p class="mt-4" style="font-size: 25px; color: #920700"><b>Data Pembeli </b></p>
    <ul class="ms-3 list-unstyled">
        <li><b>Nama Lengkap<span id="nama-order-preview">:</span></b> {{ session('order_preview.nama') }}</li>
        <li class="mt-2"><b>Alamat<span id="alamat-order-preview">:</span></b> {{ session('order_preview.alamat') }}</li>
        <li class="mt-2"><b>Kec./Kelurahan / Kota dan Provinsi<span id="kecamatan-order-preview">:</span></b> {{session('order_preview.kecamatan')}}, {{session('order_preview.kelurahan')}}, {{session('order_preview.kota')}}, {{session('order_preview.provinsi')}}</li>
        <li class="mt-2"><b>No. Telp/HP<span id="telp-order-preview">:</span></b> {{session('order_preview.phone')}}</li>
    </ul>

    <div class="d-flex mt-5 justify-content-center" style="padding-bottom: 70px">
        <button class="btn btn-secondary me-2">Kembali</button>
        <button id="btn-payment" class="btn btn-primary ms-2">Selanjutnya</button>
    </div>
    
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        var listKurir = [];
        var listLayanan = [];

        var kota = [];
        var harga = []; 
        var qty = []; 
        var kurirDesc = [];
        var listProductName = [];
        var listSku = [];
        var listQty = [];
        var listCourierCost = [];

        $('.kota').each(function () {
            let data = $(this).val();
            kota= kota.concat(data);
        });

        $('.harga').each(function () {
            let data = $(this).val();
            harga= harga.concat(data);
        });

        $('.list-kurir').each(function () {
            listKurir.push($(this).val());
        });

        $('.list-layanan').each(function () {
            listLayanan.push($(this).val());
        });

        $('.list-sku').each(function () {
            listSku.push($(this).val());
        });

        $('.list-productname').each(function () {
            listProductName.push($(this).val());
        });

        $('.qty').each(function () {
            listQty.push($(this).val());
        });

        $('.list-couriercost').each(function () {
            listCourierCost.push($(this).val());
        });

        kurirDesc = listKurir.map(function (kurir, index) {
            return kurir + " - " + (listLayanan[index] || '-');
        }); 

        $('#btn-payment').on('click', function() { 

            let grandTotal = $('.gtotal').val();
            let orderId = $('#order-id').val();
            console.log(kota);
            console.log(kurirDesc);
            console.log(listSku);
            console.log(listProductName);
            console.log(listQty);
            console.log(listCourierCost);
            console.log(harga);

        $.ajax({
                url: "{{ route('payment') }}",
                type: 'post',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    listProductName: listProductName,
                    listSku: listSku,
                    kurirDesc: kurirDesc,
                    listCourierCost: listCourierCost,
                    kota: kota,
                    listQty: listQty,
                    orderId: orderId,
                    grandTotal: $('.gtotal').val()
                }),
                success: function(response){
                    window.location.href=response.redirect_url;
                    /* alert(`Nomer Virtual Account anda : ${response.va_number}, Silahkan lakukan pembayaran`); */
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            }); 
        });
    });

</script>
  </body>
</html>