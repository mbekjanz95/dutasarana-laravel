<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Toko Komputer, PC, Printer, Aksesoris terbaik di Surabaya, Malang, Kediri, Solo, Denpasar, Jogja (Yogyakarta) - Canon, Epson. HP , Brother , Asus">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DUTA SARANA COMPUTER - Toko Komputer Printer Canon, Epson, Brother, HP Surabaya,Malang,Kediri,Solo,Bali,Jogja (Yogyakarta)</title>
    
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico?v=1.0')}}">

    <link rel="stylesheet" href="{{asset('style.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style2.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style3.css?v=2')}}">
    <link rel="stylesheet" href="magnify.css?v=2">

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        thead th {
          background-color: #66c3ff !important;
          color: white !important;
          text-align: center !important;
          vertical-align: middle !important;
        }
        tbody tr:nth-child(even) {
          background-color: #c6e7ff !important;
        }
        tbody td {
          vertical-align: middle !important;
        }

        .form-container {
          background-color: #fff;
          padding: 30px;
          border-radius: 10px;
          box-shadow: 5px 5px 15px rgba(0,0,0,0.3);
          max-width: 900px;
          margin: 50px auto;
        }
        .form-title {
          text-align: center;
          font-weight: bold;
          margin-top: 10px;
          margin-bottom: 30px;
        }
        .submit-btn {
          background-color: #5bc0de;
          color: white;
          font-weight: bold;
          font-size: 1.25rem;
        }
        .form-label {
          font-weight: 500;
        }
        .input-group-text {
          background-color: #ccc;
        }
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
          <i class="fas fa-user"></i>&nbsp;&nbsp;{{auth()->user()->username}}
      </div>
      <ul>

          <li id="home"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</li>
          <li id="teknisi"><i class="fas fa-wrench"></i>&nbsp;&nbsp;TEKNISI</li>
          <li id="sparepart"><i class="fas fa-cog"></i>&nbsp;&nbsp;SPAREPART</li>
          <li style="background: rgba(255, 255, 255, 0.4); cursor: default"><i class="far fa-clock"></i>&nbsp;&nbsp;STATUS</li>
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
      <span class="toggle-btn"><img src="{{asset('jempol.png')}}" class="icon-menu">
        <span id="sembunyikan-menu" style="font-size: 20px">< Sembunyikan Menu</span>
        <span id="tampilkan-menu" style="font-size: 20px">Tampilkan Menu ></span>
      </span>
      <span style="font-size: 22px; font-weight: 500">Data Servis Internal DSC</span>
  </div>
  <div class="content" id="content">
    <div class="container ms-3 mt-4">
      <h1>Status Servis</h1>
      <div class="mt-3 d-flex justify-content-between">
        <div style="font-size: 15px">Pilih Tanggal :<span><input placeholder="pilih tanggal" id="date-picker" class="ms-1" type="date"></span></div>
        <div class="d-flex align-items-center" style="font-size: 15px">Filter :
            <select id="input-filter" name="input-filter" class="ms-3 form-select w-auto" style="font-weight: 300">
                  <option selected disabled>Filter berdasar</option>
                  <option value="no_so">No. SO</option>
                  <option value="nama_customer">Nama Customer</option>
            </select>
        </div>
      </div>
      <div class="mt-4 tab-menu">
          <a href="#" data-status="keseluruhan" class="tab-link active">Data Barang<br>Keseluruhan</a>
          <a href="#" data-status="barang-diperiksa" class="tab-link">Barang Diperiksa</a>
          <a href="#" data-status="menunggu-konfirmasi" class="tab-link">Menunggu Konfirmasi<br>User</a>
          <a href="#" data-status="diproses" class="tab-link">Diproses</a>
          <a href="#" data-status="selesai" class="tab-link">Selesai</a>
      </div>
      <div style="padding-bottom: 100px" class="card mt-4">
        <div class="card-body">
          <div id="filter-value" class="d-flex">
            
          </div>
        <div class="mt-4 table-responsive">
          <table class="table table-bordered align-middle w-auto text-nowrap">
            <thead class="text-white" style="background-color: #66CCFF;">
              <tr>
                <th>No. SO</th>
                <th>Nama Customer</th>
                <th>No. Telepon</th>
                <th>Email</th>
                <th>Keluhan</th>
                <th>Merk</th>
                <th>Tipe Unit</th>
                <th>Serial Number</th>
                <th>Unit yang diterima</th>
                <th>Status</th>
              </tr>
            </thead>
           <tbody>
              @forelse ($service as $row)
                <tr>
                  <td>{{ $row->no_so }}</td>
                  <td>{{ $row->customername }}</td>
                  <td>{{ $row->phone }}</td>
                  <td>{{ $row->email }}</td>
                  <td>{{ $row->keluhan }}</td>
                  <td>{{ $row->merk }}</td>
                  <td>{{ $row->tipe_barang }}</td>
                  <td>{{ $row->serial_number }}</td>
                  <td>{{ $row->unit_diterima }}</td>
                  <td>{{ $row->status }}</td>
                </tr>
              @empty
                <tr style="background-color: #b3e5ff;">
                  <td colspan="10" class="text-center">Data belum tersedia</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        </div>
      </div>
    </div> 
  </div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
    $('#date-picker').on('change', function() {
      let tanggal = $('#date-picker').val();

      $.ajax({
          url: "{{ route('filter.tanggal') }}",
          type: 'get',
          dataType: 'json',
          data: 
          {
            _token: "{{ csrf_token() }}",
            tanggal: tanggal
          },
          success: function(response){
            setTimeout(function() {
                $('#spinner').hide();
            }, 700);
                        
            $("#data-keseluruhan").html('');

            $.each(response, function(i, val){
                $("#data-keseluruhan").append(
                `
                    <tr>
                    <td class="text-center">${val.no_so}</td>
                    <td class="text-center">${val.customername}</td>
                    <td class="text-center">${val.phone}</td>
                    <td class="text-center">${val.email}</td>
                    <td class="text-center">${val.keluhan}</td>
                    <td class="text-center">${val.merk}</td>
                    <td class="text-center">${val.tipe_barang}</td>
                    <td class="text-center">${val.serial_number}</td>
                    <td class="text-center">${val.unit_diterima}</td>
                    <td class="text-center">${val.status}</td>
                  </tr>
                `);
            });
          },
          error: function (xhr) { 
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);
          }
        });
    });

    $('#input-filter').on('change', function() {
      let input = $(this).val();

      if (input === 'no_so') 
      {
        $('#filter-value').html('');
        $('#filter-value').append
        (`
          <div style="font-size: 15px; font-weight: 600">Masukkan No. SO :<span><input id="filter-by-so" placeholder="No. SO" class="ms-2" type="text"></span></div>
        `);
      }
      if (input === 'nama_customer') 
      {
         $('#filter-value').html('');
        $('#filter-value').append
        (`
          <div style="font-size: 15px; font-weight: 600">Masukkan Nama Customer :<span><input id="filter-by-customer" placeholder="Nama Customer" class="ms-2" type="text"></span></div>
        `);
      }
    });

    $(document).on('change', '#filter-by-customer', function() {
       let nama = $('#filter-by-customer').val();

      $.ajax({
          url: "{{ route('filter.customer') }}",
          type: 'get',
          dataType: 'json',
          data: 
          {
            _token: "{{ csrf_token() }}",
            nama: nama
          },
          success: function(response){
            setTimeout(function() {
                $('#spinner').hide();
            }, 700);
                        
            $("#data-keseluruhan").html('');

            $.each(response, function(i, val){
                $("#data-keseluruhan").append(
                `
                    <tr>
                    <td class="text-center">${val.no_so}</td>
                    <td class="text-center">${val.customername}</td>
                    <td class="text-center">${val.phone}</td>
                    <td class="text-center">${val.email}</td>
                    <td class="text-center">${val.keluhan}</td>
                    <td class="text-center">${val.merk}</td>
                    <td class="text-center">${val.tipe_barang}</td>
                    <td class="text-center">${val.serial_number}</td>
                    <td class="text-center">${val.unit_diterima}</td>
                    <td class="text-center">${val.status}</td>
                  </tr>
                `);
            });
          },
          error: function (xhr) { 
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);
          }
        });
    });    

    $(document).on('change', '#filter-by-so', function() {
       let no_so = $('#filter-by-so').val();

      $.ajax({
          url: "{{ route('filter.so') }}",
          type: 'get',
          dataType: 'json',
          data: 
          {
            _token: "{{ csrf_token() }}",
            no_so: no_so
          },
          success: function(response){
            setTimeout(function() {
                $('#spinner').hide();
            }, 700);
                        
            $("#data-keseluruhan").html('');

            $.each(response, function(i, val){
                $("#data-keseluruhan").append(
                `
                    <tr>
                    <td class="text-center">${val.no_so}</td>
                    <td class="text-center">${val.customername}</td>
                    <td class="text-center">${val.phone}</td>
                    <td class="text-center">${val.email}</td>
                    <td class="text-center">${val.keluhan}</td>
                    <td class="text-center">${val.merk}</td>
                    <td class="text-center">${val.tipe_barang}</td>
                    <td class="text-center">${val.serial_number}</td>
                    <td class="text-center">${val.unit_diterima}</td>
                    <td class="text-center">${val.status}</td>
                  </tr>
                `);
            });
          },
          error: function (xhr) { 
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);
          }
        });
    });

    $('#tampilkan-menu').hide();

    $('#home').on('click', function() {
        window.location.href = '/internal-service';
    });

    $('#sparepart').on('click', function() {
        window.location.href = '/internal-service/sparepart';
    });

    $('#teknisi').on('click', function() {
        window.location.href = '/internal-service/teknisi';
    });

    const $dateInput = $('input[type="date"]');

    if ($dateInput[0] && $dateInput[0].showPicker) {
    $dateInput.on('focus', function () {
        this.showPicker();
    });
    }

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

    $(".tab-link, .status-item").click(function(e) {
            e.preventDefault();
            let status = $(this).data("status");

            // Ganti class active
            $(".tab-link, .status-item").removeClass("active");
            $(this).addClass("active");

            // Ambil data via AJAX
            $.ajax({
                url: "{{ route('service.fetch') }}",
                type: "GET",
                data: { status: status },
                success: function(response) {
                    $(".card-body").html(response);
                }
            });
    });
});
</script>
<script>
    flatpickr("#date-picker", {
    dateFormat: "Y-m-d"
});
  </script>
  </body>
</html>