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

	#email:focus, #password:focus, #obscure-btn:focus {
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
				<div class="container text-center mt-2">
                    <h4>Daftar Akun Baru</h4>
            <div class="mt-50">
                <a href="/auth/google/redirect" id="google-btn" style="display: flex; align-items: center; border: 1px solid rgb(0, 0, 0, 0.3)" class="btn btn-lg btn-light btn-block text-uppercase btn-outline justify-content-center">
                <img style="width: 20px; height: 20px;" src="https://img.icons8.com/color/16/000000/google-logo.png">&nbsp;daftar dengan Google
                </a>
            </div>
				</div>
			</div>
		</div>
	</div>

  <div class="login-container">
		<img src="logo-dsc.svg" alt="Logo DSC" class="login-logo" />
    <div id="daftar-baru-responsive">
		    <h3 style="font-family: Arial, Helvetica, sans-serif;">Daftar Akun Baru</h3>
        <div class="mt-50">
            <a href="/auth/google/redirect" id="google-btn" style="display: flex; align-items: center; border: 1px solid rgb(0, 0, 0, 0.3)" class="btn btn-lg btn-light btn-block text-uppercase btn-outline justify-content-center">
            <img style="width: 20px; height: 20px;" src="https://img.icons8.com/color/16/000000/google-logo.png">&nbsp;daftar dengan Google
            </a>
        </div>
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
</body>
</html>