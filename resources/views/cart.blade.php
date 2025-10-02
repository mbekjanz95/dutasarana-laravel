<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KERANJANG</title>
    
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

@if(session('error'))
    <div id="cart-null" class="fixed-top mt-5 alert alert-danger text-center" role="alert">
        {{ session('error') }}
    </div>
@endif

<div id="sukses" class="fixed-top mt-5 alert alert-success text-center" role="alert">
  Berhasil menghapus produk dari keranjang
</div>

@if ($cart->count() == 0)
  <div class="container mt-5 text-center justify-content-center">
      <img src="cart.png" alt="cart-logo" width="200" height="210">
    <h1 class="mt-5">Keranjang Anda Masih Kosong</h1>
    <button id="back" class="btn btn-danger mt-3" style="border-radius: 15px; font-size: 20px; font-weight: 600; width: auto; height: 50px;">Kembali ke Halaman Utama</button>
  </div>
@else
<div class="container mt-4">
  <div id="add-wishlist-success" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
    Berhasil menambahkan produk ke Wishlist
  </div>
  <div id="delete-wishlist-success" class="fixed-top mt-5 alert alert-warning text-center" role="alert">
    Berhasil menghapus produk dari Wishlist
  </div>
  <div class="row">
      <!-- Bagian Keranjang -->
      <div class="col-md-8">
          <div class="card p-3" style="border-radius: 20px; border: 2px solid rgba(0,0,0,0.3);">
              <h3>Keranjang</h3>
              <div class="d-flex justify-content-between align-items-center mt-3">
                  <div>
                      <input id="selectAll" type="checkbox">
                      <label id="selectAll-label" for="selectAll" class="fw-bold">Pilih Semua</label>
                  </div>
                  <button id="btn-delete-all" class="text-danger fw-bold border-0 bg-transparent">
                      Hapus
                  </button>
              </div>
              <hr>

              <div class="row">
                  @php 
                    $grand_total = 0; 
                  @endphp
                  @foreach ($produk as $row)
                  @php 
                      $sub_total = $row->priceafter * $row->qty;
                      $grand_total += $sub_total;
                      $isWishlist = $wishlistStatuses[$row->id] ?? false; // Cek status wishlist untuk produk ini
                  @endphp
                  <div class="col-12 mb-3 product-card">
                      <div class="card shadow-sm p-3" style="border-radius: 20px; border: 2px solid rgba(0,0,0,0.3)">
                          <div class="row g-0 align-items-center">
                              <div class="col-md-4 text-center">
                                  <img src="{{ asset($row->imagepath) }}" class="img-fluid rounded" style="max-width: 150px;">
                                  <input type="hidden" class="img-produk" value="{{$row->imagepath}}">
                              </div>
                              <div class="col-md-8">
                                  <div class="card-body">
                                      <div class="d-flex justify-content-between">
                                          <h5 class="fw-bold">{{ $row->productname }}</h5>
                                          <h5 class="fw-bold">Rp {{ number_format($row->priceafter, 0, ',', '.') }}</h5>
                                          <input type="hidden" class="harga" value="{{$row->priceafter}}">
                                          <input type="hidden" class="idvar" value="{{$row->id}}">
                                      </div>
                                      <p class="text-muted">{{ $row->value }}</p>
                                      <p class="mb-2">Cabang: {{ $row->kota }}</p>
                                      <input type="hidden" class="kota" value="{{$row->kota}}">
              
                                      <div class="d-flex align-items-center mt-3">
                                          <button onclick="this.parentNode.querySelector('.qty').stepDown()" class="btn btn-light btn-sm me-1 min-btn-produk">-</button>
                                          <input type="number" class="form-control text-center qty" style="width: 60px;" min="1" value="{{ $row->qty }}" max="{{ $row->stok }}">
                                          <button onclick="this.parentNode.querySelector('.qty').stepUp()" class="btn btn-light btn-sm ms-1 plus-btn-produk">+</button>
              
                                          <div class="ms-auto">
                                              @if ($isWishlist)
                                                  <i class="fas fa-heart text-danger fs-4 me-3 btn-delete-wish" style="cursor: pointer"></i>
                                              @else
                                                  <i class="far fa-heart text-danger fs-4 me-3 btn-wish" style="cursor: pointer"></i>
                                              @endif
                                              <i class="fas fa-trash text-danger fs-4 btn-hapus" style="cursor: pointer"></i>
                                          </div>
                                      </div>
                                      <input type="hidden" class="sub-col" value="{{ number_format($sub_total, 0, ',', '.') }}">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach              
              </div>
          </div>
      </div>

      <!-- Bagian Ringkasan Belanja -->
      <div class="col-md-4">
          <div class="card p-3" style="border-radius: 20px; border: 2px solid rgba(0,0,0,0.3);">
              <h3>Ringkasan Belanja</h3>
              <hr>
              <div class="d-flex justify-content-between">
                  <h4>Total</h4>
                  <h4 class="grand-total">Rp. {{ number_format($grand_total, 0, ',', '.') }}</h4>
              </div>
              <div class="text-center mt-4">
                  <button class="btn btn-warning w-100 fw-bold">VOUCHER TERSEDIA (0 VOUCHER)</button>
              </div>
              <div class="d-flex justify-content-between mt-4">
                  <h4>Grand Total</h4>
                  <h4 class="grand-total">Rp. {{ number_format($grand_total, 0, ',', '.') }}</h4>
              </div>
              <div class="text-center mt-4">
                  <button id="btn-checkout" class="btn btn-danger w-100 fw-bold">CHECKOUT</button>
              </div>
          </div>
      </div>
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
</div>

@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function(){
    if(localStorage.getItem("add-wishlistClicked"))
        {      
            localStorage.removeItem("add-wishlistClicked");     
            $('#add-wishlist-success').slideDown(150);
            setTimeout(function() {
                $('#add-wishlist-success').slideUp(900);
                }, 5000);
        }
      
      if(localStorage.getItem("delete-wishlistClicked"))
      {      
          localStorage.removeItem("delete-wishlistClicked");     
          $('#delete-wishlist-success').slideDown(150);
          setTimeout(function() {
              $('#delete-wishlist-success').slideUp(900);
              }, 5000);
      }

    setTimeout(function() {
      $('#cart-null').slideUp(1500);
    }, 1500);

    $('#back').on('click', function() {
      window.location.href = '/';
    });

    $('.qty').on('change', function() {
      $('.spinner-border').show();
      $('.grand-total').hide();

        var index = $(".qty").index($(this));
        var harga = $(".harga").eq(index).val();
        var nama_produk = $(".nama_produk").eq(index).val();
        var qty = $(".qty").eq(index).val();
        var maxValue = parseInt($('.qty').eq(index).attr('max'));

        if (qty < 1)
        {
          alert('MINIMAL 1');
          $(".qty").eq(index).val('1')
          qty = 1;
        } else if (qty > maxValue)
        {
          alert('MAKSIMAL ' + maxValue);
          $(".qty").eq(index).val(maxValue);
          qty = maxValue;
        }

        var subtotalColumn = $(".sub-col").eq(index);
        var newsubVal = qty * harga;
        var formattednewsubVal = parseFloat(newsubVal).toLocaleString('id-ID', {
                                      minimumFractionDigits: 0,
                                      maximumFractionDigits: 0,
                                      useGrouping: true
                                  });

        subtotalColumn.val('');
        subtotalColumn.val(
        `
          Rp. ${formattednewsubVal} 
        `  
        );

        var all = $(".sub-col").map(function() {
          return $(this).val();
        }).get();

        var convert = all.map(price => parseInt(price.replace(/\D/g, ''), 10));

        var sum = 0;
        for (let i = 0; i < convert.length; i++) {
          sum += convert[i];
        }

        var formattedSum = parseFloat(sum).toLocaleString('id-ID', {
                                      minimumFractionDigits: 0,
                                      maximumFractionDigits: 0,
                                      useGrouping: true
        });

        setTimeout(function() {
          $('.spinner-border').hide();
          $('.grand-total').html('');
          $('.grand-total').append(
          `
            Rp. ${formattedSum}
          `  
          );
          $('.grand-total').show();
        }, 300);
    });

    $('.min-btn-produk').on('click', function() {
        var index = $(".min-btn-produk").index($(this));
        $(".qty").eq(index).trigger('change');
      });
      
    $('.plus-btn-produk').on('click', function() {
      var index = $(".plus-btn-produk").index($(this));
      $(".qty").eq(index).trigger('change');
    });

    $('.btn-hapus').on('click', function() {
        var index = $(".btn-hapus").index($(this));
        var idvar = $(".idvar").eq(index).val();
        var kota = $(".kota").eq(index).val();
        var table = $(".product-card ").eq(index);

        $.ajax({
                  url: "{{ route('delete.keranjang') }}",
                  type: 'DELETE',
                  dataType: 'text',
                  data: 
                  {
                      _token: "{{ csrf_token() }}",
                      idvar: idvar,
                      kota: kota
                  },
                  success: function(){
                      table.html('');
                      $('#sukses').slideDown(150);
                      if($('.harga').length === 0) 
                      {
                        location.reload();
                      }
                  },
                  error: function (xhr, status, error) {
                      console.error(xhr.responseText);
                      // Handle error response
                  },
                  complete: function() {
                    var all = $(".sub-col").map(function() {
                                return $(this).val();
                              }).get();

                    var convert = all.map(price => parseInt(price.replace(/\D/g, ''), 10));

                    var sum = 0;
                    for (let i = 0; i < convert.length; i++) {
                      sum += convert[i];
                    }

                    var formattedSum = parseFloat(sum).toLocaleString('id-ID', {
                                                  minimumFractionDigits: 0,
                                                  maximumFractionDigits: 0,
                                                  useGrouping: true
                                      });
                                    
                    $('.grand-total').html('');
                    $('.grand-total').append(
                    `
                      Rp. ${formattedSum}
                    `  
                    );
                    
                  }
        });
                  setTimeout(function() {
                      $('#sukses').slideUp(900);
                  }, 1000);
    });

    $('.btn-wish').on('click', function(e) {
        e.preventDefault();

        $('#add-wishlist-success').hide();

        var index = $(".btn-wish").index($(this));
        var idvar = $(".idvar").eq(index).val();
        var imagepath = $('.img-produk').eq(index).val();

        $.ajax({
            url: "/addwishlist",
            type: 'POST',
            dataType: 'text',
            data: 
        {
            _token: "{{ csrf_token() }}",
            idvar: idvar,
            imagepath: imagepath
        },
        success: function(response) {
            location.reload(); 
            localStorage.setItem("add-wishlistClicked", true);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
        });
    });

    $(document).on('click', '.btn-delete-wish', function(e) { 
            e.preventDefault();

            var index = $(".btn-delete-wish").index($(this));
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

    $('#btn-checkout').on('click', function(e) {
      e.preventDefault();
      $(".idvar").each(function(index) {
          var idvar = $(".idvar").eq(index).val();
          var qty = $(".qty").eq(index).val(); 
          
          $.ajax({
                    url: "{{ route('qty.keranjang') }}",
                    type: 'PUT',
                    dataType: 'text',
                    data: 
                    {
                        _token: "{{ csrf_token() }}",
                        idvar: idvar,
                        qty: qty
                    },
                    success: function(){
                      window.location.href = '/checkout';
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
          });
      });
    });

    $('#selectAll').on('change', function() {
        if ($(this).is(':checked')) {
            // Ketika checkbox tercentang
            $('#btn-delete-all').on('click', function(e) {
                e.preventDefault();
                
                $.ajax({
                    url: "{{ route('delete.keranjang-all') }}",
                    type: 'DELETE',
                    dataType: 'text',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(){
                        location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                
            });
        } else {
            // Ketika checkbox tidak tercentang, hapus event handler
            $('#btn-delete-all').off('click');
        }
    });

  });
</script>
</body>
</html>