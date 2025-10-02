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
        margin-bottom: 15px;
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
  <h2>Konfirmasi Pembayaran</h2>

  <form id="form-pembayaran" enctype="multipart/form-data">
    @csrf
    <div class="mt-4 order-id">
      Order ID : <strong>{{ $orderId }}</strong>
      <input type="hidden" name="order_id" value="{{ $orderId }}">
      <input type="hidden" name="iduser" value="{{auth()->user()->id}}">
    </div>
    <div class="form-group">
      <label>Bank Tujuan</label>
      <select name="bank_tujuan">
        <option value="BCA 1309 3988 99">BCA 1309 3988 99</option>
        <option value="Mandiri 1420 0667 288 99">Mandiri 1420 0667 288 99</option>
      </select>
    </div>
    
    <div class="form-group">
      <label>Bank Asal</label>
      <input type="text" name="bank_asal">
    </div>

    <div class="form-group">
      <label>Nama Pemilik Rekening</label>
      <input type="text" name="pemilik_rekening">
    </div>

    <div class="form-group">
      <label>Nomor Rekening Pemilik</label>
      <input type="text" name="no_rekening_pemilik">
    </div>

    <div class="form-group">
      <label>Tanggal Pembayaran</label>
      <input type="date" name="tanggal_pembayaran">
    </div>

    <div class="form-group">
      <label>Jumlah yang sudah dibayarkan</label>
      <input type="text" name="jumlah" value="Rp. {{number_format($gtotal,0,',','.')}}" readonly>
      <input type="hidden" name="total_bayar" value="{{ $gtotal }}">
    </div>

    <div class="form-group">
      <label>Bukti Pembayaran (Max 10 MB)</label>
      {{-- <input type="file" name="bukti_pembayaran" accept="image/*,application/pdf"> --}}
      <input type="file" name="file" id="file">
      <div id="upload-image">
            
      </div>
    </div>

    <div class="form-group">
      <label>Keterangan (Opsional)</label>
      <textarea name="keterangan"></textarea>
    </div>

    <button type="submit" class="btn">Konfirmasi Pembayaran</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function () {
    const $dateInput = $('input[type="date"]'); 

    if ($dateInput[0] && $dateInput[0].showPicker) {
      $dateInput.on('focus', function () {
        this.showPicker();
      });
    }

    $('#file').change(function () {
            const fileName = $(this).val().split('\\').pop();
            const fileInput = $('#file')[0];
            const formData = new FormData();

            formData.append('file', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}'); 

            $.ajax({
                url: "{{ route('upload.temp') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) { 
                    if (response.success) {
                        $('#upload-image').html(`
                            <img class="d-block mt-3" style="width: 300px; height:300px;" src="${response.file_url}">
                        `);
                    } else {
                        alert('Gagal mengupload file.');
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan saat mengupload file.');
                }
            });
    });

    $('#form-pembayaran').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('pembayaran.store') }}", 
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                  if (response.status === "success") {
                    localStorage.setItem("pembayaran-sukses", true);
                    window.location.href = '/dashboard';
                  } else {
                      alert('Salah satu stok barang habis, silahkan checkout ulang !');
                      window.location.href = '/dashboard';
                  }   
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan!');
                }
            });
    });
  });
</script>
  </body>
</html>