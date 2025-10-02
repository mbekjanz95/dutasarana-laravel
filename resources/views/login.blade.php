<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DUTA SARANA COMPUTER</title>
    
    <link rel="icon" type="image/x-icon" href="favicon.ico?v=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="style2.css?v=2">
	<link rel="stylesheet" href="style3.css?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a59b9b09ab.js" crossorigin="anonymous"></script>

	<style>
	.input-group .form-control {
		border-top-left-radius: 7px;
		border-bottom-left-radius: 7px;
		border-right: 1px;
	}

	.input-group .btn {
		border-top-right-radius: 7px;
		border-bottom-right-radius: 7px;
		padding: 0 12px;
	}

	</style>
  </head>
<body>
	<div class="two-columns-grid">
		<div style="background-color: #88021d; height: 100%">
			<div class="container text-center"><img width="150" height="75" src="logo-dsc-white.png"></div>
			<div class="container text-center mt-50" style="font-size: 40px; color: white; font-family: 'Trebuchet MS', 'Helvetica', sans-serif;">
                Selamat Datang di<br>Duta Sarana Computer
            </div>
			<div class="container text-center mt-50" style="font-size: 20px; color: white; font-family: 'Trebuchet MS', 'Helvetica', sans-serif;">Temukan barang impian<br>sesuai dengan kebutuhanmu</div>
			<div class="container text-center mt-20"><img src="13.png" style="width: 300px; height: 250px;"></div>
		</div>
		<div>
			<div class="container text-center mt-20">
				<h3>Mulai Belanja Sekarang !</h3>
				<h4 class="mt-4">Masukkan Email dan Password Anda</h4>
				<div class="mt-50">
					<a href="/auth/google/redirect" id="google-btn" style="display: flex; align-items: center;" class="btn btn-lg btn-light btn-block text-uppercase btn-outline justify-content-center">
						<img style="width: 20px; height: 20px;" src="https://img.icons8.com/color/16/000000/google-logo.png">&nbsp;masuk dengan Google
					</a>
				</div>
				<div class="container text-center mt-4">ATAU</div>
				<div class="container text-center mt-4">
				<form action="/login" method="post">
					@csrf
					<div class="input-group mb-3">
						<input id="email" name="email" type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email" style="border-radius: 0%;">
					</div>
					<div class="d-flex">
						<div class="input-group mt-3" style="width: 90%;">
							<input name="password" type="password" class="password form-control form-control-lg bg-light fs-6" placeholder="Password" style="border-radius: 0%; border-right: 0px;">
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
					<div class="d-flex mt-4" style="font-weight: 500"> 
						<div id="lupa-password" class="mx-auto" style="cursor: pointer; color: #88021d;">
							Lupa Password ?
						</div>
					</div>
						@if ($errors->any())
							<div style="height: auto; font-size:15px; display: flex; align-items: center; color: rgb(214, 52, 52);" class="mt-3 alert alert-danger">  
								@foreach ($errors->all() as $message) 
									{{ $message }}<br>
								@endforeach
							</div>
						@endif
					<div class="mt-50">
						<button id="submit-btn" type="submit" class="btn btn-lg btn-danger w-100">LOGIN</button>
					</div>
				</form>
					<div class="text-center mt-50">
						<b>Belum punya akun ?<a style="color: #88021d; text-decoration: none;" class="ml-2" href="/sign-up">&nbsp;DAFTAR</a></b>
					</div>
				</div>
			</div>
		</div>

		 <div id="dialog-confirm" style="display: none;">
                <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 400px; margin: auto;">
					<div class="float-end close-dialog" style="cursor: pointer;">
						<i class="fas fa-times"></i>
					</div>

                  	<form method="POST" action="{{ route('password.email') }}">
						@csrf
							<h5 class="mt-4" style="font-family: 'Segoe UI', serif;">Silahkan masukkan alamat Email anda.<br>
							Link Reset Password akan dikirimkan ke Email anda</h5>

							<input type="email" name="email" class="form-control w-100 mt-3" required autofocus placeholder="Masukkan Email anda">
							@if ($errors->any())
								<div style="height: 30px; font-size:15px; display: flex; align-items: center; color: rgb(214, 52, 52); width: 80%;" class="mt-3 mx-auto alert alert-danger">  
									@foreach ($errors->all() as $message) 
										* {{ $message }}<br>
									@endforeach
								</div>
							@endif

							<button type="submit" class="btn btn-primary mt-3">Kirim Link Reset</button>
					</form>
                </div>
            </div>
	</div>

	<div class="login-container">
		<img src="logo-dsc.svg" alt="Logo DSC" class="login-logo" />
		<h1 style="font-family: Arial, Helvetica, sans-serif;">Login</h1>
		<form action="/login" method="post">
			@csrf
			<div class="text-center">
				<input id="email" name="email" type="email" class="form-control bg-light fs-6 mx-auto" placeholder="Email">
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
				</div>
			</div>
			@if ($errors->any())
				<div style="height: 30px; font-size:15px; display: flex; align-items: center; color: rgb(214, 52, 52); width: 80%;" class="mt-3 mx-auto alert alert-danger">  
					@foreach ($errors->all() as $message) 
						* {{ $message }}<br>
					@endforeach
				</div>
			@endif
		  <div class="remember-forgot mx-auto">
			<a href="/forgot-password" class="mx-auto">Lupa Kata Sandi ?</a>
		  </div>
		  <button type="submit" class="btn-login mt-3">MASUK</button>
		</form>
		<div class="atau">ATAU</div>
		<div class="google-login mx-auto mt-3">
			<a style="text-decoration: none; color: inherit" href="/auth/google/redirect">
				<img style="width: 20px; height: 20px;" src="https://img.icons8.com/color/16/000000/google-logo.png">&nbsp;Masuk dengan Google
			</a>
		</div>
		<div class="register" style="padding-bottom: 100px;">
		  Belum punya Akun ? <a href="/sign-up">DAFTAR</a>
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
	
	$('#lupa-password').on('click', function () {
        window.location.href="/forgot-password";
    });

	$('.close-dialog').on('click', function () {
        $('#dialog-confirm').fadeOut();
    });
});
</script>
</body>
</html>