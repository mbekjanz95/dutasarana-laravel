<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Toko Komputer, PC, Printer, Aksesoris terbaik di Surabaya, Malang, Kediri, Solo, Denpasar, Jogja (Yogyakarta) - Canon, Epson. HP , Brother , Asus">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DUTA SARANA COMPUTER - PRICE LIST</title>
    
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

<div id="floating-button-resp" class="d-flex justify-content-center align-items-center">
  <i class="fab fa-whatsapp" style="font-size: 30px;"></i>
</div>

<div class="container mt-5">
    <h5 style="font-weight: 600">* Klik salah satu brosur untuk download</h5>
    <div class="row mt-4">
        <!-- Gambar dalam grup 3 -->
        @foreach($paginatedImages->slice(0, floor($paginatedImages->count() / 3) * 3)->chunk(3) as $chunk)
            <div class="row">
                @foreach($chunk as $image)
                    <div class="col-md-4 mb-4">
                        <a href="{{ asset('brosur/' . $image->getFilename()) }}" download="{{ $image->getFilename() }}">
                            <img style="cursor: pointer" src="{{ asset('brosur/' . $image->getFilename()) }}" alt="Image" class="img-fluid">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach

        <!-- Baris terakhir jika ada sisa gambar -->
        @if($paginatedImages->count() % 3 !== 0)
            <div class="mt-3 row justify-content-center">
                @foreach($paginatedImages->slice(-($paginatedImages->count() % 3)) as $image)
                    <div class="col-md-4 mb-4">
                        <a href="{{ asset('brosur/' . $image->getFilename()) }}" download="{{ $image->getFilename() }}">
                            <img style="cursor: pointer" src="{{ asset('brosur/' . $image->getFilename()) }}" alt="Image" class="img-fluid">
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>    
    <div id="page-link">
        {{$paginatedImages->links('vendor.pagination.bootstrap-5')}}
    </div>

    <div id="page-link-responsive">
        {{$paginatedImages->links('vendor.pagination.custom')}}
    </div>
</div>

@include('partials.footer')
  </body>
</html>

