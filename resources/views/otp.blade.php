<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DUTA SARANA COMPUTER')</title>
    
    <link rel="icon" type="image/x-icon" href="favicon.ico?v=1.0">

    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="style2.css?v=2">
    <link rel="stylesheet" href="style3.css?v=2">

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
		/* container */
	.two-columns-grid {
		display: grid;
		grid-template-columns: 1fr 1fr;
	}

	/* columns */
	.two-columns-grid > * {
		padding:1rem;
	}

	.email:focus, .password:focus, .obscure-btn:focus {
		box-shadow: none;
		outline: none;
	}

	</style>
</head>
<body>
  <div id="sukses" class="fixed-top mt-5 alert alert-success text-center" role="alert">
    Berhasil terdaftar ! Silahkan <a href="/login">Login</a>
  </div>

    <div class="two-columns-grid">
		<div style="background-color: #88021d; padding-bottom: 200px;">
			<div class="container text-center mt-5"><img src="logo-dsc-white.png" width="250" height="140"></div>
			<div class="container text-center mt-50" style="font-size: 40px; color: white; font-weight: 500;">Sudah Punya Akun ?</div>
			<div class="container text-center mt-50" style="font-size: 20px; color: white;">
        <button id="btn-login" class="btn btn-warning" style="font-size: 20px; border-radius: 15px; width: 200px; height: 60px; font-weight:600">
          LOGIN
        </button>
      </div>
			<div class="container text-center mt-30">
        <button id="btn-back" class="btn" style="color: white; font-size: 20px; border-radius: 15px; width: 200px; height: 60px; font-weight:600; border: 1px solid rgba(255, 255, 255, 1)">
          KEMBALI
        </button>
      </div>
		</div>
		<div>
			<div class="container text-center mt-50">
				<div id="daftar-baru" class="container text-center mt-2">
                    <h4>Daftar Akun Baru</h4>
				
					<div id="recaptcha-container"></div>
					<div class="d-block">
            <div class="input-group mt-3">
							<input @if(session('alert')) style="font-weight: bold;  background-color: rgb(212, 209, 209); border: none;" readonly value="{{ session('email') }}" @endif name="email" type="email" class="email form-control form-control-lg bg-light fs-6 w-100" placeholder="Email" style="border-radius: 0%;">
						</div>
						<div class="input-group mt-4">
							<input @if(session('alert')) style="font-weight: bold;  background-color: rgb(212, 209, 209); border: none;" readonly value="{{ session('customername') }}" @endif name="customername" type="text" class="customername form-control form-control-lg bg-light fs-6 w-100" placeholder="Nama Lengkap" style="border-radius: 0%;">
						</div>
            <div class="input-group mt-4">
							<input name="username" type="text" class="username form-control form-control-lg bg-light fs-6 w-100" placeholder="Username (Max 10 karakter)" style="border-radius: 0%;">
              <div class="error-username mt-1" style="color: red; display:none"></div>
						</div>
            <div class="input-group mt-3">
							<input name="phone" type="text" class="phone form-control form-control-lg bg-light fs-6 w-100" placeholder="No. Telepon" style="border-radius: 0%;">
              <div class="warning-telp mt-1" style="color: red; display:none">* Input harus angka saja !</div>
              <div class="mt-1 error-telp" style="color: red; display:none"></div>
						</div>
            
            <div class="d-flex">
              <div class="input-group mt-3">
                <input name="password" type="password" class="password form-control form-control-lg bg-light fs-6 w-100" placeholder="Password (min.6, maks.10 karakter)" style="border-radius: 0%;">
                <div class="mt-1 error-password" style="color: red; display:none"></div>
              </div>
              <div>
                <button type="button" class="obscure-btn btn btn-lg btn-light mt-3" style="border-radius: 0%; border: 1px solid #ced4da; border-left: 0px;">
                  <span class="open-eye" style="display: none;">
                    <i class="fas fa-eye"></i>
                  </span>
                  <span class="close-eye">
                    <i class="fas fa-eye-slash"></i>
                  </span>
                </button>
              </div>
            </div>
            {{-- <div class="input-group mt-3">
							<input id="konf-password" name="konf-password" type="password" class="form-control form-control-lg bg-light fs-6 w-100" placeholder="Konfirmasi Password" style="border-radius: 0%;">
						</div> --}}
					</div>
					<div class="input-group mt-40">
						<button type="submit" class="submit-btn btn btn-lg btn-danger w-100">BUAT AKUN</button>
					</div>
				</div>
			</div>
		</div>
	</div>

  <div class="login-container">
		<img src="logo-dsc.svg" alt="Logo DSC" class="login-logo" />
    <div id="daftar-baru-responsive">
		<h3 style="font-family: Arial, Helvetica, sans-serif;">Daftar Akun Baru</h3>
			<div class="text-center mt-4">
				<input @if(session('alert')) style="font-weight: bold;  background-color: rgb(212, 209, 209); border: none;" readonly value="{{ session('email') }}" @endif name="email" type="email" class="email form-control bg-light fs-6 mx-auto" placeholder="Email">
			</div>
      <div class="text-center mt-3">
				<input @if(session('alert')) style="font-weight: bold;  background-color: rgb(212, 209, 209); border: none;" readonly value="{{ session('customername') }}" @endif name="customername" type="text" class="customername form-control bg-light fs-6 mx-auto" placeholder="Nama Lengkap">
			</div>
      <div class="text-center mt-3">
				<input name="username" type="text" class="username form-control bg-light fs-6 mx-auto" placeholder="Username (Max. 10 karakter)">
        <div class="error-username mt-1" style="color: red; display:none"></div>
			</div>
      <div class="text-center mt-3">
				<input name="phone" type="text" class="phone form-control bg-light fs-6 mx-auto" placeholder="No. Telepon">
        <div class="warning-telp mt-1" style="color: red; display:none">* Input harus angka saja !</div>
        <div class="mt-1 error-telp" style="color: red; display:none"></div>
			</div>
			<div class="text-center mt-3">
				<div class="input-group mx-auto" style="width: 80%;">
				  <input name="password" type="password" class="form-control bg-light fs-6 password" placeholder="Password">
				  <button type="button" class="obscure-btn btn btn-light toggle-password" style="border: 1px solid #ced4da; border-left: 0;">
            <span class="open-eye" style="display: none;">
              <i class="fas fa-eye"></i>
            </span>
            <span class="close-eye">
              <i class="fas fa-eye-slash"></i>
            </span>
				  </button>
          <div class="mt-1 error-password" style="color: red; display:none"></div>
				</div>
			</div>
			
		  <button type="submit" class="submit-btn btn-login mt-5">BUAT AKUN</button>
      </div>
		@auth
			<nav class="mobile-nav">
				<a href="/"><i class="fas fa-home"></i>Home</a>
				<a href="/wishlist"><i class="far fa-heart"></i>Wishlist</a>
				<a href="/cart"><i class="fas fa-shopping-cart"></i>Cart</a>
				<a href="/login"><i class="fas fa-user"></i>Dashboard</a>
			</nav>
		@else
			<nav class="mobile-nav">
				<a href="/"><i class="fas fa-home"></i>Home</a>
				<a href="/wishlist"><i class="far fa-heart"></i>Wishlist</a>
				<a href="/cart"><i class="fas fa-shopping-cart"></i>Cart</a>
				<a href="/login"><i class="fas fa-user"></i>Login</a>
			</nav>
		@endauth
	  </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {

  $('input').on('input', function () {
    $('.error-username').html('');
    $('.error-telp').html('');
    $('.error-password').html('');

    $('.error-username').hide();
    $('.error-telp').hide();
    $('.error-password').hide();
  });

  $('.obscure-btn').on('click', function () {
            const passwordInput = $('.password');
            const passwordType = passwordInput.attr('type');

            if (passwordType === 'password') {
                passwordInput.attr('type', 'text'); // Ubah ke text untuk menampilkan password
                $('.open-eye').show();
                $('.close-eye').hide();
            } else {
                passwordInput.attr('type', 'password'); // Ubah ke password untuk menyembunyikan
                $('.open-eye').hide();
                $('.close-eye').show();
            }
    });

    $('.phone').on('input', function () {
      const value = $(this).val(); // Ambil nilai input
      const isNumber = /^[0-9]+(\.[0-9]+)?$/.test(value);
      const cleanValue = value.replace(/[^0-9]/g, ''); // Hapus karakter non-angka (kecuali titik)
      
      if (value !== cleanValue) 
      {
        $('.warning-telp').show();
        $(this).val(cleanValue); 
      }

      if (isNumber || value === '') 
      {
        $('.warning-telp').hide();
      }
    });

    $('.submit-btn').on('click', function(e) {
      e.preventDefault();
       let customernames = $('.customername').map(function() {
        return $(this).val();
      }).get();

      let customername = customernames.find(p => p.trim() !== '') || '';

       let usernames = $('.username').map(function() {
        return $(this).val();
      }).get();

      let username = usernames.find(p => p.trim() !== '') || '';

       let emails = $('.email').map(function() {
        return $(this).val();
      }).get();

      let email = emails.find(p => p.trim() !== '') || '';

       let passwords = $('.password').map(function() {
        return $(this).val();
      }).get();

      let password = passwords.find(p => p.trim() !== '') || '';

      let phones = $('.phone').map(function() {
        return $(this).val();
      }).get();

      let phone = phones.find(p => p.trim() !== '') || '';

        $.ajax({
          url: "/data-api/daftar",
          type: 'POST',
          dataType: 'json',
          data: 
          {
            customername: customername,
            username: username,
            phone: phone,
            email: email,
            password: password
          },
          success: function(response){

            if (response.status === 'success') 
            {
              $('#daftar-baru').html('');
              $('#daftar-baru').append(
              `
              <div class="container text-center mt-50">
                <div class="container text-center mt-2">
                            <h4>Daftar Akun Baru</h4>
                    <div class="mt-50">
                        <a href="/auth/google/redirect" id="google-btn" style="display: flex; align-items: center; border: 1px solid rgb(0, 0, 0, 0.3)" class="btn btn-lg btn-light btn-block text-uppercase btn-outline justify-content-center">
                        <img style="width: 20px; height: 20px;" src="https://img.icons8.com/color/16/000000/google-logo.png">&nbsp;daftar dengan Google
                        </a>
                    </div>
                </div>
              </div>
              `);

              $('#daftar-baru-responsive').html('');
              $('#daftar-baru-responsive').append(
              `
                    <h3 style="font-family: Arial, Helvetica, sans-serif;">Daftar Akun Baru</h3>
                    <div class="mt-50">
                        <a href="/auth/google/redirect" id="google-btn" style="display: flex; align-items: center; border: 1px solid rgb(0, 0, 0, 0.3)" class="btn btn-lg btn-light btn-block text-uppercase btn-outline justify-content-center">
                        <img style="width: 20px; height: 20px;" src="https://img.icons8.com/color/16/000000/google-logo.png">&nbsp;daftar dengan Google
                        </a>
                    </div>
               
              `);
              
              console.log('User:', response.user);
              console.log('Token:', response.access_token);

              $('#sukses').slideDown(100);
              setTimeout(function() {
                $('#sukses').slideUp(900);
                }, 6000);

              $('input').val('');
              $('.email').attr('readonly', false).css('font-weight', 'normal');
              $('.customername').attr('readonly', false).css('font-weight', 'normal');
            }
          },
          error: function (xhr) {
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);

            $.each(errorMsg, function(index, error) {
              $.each(error, function(index, val) {  
                  if (val.indexOf('username') !== -1) 
                  {
                      $('.error-username').show();
                      $('.error-username').append(`${val}`); 
                  }
                  if (val.indexOf('phone') !== -1) 
                  {
                      $('.error-telp').show();
                      $('.error-telp').append(`${val}`);
                  }
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

    $('#btn-login').on('click', function() {
      window.location.href = '/login';
    });
  });
</script>  
</body>
</html>