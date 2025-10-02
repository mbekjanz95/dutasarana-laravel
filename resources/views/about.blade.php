<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Toko Komputer, PC, Printer, Aksesoris terbaik di Surabaya, Malang, Kediri, Solo, Denpasar, Jogja (Yogyakarta) - Canon, Epson. HP , Brother , Asus">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DUTA SARANA COMPUTER - Tentang Kami</title>
    
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">
  </head>
  <body>

@include('partials.navbar')
@include('partials.floatingbutton')

<h2></h2>

<div class="container mt-5" style="padding-bottom: 100px;">
    <h1 class="d-flex" style="font-weight: 300;"><span id="terpercaya-sejak" style="font-weight: 600;">Hadir</span><span id="tahun" class="ms-2" style="color: #920700; font-weight:800;"> 37 Tahun</span></h1>
    <hr class="line-headline" style="border-top: 3.5px solid #920700; width: 350px;">
    <div id="about" class="d-flex mt-5">
        <img class="float-start" src="surabaya.jpeg" width="600" height="400" style="margin: auto;">
      <div id="paragraf" class="ms-5">
        <p>
          <h5 class="open-sans" style="line-height: 2; text-align: justify; text-indent: 30px;">
            Sejak 1987, kami adalah mitra solusi teknologi
            dengan pengalaman panjang dan komitmen kuat
            terhadap kualitas. Filosofi kami terwujud dalam
            inovasi, membanggakan kepercayaan pelanggan,
            pelayanan terpercaya, dan produk asli sebagai
            pijakan utama kami dalam memberikan solusi
            teknologi terbaik.
          </h5>
  
          <h5 class="open-sans mt-3" style="line-height: 2; text-align: justify; text-indent: 30px;">
            Dengan mengutamakan profesional dibidangnya, Duta Sarana Computer didukung oleh tim yang berkompeten
            pada bidangnya, mulai dari pelayanan, produk, dan kualitas.
          </h5>
        </p>
      </div>
    </div>
  </div>

  @include('partials.footer')
</body>
</html>