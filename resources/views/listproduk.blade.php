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


<div class="mt-5 container">
    <div class="row">
            @foreach ($produk as $row)
            @if ($row->catname === 'CCTV' || $row->catname === 'PROJECTOR' || $row->catname === 'PRINTER' || $row->catname === 'SCANNER' || $row->catname === 'TABLET' || $row->catname === 'UPS')
                <div id="listproduk" class="col-md-3 mb-4">  
                    <div class="card" style="width: 100%;">
                        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: inherit; text-decoration: none;">
                            <img class="card-img-top" src="{{$row->imagepath}}" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title">{{$row->productname}}</h3>
                                {{-- <h5 class="card-title"><s style="color: red">Rp {{number_format($row->pricebefore,0,',','.')}}</s></h5> --}}
                                <h5 class="card-title">Rp {{number_format($row->priceafter,0,',','.')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <div id="listproduk" class="col-md-3 mb-4">  
                    <div class="card" style="width: 100%;">
                        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: inherit; text-decoration: none;">
                            <img class="card-img-top" src="{{$row->imagepath}}" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title">{{$row->productname}}</h3>
                                <h5 class="card-title">Rp {{number_format($row->priceafter,0,',','.')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @endforeach

            @foreach ($produkResponsive as $row)
            @if ($row->catname === 'CCTV' || $row->catname === 'PROJECTOR' || $row->catname === 'PRINTER' || $row->catname === 'SCANNER' || $row->catname === 'TABLET' || $row->catname === 'UPS')
                <div id="listproduk-responsive" class="col-md-3 mb-4">  
                    <div class="card" style="width: 100%;">
                        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: inherit; text-decoration: none;">
                            <img class="card-img-top" src="{{$row->imagepath}}" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title">{{$row->productname}}</h3>
                                {{-- <h5 class="card-title"><s style="color: red">Rp {{number_format($row->pricebefore,0,',','.')}}</s></h5> --}}
                                <h5 class="card-title">Rp {{number_format($row->priceafter,0,',','.')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <div id="listproduk-responsive" class="col-md-3 mb-4">  
                    <div class="card" style="width: 100%;">
                        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: inherit; text-decoration: none;">
                            <img class="card-img-top" src="{{$row->imagepath}}" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="card-title">{{$row->productname}}</h3>
                                <h5 class="card-title">Rp {{number_format($row->priceafter,0,',','.')}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endif
            @endforeach
    </div>
</div>

<div id="page-link">
    {{$produk->links('vendor.pagination.bootstrap-5')}}
</div>

<div id="page-link-responsive">
    {{$produkResponsive->links('vendor.pagination.custom')}}
</div>


@include('partials.footer')
</body>
</html>