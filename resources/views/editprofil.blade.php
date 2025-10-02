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

<div id="dashboard-card" class="container d-flex" style="margin-left: 3em; padding-bottom: 100px;">
    <div class="card mt-5" style="width: 30%; 
        background-color: rgba(243, 240, 240, 0.7); border: none; 
        padding-bottom: 70px;">
        <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
        <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

        <h4 id="transaksi" class=" transaksi mt-3 ms-4" style="font-weight: 300; cursor: pointer">Histori Transaksi</h4>
        <h4 id="servis" class="servis mt-5 ms-4" style="font-weight: 300; cursor: pointer">Servis</h4>
        <h4 id="alamat" class="alamat mt-5 ms-4" style="font-weight: 300; cursor: pointer">Alamat</h4>
        <h4 id="profil" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Profil</h4>
        {{-- <h4 id="tracking" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container">
        <h1 class="ms-3" style="font-weight: 300; margin-top: 80px;">Profil</h1>
        <hr class="ms-3" style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">

        <div class="d-flex">
            <h5 class="mt-4 ms-5" style="font-weight: 300">Nama Lengkap</h5>
            <h5 class="mt-4" style="font-weight: 600; margin-left: 55px">
                {{ auth()->user()->customer->customername }}
            </h5>
            <button id="btn-ubah-nama" class="btn btn-danger mt-3 ms-auto w-25" style="height: 50%">
              UBAH
            </button>
        </div>
        <div class="d-flex">
            <h5 class="mt-4 ms-5" style="font-weight: 300">Username</h5>
            <h5 class="mt-4" style="font-weight: 600; margin-left: 100px">
                {{ auth()->user()->username }}
            </h5>
             <button id="btn-ubah-username" class="btn btn-danger mt-3 ms-auto w-25" style="height: 50%">
              UBAH
            </button>
        </div>
        <div id="telepon" class="d-flex">
            <h5 class="mt-4 ms-5" style="font-weight: 300">Telepon/WA</h5>
            <h5 class="mt-4" style="font-weight: 600; margin-left: 85px">
                {{ auth()->user()->customer->phone }}
            </h5>
            <button id="btn-ubah-telp" class="btn btn-danger mt-3 ms-auto w-25" style="height: 50%">
              UBAH
            </button>
        </div>
        <div class="mt-4 d-flex">
            <h5 class="mt-4 ms-5" style="font-weight: 300">Password</h5>
            <input disabled type="password" class="mt-4" value="{{ substr(auth()->user()->password, 0, 10) }}"
            style="font-weight: 600; margin-left: 110px; border:none;">
            <button id="btn-ubah-password" class="btn btn-danger mt-3 ms-auto w-25" style="height: 50%">
              UBAH
            </button>
        </div>

        <div class="dialog-confirm" style="display: none;">
            <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
                <div class="float-end close-dialog" style="cursor: pointer;">
                    <i class="fas fa-times"></i>
                </div>

                <div class="dialog-content">
                  
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
        <h4 id="servis" class="servis mt-4 ms-4" style="font-weight: 300; cursor: pointer;">Servis</h4>
        <h4 id="alamat" class="alamat mt-4 ms-4" style="font-weight: 300; cursor: pointer">Alamat</h4>
        <h4 id="profil" class="mt-4 ms-4" style="font-weight: 300; cursor: pointer; color: #920700;">Profil</h4>
        {{-- <h4 id="tracking" class="mt-4 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container mt-5" style="padding-bottom: 300px">
        <h1 style="font-weight: 300;">Edit Profil</h1>
        <hr style="width: 100%; border: 1px solid rgba(0,0,0,0.7)">

        <div class="d-flex">
            <h5 class="mt-4" style="font-weight: 300">Nama Lengkap</h5>
            <h5 class="mt-4" style="font-weight: 600; margin-left: 55px">
                {{ auth()->user()->customer->customername }}
            </h5>
        </div>
        <button id="btn-ubah-nama" class="btn btn-danger mt-3 ms-auto w-100" style="height: 50%">
            UBAH
        </button>

        <div class="d-flex">
            <h5 class="mt-4" style="font-weight: 300">Username</h5>
            <h5 class="mt-4" style="font-weight: 600; margin-left: 100px">
                {{ auth()->user()->username }}
            </h5>
        </div>
        <button id="btn-ubah-username" class="btn btn-danger mt-3 ms-auto w-100" style="height: 50%">
            UBAH
        </button>

        <div id="telepon" class="d-flex">
            <h5 class="mt-4" style="font-weight: 300">Telepon/WA</h5>
            <h5 class="mt-4" style="font-weight: 600; margin-left: 85px">
                {{ auth()->user()->customer->phone }}
            </h5>
        </div>
        <button id="btn-ubah-telp" class="btn btn-danger mt-3 ms-auto w-100" style="height: 50%">
            UBAH
        </button>

        <div class="mt-4 d-flex">
            <h5 class="mt-4" style="font-weight: 300">Password</h5>
            <input disabled type="password" class="mt-4 w-50" value="{{ substr(auth()->user()->password, 0, 10) }}"
            style="font-weight: 600; margin-left: 110px; border:none;">
        </div>
        <button id="btn-ubah-password" class="btn btn-danger mt-3 ms-auto w-100" style="height: 50%">
            UBAH
        </button>
    </div>

    <div class="dialog-confirm" style="display: none;">
            <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 600px; margin: auto;">
                <div class="float-end close-dialog" style="cursor: pointer;">
                    <i class="fas fa-times"></i>
                </div>

                <div class="dialog-content-responsive">
                  
                </div>
            </div>
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
    $('.alamat').on('click', function() {
      window.location.href = '/dashboard/list-alamat';
    });
    $('.profil').on('click', function() {
      window.location.href = '/dashboard/editprofil';
    });
    $('#tracking').on('click', function() {
      window.location.href = '/dashboard/tracking';
    });
    
    $('#btn-ubah-nama, #btn-ubah-username, #btn-ubah-telp, #btn-ubah-password').on('click', function() {
      var buttonId = $(this).attr('id');

      if (buttonId === 'btn-ubah-nama') {
        $('.dialog-content-responsive').html('');
        $('.dialog-content').html('');
        $('.dialog-content-responsive').append(
          `
            <h5 class="justify-content-center">Masukkan Nama Lengkap Baru</h5>
            <input id="customername-responsive" class="form-control w-100 mt-3" type="text" placeholder="Nama Lengkap">
            <div class="error-nama mt-1" style="color: red; display:none"></div>

            <button id="btn-konfirmasi-ubah-nama-responsive" class="btn btn-danger mt-3">UBAH</button>
          `);
        $('.dialog-content').append(
        `
          <h5 class="justify-content-center">Masukkan Nama Lengkap Baru</h5>
          <input id="customername" class="form-control w-100 mt-3" type="text" placeholder="Nama Lengkap">
          <div class="error-nama mt-1" style="color: red; display:none"></div>

          <button id="btn-konfirmasi-ubah-nama" class="btn btn-danger mt-3">UBAH</button>
        `);

          $('#btn-konfirmasi-ubah-nama, #btn-konfirmasi-ubah-nama-responsive').on('click', function() {
            let customername = $('#customername').val() || $('#customername-responsive').val();
 
            $.ajax({
                url: "{{ route('ubah.nama') }}",
                type: "PUT",
                data: 
                {
                    _token: '{{ csrf_token() }}' ,
                    customername: customername
                },
                success: function(response) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                  var errorMsg = JSON.parse(xhr.responseText);
                  console.error(errorMsg);

                  $.each(errorMsg, function(index, error) {
                    $.each(error, function(index, val) {  
                        if (val.indexOf('customernam') !== -1) 
                        {
                            $('.error-nama').show();
                            $('.error-nama').append(`${val}`); 
                        }
                    });
                  });
                }
            });
          });

      } else if (buttonId === 'btn-ubah-username') {
        $('.dialog-content-responsive').html('');
        $('.dialog-content').html('');
        $('.dialog-content-responsive').append(
          `
            <h5 class="justify-content-center">Masukkan Username Baru</h5>
            <input id="user-responsive" class="form-control w-100 mt-3" type="text" placeholder="Username">
            <div class="error-username mt-1" style="color: red; display:none"></div>

            <button id="btn-konfirmasi-ubah-username-responsive" class="btn btn-danger mt-3">UBAH</button>
          `);
        $('.dialog-content').append(
        `
          <h5 class="justify-content-center">Masukkan Username Baru</h5>
          <input id="user" class="form-control w-100 mt-3" type="text" placeholder="Username">
          <div class="error-username mt-1" style="color: red; display:none"></div>

          <button id="btn-konfirmasi-ubah-username" class="btn btn-danger mt-3">UBAH</button>
        `);

          $('#btn-konfirmasi-ubah-username, #btn-konfirmasi-ubah-username-responsive').on('click', function() {
            let username = $('#user').val() || $('#user-responsive').val();

            $.ajax({
                url: "{{ route('ubah.username') }}",
                type: "PUT",
                data: 
                {
                    _token: '{{ csrf_token() }}' ,
                    username: username
                },
                success: function(response) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                  var errorMsg = JSON.parse(xhr.responseText);
                  console.error(errorMsg);

                  $.each(errorMsg, function(index, error) {
                    $.each(error, function(index, val) {  
                        if (val.indexOf('username') !== -1) 
                        {
                            $('.error-username').show();
                            $('.error-username').append(`${val}`); 
                        }
                    });
                  });
                }
            });
          });

      } else if (buttonId === 'btn-ubah-telp') {
        $('.dialog-content-responsive').html('');
        $('.dialog-content').html('');
        $('.dialog-content-responsive').append(
          `
            <h5 class="justify-content-center">Masukkan Nomer Telepon Baru</h5>
            <input id="phone-responsive" class="form-control w-100 mt-3" type="text" placeholder="No. Telepon">
            <div class="error-telp mt-1" style="color: red; display:none"></div>

            <button id="btn-konfirmasi-ubah-telp-responsive" class="btn btn-danger mt-3">UBAH</button>
          `);
         $('.dialog-content').append(
          `
            <h5 class="justify-content-center">Masukkan Nomer Telepon Baru</h5>
            <input id="phone" class="form-control w-100 mt-3" type="text" placeholder="No. Telepon">
            <div class="error-telp mt-1" style="color: red; display:none"></div>

            <button id="btn-konfirmasi-ubah-telp" class="btn btn-danger mt-3">UBAH</button>
          `);

          $('#btn-konfirmasi-ubah-telp, #btn-konfirmasi-ubah-telp-responsive').on('click', function() {
            $('.error-telp').html('');
            let phone = $('#phone').val() || $('#phone-responsive').val();

            $.ajax({
                url: "{{ route('ubah.telepon') }}",
                type: "PUT",
                data: 
                {
                    _token: '{{ csrf_token() }}' ,
                    phone: phone
                },
                success: function(response) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                  var errorMsg = JSON.parse(xhr.responseText);
                  console.error(errorMsg);

                  $.each(errorMsg, function(index, error) {
                    $.each(error, function(index, val) {  
                        if (val.indexOf('phone') !== -1) 
                        {
                            $('.error-telp').show();
                            $('.error-telp').append(`${val}`); 
                        }
                    });
                  });
                }
            });
          });

      } else if (buttonId === 'btn-ubah-password') {
        $('.dialog-content-responsive').html('');
        $('.dialog-content').html('');
        $('.dialog-content-responsive').append(
          `
            <h5 class="justify-content-center">Masukkan Password Baru</h5>
            <input id="password-responsive" class="form-control w-100 mt-3" type="text" placeholder="Password">
            <div class="error-password mt-1" style="color: red; display:none"></div>

            <button id="btn-konfirmasi-ubah-password-responsive" class="btn btn-danger mt-3">UBAH</button>
          `);
        $('.dialog-content').append(
          `
            <h5 class="justify-content-center">Masukkan Password Baru</h5>
            <input id="password" class="form-control w-100 mt-3" type="text" placeholder="Password">
            <div class="error-password mt-1" style="color: red; display:none"></div>

            <button id="btn-konfirmasi-ubah-password" class="btn btn-danger mt-3">UBAH</button>
          `);

          $('#btn-konfirmasi-ubah-password, #btn-konfirmasi-ubah-password-responsive').on('click', function() {
            $('.error-password').html('');
            let password = $('#password').val() || $('#password-responsive').val();

            $.ajax({
                url: "{{ route('ubah.password') }}",
                type: "PUT",
                data: 
                {
                    _token: '{{ csrf_token() }}' ,
                    password: password
                },
                success: function(response) {
                    location.reload();
                },
                error: function (xhr, status, error) {
                  var errorMsg = JSON.parse(xhr.responseText);
                  console.error(errorMsg);

                  $.each(errorMsg, function(index, error) {
                    $.each(error, function(index, val) {  
                        if (val.indexOf('password') !== -1) 
                        {
                            $('.error-password').show();
                            $('.error-password').append(`${val}`); 
                        }
                    });
                  });
                }
            });
          });
      }

      $('.dialog-confirm').fadeIn();
    });

    $('.close-dialog').on('click', function() {
      $('.dialog-confirm').fadeOut();
      $('.dialog-content').html('');
    });
  });
</script>
  </body>
</html>