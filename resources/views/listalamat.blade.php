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

  </head>
  <body>
    
@include('partials.navbar')

<div id="alamat-card" class="container d-flex" style="margin-left: 3em; padding-bottom: 100px;">
    <div class="card mt-5" style="width: 30%; 
        background-color: rgba(243, 240, 240, 0.7); border: none; 
        padding-bottom: 70px;">
        <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
        <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

        <h4 id="transaksi" class="mt-3 ms-4" style="font-weight: 300; cursor: pointer">Histori Transaksi</h4>
        <h4 id="alamat" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Alamat</h4>
        <h4 class="mt-5 ms-4 profil" style="font-weight: 300; cursor: pointer">Profil</h4>
        {{-- <h4 id="tracking" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container">
        @forelse ($alamat as $row)
          <div class="d-flex justify-content-between">
            <h2 class="ms-3" style="font-weight: 300; margin-top: 80px;">Alamat Tujuan</h2>
            <button id="edit-alamat" class="btn btn-primary" style="height: 45px; margin-top: 80px;">
              <i class="fas fa-pen"></i>&nbsp;&nbsp;EDIT ALAMAT
            </button>
          </div>
          <hr class="ms-3" style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
            <div class="mt-5 table-responsive">
                <table class="table table-bordered" style="border-width:8px;">
                    <thead class="thead-dark">
                        <tr>  
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Kota/Kab.</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kelurahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>{{$row->customername}}</td>
                        <td>{{$row->address}}</td>
                        <td>{{$row->province}}</td>
                        <td>{{$row->city_name}}</td>
                        <td>{{$row->district_name}}</td>
                        <td>{{$row->kelurahan_name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @empty
          <div class="d-flex">
            <h2 class="ms-3" style="font-weight: 300; margin-top: 80px;">Alamat Tujuan</h2>
            <button id="btn-alamat" class="btn btn-primary" style="margin-left: 430px; height: 45px; margin-top: 80px;">
              <i class="fas fa-plus"></i>&nbsp;TAMBAH ALAMAT
            </button>
          </div>
          <hr class="ms-3" style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
          <div class="ms-3" style="font-size:20px">Anda belum menambahkan alamat, silahkan klik TAMBAH ALAMAT</div>  
        @endforelse
    </div>
</div>

<div class="container-fluid">
  <div class="card mt-5" style=" background-color: rgba(243, 240, 240, 0.7); border: none; padding-bottom: 50px;">
      <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
      <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

      <h4 class="mt-3 ms-4 transaksi" style="font-weight: 300; cursor: pointer;">Histori Transaksi</h4>
      <h4 id="servis" class="servis mt-4 ms-4" style="font-weight: 300; cursor: pointer">Servis</h4>
      <h4 id="alamat" class="alamat mt-4 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Alamat</h4>
      <h4 class="mt-4 ms-4 profil" style="font-weight: 300; cursor: pointer">Profil</h4>
      {{-- <h4 id="tracking" class="mt-4 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
  </div>

  <div class="container" style="padding-bottom: 100px">
    @forelse ($alamat as $row)
      <div class="d-flex justify-content-between">
        <h4 style="font-weight: 300; margin-top: 80px;">Alamat Tujuan</h4>
        <button id="edit-alamat" class="btn btn-primary" style="font-size: 12px; height: 30px; margin-top: 80px;">
          <i class="fas fa-pen"></i>&nbsp;&nbsp;EDIT ALAMAT
        </button>
      </div>
      <hr style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
        <div class="mt-5 table-responsive">
            <table class="table table-bordered" style="border-width:8px;">
                <thead class="thead-dark">
                    <tr>  
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Kota/Kab.</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kelurahan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>{{$row->customername}}</td>
                    <td>{{$row->address}}</td>
                    <td>{{$row->province}}</td>
                    <td>{{$row->city_name}}</td>
                    <td>{{$row->district_name}}</td>
                    <td>{{$row->kelurahan_name}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @empty
      <div class="d-flex">
        <h2 style="font-weight: 300; margin-top: 80px;">Alamat Tujuan</h2>
        <button id="btn-alamat" class="btn btn-primary" style="height: 45px; margin-top: 80px;">
          <i class="fas fa-plus"></i>&nbsp;TAMBAH ALAMAT
        </button>
      </div>
      <hr class="ms-3" style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">
      <div class="ms-3" style="font-size:20px">Anda belum menambahkan alamat, silahkan klik TAMBAH ALAMAT</div>  
    @endforelse
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
 $(document).ready(function(){
    $('.transaksi').on('click', function() {
      window.location.href = '/dashboard';
    });
    $('.servis').on('click', function() {
      window.location.href = '/dashboard/servis';
    });
    $('#alamat').on('click', function() {
      window.location.href = '/dashboard/list-alamat';
    });
    $('.profil').on('click', function() {
      window.location.href = '/dashboard/editprofil';
    });
    $('#tracking').on('click', function() {
      window.location.href = '/dashboard/tracking';
    });
    $('#btn-alamat,#edit-alamat').on('click', function() {
      window.location.href = '/dashboard/tambah-alamat';
    });
  });
</script>
  </body>
</html>