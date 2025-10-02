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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <style>
      h2 {
        font-size: 20px;
        margin-bottom: 10px;
      }
  
      .form-wrapper {
        max-width: 600px;
      }
  
      .form-group {
        margin-bottom: 10px;
        margin-top: 50px;
      }
  
      label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
      }
  
      input[type="text"],
      input[type="date"],
      input[type="file"],
      select,
      textarea {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
        background-color: white;
      }
  
      input[readonly] {
        background-color: #ddd;
        font-weight: bold;
      }
  
      textarea {
        resize: vertical;
        min-height: 100px;
      }
  
      .btn {
        display: inline-block;
        background-color: #fbbc3e;
        color: #000;
        font-weight: bold;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }
  
      .btn:hover {
        background-color: #e0a821;
      }
  
      .order-id {
        margin-bottom: 20px;
      }
      .container {
        padding-bottom: 100px !important;
      }
    </style>
  </head>
  <body>
    
@include('partials.navbar')

<div class="mt-5 container">
  <h4>Komplain Produk</h4>
  <hr class="line-top-categories">

  <form id="form-komplain" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
      <div class="mt-4">
        <h4>Order ID : {{ $orderId }}</h4>
        <input type="hidden" class="order_id" name="order_id" value="{{ $orderId }}">
      </div>

      <div style="font-size: 17px">Tanggal Order : <b>{{ $tanggalPengiriman }}</b></div>

      <h4 class="text-danger fw-bold mt-4">Lokasi Pengiriman : {{ $kotaPengiriman }}</h4>

      <div class="col-md-2 mt-3">
          <img src="{{$fotoProduk}}" class="img-fluid" alt="">
      </div>
      <div class="col-md-6 mt-3">
          <h6>{{$namaProduk}}</h6>
          <p>{{$sku}}</p>
          <p>Qty : {{$qty}} pcs (@ Rp {{number_format($harga,0,',','.')}})</p>
          <input type="hidden" class="nama_produk" name="nama_produk" value="{{ $namaProduk }}">
          <input type="hidden" class="sku" name="sku" value="{{ $sku }}">
      </div>

      <div class="col-md-4 text-end">
          <p>Kurir: {{ $kurir }}</p>
          <p>(Rp. {{ number_format($biayaKurir, 0, ',', '.') }})</p>
      </div>
    </div>

    <div class="form-group">
      <label class="mt-3">Upload Video Unboxing (Max 100 MB)</label>
      {{-- <input type="file" name="bukti_pembayaran" accept="image/*,application/pdf"> --}}
      <input type="file" name="file" id="file">
      <div id="upload-video">
            
      </div>
    </div>

    <div class="form-group">
      <label>Keterangan</label>
      <textarea name="keterangan_komplain"></textarea>
    </div>

    <div>
      <i style="color: red">*Mohon rekam video unboxing serta beri keterangan
         yang jelas. Tanpa video unboxing dan keterangan 
         yang jelas, komplain tidak diterima.</i>
    </div>

    <div class="text-center">
        <button type="submit" class="mt-5 btn btn-warning w-50 btn-submit">SUBMIT</button>
    </div>
  </form>

  <div id="dialog-confirm" style="display: none">
    <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
        <div style="width:5rem; height:5rem; border-width:0.6em;" class="spinner-border text-success" role="status"></div>
        <h5 class="mt-2 justify-content-center" style="font-weight: 600">Mengirim File</h5>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
    const MAX_SIZE_MB = 100;

    $('#file').change(function () {

      $('.btn-submit').attr("disabled", true);
      const fileInput = $('#file')[0];
      const file = fileInput.files[0];

      if (!file) return;

      const fileSizeMB = file.size / (1024 * 1024);

      if (fileSizeMB > MAX_SIZE_MB) {
          alert(`Ukuran file terlalu besar (${fileSizeMB.toFixed(2)} MB). Maksimal 100 MB.`);
          $('#file').val(''); // reset input
          return;
      }

      const formData = new FormData();
      formData.append('file', file);
      formData.append('_token', '{{ csrf_token() }}');

      // Tampilkan loading spinner
      $('#upload-video').html(`
          <div class="spinner-border text-warning" role="status">
              <span class="visually-hidden">Uploading...</span>
          </div>
          <span class="ms-2">Uploading video...</span>
      `);

      $.ajax({
          url: "{{ route('upload.temp-video') }}",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
              $('.btn-submit').attr("disabled", false);

              if (response.success) {
                  $('#upload-video').html(`
                      <div class="alert alert-success mt-2">
                          Video berhasil diunggah.
                          <br><a href="${response.file_url}" target="_blank">Lihat Video</a>
                      </div>
                  `);
              } else {
                  $('#upload-video').html('');
                  alert('Gagal mengupload file.');
              }
          },
          error: function (xhr) {
              console.error(xhr.responseText);

              let response = JSON.parse(xhr.responseText);
              let errorMsg = response.file;

              $('#upload-video').html('');
              alert(`Terjadi kesalahan saat mengupload file. ${errorMsg}`);
          }
      });
    });


    $('#form-komplain').on('submit', function(e) {
      e.preventDefault();

      // Tampilkan loading overlay
      $('#dialog-confirm').fadeIn();

      let formData = new FormData(this);

      $.ajax({
          url: "{{ route('komplain.store') }}", 
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
              // Redirect hanya setelah loading selesai
              window.location.href = '/dashboard';
          },
          error: function(xhr, status, error) {
              console.error(xhr.responseText);

              let response = JSON.parse(xhr.responseText);
              let errorMsg = response.errors;

              alert(`${errorMsg}`);

          },
          complete: function() {
              // Sembunyikan loading jika ada error
              $('#dialog-confirm').fadeOut();
          }
      });
    });

  });
</script>
</body>
</html>