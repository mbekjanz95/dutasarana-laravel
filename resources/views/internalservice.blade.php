<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Toko Komputer, PC, Printer, Aksesoris terbaik di Surabaya, Malang, Kediri, Solo, Denpasar, Jogja (Yogyakarta) - Canon, Epson. HP , Brother , Asus">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DUTA SARANA COMPUTER - Toko Komputer Printer Canon, Epson, Brother, HP Surabaya,Malang,Kediri,Solo,Bali,Jogja (Yogyakarta)</title>
    
    <link rel="icon" type="image/x-icon" href="favicon.ico?v=1.0">

    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="style2.css?v=2">
    <link rel="stylesheet" href="style3.css?v=2">
    <link rel="stylesheet" href="magnify.css?v=2">

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
        .select2-container {
          display: block !important;
          width: 100% !important;
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

          <li style="background: rgba(255, 255, 255, 0.4); cursor: default"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</li>
          <li id="teknisi"><i class="fas fa-wrench"></i>&nbsp;&nbsp;TEKNISI</li>
          <li id="sparepart"><i class="fas fa-cog"></i>&nbsp;&nbsp;SPAREPART</li>
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
      <span class="toggle-btn"><img src="jempol.png" class="icon-menu">
        <span id="sembunyikan-menu" style="font-size: 20px">< Sembunyikan Menu</span>
        <span id="tampilkan-menu" style="font-size: 20px">Tampilkan Menu ></span>
      </span>
      <span style="font-size: 22px; font-weight: 500">Data Servis Internal DSC</span>
  </div>
  <div class="content" id="content">
    <div class="container form-container">
        <div class="text-center">
          <img src="logo-dsc.svg" alt="Logo Duta Sarana Computer" height="60"> <!-- Ganti dengan path/logo asli -->
        </div>
        <div class="d-flex justify-content-center">
            <h5 class="mt-4 form-title">Data Customer dan Barang Servis</h5>
        </div>
        
          <div class="d-flex">
            Pilih Data Customer : 
            
            <input value="form1" name="jenis-customer" checked class="ms-3" id="customer-lama" type="radio">
            <label class="ms-1" for="customer-lama">Customer lama</label>

            <input value="form2" name="jenis-customer" class="ms-3" id="customer-baru" type="radio">
            <label class="ms-1" for="customer-baru">Customer baru</label>
          </div>

          <div id="content_form1">
            <div class="mt-4 d-flex">
              <div>
                Jumlah Barang : <input value="1" class="ms-2" id="jumlah-barang-custlama" type="number" placeholder="0">
              </div>
            </div>
            <div class="mt-3 d-flex">
              <span>
                Pilih Teknisi :
              </span>
              <span class="ms-2">
                <select id="nama_teknisi_lama" name="nama_teknisi_lama" class="form-select">
                  <option selected disabled>Pilih Teknisi</option>
                  <option value="Ryan">Ryan</option>
                  <option value="Usman">Usman</option>
                </select>
                <div class="error-nama-teknisi-lama mt-1" style="color: red; display:none"></div>
              </span> 
            </div>

            <div id="spinner" class="text-center mt-2">
              <div style="width:7rem; height:7rem; border-width:0.7em;" class="spinner-border text-success mt-5" role="status"></div>
            </div>

            <div class="data1-list">
            <div class="row mb-3 mt-5">
              <div class="col-md-6">
                <label class="form-label">No. Telp / WA</label>
                <select class="form-select no_telp_lama" name="no_telp_lama">
                  <option value="" disabled selected>- - KETIK NO.TLP - -</option>
                  @foreach ( $customer as $row )
                    <option value="{{$row->id}}">{{$row->phone}}</option>
                  @endforeach
                </select>
                <div class="error-no-telp-lama mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Merk</label>
                <input id="merk_lama" name="merk_lama" type="text" class="form-control" placeholder="">
                <div class="error-merk-lama mt-1" style="color: red; display:none"></div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Nama Customer</label>
                <div class="input-group">
                  <input readonly name="nama_customer_lama" type="text" class="form-control nama_customer_lama">
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tipe Barang</label>
                <input id="tipe_barang_lama" name="tipe_barang_lama" type="text" class="form-control" placeholder="">
                <div class="error-tipe-barang-lama mt-1" style="color: red; display:none"></div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">No. SO</label>
                <input name="no_so_lama" type="text" class="form-control no_so_lama" placeholder="">
                <div class="error-no-so-lama mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Serial Number</label>
                <input id="serial_number_lama" name="serial_number_lama" type="text" class="form-control" placeholder="">
                <div class="error-serial-number-lama mt-1" style="color: red; display:none"></div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Tanggal Masuk</label>
                <input name="tanggal_masuk_lama" placeholder="dd-mm-yyyy" type="text" class="form-control tanggal_masuk_lama">
                <div class="error-tanggal-masuk-lama mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Barang yang Diterima</label>
                <select id="unit_diterima_lama" name="unit_diterima_lama" class="form-select">
                  <option selected disabled>Pilih Tipe</option>
                  <option value="Printer">Printer</option>
                  <option value="Laptop">Laptop</option>
                  <option value="Komputer">Komputer</option>
                </select>
                <div class="error-unit-diterima-lama mt-1" style="color: red; display:none"></div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Keluhan</label>
              <textarea id="keluhan_lama" name="keluhan_lama" class="form-control w-100" rows="4"></textarea>
              <div class="error-keluhan-lama mt-1" style="color: red; display:none"></div>
            </div>

            
            </div>
            <div id="dialog-confirm" style="display: none;">
              <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                  <div id="close-dialog" class="float-end" style="cursor: pointer;"><i class="fas fa-times"></i></div>
          
                  <h4 class="mt-5" style="font-weight: 300; font-family: 'Helvetica', sans-serif;">Edit Data Barang</h4>
                  
              </div>
            </div>
            <div class="text-center">
            <button id="btn-submit-lama" type="submit" class="btn submit-btn px-5">SUBMIT</button>
          </div>
          </div>

          <div id="content_form2">
            <div class="mt-4 d-flex">
              <div>
                Jumlah Barang : <input value="1" class="ms-2" id="jumlah-barang-custbaru" type="number">
              </div>
            </div>
            <div class="mt-3 d-flex">
              <span>
                Pilih Teknisi :
              </span>
              <span class="ms-2">
                <select id="nama_teknisi_baru" name="nama_teknisi_baru" class="form-select">
                  <option selected disabled>Pilih Teknisi</option>
                  <option value="Ryan">Ryan</option>
                  <option value="Usman">Usman</option>
                </select>
                <div class="error-nama-teknisi-baru mt-1" style="color: red; display:none"></div>
              </span> 
            </div>

            <div class="data2-list">
            <div class="row mb-3 mt-5">
              <div class="col-md-6">
                <label class="form-label">Nama Customer</label>
                <input name="nama_customer_baru" type="text" class="form-control nama_customer_baru">
                <div class="error-nama-customer-baru mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Merk</label>
                <input id="merk_baru" name="merk_baru" type="text" class="form-control" placeholder="">
                <div class="error-merk-baru mt-1" style="color: red; display:none"></div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">No. Telp / WA</label>
                <div class="input-group">
                  <input name="no_telp_baru" type="text" class="form-control no_telp_baru">
                  <div class="error-no-telp-baru mt-1" style="color: red; display:none"></div>
                </div>
                <label class="form-label">Email</label>
                <div class="input-group">
                  <input name="email_baru" type="text" class="form-control email_baru">
                  <div class="error-email-baru mt-1" style="color: red; display:none"></div>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tipe Barang</label>
                <input id="tipe_barang_baru" name="tipe_barang_baru" type="text" class="form-control" placeholder="">
                <div class="error-tipe-barang-baru mt-1" style="color: red; display:none"></div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">No. SO</label>
                <input name="no_so_baru" type="text" class="form-control no_so_baru" placeholder="">
                <div class="error-no-so-baru mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Serial Number</label>
                <input id="serial_number_baru" name="serial_number_baru" type="text" class="form-control" placeholder="">
                <div class="error-serial-number-baru mt-1" style="color: red; display:none"></div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">Tanggal Masuk</label>
                <input name="tanggal_masuk_baru" placeholder="dd-mm-yyyy" type="text" class="form-control tanggal_masuk_baru">
                <div class="error-tanggal-masuk-baru mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Barang yang Diterima</label>
                <select id="unit_diterima_baru" name="unit_diterima_baru" class="form-select">
                  <option selected disabled>Pilih Tipe</option>
                  <option value="Printer">Printer</option>
                  <option value="Laptop">Laptop</option>
                  <option value="Komputer">Komputer</option>
                </select>
                <div class="error-unit-diterima-baru mt-1" style="color: red; display:none"></div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Keluhan</label>
              <textarea id="keluhan_baru" name="keluhan_baru" class="form-control w-100" rows="4"></textarea>
              <div class="error-keluhan-baru mt-1" style="color: red; display:none"></div>
            </div>
          </div>

          <div class="text-center">
            <button id="btn-submit-baru" type="submit" class="btn submit-btn px-5">SUBMIT</button>
          </div>
          <div id="dialog-confirm" style="display: none;" class="dialog-confirm-baru">
              <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
                  <div id="close-dialog-baru" class="float-end" style="cursor: pointer;"><i class="fas fa-times"></i></div>
          
                  <h4 class="mt-5" style="font-weight: 300; font-family: 'Helvetica', sans-serif;">Edit Data Barang</h4>
                  
              </div>
            </div>
        </div>
      </div>
    </div>
 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function () {

  $('input').on('input', function () {
    $('.error-no-so-lama').html('');
    $('.error-no-telp-lama').html('');
    $('.error-keluhan-lama').html('');
    $('.error-merk-lama').html('');
    $('.error-tipe-barang-lama').html('');
    $('.error-serial-number-lama').html('');
    $('.error-tanggal-masuk-lama').html('');
    $('.error-unit-diterima-lama').html('');
    $('.error-nama-teknisi-lama').html('');

    $('.error-no-so-lama').hide();
    $('.error-no-telp-lama').hide();
    $('.error-keluhan-lama').hide();
    $('.error-merk-lama').hide();
    $('.error-tipe-barang-lama').hide();
    $('.error-serial-number-lama').hide();
    $('.error-tanggal-masuk-lama').hide();
    $('.error-unit-diterima-lama').hide();
    $('.error-nama-teknisi-lama').hide();

    $('.error-nama-customer-baru').html('');
    $('.error-no-so-baru').html('');
    $('.error-no-telp-baru').html('');
    $('.error-keluhan-baru').html('');
    $('.error-merk-baru').html('');
    $('.error-tipe-barang-baru').html('');
    $('.error-email-baru').html('');
    $('.error-serial-number-baru').html('');
    $('.error-tanggal-masuk-baru').html('');
    $('.error-unit-diterima-baru').html('');
    $('.error-nama-teknisi-baru').html('');

    $('.error-nama-customer-baru').hide('');
    $('.error-no-so-baru').hide();
    $('.error-no-telp-baru').hide();
    $('.error-keluhan-baru').hide();
    $('.error-merk-baru').hide();
    $('.error-tipe-barang-baru').hide();
    $('.error-email-baru').hide('');
    $('.error-serial-number-baru').hide();
    $('.error-tanggal-masuk-baru').hide();
    $('.error-unit-diterima-baru').hide();
    $('.error-nama-teknisi-baru').hide();
  });

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
    $('#teknisi').on('click', function() {
        window.location.href = '/internal-service/teknisi';
    });

  $(document).on('click', '#close-dialog', function() {
    $('#dialog-confirm').fadeOut();
  });

  $(document).on('click', '.close-dialog-baru', function() {
    $('.dialog-confirm-baru').fadeOut();
  });
  
  // Saat halaman pertama kali dimuat, tampilkan form sesuai radio yang dipilih
    toggleForm($('input[name="jenis-customer"]:checked').val());

    // Saat radio button berubah
    $('input[name="jenis-customer"]').on('change', function() {
      var selectedValue = $(this).val();
      toggleForm(selectedValue);
    });

    function toggleForm(value) {
      if (value === 'form1') {
        $('#content_form1').show();
        $('#content_form2').hide();
      } else if (value === 'form2') {
        $('#content_form1').hide();
        $('#content_form2').show();
      }
    }

    $('#jumlah-barang-custlama').on('change', function() {
      $('.data1-list').hide();
      $('#spinner').show();
      

      let jumlahBarang = $('#jumlah-barang-custlama').val();

      let container = $('#dialog-confirm');
      container.html(''); // Kosongkan isi

      let fields = ''; // untuk kumpulkan inputnya

      for (let i = 1; i <= jumlahBarang; i++) { 
        fields += `
          <div class="row mb-3 mt-4">
            <div class="col-md-6">
              <label class="form-label">Merk Barang ${i}</label>
              <input name="merk[]" type="text" class="w-100 merk${i}" placeholder="">
              <div class="error-merk-lama mt-1" style="color: red; display:none"></div>
            </div>
             <div class="col-md-6">
                <label class="form-label">Tipe Barang ${i}</label>
                <input name="tipe_barang[]" type="text" class="w-100 tipe_barang${i}" placeholder="">
                <div class="error-tipe-barang-lama mt-1" style="color: red; display:none"></div>
              </div>
          </div>

         <div class="row mb-3 mt-4">
            <div class="col-md-6">
              <label class="form-label">Serial Number Barang ${i}</label>
              <input name="serial_number[]" type="text" class="w-100 serial_number${i}" placeholder="">
              <div class="error-serial-number-lama mt-1" style="color: red; display:none"></div>
            </div>
             <div class="col-md-6">
                <label class="form-label">Barang yang Diterima (${i})</label>
                <select name="unit_diterima[]" class="w-100 unit_diterima${i}">
                  <option selected disabled>Pilih Tipe</option>
                  <option value="Printer">Printer</option>
                  <option value="Laptop">Laptop</option>
                  <option value="Komputer">Komputer</option>
                </select>
                <div class="error-unit-diterima-lama mt-1" style="color: red; display:none"></div>
              </div>
          </div>
          <div class="mb-3">
              <label class="form-label">Keluhan Barang ${i}</label>
              <textarea name="keluhan[]" class="form-control w-100 keluhan${i}" rows="4"></textarea>
              <div class="error-keluhan-lama mt-1" style="color: red; display:none"></div>
          </div>
        `;
      }

      // Gabungkan struktur besar dengan bagian yang di-loop
      let htmlContent = `
        <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
          <div id="close-dialog" class="float-end" style="cursor: pointer;"><i class="fas fa-times"></i></div>

          <h4 class="edit-data-barang mt-5" style="font-weight: 300; font-family: 'Helvetica', sans-serif;">Edit Data Barang</h4>

          ${fields} <!-- hasil loop disisipkan di sini -->
        </div>
      `;

      container.append(htmlContent);

      setTimeout(function() {
                $('#spinner').hide();
                $('.data1-list').html('');
                $('.data1-list').append(
                `
              <div class="row mb-3 mt-5">
                <div class="col-md-6">
                  <label class="form-label">No. Telp / WA</label>
                  <select class="form-select no_telp_lama" name="no_telp_lama">
                    <option value="" disabled selected>- - KETIK NO.TLP - -</option>
                    @foreach ( $customer as $row )
                      <option value="{{$row->id}}">{{$row->phone}}</option>
                    @endforeach
                  </select>
                  <div class="error-no-telp-lama mt-1" style="color: red; display:none"></div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Nama Customer</label>
                  <div class="input-group">
                    <input readonly name="nama_customer_lama" type="text" class="form-control nama_customer_lama">
                  </div>
                </div>
              </div>
           
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">No. SO</label>
                <input name="no_so_lama" type="text" class="form-control no_so_lama" placeholder="">
                <div class="error-no-so-lama mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tanggal Masuk</label>
                <input name="tanggal_masuk_lama" placeholder="dd-mm-yyyy" type="date" class="form-control tanggal_masuk_lama">
                <div class="error-tanggal-masuk-lama mt-1" style="color: red; display:none"></div>
              </div>
              <button style="width: 40%" class="edit-barang-lama mt-5 mx-auto btn btn-primary" type="submit">
                      <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;EDIT DATA BARANG
              </button>
            </div>
                `);
                $('.no_telp_lama').select2(); 
                $('.data1-list').show();
                 let labelDitemukan = $('.data1-list label').filter(function() {
                      return $(this).text().includes(jumlahBarang);
                  });

                  if (labelDitemukan.length > 0) {
                      labelDitemukan.on('click', function() {
                        $('#dialog-confirm').fadeIn();
                      });
                      
                  } 
      }, 300);
       
    });

    $('#jumlah-barang-custbaru').on('change', function() {
      $('.data2-list').hide();
      $('#spinner').show();
      

      let jumlahBarang = $('#jumlah-barang-custbaru').val();

      let container = $('.dialog-confirm-baru');
      container.html(''); // Kosongkan isi

      let fields = ''; // untuk kumpulkan inputnya

      for (let i = 1; i <= jumlahBarang; i++) { 
        fields += `
          <div class="row mb-3 mt-4">
            <div class="col-md-6">
              <label class="form-label">Merk Barang ${i}</label>
              <input name="merk[]" type="text" class="w-100 merk${i}" placeholder="">
              <div class="error-merk-baru mt-1" style="color: red; display:none"></div>
            </div>
             <div class="col-md-6">
                <label class="form-label">Tipe Barang ${i}</label>
                <input name="tipe_barang[]" type="text" class="w-100 tipe_barang${i}" placeholder="">
                <div class="error-tipe-barang-baru mt-1" style="color: red; display:none"></div>
              </div>
          </div>

         <div class="row mb-3 mt-4">
            <div class="col-md-6">
              <label class="form-label">Serial Number Barang ${i}</label>
              <input name="serial_number[]" type="text" class="w-100 serial_number${i}" placeholder="">
              <div class="error-serial-number-baru mt-1" style="color: red; display:none"></div>
            </div>
             <div class="col-md-6">
                <label class="form-label">Barang yang Diterima (${i})</label>
                 <select name="unit_diterima[]" class="w-100 unit_diterima${i}">
                  <option selected disabled>Pilih Tipe</option>
                  <option value="Printer">Printer</option>
                  <option value="Laptop">Laptop</option>
                  <option value="Komputer">Komputer</option>
                </select>
                <div class="error-unit-diterima-baru mt-1" style="color: red; display:none"></div>
              </div>
          </div>
          <div class="mb-3">
              <label class="form-label">Keluhan Barang ${i}</label>
              <textarea name="keluhan[]" class="form-control w-100 keluhan${i}" rows="4"></textarea>
              <div class="error-keluhan-baru mt-1" style="color: red; display:none"></div>
          </div>
        `;
      }

      // Gabungkan struktur besar dengan bagian yang di-loop
      let htmlContent = `
        <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto; font-family: Arial, sans-serif;">
          <div class="float-end close-dialog-baru" style="cursor: pointer;"><i class="fas fa-times"></i></div>

          <h4 class="edit-data-barang-baru mt-5" style="font-weight: 300; font-family: 'Helvetica', sans-serif;">Edit Data Barang</h4>

          ${fields} <!-- hasil loop disisipkan di sini -->
        </div>
      `;

      container.append(htmlContent);

      setTimeout(function() {
                $('#spinner').hide();
                $('.data2-list').html('');
                $('.data2-list').append(
                `
                <div class="row mb-3 mt-5">
              <div class="col-md-6">
                <label class="form-label">No. Telp / WA</label>
                <input name="no_telp_baru" type="text" class="form-control no_telp_baru" placeholder="">
                <div class="error-no-telp-baru mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Nama Customer</label>
                <div class="input-group">
                  <input name="nama_customer_baru" type="text" class="form-control nama_customer_baru" placeholder="">
                  <div class="error-nama-customer-baru mt-1" style="color: red; display:none"></div>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label class="form-label">No. SO</label>
                <input name="no_so_baru" type="text" class="form-control no_so_baru" placeholder="">
                <div class="error-no-so-baru mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Tanggal Masuk</label>
                <input name="tanggal_masuk_baru" placeholder="dd-mm-yyyy" type="date" class="form-control tanggal_masuk_baru">
                <div class="error-tanggal-masuk-baru mt-1" style="color: red; display:none"></div>
              </div>
              <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <input name="email_baru" type="text" class="form-control email_baru">
                  <div class="error-email-baru mt-1" style="color: red; display:none"></div>
              </div>
            </div>
              <div class="text-center">
                <button style="width: 40%" class="edit-barang-baru mt-3 mx-auto btn btn-primary" type="submit">
                        <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;EDIT DATA BARANG
                </button>
              </div>
                `);
                $('.data2-list').show();
                 let labelDitemukan = $('.data2-list label').filter(function() {
                      return $(this).text().includes(jumlahBarang);
                  });

                  if (labelDitemukan.length > 0) {
                      labelDitemukan.on('click', function() {
                        $('#dialog-confirm').fadeIn();
                      });
                      
                  } 
      }, 300);
       
    });

    
  $(document).on('click', '.edit-barang-lama', function() {
    $('#dialog-confirm').fadeIn();
  });

  $(document).on('click', '.edit-barang-baru', function() {
  $('.dialog-confirm-baru').fadeIn();
});

  $(document).on('click', '.dialog-confirm-save', function () {
    let barangData = {};

$('#dialog-confirm').find('input, select').each(function () {
    const name = $(this).attr('name');
    const value = $(this).val();

    if (name.endsWith('[]')) {
        const key = name.replace('[]', '');

        // Cek jika belum ada atau bukan array → set ke array
        if (!Array.isArray(barangData[key])) {
            barangData[key] = [];
        }

        barangData[key].push(value);
    } else {
        // Untuk input biasa (bukan array)
        barangData[name] = value;
    }
});

  console.log(barangData);
});



    $('.no_telp_lama').select2();

    $(document).on('change', '.no_telp_lama', function(e) { 
        let idCust = $('.no_telp_lama').val();

          $.ajax({
                    url: "{{ route('customername.request') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: 
                    {
                        _token: "{{ csrf_token() }}",
                        idCust: idCust
                    },
                    success: function(response){

                      $('.nama_customer_lama').val('');            
                      $('.nama_customer_lama').val(response.customerName.customername);

                      /* $.each(response.district, function(i, val) {

                        $('#kecamatan').append(
                            `
                              <option value="${val.id}">${val.name}</option>
                            `
                          );
                      }); */
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
          });
    });

    $('#tampilkan-menu').hide();

    $('#sparepart').on('click', function() {
        window.location.href = '/internal-service/sparepart';
    });

    $('#status').on('click', function() {
        window.location.href = '/internal-service/status';
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

    $('#btn-submit-lama').on('click', function(e) { 
      e.preventDefault();

      $('.error-no-so-lama').html('');
      $('.error-no-telp-lama').html('');
      $('.error-keluhan-lama').html('');
      $('.error-merk-lama').html('');
      $('.error-tipe-barang-lama').html('');
      $('.error-serial-number-lama').html('');
      $('.error-tanggal-masuk-lama').html('');
      $('.error-unit-diterima-lama').html('');
      $('.error-nama-teknisi-lama').html('');

      let teknisi = $('#nama_teknisi_lama').val();
      let idcust = $('.no_telp_lama').val();
      let no_so = $('.no_so_lama').val();
      let merk = $('#merk_lama').val();
      let tipe = $('#tipe_barang_lama').val();
      let serial = $('#serial_number_lama').val();
      let tanggal = $('.tanggal_masuk_lama').val();
      let unit = $('#unit_diterima_lama').val();
      let keluhan = $('#keluhan_lama').val();

      let semuaMerk = $('#dialog-confirm input[name="merk[]"]').map(function() {
        return $(this).val();
      }).get();

      let semuaTipe = $('#dialog-confirm input[name="tipe_barang[]"]').map(function() {
        return $(this).val();
      }).get();

      let semuaSerial = $('#dialog-confirm input[name="serial_number[]"]').map(function() {
        return $(this).val();
      }).get();

      let semuaUnit = $('#dialog-confirm select[name="unit_diterima[]"]').map(function() {
        return $(this).val();
      }).get();

      let semuaKeluhan = $('#dialog-confirm textarea[name="keluhan[]"]').map(function() {
        return $(this).val();
      }).get();

      if ($('.edit-data-barang').length) {
        $.ajax({
          url: "{{ route('store.data-servis-many') }}",
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            _token: "{{ csrf_token() }}",
            idcust: idcust,
            no_so: no_so,
            status: 'barang-diperiksa',
            tanggal_masuk: tanggal,
            nama_teknisi: teknisi,
            merk: semuaMerk,
            tipe_barang: semuaTipe,
            serial_number: semuaSerial,
            unit_diterima: semuaUnit,
            keluhan: semuaKeluhan
          }),
          success: function(response){
            if (response.status === 'success') 
            {
              window.location.href = window.location.href;
              localStorage.setItem('showSuccess', true);
            }
          },
          error: function (xhr) {
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);

            var keluhanAlertShown = false;
            var merkAlertShown = false;
            var tipeAlertShown = false;
            var serialAlertShown = false;
            var unitAlertShown = false;

            $.each(errorMsg, function(index, error) {
              $.each(error, function(index, val) {  
                  if (val.indexOf('no so') !== -1) // val.indexOf('no so') dari pesan console.error(errorMsg); (Kolom no so harus diisi !)
                  {
                      $('.error-no-so-lama').show();
                      $('.error-no-so-lama').append(`${val}`);
                  }
                  if (val.indexOf('idcust') !== -1) 
                  {
                      $('.error-no-telp-lama').show();
                      $('.error-no-telp-lama').append(`${val}`);
                  }
                  if (val.toLowerCase().indexOf('keluhan') !== -1 && !keluhanAlertShown) {
                    alert('CEK KEMBALI DATA KELUHAN BARANG');
                    $('.error-keluhan-lama').show().append(`${val}<br>`);
                    keluhanAlertShown = true;
                  }
                  if (val.toLowerCase().indexOf('merk') !== -1 && !merkAlertShown) {
                    alert('CEK KEMBALI DATA MERK BARANG');
                    $('.error-merk-lama').show().append(`${val}<br>`);
                    merkAlertShown = true;
                  }
                  if (val.toLowerCase().indexOf('tipe_barang') !== -1 && !tipeAlertShown) {
                    alert('CEK KEMBALI DATA TIPE BARANG');
                    $('.error-tipe-barang-lama').show().append(`${val}<br>`);
                    tipeAlertShown = true;
                  }
                  if (val.toLowerCase().indexOf('serial_number') !== -1 && !serialAlertShown) {
                    alert('CEK KEMBALI DATA SERIAL NUMBER BARANG');
                    $('.error-serial-number-lama').show().append(`${val}<br>`);
                    serialAlertShown = true;
                  }
                  if (val.indexOf('tanggal masuk') !== -1) 
                  {
                      $('.error-tanggal-masuk-lama').show();
                      $('.error-tanggal-masuk-lama').append(`${val}`);
                  }
                  if (val.toLowerCase().indexOf('unit diterima') !== -1 && !unitAlertShown) {
                    alert('CEK KEMBALI DATA BARANG YANG DITERIMA');
                    $('.error-unit-diterima-lama').show().append(`${val}<br>`);
                    unitAlertShown = true;
                  }
                  if (val.indexOf('nama teknisi') !== -1) 
                  {
                      $('.error-nama-teknisi-lama').show();
                      $('.error-nama-teknisi-lama').append(`${val}`);
                  }
              });         
            });
          }
        });
      }
      else {
        $.ajax({
          url: "{{ route('store.data-servis') }}",
          type: 'POST',
          contentType: 'application/json',
         data: JSON.stringify({
            _token: "{{ csrf_token() }}",
            idcust: idcust,
            no_so: no_so,
            status: 'barang-diperiksa',
            keluhan: keluhan,
            merk: merk,
            tipe_barang: tipe,
            serial_number: serial,
            tanggal_masuk: tanggal,
            nama_teknisi: teknisi,
            unit_diterima: unit
          }),
          success: function(response){
            // console.log(response.message); 
            // console.log(response.customer); 

            if (response.status === 'success') 
            {
              window.location.href = window.location.href;
              localStorage.setItem('showSuccess', true);
            }
          },
          error: function (xhr) {
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);

            $.each(errorMsg, function(index, error) {
              $.each(error, function(index, val) {  
                  if (val.indexOf('no so') !== -1) // val.indexOf('no so') dari pesan console.error(errorMsg); (Kolom no so harus diisi !)
                  {
                      $('.error-no-so-lama').show();
                      $('.error-no-so-lama').append(`${val}`);
                  }
                  if (val.indexOf('idcust') !== -1) 
                  {
                      $('.error-no-telp-lama').show();
                      $('.error-no-telp-lama').append(`${val}`);
                  }
                  if (val.indexOf('keluhan') !== -1) 
                  {
                      $('.error-keluhan-lama').show();
                      $('.error-keluhan-lama').append(`${val}`);
                  }
                  if (val.indexOf('merk') !== -1) 
                  {
                      $('.error-merk-lama').show();
                      $('.error-merk-lama').append(`${val}`);
                  }
                  if (val.indexOf('tipe barang') !== -1) 
                  {
                      $('.error-tipe-barang-lama').show();
                      $('.error-tipe-barang-lama').append(`${val}`);
                  }
                  if (val.indexOf('serial number') !== -1) 
                  {
                      $('.error-serial-number-lama').show();
                      $('.error-serial-number-lama').append(`${val}`);
                  }
                  if (val.indexOf('tanggal masuk') !== -1) 
                  {
                      $('.error-tanggal-masuk-lama').show();
                      $('.error-tanggal-masuk-lama').append(`${val}`);
                  }
                  if (val.indexOf('unit diterima') !== -1) 
                  {
                      $('.error-unit-diterima-lama').show();
                      $('.error-unit-diterima-lama').append(`${val}`);
                  }
                  if (val.indexOf('nama teknisi') !== -1) 
                  {
                      $('.error-nama-teknisi-lama').show();
                      $('.error-nama-teknisi-lama').append(`${val}`);
                  }
              });         
            });
          }
        });
      }
    });

    $('#btn-submit-baru').on('click', function(e) {
      e.preventDefault();

      $('.error-nama-customer-baru').html('');
      $('.error-no-so-baru').html('');
      $('.error-no-telp-baru').html('');
      $('.error-keluhan-baru').html('');
      $('.error-merk-baru').html('');
      $('.error-tipe-barang-baru').html('');
      $('.error-email-baru').html('');
      $('.error-serial-number-baru').html('');
      $('.error-tanggal-masuk-baru').html('');
      $('.error-unit-diterima-baru').html('');
      $('.error-nama-teknisi-baru').html('');

      let teknisi = $('#nama_teknisi_baru').val();
      let phone = $('.no_telp_baru').val();
      let customername = $('.nama_customer_baru').val();
      let email = $('.email_baru').val();
      let no_so = $('.no_so_baru').val();
      let merk = $('#merk_baru').val();
      let tipe = $('#tipe_barang_baru').val();
      let serial = $('#serial_number_baru').val();
      let tanggal = $('.tanggal_masuk_baru').val();
      let unit = $('#unit_diterima_baru').val();
      let keluhan = $('#keluhan_baru').val();

      let semuaMerk = $('#dialog-confirm input[name="merk[]"]').map(function() {
        return $(this).val();
      }).get();

      let semuaTipe = $('#dialog-confirm input[name="tipe_barang[]"]').map(function() {
        return $(this).val();
      }).get();

      let semuaSerial = $('#dialog-confirm input[name="serial_number[]"]').map(function() {
        return $(this).val();
      }).get();

      let semuaUnit = $('#dialog-confirm select[name="unit_diterima[]"]').map(function() {
        return $(this).val();
      }).get();

      let semuaKeluhan = $('#dialog-confirm textarea[name="keluhan[]"]').map(function() {
        return $(this).val();
      }).get();


      if ($('.edit-data-barang-baru').length) {
        $.ajax({
          url: "{{ route('store.data-servis-baru-many') }}",
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            _token: "{{ csrf_token() }}",
            no_so: no_so,
            customername: customername,
            status: 'barang-diperiksa',
            phone: phone,
            email: email,
            tanggal_masuk: tanggal,
            nama_teknisi: teknisi,
            merk: semuaMerk,
            tipe_barang: semuaTipe,
            serial_number: semuaSerial,
            unit_diterima: semuaUnit,
            keluhan: semuaKeluhan
          }),
          success: function(response){ 
            if (response.status === 'success') 
            {
              window.location.href = window.location.href;
              localStorage.setItem('showSuccess', true);
            }
          },
          error: function (xhr) { 
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);

            var keluhanAlertShown = false;
            var merkAlertShown = false;
            var tipeAlertShown = false;
            var serialAlertShown = false;
            var unitAlertShown = false;


            $.each(errorMsg, function(index, error) {
              $.each(error, function(index, val) {
                  if (val.indexOf('customername') !== -1) 
                  {
                      $('.error-nama-customer-baru').show();
                      $('.error-nama-customer-baru').append(`${val}`);
                  }
                  if (val.indexOf('phone') !== -1) 
                  {
                      $('.error-no-telp-baru').show();
                      $('.error-no-telp-baru').append(`${val}`);
                  }  
                  if (val.indexOf('no so') !== -1) 
                  {
                      $('.error-no-so-baru').show();
                      $('.error-no-so-baru').append(`${val}`);
                  }
                  if (val.toLowerCase().indexOf('keluhan') !== -1 && !keluhanAlertShown) {
                    alert('CEK KEMBALI DATA KELUHAN BARANG');
                    $('.error-keluhan-baru').show().append(`${val}<br>`);
                    keluhanAlertShown = true;
                  }
                  if (val.toLowerCase().indexOf('merk') !== -1 && !merkAlertShown) {
                    alert('CEK KEMBALI DATA MERK BARANG');
                    $('.error-merk-baru').show().append(`${val}<br>`);
                    merkAlertShown = true;
                  }
                  if (val.toLowerCase().indexOf('tipe_barang') !== -1 && !tipeAlertShown) {
                    alert('CEK KEMBALI DATA TIPE BARANG');
                    $('.error-tipe-barang-baru').show().append(`${val}<br>`);
                    tipeAlertShown = true;
                  }
                  if (val.toLowerCase().indexOf('serial_number') !== -1 && !serialAlertShown) {
                    alert('CEK KEMBALI DATA SERIAL NUMBER BARANG');
                    $('.error-serial-number-baru').show().append(`${val}<br>`);
                    serialAlertShown = true;
                  }
                  if (val.indexOf('tanggal masuk') !== -1) 
                  {
                      $('.error-tanggal-masuk-baru').show();
                      $('.error-tanggal-masuk-baru').append(`${val}`);
                  }
                  if (val.indexOf('email') !== -1) 
                  {
                      $('.error-email-baru').show();
                      $('.error-email-baru').append(`${val}`);
                  }
                  if (val.toLowerCase().indexOf('unit diterima') !== -1 && !unitAlertShown) {
                    alert('CEK KEMBALI DATA BARANG YANG DITERIMA');
                    $('.error-unit-diterima-baru').show().append(`${val}<br>`);
                    unitAlertShown = true;
                  }
                  if (val.indexOf('nama teknisi') !== -1) 
                  {
                      $('.error-nama-teknisi-baru').show();
                      $('.error-nama-teknisi-baru').append(`${val}`);
                  }
              });         
            });
          }
        });
      }
      else {
        $.ajax({
          url: '{{ route("store.data-servis-baru") }}',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            _token: '{{ csrf_token() }}',
            phone: phone,
            email: email,
            customername: customername,
            no_so: no_so,
            status: 'barang-diperiksa',
            keluhan: keluhan,
            merk: merk,
            tipe_barang: tipe,
            serial_number: serial,
            tanggal_masuk: tanggal,
            nama_teknisi: teknisi,
            unit_diterima: unit
          }),
          success: function(response){
            // console.log(response.message); 
            // console.log(response.customer); 

            if (response.status === 'success') 
            {
              window.location.href = window.location.href;
              localStorage.setItem('showSuccess', true);
            }
          },
          error: function (xhr) { 
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);

            $.each(errorMsg, function(index, error) {
              $.each(error, function(index, val) {
                  if (val.indexOf('customername') !== -1) 
                  {
                      $('.error-nama-customer-baru').show();
                      $('.error-nama-customer-baru').append(`${val}`);
                  }
                  if (val.indexOf('phone') !== -1) 
                  {
                      $('.error-no-telp-baru').show();
                      $('.error-no-telp-baru').append(`${val}`);
                  }  
                  if (val.indexOf('no so') !== -1) 
                  {
                      $('.error-no-so-baru').show();
                      $('.error-no-so-baru').append(`${val}`);
                  }
                  if (val.indexOf('keluhan') !== -1) 
                  {
                      $('.error-keluhan-baru').show();
                      $('.error-keluhan-baru').append(`${val}`);
                  }
                  if (val.indexOf('merk') !== -1) 
                  {
                      $('.error-merk-baru').show();
                      $('.error-merk-baru').append(`${val}`);
                  }
                  if (val.indexOf('tipe barang') !== -1) 
                  {
                      $('.error-tipe-barang-baru').show();
                      $('.error-tipe-barang-baru').append(`${val}`);
                  }
                  if (val.indexOf('serial number') !== -1) 
                  {
                      $('.error-serial-number-baru').show();
                      $('.error-serial-number-baru').append(`${val}`);
                  }
                  if (val.indexOf('tanggal masuk') !== -1) 
                  {
                      $('.error-tanggal-masuk-baru').show();
                      $('.error-tanggal-masuk-baru').append(`${val}`);
                  }
                  if (val.indexOf('email') !== -1) 
                  {
                      $('.error-email-baru').show();
                      $('.error-email-baru').append(`${val}`);
                  }
                  if (val.indexOf('unit diterima') !== -1) 
                  {
                      $('.error-unit-diterima-baru').show();
                      $('.error-unit-diterima-baru').append(`${val}`);
                  }
                  if (val.indexOf('nama teknisi') !== -1) 
                  {
                      $('.error-nama-teknisi-baru').show();
                      $('.error-nama-teknisi-baru').append(`${val}`);
                  }
              });         
            });
          }
        });
      }
  
    });
});
</script>
<script>
    flatpickr(".tanggal_masuk_lama, .tanggal_masuk_baru", {
        dateFormat: "Y-m-d"
    });
</script>
  </body>
</html>