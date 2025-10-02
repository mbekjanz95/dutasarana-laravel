<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$produk->productname}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DUTA SARANA COMPUTER - {{$produk->productname}}</title>

    <link rel="icon" type="image/x-icon" href="favicon.ico?v=1.0">

    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="style2.css?v=2">
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="magnify.css?v=2">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <style>
        .magnify {
            display: block !important;
            margin-left: auto !important;
            margin-right: auto !important;
            width: fit-content; /* atau fixed width jika perlu */
        }
         .status-card {
            padding: 13px;
            white-space: nowrap;
            overflow-x: auto;
        }
        .status-item {
            display: inline-block;
            margin-right: 10px;
            font-size: 1rem;
            color: #962f28;
            cursor: pointer;
            position: relative;
        }
        .status-item.active::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 100%;
            height: 4px;
            background-color: #962f28;
        }
    </style>
</head>
<body>
@include('partials.navbar')
@include('partials.floatingbutton')

<div id="floating-button-resp" class="d-flex justify-content-center align-items-center">
    <i class="fab fa-whatsapp" style="font-size: 30px;"></i>
</div>

<div class="desktop-produk container mt-4 d-flex">
    <div id="add-wishlist-success" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
        Berhasil menambahkan produk ke Wishlist
    </div>

    <div id="add-cart-success" class="fixed-top mt-5 alert alert-success text-center" role="alert">
        Berhasil menambahkan produk ke Keranjang <a href="/cart">Cek Keranjang</a>
    </div>

    <div id="alert-stok" class="fixed-top mt-5 alert alert-danger text-center" role="alert">
   
    </div>

    <div id="delete-wishlist-success" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
        Berhasil menghapus produk dari Wishlist
    </div>

    <img id="img-produk" style="width: 400px; height:400px;" src="{{$produk->imagepath}}" class="zoom float-start" data-magnify-src="{{$produk->imagepath}}">
        <input type="hidden" id="input-img-produk" value="{{$produk->imagepath}}">
        <input type="hidden" id="input-id-produk" value="{{$produk->id}}">

@if ($produk->imagepath && 
     is_null($produk->imagepath_2) && 
     is_null($produk->imagepath_3) && 
     is_null($produk->imagepath_4) && 
     is_null($produk->imagepath_5))

   <div class="d-flex position-relative" style="margin-top: 420px; margin-right: 450px">
    <img class="thumbnail-image" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
   </div>
@endif

@if ($produk->imagepath && 
     $produk->imagepath_2 && 
     is_null($produk->imagepath_3) && 
     is_null($produk->imagepath_4) && 
     is_null($produk->imagepath_5))

   <div class="d-flex position-relative" style="margin-top: 420px; margin-right: 350px">
    <img class="thumbnail-image" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_2 }}" data-magnify-src="{{$produk->imagepath_2}}">
   </div>
@endif

@if ($produk->imagepath && 
     $produk->imagepath_2 && 
     $produk->imagepath_3 && 
     is_null($produk->imagepath_4) && 
     is_null($produk->imagepath_5))

   <div class="d-flex position-relative" style="margin-top: 420px; margin-right: 250px">
    <img class="thumbnail-image" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_2 }}" data-magnify-src="{{$produk->imagepath_2}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_3 }}" data-magnify-src="{{$produk->imagepath_3}}">
   </div>
@endif

@if ($produk->imagepath && 
     $produk->imagepath_2 && 
     $produk->imagepath_3 && 
     $produk->imagepath_4 && 
     is_null($produk->imagepath_5))

   <div class="d-flex position-relative" style="margin-top: 420px; margin-right: 170px">
    <img class="thumbnail-image" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_2 }}" data-magnify-src="{{$produk->imagepath_2}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_3 }}" data-magnify-src="{{$produk->imagepath_3}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_4 }}" data-magnify-src="{{$produk->imagepath_4}}">
   </div>
@endif

@if ($produk->imagepath && 
     $produk->imagepath_2 && 
     $produk->imagepath_3 && 
     $produk->imagepath_4 && 
     $produk->imagepath_5)

   <div class="d-flex position-relative" style="margin-top: 420px; margin-right: 100px">
    <img class="thumbnail-image" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_2 }}" data-magnify-src="{{$produk->imagepath_2}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_3 }}" data-magnify-src="{{$produk->imagepath_3}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_4 }}" data-magnify-src="{{$produk->imagepath_4}}">
    <img class="thumbnail-image ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_5 }}" data-magnify-src="{{$produk->imagepath_5}}">
   </div>
@endif

    <div class="col-xl-7">
       <div hidden>{{$produk->catname}}</div>
       <div style="font-size: 30px; font-weight: 500;">{{$produk->productname}}</div>
       <div id="harga-produk" class="mt-2" style="font-size: 30px; font-weight: 400;">
            @if ($produk->catname === 'CCTV' || $produk->catname === 'PROJECTOR' || $produk->catname === 'PRINTER' || $produk->catname === 'SCANNER' || $produk->catname === 'TABLET' || $produk->catname === 'UPS')
                <div id="harga-sebelum"><s style="color: red;">Rp {{number_format($produk->pricebefore,0,',','.')}}</s></div>
                <div id="harga-sesudah">Rp {{number_format($produk->priceafter,0,',','.')}}</div>
            @else
                <div id="harga-normal">Rp {{number_format($produk->priceafter,0,',','.')}}</div>
            @endif
       </div>
       <div id="text-pilih-variasi-1" class="mt-4" style="font-size: 17px; font-weight: 400;">Pilih Variasi :</div>
       <div id="stok-column" style="font-size: 17px; font-weight: 400; 
            margin-top: 30px; display: grid; 
            grid-template-columns: repeat(2, 1fr); gap: 15px;">
        </div>
        <div id="text-pilih-variasi-2" class="mt-4" style="font-size: 17px; font-weight: 400;">Pilih Variasi :</div>
       <div class="pilih-variasi" style="font-size: 17px; font-weight: 400;">
            @foreach ($variasi as $row )
            <div class="variasi ms-2 btn btn-danger" data-id="{{$row->id}}" data-priceafter="{{$row->priceafter}}">
                {{$row->value}}
            </div>
            <input type="hidden" class="id-var" value="{{$row->id}}" data-id="{{$row->id}}">
            @endforeach
        </div>
    
       <div style="font-size: 17px; font-weight: 400; margin-top: 30px;">
            Qty
            <span class="ms-3">
                <button onclick="this.parentNode.querySelector('.qty').stepDown()" class="min-btn-produk" style="width: 40px; background-color: white;">-</button>
                <input class="qty text-center ms-1" style="width: 60px;" type="number" min="1" value="1">
                <button onclick="this.parentNode.querySelector('.qty').stepUp()" class="ms-1 plus-btn-produk" style="width: 40px; background-color: white;">+</button>
            </span>
       </div>
      
       <div style="font-size: 17px; font-weight: 400; margin-top: 50px;">
            <span id="cart">
                <button class="add-cart btn btn-success" style="width: 230px;"><i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart</button>
            </span>
            <span id="wishlist">
                <button class="add-wishlist ms-2 btn btn-warning" style="width: 230px;"><i class="far fa-heart"></i>&nbsp;Add to Wishlist</button>
            </span>                
       </div>
       <div class="container" style="position: absolute;">
        @auth
        @else
            <h5 class="mt-4" id="login-text"><i>**Silahkan Login untuk Checkout Produk**</i></h5>
        @endauth
    </div>
</div>
</div>     


{{-- <div class="responsive-produk container mt-4 d-flex"> --}}
<div id="add-wishlist-success-responsive" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
        Berhasil menambahkan produk ke Wishlist
</div>

<div id="add-cart-success-responsive" class="fixed-top mt-5 alert alert-success text-center" role="alert">
        Berhasil menambahkan produk ke Keranjang <a href="/cart">Cek Keranjang</a>
</div>

<div id="alert-stok-responsive" class="fixed-top mt-5 alert alert-danger text-center" role="alert">
   
</div>

<div id="delete-wishlist-success-responsive" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
        Berhasil menghapus produk dari Wishlist
</div>

    <img id="img-produk-responsive" style="width: 100px; height:100px;" src="{{$produk->imagepath}}" class="zoom responsive mx-auto mt-4" data-magnify-src="{{$produk->imagepath}}">
        <input type="hidden" id="input-img-produk" value="{{$produk->imagepath}}">
        <input type="hidden" id="input-id-produk" value="{{$produk->id}}">

<div class="list-image-responsive">
@if ($produk->imagepath && 
     is_null($produk->imagepath_2) && 
     is_null($produk->imagepath_3) && 
     is_null($produk->imagepath_4) && 
     is_null($produk->imagepath_5))

   <div class="d-flex container mt-3">
    <img class="thumbnail-image-responsive" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
   </div>
@endif
   
@if ($produk->imagepath && 
     $produk->imagepath_2 && 
     is_null($produk->imagepath_3) && 
     is_null($produk->imagepath_4) && 
     is_null($produk->imagepath_5))

   <div class="d-flex container mt-3">
    <img class="thumbnail-image-responsive" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
    <img class="thumbnail-image-responsive ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_2 }}" data-magnify-src="{{$produk->imagepath_2}}">
   </div>
@endif

@if ($produk->imagepath && 
     $produk->imagepath_2 && 
     $produk->imagepath_3 && 
     is_null($produk->imagepath_4) && 
     is_null($produk->imagepath_5))

   <div class="d-flex container mt-3">
    <img class="thumbnail-image-responsive" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
    <img class="thumbnail-image-responsive ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_2 }}" data-magnify-src="{{$produk->imagepath_2}}">
    <img class="thumbnail-image-responsive ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_3 }}" data-magnify-src="{{$produk->imagepath_3}}">
   </div>
@endif

@if ($produk->imagepath && 
     $produk->imagepath_2 && 
     $produk->imagepath_3 && 
     $produk->imagepath_4 && 
     is_null($produk->imagepath_5))

   <div class="d-flex container mt-3">
    <img class="thumbnail-image-responsive" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
    <img class="thumbnail-image-responsive ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_2 }}" data-magnify-src="{{$produk->imagepath_2}}">
    <img class="thumbnail-image-responsive ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_3 }}" data-magnify-src="{{$produk->imagepath_3}}">
    <img class="thumbnail-image-responsive ms-3" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_4 }}" data-magnify-src="{{$produk->imagepath_4}}">
   </div>
@endif

@if ($produk->imagepath && 
     $produk->imagepath_2 && 
     $produk->imagepath_3 && 
     $produk->imagepath_4 && 
     $produk->imagepath_5)

   <div class="d-flex container mt-3">
    <div class="status-card shadow-sm bg-white">
        <img class="thumbnail-image-responsive-5 status-item" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath }}" data-magnify-src="{{$produk->imagepath}}">
        <img class="thumbnail-image-responsive-5 status-item" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_2 }}" data-magnify-src="{{$produk->imagepath_2}}">
        <img class="thumbnail-image-responsive-5 status-item" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_3 }}" data-magnify-src="{{$produk->imagepath_3}}">
        <img class="thumbnail-image-responsive-5 status-item" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_4 }}" data-magnify-src="{{$produk->imagepath_4}}">
        <img class="thumbnail-image-responsive-5 status-item" style="width: 80px; height:80px; cursor: pointer;" src="{{ $produk->imagepath_5 }}" data-magnify-src="{{$produk->imagepath_5}}">
    </div>
   </div>
@endif 
</div>

    <div class="produk-content-responsive mt-4 col container">
       <div hidden>{{$produk->catname}}</div>
       <div style="font-size: 30px; font-weight: 500;">{{$produk->productname}}</div>
       <div id="harga-produk" class="mt-2" style="font-size: 30px; font-weight: 400;">
            @if ($produk->catname === 'CCTV' || $produk->catname === 'PROJECTOR' || $produk->catname === 'PRINTER' || $produk->catname === 'SCANNER' || $produk->catname === 'TABLET' || $produk->catname === 'UPS')
                <div id="harga-sebelum"><s style="color: red;">Rp {{number_format($produk->pricebefore,0,',','.')}}</s></div>
                <div id="harga-sesudah">Rp {{number_format($produk->priceafter,0,',','.')}}</div>
            @else
                <div id="harga-normal">Rp {{number_format($produk->priceafter,0,',','.')}}</div>
            @endif
       </div>
       <div id="text-pilih-variasi-1-responsive" class="mt-4" style="font-size: 17px; font-weight: 400;">Pilih Variasi :</div>
       <div id="stok-column-responsive" style="font-size: 17px; font-weight: 400; 
            margin-top: 30px; ">
        </div>
        <div id="text-pilih-variasi-2-responsive" class="mt-4" style="font-size: 17px; font-weight: 400;">Pilih Variasi :</div>
       <div class="pilih-variasi" style="font-size: 17px; font-weight: 400;">
            @foreach ($variasi as $row )
            <div class="variasi ms-2 btn btn-danger" data-id="{{$row->id}}" data-priceafter="{{$row->priceafter}}">
                {{$row->value}}
            </div>
            <input type="hidden" class="id-var" value="{{$row->id}}" data-id="{{$row->id}}">
            @endforeach
        </div>
    
       <div style="font-size: 17px; font-weight: 400; margin-top: 30px;">
            Qty
            <span class="ms-3">
                <button onclick="this.parentNode.querySelector('.qty-responsive').stepDown()" class="min-btn-produk" style="width: 40px; background-color: white;">-</button>
                <input class="qty-responsive text-center ms-1" style="width: 60px;" type="number" min="1" value="1">
                <button onclick="this.parentNode.querySelector('.qty-responsive').stepUp()" class="ms-1 plus-btn-produk" style="width: 40px; background-color: white;">+</button>
            </span>
       </div>
      
       <div style="font-size: 17px; font-weight: 400; margin-top: 50px;">
            <span id="cart-responsive">
                <button class="add-cart btn btn-success w-100"><i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart</button>
            </span>
            <span id="wishlist-responsive">
                <button class="add-wishlist btn btn-warning mt-3 w-100"><i class="far fa-heart"></i>&nbsp;Add to Wishlist</button>
            </span>                
       </div>
       <div class="container" style="position: absolute;">
        @auth
        @else
            <h5 class="mt-4" id="login-text"><i>**Silahkan Login untuk Checkout Produk**</i></h5>
        @endauth
    </div>
</div> 

{{-- </div>    --}}

<div class="container mb-5" style="margin-top: 150px;">
    <div class="tabs d-flex">
        <input type="radio" class="tabs-radio" name="tabs-example" id="tab1" checked>
        <label for="tab1" class="tabs-label">Deskripsi Produk</label>
        <div class="tabs-content">
            <div class="mt-3 mb-3">{!! $produk->productdesc !!}</div>
        </div>
        <input type="radio" class="tabs-radio" name="tabs-example" id="tab2">
        <label for="tab2" class="tabs-label">Informasi Tambahan</label>
        <div class="tabs-content">
            <br><b>Weight :</b>&nbsp;&nbsp;&nbsp;{{$produk->berat}} gram<br>
            {{-- <br><b>Dimensions :</b>&nbsp;&nbsp;&nbsp;55 x 15 x 45 cm<br> --}}
        </div>
    </div>
</div>

@include('partials.footer')

<script src="jquery.magnify.js"></script>
<script>
    $(document).ready(function() {

        let selectedVariasiId = null;

        $("#text-pilih-variasi-2").hide();
        $("#text-pilih-variasi-2-responsive").hide();

        $('.add-cart').attr('disabled',true);
        $(".add-wishlist").attr("disabled", true);


        if(localStorage.getItem("add-wishlistClicked"))
        {      
            localStorage.removeItem("add-wishlistClicked");     
            $('#add-wishlist-success').slideDown(150);
            setTimeout(function() {
                $('#add-wishlist-success').slideUp(900);
                }, 5000);

            $('#add-wishlist-success-responsive').slideDown(150);
            setTimeout(function() {
                $('#add-wishlist-success-responsive').slideUp(900);
                }, 5000);
        }

        if(localStorage.getItem("add-cartClicked"))
        {      
            localStorage.removeItem("add-cartClicked");     
            $('#add-cart-success').slideDown(150);
            setTimeout(function() {
                $('#add-cart-success').slideUp(900);
                }, 5000);

            $('#add-cart-success-responsive').slideDown(150);
            setTimeout(function() {
                $('#add-cart-success-responsive').slideUp(900);
                }, 5000);
        }

        if(localStorage.getItem("delete-wishlistClicked"))
        {      
            localStorage.removeItem("delete-wishlistClicked");     
            $('#delete-wishlist-success').slideDown(150);
            setTimeout(function() {
                $('#delete-wishlist-success').slideUp(900);
                }, 5000);

            $('#delete-wishlist-success-responsive').slideDown(150);
            setTimeout(function() {
                $('#delete-wishlist-success-responsive').slideUp(900);
                }, 5000);
        }

        $('.zoom').magnify();

        $('.thumbnail-image').on('click', function(){
            var newSrc = $(this).attr('src');
            var newMagnify = $(this).attr('data-magnify-src');

            // 1. Unbind plugin dulu (kalau didukung)
            $('#img-produk').magnify('destroy'); // ini untuk plugin magnify.js

            // 2. Ganti src dan data-magnify-src
            $('#img-produk')
                .attr('src', newSrc)
                .attr('data-magnify-src', newMagnify);

            // 3. Bind ulang plugin
            $('#img-produk').magnify(); // atau fungsi inisialisasi lain sesuai plugin kamu
        });

        $('.thumbnail-image-responsive, .thumbnail-image-responsive-5').on('click', function(){
            var newSrc = $(this).attr('src');
            var newMagnify = $(this).attr('data-magnify-src');

            // 1. Unbind plugin dulu (kalau didukung)
            $('#img-produk-responsive').magnify('destroy'); // ini untuk plugin magnify.js

            // 2. Ganti src dan data-magnify-src
            $('#img-produk-responsive')
                .attr('src', newSrc)
                .attr('data-magnify-src', newMagnify);

            // 3. Bind ulang plugin
            $('#img-produk-responsive').magnify(); // atau fungsi inisialisasi lain sesuai plugin kamu
        });

        $('.min-btn-produk').on('click', function() {
            $(".qty").trigger('change');
            $(".qty-responsive").trigger('change');
        });

        $('.plus-btn-produk').on('click', function() {
            $(".qty").trigger('change');
            $(".qty-responsive").trigger('change');
        });

            let minPriceafter = Infinity; // Inisialisasi dengan nilai maksimum
            let selectedVariation = null;

        $('.variasi').each(function () {
            let priceafter = parseFloat($(this).data('priceafter'));
            if (priceafter < minPriceafter) {
                minPriceafter = priceafter;
                selectedVariation = $(this);
            }
        });

            // Fokuskan elemen dengan harga terendah
            if (selectedVariation) {
                selectedVariation.css({
                    'background-color': 'white',
                    'color': 'black'
                });
                selectedVariation.trigger('click');
            }

        $(document).on('click' ,'.variasi', function(e) {
            e.preventDefault();

            selectedVariasiId = $(this).data('id');

            $('.add-cart').attr('disabled',true);

            var index = $(".variasi").index($(this));
            var idProduk = $(".id-var").eq(index).val();
            var idProduct = $("#input-id-produk").val();
            var variasiVal = $(".variasi").eq(index).html().trim().replace(/\s+/g, ' ');

            $('.variasi').css({
                'background-color': 'white',
                'color': 'black'
            });
            $(".variasi").eq(index).css({
                'background-color': '#e40013',
                'color': 'white'
            });

            $.ajax({
                url: "{{ route('variasi.harga') }}",
                type: 'PUT',
                dataType: 'json',
                data: 
                {
                    _token: "{{ csrf_token() }}",
                    id_produk: idProduk,
                    variasiVal: variasiVal,
                    idProduct: idProduct
                },
                success: function(response){
                    let hargaSesudah = response.hargavariasi;
                    let hargaSebelum = response.hargasebelum;
                    let cards = response.cards;
                    let wishlistVal = response.wishlist;

                $("#harga-sebelum").html('');
                $("#harga-sebelum").append(
                `
                    <div id="harga-sebelum"><s style="color: red;">Rp ${new Intl.NumberFormat('id-ID').format(hargaSebelum)}</s></div>
                `
                );

                $("#harga-sesudah").html('');
                $("#harga-sesudah").append(
                `
                    <div id="harga-sesudah">Rp ${new Intl.NumberFormat('id-ID').format(hargaSesudah)}</div>
                `
                );

                $("#harga-normal").html('');
                $("#harga-normal").append(
                `
                    <div id="harga-normal">Rp ${new Intl.NumberFormat('id-ID').format(hargaSesudah)}</div>
                `
                );

                $("#text-pilih-variasi-1").hide();
                $("#text-pilih-variasi-1-responsive").hide();

                $("#text-pilih-variasi-2").show();
                $('#text-pilih-variasi-2-responsive').addClass('pb-3');
                $("#text-pilih-variasi-2-responsive").show();

                $("#stok-column").html('');
                $("#stok-column").append(`<h5 style="font-weight: 600">Pilih Lokasi Pengiriman :</h5><br>`);
                cards.forEach(function(card) {
                    $("#stok-column").append
                    (
                    `
                        <div class="card" style="border-radius: 20px; border: 1px solid rgba(0,0,0,0.3); cursor: pointer;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <input type="radio" class="nama-cabang" name="nama-cabang" value="${card.name}">&nbsp; <b>${card.name}</b>
                                    <input type="hidden" class="stok-cabang" value="${card.stock}">
                                </h5>
                                <p class="card-text">
                                    <div style="color: #920700">
                                        Stok Tersedia: <b>${card.stock}</b>
                                    </div>
                                </p>
                            </div>
                        </div>
                    `
                    );
                });
                $("#stok-column").append(`<h5><i>Silahkan hubungi Whatsapp kami untuk info stok terbaru</i></h5>`);

                $("#stok-column-responsive").html('');
                $("#stok-column-responsive").addClass('row');
                $("#stok-column-responsive").append(`<h5 style="font-weight: 600">Pilih Lokasi Pengiriman :</h5><br>`);
                cards.forEach(function(card) {
                    $("#stok-column-responsive").append(`
                        <div class="col-12 col-md-6 g-3">
                            <div class="card h-100" style="border-radius: 20px; border: 1px solid rgba(0,0,0,0.3); cursor: pointer;">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <input type="radio" class="nama-cabang" name="nama-cabang" value="${card.name}">&nbsp; 
                                        <b>${card.name}</b>
                                        <input type="hidden" class="stok-cabang" value="${card.stock}">
                                    </h5>
                                    <p class="card-text mb-0" style="color: #920700; font-weight: bold;">
                                        Stok Tersedia: ${card.stock}
                                    </p>
                                </div>
                            </div>
                        </div>
                    `);
                });

                $("#stok-column-responsive").append(`<h5 class="mt-3"><i>Silahkan hubungi Whatsapp kami untuk info stok terbaru</i></h5>`);


                let namaCabang = "";
                let stokValue = "";

               $(document).off("click", ".card-body").on("click", ".card-body", function() {
                    let namaCabang = $(this).find(".nama-cabang");

                    namaCabang.prop("checked", true).trigger("change");
                });
                
                $(document).off("change", ".nama-cabang").on("change", ".nama-cabang", function() {

                    let selectedRadio = $(this); 
                    stokValue = selectedRadio.closest(".card").find(".stok-cabang").val(); 
                    namaCabang = selectedRadio.val();
                    let kota = namaCabang.replace(/DSC\s|(\s*\(.*\))/g, "").trim();

                    $.ajax({
                        url: "/cekstokcabang",
                        type: 'GET',
                        dataType: 'json',
                        data: 
                    {
                        _token: "{{ csrf_token() }}",
                        kota: kota,
                        idvar: idProduk
                    },
                    success: function(response) {
                      let cart = response.cart;
                      
                      if (cart)
                        {
                            $("#cart").html('');
                            $("#cart-responsive").html('');
                            $("#cart").append(
                            `
                            @auth
                                <button class="add-cart btn btn-success" style="width: 230px;"><i class="fas fa-shopping-cart"></i>&nbsp;Tambahkan lagi</button>
                            @else
                                <button class="add-cart btn btn-success" style="width: 230px;"><i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart</button>
                            @endauth
                            `
                            );
                            $("#cart-responsive").append(
                            `
                            @auth
                                <button class="add-cart btn btn-success w-100"><i class="fas fa-shopping-cart"></i>&nbsp;Tambahkan lagi</button>
                            @else
                                <button class="add-cart btn btn-success w-100"><i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart</button>
                            @endauth
                            `
                            );
                        } else {
                            $("#cart").html('');
                            $("#cart-responsive").html('');
                            $("#cart").append(
                            `
                            @auth
                                <button class="add-cart btn btn-success" style="width: 230px;"><i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart</button>
                            @else
                                <button class="add-cart btn btn-success" style="width: 230px;"><i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart</button>
                            @endauth
                            `
                            );
                            $("#cart-responsive").append(
                            `
                            @auth
                                <button class="add-cart btn btn-success w-100"><i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart</button>
                            @else
                                <button class="add-cart btn btn-success w-100"><i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart</button>
                            @endauth
                            `
                            );
                        }  

                        if (parseInt(stokValue) === 0) {
                            $('.add-cart').attr('disabled',true);
                        } else {
                            $('.add-cart').attr('disabled',false);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                    });
                });


                if (wishlistVal)
                {
                    $("#wishlist").html('');
                    $("#wishlist-responsive").html('');
                    $("#wishlist").append(
                    `
                    @auth
                        <button class="delete-wishlist ms-2 btn btn-danger" style="width: 230px;"><i class="fas fa-trash-alt"></i>&nbsp;Hapus dari Wishlist</button>
                    @else
                        <button class="add-wishlist ms-2 btn btn-warning" style="width: 230px;"><i class="far fa-heart"></i>&nbsp;Add to Wishlist</button>
                    @endauth
                    `
                    );
                     $("#wishlist-responsive").append(
                    `
                    @auth
                        <button class="delete-wishlist btn btn-danger mt-3 w-100""><i class="fas fa-trash-alt"></i>&nbsp;Hapus dari Wishlist</button>
                    @else
                        <button class="add-wishlist btn btn-warning mt-3 w-100""><i class="far fa-heart"></i>&nbsp;Add to Wishlist</button>
                    @endauth
                    `
                    );
                } else {
                    $("#wishlist").html('');
                    $("#wishlist-responsive").html('');
                    $("#wishlist").append(
                    `
                    @auth
                        <button class="add-wishlist ms-2 btn btn-warning" style="width: 230px;"><i class="far fa-heart"></i>&nbsp;Add to Wishlist</button>
                    @else
                        <button class="add-wishlist ms-2 btn btn-warning" style="width: 230px;"><i class="far fa-heart"></i>&nbsp;Add to Wishlist</button>
                    @endauth
                    `
                    );
                     $("#wishlist-responsive").append(
                    `
                    @auth
                        <button class="add-wishlist btn btn-warning mt-3 w-100"><i class="far fa-heart"></i>&nbsp;Add to Wishlist</button>
                    @else
                        <button class="add-wishlist btn btn-warning mt-3 w-100"><i class="far fa-heart"></i>&nbsp;Add to Wishlist</button>
                    @endauth
                    `
                    );
                }

                $('.add-wishlist').on('click', function(e) {
                    e.preventDefault();

                    $('#add-wishlist-success').hide();
                    $('#add-wishlist-success-responsive').hide();

                    let imagepath = $('#input-img-produk').val();
                    let loggedIn = {{ auth()->check() ? 'true' : 'false' }};

                    $.ajax({
                        url: "/addwishlist",
                        type: 'POST',
                        dataType: 'text',
                        data: 
                    {
                        _token: "{{ csrf_token() }}",
                        idvar: idProduk,
                        imagepath: imagepath
                    },
                    success: function(response) {
                        if (loggedIn)
                        {
                            location.reload(); 
                            localStorage.setItem("add-wishlistClicked", true);
                        } else
                        {
                            window.location.href = '/login';
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                    });
                });
                $(document).on('click', '.add-cart', function(e) { 
                    e.preventDefault();

                    $('#alert-stok').html('');
                    $('#alert-stok-responsive').html('');
                    $('#add-cart-success').hide();
                    $('#add-cart-success-responsive').hide();

                    let imagepath = $('#input-img-produk').val();
                    let qty = $('.qty:visible').val() || $('.qty-responsive:visible').val();
                    let kota = namaCabang.replace(/DSC\s|(\s*\(.*\))/g, "").trim();
                    let loggedIn = {{ auth()->check() ? 'true' : 'false' }};

                    if (parseInt(qty) > parseInt(stokValue)) {
                        alert(`PEMBELIAN MELEBIHI BATAS STOK , MAKS. ${stokValue}`);
                    } else {
                        $.ajax({
                            url: "/addcart",
                            type: 'POST',
                            dataType: 'text',
                            data: 
                        {
                            _token: "{{ csrf_token() }}",
                            idvar: idProduk,
                            imagepath: imagepath,
                            qty: qty,
                            kota: kota,
                            stok: stokValue
                        },
                        success: function(response) {
                            if (loggedIn)
                            {
                                location.reload(); 
                                localStorage.setItem("add-cartClicked", true);
                            } else
                            {
                                window.location.href = '/login';
                            }
                        },
                        error: function (xhr, status, error) {
                            $('#alert-stok').append(
                            `
                                Pembelian melebihi stok (maks. ${stokValue})
                            `    
                            );

                            $('#alert-stok-responsive').append(
                            `
                                Pembelian melebihi stok (maks. ${stokValue})
                            `    
                            );

                            $('#alert-stok').slideDown(150);
                            $('#alert-stok-responsive').slideDown(150);
                        }
                        });
                    }

                    setTimeout(function() {
                        $('#alert-stok').slideUp(900);
                        $('#alert-stok-responsive').slideUp(900);
                        }, 2000);
                });
                $(document).on('click', '.delete-wishlist', function(e) { 
                    e.preventDefault();

                    $('#delete-wishlist-success').hide();

                    $.ajax({
                        url: "delete/wishlist",
                        type: 'DELETE',
                        dataType: 'text',
                        data: 
                        {
                            _token: "{{ csrf_token() }}",
                            idvar: selectedVariasiId 
                        },
                        success: function(){
                            location.reload(); 
                            localStorage.setItem("delete-wishlistClicked", true);
                        },
                         error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

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

        $('#floating-button-resp').on('click', function() {
            window.location.href = '/whatsapp-contact';
        });
    });

     /* window.onload = function() {
        var width = window.innerWidth;
        var height = window.innerHeight;
        alert("Lebar Layar: " + width + "px\nTinggi Layar: " + height + "px");
    }; */
</script>
</body>
</html>