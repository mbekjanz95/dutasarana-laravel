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
        body {
          background-color: #d9534f; /* Warna merah latar belakang */
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
    <div id="sukses" class="fixed-top mt-5 alert alert-success text-center" role="alert">
      Berhasil Disimpan !
    </div>

    <div class="sidebar" id="sidebar">
      <div style="margin-top: 10vh; margin-left: 2vh; font-size: 23px; font-weight: 600">
          <i class="fas fa-user"></i>&nbsp;&nbsp;{{auth()->user()->username}}
      </div>
      <ul>

          <li id="home"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</li>
          <li id="teknisi"><i class="fas fa-wrench"></i>&nbsp;&nbsp;TEKNISI</li>
          <li style="background: rgba(255, 255, 255, 0.4); cursor: default"><i class="fas fa-cog"></i>&nbsp;&nbsp;SPAREPART</li>
          <li id="status"><i class="far fa-clock"></i>&nbsp;&nbsp;STATUS</li>
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
    <div class="container form-container">
      @if ($service->isEmpty())
          <h2 class="mt-1 text-center">Belum ada data !</h2>
      @else
        <div class="text-center">
          <img src="{{asset('logo-dsc.svg')}}" alt="Logo Duta Sarana Computer" height="60"> <!-- Ganti dengan path/logo asli -->
        </div>
        <div class="d-flex justify-content-center">
            <h5 class="mt-4 form-title">Form Sparepart</h5>
        </div>
          <form>
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
            {{-- <div class="mb-3 mt-5">
              <div class="col-md-6">
                <label class="form-label">Nama Teknisi</label>
                <input readonly value="Ryan" type="text" class="form-control" placeholder="">
              </div>
            </div> --}}

            <div id="sparepart-list" class="mt-3">
              
            </div>
            <div class="d-flex mt-3">
              Harga Servis :<input name="harga-servis" class="ms-3" id="harga-servis" type="text">
            </div>
            <div class="text-center">
              <button id="submit-btn" type="submit" class="mt-5 btn submit-btn px-5">SUBMIT</button>
            </div>
          </form>
      @endif
      </div>
  </div>
<script>
  const dataByNoSo = @json($groupedData);
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function () {

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

    $('#submit-btn').attr('disabled', true);

    function updateAll() {
      let noSo = $('#no_so').val();
      let dataList = dataByNoSo[noSo];

      $('#sparepart-list').html('');

      if (dataList && dataList.length > 0) {
        dataList.forEach((item, index) => {
          $('#sparepart-list').append(`
            <div class="border rounded p-3 mb-3 unit-item" data-serial="${item.serial_number}">
              <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                  <strong>Serial Number:</strong><span class="ms-2">${item.serial_number}</span>
                </div>
                <div class="d-flex align-items-center">
                    <label for="nama-teknisi" class="me-2">Nama Teknisi</label>
                    <input id="nama-teknisi" style="width: 50%; background-color: #ccc; border-color: rgba(0, 0, 0, 0.5)" readonly value="${item.nama_teknisi}" type="text">
                </div>
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

              <div class="mt-4">Sparepart:
                <label class="ms-3"><input type="radio" name="status_${item.serial_number}" value="indent"> Indent</label>
                <label class="ms-3"><input type="radio" name="status_${item.serial_number}" value="ready"> Ready</label>
              </div>
            </div>
          `);
        });

        $('#submit-btn').removeAttr('disabled');
      }
    }


  // Inisialisasi saat halaman pertama kali dibuka
  updateAll();

    $('#tampilkan-menu').hide();

    $('#no_so').on('change', function() {
        $('#nama-teknisi').val('');
        $('#analisa-teknisi').val('');
        $('#solusi-saran').val('');
        $('#part-diganti').val('');

        $('#submit-btn').attr('disabled', true); 
        
        updateAll();
    });

    $('#home').on('click', function() {
        window.location.href = '/internal-service';
    });

    $('#teknisi').on('click', function() {
        window.location.href = '/internal-service/teknisi';
    });

    $('#status').on('click', function() {
        window.location.href = '/internal-service/status';
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

    $('#submit-btn').on('click', function(e) {
      e.preventDefault();

      let harga = $('#harga-servis').val();
      let unitData = [];

      $('.unit-item').each(function() {
        let serial = $(this).data('serial');
        let status = $(`input[name="status_${serial}"]:checked`).val();

        if (!status) {
          alert(`Pilih status sparepart untuk serial number ${serial}`);
          return false;
        }

        unitData.push({
          serial_number: serial,
          status_sparepart: status
        });
      });

      if (unitData.length === 0) {
        alert('Data unit kosong');
        return;
      }

      $.ajax({
        url: "{{ route('insert.data-sparepart') }}",
        type: 'PUT',
        dataType: 'json',
        data: {
          _token: "{{ csrf_token() }}",
          harga: harga,
          data: unitData
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

});
</script>
<script>
    flatpickr("#tanggalMasuk", {
      dateFormat: "d-m-Y"
    });
  </script>
  </body>
</html>