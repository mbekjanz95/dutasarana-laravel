<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>WISHLIST</title>
    
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

  </head>
  <body>
    
@include('partials.navbar')

<div id="delete-wishlist-success" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
  Berhasil menghapus produk dari Wishlist
</div>

@if ($wishlist->count() == 0)
  <div class="container mt-5 text-center justify-content-center">
      <img src="jempol.png" alt="wishlist-logo" width="200" height="210">
    <h1 class="mt-5">Wishlist Anda Masih Kosong</h1>
    <button id="back" class="btn btn-danger mt-3" style="border-radius: 15px; font-size: 20px; font-weight: 600; width: auto; height: 50px;">Kembali ke Halaman Utama</button>
  </div>
@else
  <div class="container mt-4">
    <h3>Daftar Wishlist</h3>
    <div class="mt-4" >
      <input id="semua" type="checkbox" style="border-radius: 5px;">
      <label for="semua" style="font-weight: 500; font-size: 19px;" class="ms-1">Pilih Semua</label>
      <button class="float-end" style="background: none; border:none; 
      font-weight:500; color: #920700; font-size: 19px;">Hapus</button>
    </div>
    <hr>

    <div class="row">
    @foreach ($produk as $row)
    <div class="col-md-3 mb-4">
    <div class="card" style="margin-left: 30px; display: flex; flex-direction: column; height: 100%;">
          <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="text-decoration: none; color: inherit;">
              <img class="card-img-top" src="{{asset($row->imagepath)}}" alt="Card image cap">
              <div class="card-body d-flex flex-column" style="flex-grow: 1">
              <h3 class="card-title">{{$row->productname}}</h3>
                  {{-- <p class="card-text text-truncate">{{$row->kegunaan}}</p> --}}
              {{-- <h5 class="card-title"><s style="color: red;">Rp {{number_format($row->pricebefore,0,',','.')}}</s></h5> --}}
              <div class="card-title">{{$row->value}}</div>
              <input type="hidden" class="idvar" value="{{$row->id}}">
              <h5 class="card-title">Rp {{number_format($row->priceafter,0,',','.')}}</h5>
              <button class="delete-wishlist mt-4 btn btn-danger"><i class="fas fa-trash"></i>&nbsp;Hapus Dari Wishlist</button>
              </div>
          </a>
    </div>
    </div>
    @endforeach
    </div>
  </div>
@endif

<div class="container mt-70">
  <h3>Our Best Seller</h3>
  <hr class="line-top-categories">
    <div class="best-seller container mt-5 d-flex justify-content-center">
      @foreach ($bestSeller1 as $row )
      @if ($row->catname === 'CCTV' || $row->catname === 'PROJECTOR' || $row->catname === 'PRINTER' || $row->catname === 'SCANNER' || $row->catname === 'TABLET' || $row->catname === 'UPS')
        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
          <div class="card" style="margin-left: 30px; display: flex; flex-direction: column; height: 100%;">
              <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
              <div class="card-body d-flex flex-column" style="flex-grow: 1">
                <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                {{-- <p class="card-text"><s style="color: red">Rp {{number_format($row->pricebefore,0,',','.')}}</s></p> --}}
                <p class="card-text">Rp {{number_format($row->priceafter,0,',','.')}}</p>
              </div>
          </div>
        </a>
      @else
        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
          <div class="card" style="margin-left: 30px; display: flex; flex-direction: column; height: 100%;">
            <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column" style="flex-grow: 1">
                <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                <p class="card-text">Rp {{number_format($row->priceafter,0,',','.')}}</p>
              </div>
          </div>
        </a>
      @endif
      @endforeach
    </div>

    <div class="best-seller container mt-5 d-flex justify-content-center">
      @foreach ($bestSeller2 as $row )
      @if ($row->catname === 'CCTV' || $row->catname === 'PROJECTOR' || $row->catname === 'PRINTER' || $row->catname === 'SCANNER' || $row->catname === 'TABLET' || $row->catname === 'UPS')
        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
          <div class="card" style="margin-left: 30px; display: flex; flex-direction: column; height: 100%;">
            <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column" style="flex-grow: 1">
                <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                {{-- <p class="card-text"><s style="color: red">Rp {{number_format($row->pricebefore,0,',','.')}}</s></p> --}}
                <p class="card-text">Rp {{number_format($row->priceafter,0,',','.')}}</p>
              </div>
          </div>
        </a>
      @else
        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
          <div class="card" style="margin-left: 30px; display: flex; flex-direction: column; height: 100%;">
            <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column" style="flex-grow: 1">
                <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                <p class="card-text">Rp {{number_format($row->priceafter,0,',','.')}}</p>
              </div>
          </div>
        </a>
      @endif
      @endforeach

      @foreach ($epson as $row )
      <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
        <div class="card" style="margin-left: 30px; display: flex; flex-direction: column; height: 100%;">
          <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
          <div class="card-body d-flex flex-column" style="flex-grow: 1">
              <h5 class="card-title"><b>{{$row->productname}}</b></h5>
              {{-- <p class="card-text"><s style="color: red">Rp {{number_format($row->pricebefore,0,',','.')}}</s></p> --}}
              <p class="card-text">Rp {{number_format($row->priceafter,0,',','.')}}</p>
            </div>
        </div>
      </a>
      @endforeach
    </div>

    <div class="best-seller row mt-3 justify-content-center">
        @foreach ($bestSeller1 as $row )
        @if ($row->catname === 'CCTV' || $row->catname === 'PROJECTOR' || $row->catname === 'PRINTER' || $row->catname === 'SCANNER' || $row->catname === 'TABLET' || $row->catname === 'UPS')
          <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
            <div class="card" style="margin: auto;">
                <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                  {{-- <p class="card-text mt-3"><s style="color: red">Rp {{number_format($row->pricebefore,0,',','.')}}</s></p> --}}
                  <p class="card-text mt-3">Rp {{number_format($row->priceafter,0,',','.')}}</p>
                </div>
            </div>
          </a>
        @else
          <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
            <div class="card" style="margin: auto;">
                <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                  <p class="card-text mt-3">Rp {{number_format($row->priceafter,0,',','.')}}</p>
                </div>
            </div>
          </a>
        @endif
        @endforeach

        @foreach ($bestSeller2 as $row )
        @if ($row->catname === 'CCTV' || $row->catname === 'PROJECTOR' || $row->catname === 'PRINTER' || $row->catname === 'SCANNER' || $row->catname === 'TABLET' || $row->catname === 'UPS')
          <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
            <div class="card" style="margin: auto;">
                <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                  {{-- <p class="card-text mt-3"><s style="color: red">Rp {{number_format($row->pricebefore,0,',','.')}}</s></p> --}}
                  <p class="card-text mt-3">Rp {{number_format($row->priceafter,0,',','.')}}</p>
                </div>
            </div>
          </a>
        @else
          <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
            <div class="card" style="margin: auto;">
                <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                  <p class="card-text mt-3">Rp {{number_format($row->priceafter,0,',','.')}}</p>
                </div>
            </div>
          </a>
        @endif
        @endforeach

        @foreach ($epson as $row )
        <a href="{{ route('product.index', ['productname' => $row->productname]) }}" style="color: black; text-decoration: none;">
          <div class="card" style="margin: auto;">
              <img src="{{$row->imagepath}}" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><b>{{$row->productname}}</b></h5>
                {{-- <p class="card-text mt-3"><s style="color: red">Rp {{number_format($row->pricebefore,0,',','.')}}</s></p> --}}
                <p class="card-text mt-3">Rp {{number_format($row->priceafter,0,',','.')}}</p>
              </div>
          </div>
        </a>
        @endforeach
    </div>
</div>

@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    if(localStorage.getItem("delete-wishlistClicked"))
        {      
            localStorage.removeItem("delete-wishlistClicked");     
            $('#delete-wishlist-success').slideDown(150);
            setTimeout(function() {
                $('#delete-wishlist-success').slideUp(900);
                }, 5000);
        }

    $('#back').on('click', function() {
      window.location.href = '/';
    });

    $('.delete-wishlist').on('click', function(e) {
            e.preventDefault();

            var index = $(".delete-wishlist").index($(this));
            $('#delete-wishlist-success').hide();
            let idvar = $(".idvar").eq(index).val();

            $.ajax({
                url: "delete/wishlist",
                type: 'DELETE',
                dataType: 'text',
                data: 
                {
                    _token: "{{ csrf_token() }}",
                    idvar: idvar
                },
                success: function(){
                    location.reload(); 
                    localStorage.setItem("delete-wishlistClicked", true);
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
  });
</script>
</body>
</html>