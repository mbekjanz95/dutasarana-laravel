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

  </head>
  <body>
    
@include('partials.nav-asset')

<div class="container d-flex" style="margin-left: 3em; padding-bottom: 100px;">
    <div class="card mt-5" style="width: 30%; 
        background-color: rgba(243, 240, 240, 0.7); border: none; 
        padding-bottom: 70px;">
        <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
        <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

        <h4 id="transaksi" class="mt-3 ms-4" style="font-weight: 300; cursor: pointer">Histori Transaksi</h4>
        <h4 id="alamat" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Alamat</h4>
        <h4 id="profil" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Profil</h4>
        {{-- <h4 id="tracking" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container">
        <h1 class="ms-3" style="font-weight: 300; margin-top: 80px;">Tracking Pengiriman</h1>
        <hr class="ms-3" style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
 $(document).ready(function(){
    $('#transaksi').on('click', function() {
      window.location.href = '/dashboard/histori-transaksi';
    });
    $('#alamat').on('click', function() {
      window.location.href = '/dashboard/list-alamat';
    });
    $('#profil').on('click', function() {
      window.location.href = '/dashboard/editprofil';
    });
    $('#tracking').on('click', function() {
      window.location.href = '/dashboard/tracking';
    });
  });
</script>
  </body>
</html>