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

<div style="display: none" id="delete-transaction-success" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
    Order ID sudah digunakan, silahkan lakukan checkout kembali !
</div>
<div id="sukses" class="fixed-top mt-5 alert alert-success text-center" role="alert">
      Berhasil Disimpan !
    </div>

<div id="dashboard-card" class="container d-flex" style="margin-left: 3em; padding-bottom: 100px;">
    <div class="card mt-5" style="width: 30%; 
        background-color: rgba(243, 240, 240, 0.7); border: none; 
        padding-bottom: 70px;">
        <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
        <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

        <h4 class="mt-3 ms-4 transaksi" style="font-weight: 300; cursor: pointer;">Histori Transaksi</h4>
        <h4 id="servis" class="servis mt-5 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Servis</h4>
        <h4 id="alamat" class="alamat mt-5 ms-4" style="font-weight: 300; cursor: pointer">Alamat</h4>
        <h4 id="profil" class="profil mt-5 ms-4" style="font-weight: 300; cursor: pointer">Profil</h4>
        {{-- <h4 id="tracking" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container">
        <h1 class="ms-3" style="font-weight: 300; margin-top: 80px;">Data Barang Servis</h1>
        <hr class="ms-3" style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
        {{-- <h2 class="text-center" style="font-weight: 300; margin-top: 80px;">Anda belum melakukan transaksi.</h2> --}}
        
          <div class="container ms-3 mt-4">
            <div class="tab-menu">
                <a href="#" data-status="menunggu-konfirmasi" class="tab-link active">Menunggu Konfirmasi</a>
                <a href="#" data-status="diproses" class="tab-link">Diproses</a>
                <a href="#" data-status="selesai" class="tab-link">Selesai</a>
            </div>
              {{-- <div class="search-box">
                  <span class="icon"><i class="fas fa-search"></i></span>
                  <input type="text" placeholder="Cari Pesanan">
              </div> --}}
              <div class="card mt-4">
                <div class="card-body">
                    <div class="d-block">
                           {{--  <div class="text-end">
                                Tanggal Servis : <input value="{{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('Y-m-d') }}" class="ms-3" type="date" style="font-weight: 500">
                            </div> --}}
                            @if ($groupedData->isEmpty())
                                <h2 class="mt-1 text-center">Belum ada data !</h2>
                            @else
                            <div id="content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div style="font-size: 20px;">No. SO :</div>
                                        <select class="ms-2 form-select w-auto" name="no_so" id="no_so">
                                        @foreach ($groupedData as $no_so => $items)
                                            <option value="{{ $no_so }}">{{ $no_so }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="sparepart-list" class="mt-3">
                
                                </div>
                                
                                <div id="harga-container" class="mb-3">
                                <strong>Harga Servis :</strong> <span id="harga-value"></span>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="submit-btn-desktop mt-5 btn btn-lg btn-primary submit-btn px-5">PROSES</button>
                                </div>
                            </div>
                            @endif
                </div>
              </div>  
          </div>
    </div>

    <div id="dialog-confirm" style="display: none;">
        <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
            <div id="close-dialog" class="float-end" style="cursor: pointer;"><i class="fas fa-times"></i></div>
    
            <h4 class="mt-5" style="font-weight: 300; font-family: 'Helvetica', sans-serif;">Pilih Metode pembayaran</h4>
            <!-- Transfer Manual Section -->
            <div id="manual" class="mt-3" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; border-radius: 8px;">
                <div style="font-size: 18px; font-weight: bold; color: #333;">Transfer Manual BCA / Mandiri (Bebas Biaya Admin)</div>
                <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 10px;">
                    <img src="logo-bank/bca.png" alt="BCA" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                    <img src="logo-bank/mandiri.png" alt="Mandiri" style="height: 50px; background: #fff; padding: 10px; border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                </div>
            </div>
    
            <!-- QRIS / GoPay Section -->
            <div id="midtrans" style="cursor:pointer; border: 1px solid #ccc; padding: 20px; border-radius: 8px;">
                <div style="font-size: 18px; font-weight: bold; color: #333; margin-bottom: 10px;">QRIS / GoPay (Include Biaya Admin)</div>
                <div class="mt-2" style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 10px;">
                    <img src="qris.png" alt="QRIS" style="height: 45px; padding: 10px;">
                    <img src="dana.png" alt="DANA" style="height: 45px; padding: 10px;">
                    <img src="ovo.png" alt="OVO" style="height: 40px;">
                    <img src="gopay.png" alt="GoPay" style="height: 45px; padding: 10px;">
                </div>
                <div class="mt-4" style="font-size: 16px; color: #555;"><img src="via-midtrans.png" alt="Midtrans" style="height: 20px; vertical-align: middle; margin-left: 5px;"></div>
            </div>
        </div>
    </div>    
</div>
</div>

<div id="dashboard-card-responsive" class="container-fluid">
    <div class="card mt-5" style=" background-color: rgba(243, 240, 240, 0.7); border: none; padding-bottom: 50px;">
        <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
        <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

        <h4 class="mt-3 ms-4 transaksi" style="font-weight: 300; cursor: pointer;">Histori Transaksi</h4>
        <h4 id="servis" class="servis mt-4 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Servis</h4>
        <h4 id="alamat" class="alamat mt-4 ms-4" style="font-weight: 300; cursor: pointer">Alamat</h4>
        <h4 id="profil" class="profil mt-4 ms-4" style="font-weight: 300; cursor: pointer">Profil</h4>
        {{-- <h4 id="tracking" class="mt-4 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container mt-5" style="padding-bottom: 300px">
        <h1 style="font-weight: 300;">Data Barang Servis</h1>
        <hr style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
        <div class="status-card shadow-sm bg-white">
          <a style="text-decoration: none" href="#" data-status="menunggu-konfirmasi" class="status-item active">Menunggu Konfirmasi</a>
          <a style="text-decoration: none" href="#" data-status="diproses" class="status-item">Diproses</a>
          <a style="text-decoration: none" href="#" data-status="dalam-pengiriman" class="status-item">Selesai</a>
        </div>
        <div class="search-box" style="padding: 1px">
            <span class="icon ms-2"><i class="fas fa-search"></i></span>
            <input type="text" placeholder="Cari Pesanan">
        </div>
        <div class="card mt-4">
            <div class="card-body">
                @foreach ( $service as $row )
                    <div class="d-block">
                            <div class="text-end">
                                Tanggal Servis : <input value="{{ \Carbon\Carbon::parse($row->tanggal_masuk)->format('Y-m-d') }}" class="ms-3" type="date" style="font-weight: 500">
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div style="font-size: 20px;">No. SO :</div>
                                    <select class="ms-2 form-select w-auto" name="no_so" id="no_so">
                                    @foreach ($groupedData as $no_so => $items)
                                        <option value="{{ $no_so }}">{{ $no_so }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex">
                                Merk Barang : <span class="ms-3" style="font-weight: 500">{{ $row->merk }}</span>
                            </div>
                            <div class="d-flex">
                                Tipe Barang : <span class="ms-3" style="font-weight: 500">{{ $row->unit_diterima }}</span>
                            </div>
                    </div>
                    <div class="mb-3 mt-4">
                            <label class="form-label ms-2">Analisa Teknisi</label>
                            <textarea placeholder="{{ $row->analisa_teknisi }}" class="ms-2 form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3 mt-3">
                            <label class="form-label ms-2">Solusi / Saran</label>
                            <textarea placeholder="{{ $row->solusi_saran }}" class="ms-2 form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3 mt-3">
                            <label class="form-label ms-2">Part DIganti</label>
                            <textarea placeholder="{{ $row->part_diganti }}" class="ms-2 form-control" rows="4"></textarea>
                        </div>
                        <div class="mt-4 d-flex">
                            Spare Part : <span class="ms-3" style="font-weight: 500">{{ $row->status_sparepart }}</span>
                        </div>
                        <div class="mt-4 d-flex">
                            Harga : <span class="ms-3" style="font-weight: 500">Rp. {{number_format($row->harga,0,',','.')}}</span>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="mt-5 btn btn-lg btn-primary submit-btn px-5">PROSES</button>
                        </div>
                    @endforeach
            </div>
          </div> 
    </div>
</div>

<script>
  window.dataByNoSo = @json($groupedData);
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
 $(document).ready(function(){
    console.log(dataByNoSo);

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
    
    function updateAll() {
      let noSo = $('#no_so').val();
      let dataList = dataByNoSo[noSo];

       if (!Array.isArray(dataList) || dataList.length === 0) {
            $('#sparepart-list').html('');
            return;
        }

      let harga = dataList[0].harga;
      let formattedHarga = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(harga);
      $('#harga-value').text(formattedHarga);

      $('#sparepart-list').html('');

      if (dataList && dataList.length > 0) {
        dataList.forEach((item, index) => {
          $('#sparepart-list').append(`
            <div class="border rounded p-3 mb-3 unit-item" data-serial="${item.serial_number}">
            <div class="d-flex align-items-center">
                  <strong>Serial Number:</strong><span class="ms-2">${item.serial_number}</span>
            </div>
            <div class="d-flex align-items-center">
                  <strong>Merk Barang:</strong><span class="ms-2">${item.merk}</span>
            </div>   
            <div class="d-flex align-items-center">
                  <strong>Tipe Barang:</strong><span class="ms-2">${item.tipe_barang}</span>
            </div>
            <div class="d-flex align-items-center">
                  <strong>Keluhan:</strong><span class="ms-2">${item.keluhan}</span>
            </div>      

              <div class="mt-4"><strong>Analisa Teknisi:</strong>
                <textarea readonly class="form-control mt-1 w-100">${item.analisa_teknisi}</textarea>
              </div>

              <div class="mt-2"><strong>Solusi / Saran:</strong>
                <textarea readonly class="form-control mt-1 w-100">${item.solusi_saran}</textarea>
              </div>

              <div class="mt-2"><strong>Part Diganti:</strong>
                <textarea readonly class="form-control mt-1 w-100">${item.part_diganti}</textarea>
              </div>

              <div class="mt-4 d-flex align-items-center">
                  <strong>Status Sparepart :</strong><span class="ms-2">${item.status_sparepart}</span>
              </div>
            </div>
          `);
        });

        $('#submit-btn').removeAttr('disabled');
      } 
    }

    updateAll();

 
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

    $('.transaksi').on('click', function() {
      window.location.href = '/dashboard';
    });
    $('.alamat').on('click', function() {
      window.location.href = '/dashboard/list-alamat';
    });
    $('.profil').on('click', function() {
      window.location.href = '/dashboard/editprofil';
    });
    $('#tracking').on('click', function() {
      window.location.href = '/dashboard/tracking';
    });

    $('#btn-hapus').on('click', function() {
        let orderId = $('#order-id').val();

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

    $('#btn-bayar').on('click', function() {
        $('#dialog-confirm').fadeIn(); 
    });

    $('#manual').on('click', function() {
        let gtotal = $('#gtotal').val();
        
        $.ajax({
            url: '/manual-payment',
            method: 'POST',
            data: {
                gtotal: gtotal,
                _token: '{{ csrf_token() }}' // penting untuk proteksi CSRF Laravel
            },
            success: function (response) {
                console.log('Data berhasil dikirim:', response);
                // contoh: redirect setelah berhasil
                window.location.href = '/manual-payment/index';
            },
            error: function (xhr) {
                console.log('Terjadi kesalahan:', xhr.responseText);
            }
        });
    });

    $('#midtrans').on('click', function() {
        
        let orderId = $('#order-id').val();
        let gtotal = $('#gtotal').val();
        console.log(gtotal);
        console.log(orderId);

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

    $('#close-dialog').on('click', function() {
        $('#dialog-confirm').fadeOut();
    });

    $('.submit-btn-desktop').on('click', function(e) {
        e.preventDefault();
        let no_so = $('#no_so').val();

        $.ajax({
            url: "{{ route('insert.data-user') }}",
            type: 'PUT',
            dataType: 'json',
            data: 
            {
                _token: "{{ csrf_token() }}",
               no_so: no_so
            },
            success: function(response){
                window.location.href = window.location.href;
                localStorage.setItem('showSuccess', true);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $(".tab-link, .status-item").click(function(e) {
            e.preventDefault();
            let status = $(this).data("status");

            // Ganti class active
            $(".tab-link, .status-item").removeClass("active");
            $(this).addClass("active");

            // Ambil data via AJAX
            $.ajax({
                url: "{{ route('service-user.fetch') }}",
                type: "GET",
                data: { status: status },
                success: function(response) {
                    $(".card-body").html(response.html);
                    window.dataByNoSo = response.groupedData;
                    updateAll(); 
                }
            });
    });
  });
</script>
  </body>
</html>