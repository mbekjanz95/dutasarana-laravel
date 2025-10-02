<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DUTA SARANA COMPUTER')</title>
    
    <link rel="icon" type="image/x-icon" href="favicon.ico?v=1.0">

    <link rel="preload" href="style.css" as="style" />
    <link rel="stylesheet" href="style.css?v=2">

    <link rel="preload" href="style2.css" as="style" />
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

  </head>
  <body>
    
@include('partials.navbar')
@include('partials.floatingbutton')

<div class="container mt-5 text-center">
    <div style="font-size: 50px; font-weight: 500;">OUR MARKETPLACE</div>
    <a href="https://shopee.co.id/dutasaranacomputer?categoryId=100644&entryPoint=ShopByPDP&itemId=5850373224&upstream=search" target="_blank"><img style="margin-top: 40px;" src="marketplace/shopee.png" width=300px height=300px></a>
    <a href="https://www.tokopedia.com/dutasarana168?source=universe&st=product" target="_blank"><img style="margin-left: 30px;" src="marketplace/tokopedia.png" width=300px height=300px></a>
    <a href="https://www.blibli.com/merchant/duta-sarana-computer/DUS-60026?pickupPointCode=PP-3037382&fbbActivated=false" target="_blank"><img style="margin-left: 30px;" src="marketplace/blibli.png" width=300px height=300px><br></a>
    <a href="https://siplah.blibli.com/merchant-detail/SDSC-0001?itemPerPage=40&page=0&merchantId=SDSC-0001" target="_blank"><img style="margin-left: 30px;" src="marketplace/siplah.png" width=300px height=300px></a>
    <a href="https://datascripmall.id/sellerstore/duta.sarana.computer" target="_blank"><img style="margin-left: 30px;" src="marketplace/datascript.png" width=300px height=300px></a>
    <a href="https://e-katalog.lkpp.go.id/productsearchcontroller/listproduk?authenticityToken=bc0af4782ecf05149efda3331dc53c2fefa2e515&cat=1237626&commodityId=90424&q=&jenis_produk=&pid=419860&mid=&tkdn_produk=-99&sni=-99&hemat_energi=-99&btu_id=&gt=&lt=" target="_blank"><img style="margin-left: 30px;" src="marketplace/ecatalogue.png" width=300px height=300px></a>
</div>

@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.floating-button').on('mouseenter', function() {
            $('.best-seller .card').css('z-index', '-1');
        });
        $('.floating-button').on('mouseleave', function() {
            $('.best-seller .card').css('z-index', '');
        });


        $('.element-container').on('mouseenter', function() {
            $('.best-seller .card').css('z-index', '-1');
        });
        $('.element-container').on('mouseleave', function() {
            $('.best-seller .card').css('z-index', '');
        });
    });
</script>
</body>
</html>