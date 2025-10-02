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

    <style>
    select.layanan {
        width: 100%;
        font-size: 16px;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #ccc;
        appearance: none; /* untuk Chrome */
        -webkit-appearance: none; /* untuk Safari */
        -moz-appearance: none; /* untuk Firefox */
        background: url('data:image/svg+xml;utf8,<svg fill="%23333" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
        background-size: 16px;
        background-color: white;
    }

    @media (max-width: 400px) {
        select.layanan {
            font-size: 14px;
            padding: 6px 10px;
        }
    }
    </style>

  </head>
  <body>
@include('partials.navbar')

@if(session('error'))
    <div id="preview-reject" class="fixed-top mt-5 alert alert-danger text-center" role="alert">
        {{ session('error') }}
    </div>
@endif

<div class="container mt-5">
    <h5 style="font-weight: 600">Checkout Pesanan</h5>
        <div class = "card mt-4" style="background-color: #920700;">
            <div class = "card-header">
                <h3 id="data-pembeli" class = "text-white card-title">Data Pembeli</h3>
            </div>
            <div id="data-pembeli-desktop" class = "bg-light card-body">
                <ul style="list-style: none;">
                    @forelse ($alamat as $row)
                        <li>Nama Lengkap<span style="margin-left: 30px">:</span><b class="ms-2"> {{$row->customername}}</b></li>
                        <li>No. Telp/HP<span style="margin-left: 51px">:</span><b class="ms-2"> {{$row->phone}}</b></li>
                        <li>Alamat<span style="margin-left: 88px">:</span><b class="ms-2"> {{$row->address}}, {{$row->district_name}}, {{$row->kelurahan_name}}, {{$row->city_name}}, {{$row->province}}</b></li>
                        <input type="hidden" id="nama-cust" value="{{$row->customername}}">
                        <input type="hidden" id="phone-cust" value="{{$row->phone}}">
                        <input type="hidden" id="alamat-cust" value="{{$row->address}}">
                        <input type="hidden" id="kota-cust" value="{{$row->city_name}}">
                        <input type="hidden" id="kecamatan" value="{{$row->district_name}}">
                        <input type="hidden" id="kelurahan" value="{{$row->kelurahan_name}}">
                        <input type="hidden" id="provinsi" value="{{$row->province}}">
                    @empty
                        <li><h3 style="font-weight: 400">Anda belum memiliki data alamat !</h3></li><br>
                        <button class="tambah-alamat btn btn-primary">TAMBAH DATA ALAMAT</button>
                    @endforelse
                </ul>
            </div>
            <div id="data-pembeli-mobile" class = "bg-light card-body">
                <ul style="list-style: none;">
                    @forelse ($alamat as $row)
                        <li>Nama Lengkap<span style="margin-left: 10px">:</span><br><b>{{$row->customername}}</b></li>
                        <li class="mt-3">No. Telp/HP<span style="margin-left: 32px">:</span><br><b> {{$row->phone}}</b></li>
                        <li class="mt-3">Alamat<span style="margin-left: 69px">:</span><br><b>{{$row->address}}, {{$row->district_name}}, {{$row->kelurahan_name}}, {{$row->city_name}}, {{$row->province}}</b></li>
                        <input type="hidden" id="nama-cust" value="{{$row->customername}}">
                        <input type="hidden" id="phone-cust" value="{{$row->phone}}">
                        <input type="hidden" id="alamat-cust" value="{{$row->address}}">
                        <input type="hidden" id="kota-cust" value="{{$row->city_name}}">
                        <input type="hidden" id="kecamatan" value="{{$row->district_name}}">
                        <input type="hidden" id="kelurahan" value="{{$row->kelurahan_name}}">
                        <input type="hidden" id="provinsi" value="{{$row->province}}">
                    @empty
                        <li><h3 style="font-weight: 400">Anda belum memiliki data alamat !</h3></li><br>
                        <button class="tambah-alamat btn btn-primary">TAMBAH DATA ALAMAT</button>
                    @endforelse
                </ul>
            </div>
        <div class = "mt-4 card" style="background-color: #920700;">
            <div class = "card-header">
                <h3 class = "text-white card-title">Daftar Belanja</h3>
            </div>
            <div class="bg-light card-body">
                <div style="color: red;" class="keterangan">Geser tabel ke kanan (->) untuk informasi lebih lengkap</div> 
                
                @php
                    $total_belanja = 0;
                    $total_berat = 0;
                    $groupedCart = [];
                @endphp
        
            @foreach ($cart as $row)
                @php
                    $sub_total = $row->priceafter * $row->qty;
                    $sub_berat = $row->berat * $row->qty;
                    $total_belanja += $sub_total;
                    $total_berat += $sub_berat;
                @endphp
        
                @if (!isset($groupedCart[$row->kota])) 
                    @php
                        $groupedCart[$row->kota] = [
                            'total_berat' => 0,
                            'products' => []
                        ];
                    @endphp
                @endif
        
                @php
                    $groupedCart[$row->kota]['total_berat'] += $sub_berat;
                    $groupedCart[$row->kota]['products'][] = $row;
                @endphp
            @endforeach
        
            @foreach ($groupedCart as $kota => $data)
                <p style="font-size: 20px; color: #920700" class="text-center"><b>Lokasi Pengiriman: {{$kota}}</b></p>
                <input type="hidden" value="{{$kota}}" class="kota">
                
                <input type="hidden" value='@json($data['products'])' class="list-produk">

        
                <div class="mt-4 table-responsive">
                    <table class="table table-bordered w-100" style="border-width:8px;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"></th>  
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga @</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Berat @</th>
                                <th scope="col">Sub Total</th>
                                <th scope="col">Total Berat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['products'] as $row)
                                <tr class="product-item">
                                    <td><img class="thumbnail" src="{{$row->imagepath}}" style="height: 100px;width: 100px;"></td>  
                                    <td style="word-wrap: break-word; word-break: break-word;">{{$row->productname}}</td>
                                    <td>Rp. {{number_format($row->priceafter,0,',','.')}}</td>
                                    <td>{{$row->qty}}</td>
                                    <td>{{$row->berat}}</td>
                                    <td>Rp. {{number_format($row->priceafter * $row->qty,0,',','.')}}</td>
                                    <td>{{$row->berat * $row->qty}} gram</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
            </div>
        </div>

        <div class = "mt-4 card" style="background-color: #920700;">
            <div class = "card-header">
                <h3 class = "text-white card-title">Pilih Kurir</h3>
                <div style="font-size: 20px; color: white; padding-bottom: 15px"><i>*Silahkan hubungi WA 0896 9936 4779 jika terjadi kendala</i></div>
            </div>
            <div class = "bg-light card-body">
                @foreach ($groupedCart as $kota => $data)
                    <p style="font-size: 20px; color: #920700" class="text-center"><b>Lokasi Pengiriman: {{$kota}}</b></p>
                    <input type="hidden" value="{{$kota}}" class="kota">

                    <ul style="list-style: none;">
                        <li>Berat Total: <b class="total-berat">{{$data['total_berat']}} gram</b></li>
                        <input type="hidden" value='@json($data['total_berat'])' class="berat">
                        </li><br>
                        <li class="col-md-6"> Kurir :
                            <select name="kurir" class="kurir form-select">
                                @foreach ($alamat as $row)
                                    @if ($row->city_name === 'KOTA SURABAYA' && $kota === 'Surabaya' )
                                        <option value="" disabled selected>-- PILIH KURIR --</option>
                                        <option value="dsc" data-icon="logo-kurir/jempol.png" data-name="DSC">DSC Kurir (Khusus Area Surabaya)</option>
                                        <option value="jne" data-icon="logo-kurir/jne.png" data-name="JNE">JNE</option>
                                        <option value="pos" data-icon="logo-kurir/pos.png" data-name="POS">POS</option>
                                        {{-- <option value="tiki" data-icon="logo-kurir/tiki.png" data-name="TIKI">TIKI</option> --}}
                                        {{-- <option value="ide" data-icon="logo-kurir/idexp.png" data-name="ID Express">ID Express</option> --}}
                                        <option value="lion" data-icon="logo-kurir/lion.png" data-name="Lion Parcel">Lion Parcel</option>
                                        {{-- <option value="wahana" data-icon="logo-kurir/wahana.png" data-name="Wahana">Wahana</option> --}}
                                    @endif
                                    @if ($row->city_name !== 'KOTA SURABAYA' || $kota !== 'Surabaya' )
                                        <option value="" disabled selected>-- PILIH KURIR --</option>
                                        <option value="jne" data-icon="logo-kurir/jne.png" data-name="JNE">JNE</option>
                                        <option value="pos" data-icon="logo-kurir/pos.png" data-name="POS">POS</option>
                                        {{-- <option value="tiki" data-icon="logo-kurir/tiki.png" data-name="TIKI">TIKI</option> --}}
                                        {{-- <option value="ide" data-icon="logo-kurir/idexp.png" data-name="ID Express">ID Express</option> --}}
                                        <option value="lion" data-icon="logo-kurir/lion.png" data-name="Lion Parcel">Lion Parcel</option>
                                        {{-- <option value="wahana" data-icon="logo-kurir/wahana.png" data-name="Wahana">Wahana</option> --}}
                                    @endif
                                @endforeach
                            </select>  
                        </li><br>
                        <li class="col-md-6">
                            <label id="label-layanan" for="layanan">Layanan :</label> 
                            <div style="display: flex; align-items: center;">
                            <select name="layanan" class="layanan form-select">
                                <option value="" disabled selected>-- PILIH LAYANAN --</option>
                            </select>  
                                <span class="load-layanan" style="display: none">
                                    <div style="width:1rem; height:1rem; border-width:0.2em; margin-left:10px;" class="spinner-border text-success" role="status"></div>
                                </span>  
                            </div>
                        </li><br>
                    </ul>
                @endforeach
            </div>
        </div>
        <div id="detail-bayar" class = "mt-4 card" style="background-color: #920700;">
            <div class = "card-header">
                <h3 class = "text-white card-title">Rincian Pembayaran</h3>
            </div>
            <div class = "bg-light card-body co">
                <ul style="list-style: none;">
                    <li id="total-belanja" value="{{$total_belanja}}">Total Belanja<span style="margin-left: 17px">:</span><b>&nbsp;Rp. {{number_format($total_belanja,0,',','.')}}</b> </li>
                    <li>
                        Biaya Kirim<span style="margin-left: 30px">:</span><b id="biaya-kirim"></b> 
                        <span id="load-kirim" style="display: none">
                            <div style="width:1rem; height:1rem; border-width:0.2em; margin-left:10px;" class="spinner-border text-success" role="status"></div>
                        </span>  
                    </li><br>
                    <li>
                        <strong>Grand Total</strong><span style="margin-left: 29px">:</span><b id="grand-total"></b>
                        <span id="load-gtotal" style="display: none">
                            <div style="width:1rem; height:1rem; border-width:0.2em; margin-left:10px;" class="spinner-border text-success" role="status"></div>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
</div>
    <div style="cursor: default; padding-bottom: 120px;" class="text-center">
    <button id="btn-payment" class="mt-4" style="cursor:pointer; width: 180px; 
    height: 60px; font-size: 15px;">
    SELANJUTNYA 
    </button>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function(){
    var alamatCust = $('#alamat-cust').val();

    let listProduk = [];
    let listCourier = [];
    let listWeight = [];
    let listLayanan = [];

    setTimeout(function() {
      $('#preview-reject').slideUp(1500);
    }, 1500);

    $('.layanan').attr("disabled", true);
    $('#btn-payment').attr("disabled", true);

    $('.tambah-alamat').on('click', function() { 
        window.location.href= '/dashboard/tambah-alamat';
    });

    function formatState (state) {
            if (!state.id) return state.text;
            return $('<span><img src="' + $(state.element).data('icon') + '" width="20"/> ' + state.text + '</span>');
        }

        $(".list-produk").each(function() {
            let data = $(this).val();
            listProduk = listProduk.concat(data); 
        });

        $(".berat").each(function() {
            let data = $(this).val();
            listWeight = listWeight.concat(data); 
        });

        $(".kurir").select2({
            templateResult: formatState,
            templateSelection: formatState
        });

        $(document).on('change', '.kurir', function(e) { 
            e.preventDefault();

            $('#biaya-kirim').html('');
            $('#grand-total').html('');
            $('#btn-payment').attr("disabled", true);

                if (!alamatCust) 
                {
                    document.getElementById("data-pembeli").scrollIntoView({ 
                        behavior: "smooth", 
                        block: "center" 
                    });
                }

                var index = $(".kurir").index($(this));
                let courier = $('.kurir').eq(index).val();
                let weight = $('.berat').eq(index).val();
                let loading = $('.load-layanan').eq(index);
                let layanan = $('.layanan').eq(index);
                let kecamatan = $('#kecamatan').val();
                let kelurahan = $('#kelurahan').val();
                let kotaCust = $("#kota-cust").val();
                let kotaIndex = $(".kota").eq(index).val();

                listCourier = [];
                
                $(".kurir").each(function() {
                    var selectedOption = $(this).find(':selected'); 
                    var namaKurir = selectedOption.data('name');

                    listCourier = listCourier.concat(namaKurir);
                });
                
              
                layanan.attr("disabled", true);
                loading.removeAttr("style");
           
                $.ajax({
                        url: "{{ route('check-ongkir') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: 
                        {
                            _token: "{{ csrf_token() }}",
                            kecamatan: kecamatan,
                            kelurahan: kelurahan,
                            kotaCust: kotaCust,
                            kota: kotaIndex,
                            courier: courier,
                            weight: weight
                        },
                        success: function(response) {
                            loading.hide();
                            layanan.attr("disabled", false);
                            layanan.html('');
                            layanan.append(
                                `
                                <option value="" disabled selected>-- PILIH LAYANAN --</option>
                                `
                            );

                            
                            if (response.surabaya_costs) { 
                                // Jika kurir adalah DSC, gunakan response.surabaya_costs
                                $.each(response.surabaya_costs, function(i, val) {
                                    let formattedCost = parseFloat(val.cost).toLocaleString('id-ID', {
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0,
                                        useGrouping: true
                                    });

                                    layanan.append(
                                        `<option value="${val.cost}" data-layanan="${val.service}, ${val.description}, ${val.etd}, ${val.cost}">
                                            ${val.service}, ${val.description}, ${val.etd}, Rp. ${formattedCost}
                                        </option>`
                                    );
                                });

                            } else if (response.shipping_costs) { 
                                // Jika kurir selain DSC, gunakan response.shipping_costs
                                $.each(response.shipping_costs, function(i, val) {
                                    let formattedCost = parseFloat(val.cost).toLocaleString('id-ID', {
                                        minimumFractionDigits: 0,
                                        maximumFractionDigits: 0,
                                        useGrouping: true
                                    });

                                    layanan.append(
                                        `<option value="${val.cost}" data-layanan="${val.service}, ${val.description}, ${val.etd}, ${val.cost}">
                                            ${val.service}, ${val.description}, ${val.etd}, Rp. ${formattedCost}
                                        </option>`
                                    );
                                });

                            } else {
                                console.log("Tidak ada data ditemukan.");
                            }
                        },
                        error: function(xhr) {
                            console.log("Terjadi kesalahan:", xhr.responseText);
                        }
                });
        });


        $(document).on('change', '.layanan', function(e) { 
            e.preventDefault();

            let allSelected = true;

            /* $('#load-kirim').removeAttr("style");
            $('#load-gtotal').removeAttr("style"); */

            var totalKirim = 0;
            listLayanan = [];

            $('.layanan').each(function() {
                if ($(this).val() === "" || $(this).val() === null) {
                    allSelected = false;
                    return false; // Hentikan loop jika ada yang belum dipilih
                }

                totalKirim += parseFloat($(this).val()) || 0;  // Menggunakan parseFloat dan memberi nilai default 0 jika kosong

                var selectedOption = $(this).find(':selected'); 
                var namaLayanan = selectedOption.data('layanan');

                listLayanan = listLayanan.concat(namaLayanan);
            });

            $('#btn-payment').attr("disabled", !allSelected);

            let formattedTotalKirim = parseFloat(totalKirim).toLocaleString('id-ID', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0,
                                                        useGrouping: true
                                                    });

            let totalbelanja=$('#total-belanja').val();
            let grandTotal = totalbelanja + totalKirim;

            let formattedGrandTotal = parseFloat(grandTotal).toLocaleString('id-ID', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0,
                                                        useGrouping: true
                                                    });

            
            
                                                    
            $('#biaya-kirim').html('');
            $('#biaya-kirim').append(
                `
                    &nbsp;Rp. ${formattedTotalKirim}
                `
            );                                                    
            $('#grand-total').html('');
            $('#grand-total').append(
                `
                    &nbsp;Rp. ${formattedGrandTotal}
                `
            );
        });
  /*       $('#load-kirim').hide();
        $('#load-gtotal').hide(); */

        /*     $.ajax({
                url: "{{ route('set.order.preview.access') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    access: true
                },
                success: function (response) {
                    if (response.status === "success") {
                        window.location.href = "{{ route('order.preview') }}";
                    }
                }
            }); */


        $('#btn-payment').on('click', function() { 
            let nama = $('#nama-cust').val();
            let phone = $('#phone-cust').val();
            let alamat = $('#alamat-cust').val();
            let kota = $('#kota-cust').val();
            let kecamatan = $('#kecamatan').val();
            let kelurahan = $('#kelurahan').val();
            let provinsi = $('#provinsi').val();

            // Debugging sebelum dikirim ke backend
            console.log("Data dikirim:", {
                nama: nama,
                phone: phone,
                alamat: alamat,
                kota: kota,
                kecamatan: kecamatan,
                kelurahan: kelurahan,
                provinsi: provinsi,
                listCourier: listCourier,
                listWeight: listWeight,
                listProduk: listProduk,
                listLayanan: listLayanan
            });

            $.ajax({
                url: "{{ route('store.orderpreview') }}",
                type: 'POST',
                contentType: 'application/json', // Penting agar Laravel mengenali JSON
                dataType: 'json',
                data: JSON.stringify({ // Pastikan array dikirim dalam format JSON
                    _token: "{{ csrf_token() }}",
                    nama: nama,
                    phone: phone,
                    alamat: alamat,
                    kota: kota,
                    kecamatan: kecamatan,
                    kelurahan: kelurahan,
                    provinsi: provinsi,
                    listCourier: listCourier,
                    listWeight: listWeight,
                    listProduk: listProduk,
                    listLayanan: listLayanan
                }),
                success: function(response) {
                    window.location.href = response.redirect;
                },
                error: function(xhr) {
                    console.log("Error:", xhr.responseText);
                }
            });
        });

 });
</script>
  </body>
</html>

