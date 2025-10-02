<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Page</title>

    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico?v=1.0')}}">

    <link rel="stylesheet" href="{{asset('style.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style2.css?v=2')}}">

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
        .icon-menu {
          width: 40px;  /* Sesuaikan dengan ukuran ikon sebelumnya */
          height: 40px;
          margin-bottom: 6px;
          cursor: pointer;  /* Agar tetap bisa diklik */
      }
      
      </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div style="margin-top: 10vh; margin-left: 2vh; font-size: 23px; font-weight: 600">
            <i class="fas fa-user"></i>&nbsp;&nbsp;Admin {{auth()->user()->username}}
        </div>
        <ul>

            <li id="home" style="background: rgba(255, 255, 255, 0.4); cursor: default"><i class="fas fa-home"></i>&nbsp;&nbsp;HOME</li>
            <li id="pesanan"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;PESANAN</li>
            <li id="statistik"><i class="far fa-chart-bar"></i>&nbsp;&nbsp;STATISTIK</li>
            <li>
                <form action="/logout" method="post">
                    @csrf
                    <button style="border: none; background: none; color: inherit" type="submit">
                        <i class="fas fa-power-off"></i>&nbsp;&nbsp;LOG OUT
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="nav-admin">
        <span class="toggle-btn"><img src="jempol.png" class="icon-menu">
          <span id="sembunyikan-menu" style="font-size: 20px">< Sembunyikan Menu</span>
          <span id="tampilkan-menu" style="font-size: 20px">Tampilkan Menu ></span>
        </span>
        <span style="font-size: 22px; font-weight: 500">Admin Panel (Data Stok, List Order & More)</span>
    </div>
    <div class="content" id="content">
        <div id="container-edit" class="mt-1 container justify-content-center text-center">
            <div id="sukses" class="fixed-top mt-5 alert alert-success text-center" role="alert">
                Berhasil menghapus produk
            </div> 
        
            <div id="dialog-confirm" style="display: none;">
                <div style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; max-width: 400px; margin: auto;">
                  <h5>Konfirmasi Penghapusan</h5>
                  <p>Apakah anda yakin ingin menghapus produk ini?</p>
                  <div style="margin-top: 20px;">
                    <button id="confirmDelete" class="btn btn-danger">Hapus</button>
                    <button id="cancelDelete" class="btn btn-secondary">Batal</button>
                  </div>
                </div>
            </div>
        
         {{--    <div class="dropdown mt-3 d-flex">
                <button style="margin-left: auto;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <span style="font-weight: 500; font-size: 19px;">Halo, {{ auth()->user()->username }}</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li>
                    <form action="/logout" method="post">
                        @csrf
                        <button class="dropdown-item" style="font-weight: 400;" type="submit">
                        LOG OUT
                        </button>
                    </form>
                </li>
                </ul>
            </div> --}}
        
            <img src="{{asset('logo-dsc.svg')}}" width="150px" height="150px">
        
            <h2 class="mt-4">Data Stok & Harga Barang Terbaru</h2>
            <div class="mt-5">
                <div id="sort-filter-insert" class="d-flex" style="font-size: 21px; width: 100%;">
                    {{-- <span>Urutkan : &nbsp;<button class="btn btn-secondary">A-Z</button></span>--}}

                    <form action="{{ route('tarik.data') }}" method="GET">
                        <span style="margin-right: auto;">
                            <button type="submit" class="btn" style="background-color: rgba(9, 138, 37, 0.747); color: white">
                                <i class="fas fa-arrow-down"></i>&nbsp;Tarik Data
                            </button>
                        </span>
                    </form>

                    <form id="mass-update" enctype="multipart/form-data">
                        <span class="ms-3">
                            <label for="file" id="customUploadButton" class="btn btn-success">
                                <i class="fas fa-plus"></i>&nbsp;Upload Excel
                            </label>    
                            <input type="file" name="file" id="file" style="display: none;">    
                        </span>
                    </form>
        
                    <span style="margin-left: auto;">
                        <a href="/admin/tambah-produk">
                            <button class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;Tambah Produk Baru</button>
                        </a>
                    </span>
                </div>
                <form id="admin-src-produk" class="mt-5 d-flex justify-content-between" action="" method="get">
                    <input id="cari" style="margin-right: auto; width: 95%; border: none; border-bottom: 2px solid rgba(1,1,1,0.2);" type="search" placeholder="Cari Nama/Kategori Produk...">
                    <span> 
                        <button id="btn-cari" type="submit" class="btn-src-produk">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </span>
                </form>
                <div id="spinner" class="text-center mt-2">
                    <div style="width:7rem; height:7rem; border-width:0.7em;" class="spinner-border text-success mt-5" role="status"></div>
                </div>
                
                <table id="table-induk" class="table table-bordered mt-4">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col"></th>  
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th class="text-center" scope="col">Nama Produk</th>
                        <th class="text-center" scope="col">Harga Sebelum</th>
                        <th class="text-center" scope="col">Harga Sesudah</th>
                        <th class="text-center" scope="col">Kategori Produk</th>
                        <th class="text-center" scope="col">Stok Total (Seluruh Variasi)</th>
                        </tr>
                    </thead>
                    <tbody id="isi-table"> 
                        @foreach ($produk as $row )
                            @if ($row->catname === 'CCTV' || $row->catname === 'PROJECTOR' || $row->catname === 'PRINTER' || $row->catname === 'SCANNER' || $row->catname === 'TABLET' || $row->catname === 'UPS')
                                <tr>
                                    <td class="text-center" style="padding-top: 40px;"><button class="btn-hapus btn btn-danger">Hapus produk</button></td>
                                    <td class="text-center" style="padding-top: 40px;"><a href="/admin/{{$row->productname}}"><button class="btn btn-success">Edit produk</button></a></td>
                                    <td class="text-center"><img class="thumbnail" src="{{asset($row->imagepath)}}" style="height: 100px;width: 100px;"></td>  
                                    <td class="nama-produk text-center" style="padding-top: 50px; padding-left: 0; padding-right: 0;">{{$row->productname}}</td>
                                    <td class="text-center" style="padding-top: 50px;">Rp. {{number_format($row->pricebefore,0,',','.')}}</td>
                                    <td class="text-center" style="padding-top: 50px;">Rp. {{number_format($row->priceafter,0,',','.')}}</td>
                                    <td class="text-center" style="padding-top: 50px;">{{$row->catname}}</td>
                                    <td class="text-center" style="padding-top: 50px;">{{ $produkStok[$row->id] ?? 0 }} pcs</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="text-center" style="padding-top: 40px;"><button class="btn-hapus btn btn-danger">Hapus produk</button></td>
                                    <td class="text-center" style="padding-top: 40px;"><a href="/admin/{{$row->productname}}"><button class="btn btn-success">Edit produk</button></a></td>
                                    <td class="text-center"><img class="thumbnail" src="{{asset($row->imagepath)}}" style="height: 100px;width: 100px;"></td>  
                                    <td class="nama-produk text-center" style="padding-top: 50px; padding-left: 0; padding-right: 0;">{{$row->productname}}</td>
                                    <td class="text-center" style="padding-top: 50px;">-</td>
                                    <td class="text-center" style="padding-top: 50px;">Rp. {{number_format($row->priceafter,0,',','.')}}</td>
                                    <td class="text-center" style="padding-top: 50px;">{{$row->catname}}</td>
                                    <td class="text-center" style="padding-top: 50px;">{{ $produkStok[$row->id] ?? 0 }} pcs</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> 
        
        <div id="page-link">
            {{$produk->links('vendor.pagination.bootstrap-5')}}
        </div>
        
        <div class="container mt-70">
            <div class="text-center"><span style="font-size: 18px; padding-bottom: 50px;">Copyright © 2025 • Dutasarana.id</span></div>
        </div>
    </div>



<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('#tampilkan-menu').hide();

        if (localStorage.getItem('showSuccess')) {
            // Jalankan efek slideDown
            $('#sukses').slideDown(150);

            // Hapus status dari localStorage agar tidak terus berulang
            localStorage.removeItem('showSuccess');

            // Sembunyikan elemen setelah beberapa detik
            setTimeout(function() {
                $('#sukses').slideUp();
            }, 6000);
        }

        $('#statistik').on('click', function() {
            window.location.href = '/statistik';
        });

        $('#pesanan').on('click', function() {
            window.location.href = '/pesanan';
        });

        $('.toggle-btn').on('click', function() {
          if ($('#sidebar').hasClass('hide')) {
              $('#sidebar').removeClass('hide');
              $('#content').removeClass('full');
              $('#sembunyikan-menu').show();
              $('#tampilkan-menu').hide();
          } else {
              $('#sidebar').addClass('hide');
              $('#content').addClass('full');
              $('#sembunyikan-menu').hide();
              $('#tampilkan-menu').show();
          }
        });

        $('#admin-src-produk').on('submit', function(e) {
            e.preventDefault();

            $('#spinner').show();
            $('#table-induk').hide();
            $('#page-link').hide();

            let cari = $('#cari').val();

            $.ajax({
                    url: "{{ route('cari') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: 
                    {
                        cari: cari,
                    },
                    success: function(response){
                        setTimeout(function() {
                        $('#spinner').hide();
                        $('#table-induk').show();
                            }, 700);
                        
                        $("#isi-table").html('');
   
                        $.each(response, function(i, val){
                            let hargaSebelum = val.pricebefore.toLocaleString('id-ID', { minimumFractionDigits: 0 });
                            let hargaSesudah = val.priceafter.toLocaleString('id-ID', { minimumFractionDigits: 0 });

                            if (val.catname === 'CCTV' || val.catname === 'PROJECTOR' || val.catname === 'PRINTER' || val.catname === 'SCANNER' || val.catname === 'TABLET' || val.catname === 'UPS')
                            {
                                $("#isi-table").append(
                                `
                                    <tr>
                                    <td class="text-center" style="padding-top: 40px;"><button class="btn-hapus btn btn-danger">Hapus produk</button></td>
                                    <td class="text-center" style="padding-top: 40px;"><a href="/admin/${val.productname}"><button class="btn btn-success">Edit produk</button></a></td>
                                    <td class="text-center"><img class="thumbnail" src="${val.imagepath}" style="height: 100px;width: 100px;"></td>  
                                    <td class="nama-produk text-center" style="padding-top: 50px; padding-left: 0; padding-right: 0;">${val.productname}</td>
                                    <td class="text-center" style="padding-top: 50px;">Rp. ${hargaSebelum} </td>
                                    <td class="text-center" style="padding-top: 50px;">Rp. ${hargaSesudah} </td>
                                    <td class="text-center" style="padding-top: 50px;">${val.catname}</td>
                                    <td class="text-center" style="padding-top: 50px;">${val.total_stok} pcs</td>
                                    </tr>
                                `);
                            }
                            else
                            {
                                $("#isi-table").append(
                                `
                                    <tr>
                                    <td class="text-center" style="padding-top: 40px;"><button class="btn-hapus btn btn-danger">Hapus produk</button></td>
                                    <td class="text-center" style="padding-top: 40px;"><a href="/admin/${val.productname}"><button class="btn btn-success">Edit produk</button></a></td>
                                    <td class="text-center"><img class="thumbnail" src="${val.imagepath}" style="height: 100px;width: 100px;"></td>  
                                    <td class="nama-produk text-center" style="padding-top: 50px; padding-left: 0; padding-right: 0;">${val.productname}</td>
                                    <td class="text-center" style="padding-top: 50px;">- </td>
                                    <td class="text-center" style="padding-top: 50px;">Rp. ${hargaSesudah} </td>
                                    <td class="text-center" style="padding-top: 50px;">${val.catname}</td>
                                    <td class="text-center" style="padding-top: 50px;">${val.total_stok} pcs</td>
                                    </tr>
                                `);
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
            });
        });

        $('#isi-table').on('click', '.btn-hapus', function() {
            var index = $(".btn-hapus").index($(this));
            var namaProduk = $(".nama-produk").eq(index).text();
            
            $('#dialog-confirm').fadeIn(); 

            $('#confirmDelete').click(function () {
                $.ajax({
                  url: "{{ route('delete.produk') }}",
                  type: 'DELETE',
                  dataType: 'text',
                  data: 
                  {
                      _token: "{{ csrf_token() }}",
                      namaProduk: namaProduk
                  },
                  success: function(){
                    location.reload();
                    localStorage.setItem('showSuccess', true);
                  },
                  error: function (xhr, status, error) {
                      console.error(xhr.responseText);
                  }
                }); 
            });
        });

        $('.btn-hapus').on('click', function(e) {
            e.preventDefault();

            var index = $(".btn-hapus").index($(this));
            var namaProduk = $(".nama-produk").eq(index).text();

            $('#dialog-confirm').fadeIn(); 

            $('#confirmDelete').click(function () {
                $.ajax({
                  url: "{{ route('delete.produk') }}",
                  type: 'DELETE',
                  dataType: 'text',
                  data: 
                  {
                      _token: "{{ csrf_token() }}",
                      namaProduk: namaProduk
                  },
                  success: function(){
                    location.reload();
                  },
                  error: function (xhr, status, error) {
                      console.error(xhr.responseText);
                  }
                }); 
            });
        });

        $('#cancelDelete').click(function () {
            $('#dialog-confirm').fadeOut(); 
        });

        $('#file').change(function () {
            const fileName = $(this).val().split('\\').pop();
            const fileInput = $('#file')[0];
            const formData = new FormData();

            formData.append('file', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}'); 

            $.ajax({
                url: "{{ route('mass.update') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                   alert(response.message);
                   location.reload();
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