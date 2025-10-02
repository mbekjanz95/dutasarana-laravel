<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DASHBOARD - {{auth()->user()->username}}</title>
    
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico?v=1.0')}}">

    <link rel="stylesheet" href="{{asset('style.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style2.css?v=2')}}">
    <link rel="stylesheet" href="{{asset('style3.css?v=2')}}">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


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

<div id="tambah-alamat" class="container d-flex" style="padding-bottom: 50px;">
    <div id="menu-tambah-alamat" class="card mt-5" style="width: 30%; 
        background-color: rgba(243, 240, 240, 0.7); border: none; 
        padding-bottom: 70px;">
        <h3 class="mt-4 ms-3" style="font-weight: 700">Halo, {{auth()->user()->username}}</h3>
        <hr class="ms-3" style="width: 80%; border: 1px solid rgba(0,0,0,0.7)">

        <h4 id="transaksi" class="mt-3 ms-4" style="font-weight: 300; cursor: pointer">Histori Transaksi</h4>
        <h4 id="alamat" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer;">Alamat</h4>
        <h4 id="profil" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Profil</h4>
        {{-- <h4 id="tracking" class="mt-5 ms-4" style="font-weight: 300; cursor: pointer">Lacak Pengiriman</h4> --}}
    </div>

    <div class="container">
      @if($customerName->province)
        <h1 class="ms-3" style="font-weight: 300; margin-top: 80px;">Edit Alamat</h1>
          
        <label class="ms-3 mt-4" for="nama-lengkap">Nama Lengkap</span></label>
        <span class="d-flex ms-3">
            <input readonly style="width:100%; background-color: rgb(170, 170, 170,0.5)" value="{{ $customerName->customername }}" type="text" name="customername" id="customername">
        </span>

        <label class="ms-3 mt-4" for="provinsi">Provinsi<span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <select class="form-select" name="provinsi" id="provinsi">
                <option value="" disabled selected>{{ $customerName->province }}</option>
                @foreach ( $provinsi as $row )
                  <option value="{{$row->province_id}}">{{$row->province}}</option>
                @endforeach
            </select>
        </span>

        <label class="ms-3 mt-4" for="kota">Kota/Kabupaten <span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <select disabled style="width:100%" class="form-select" name="kota" id="kota">
                <option value="" disabled selected>{{ $customerName->nama_kota }}</option>
            </select>
        </span>

        <label class="ms-3 mt-4" for="kecamatan">Kecamatan <span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <select disabled style="width:100%" class="form-select" name="kecamatan" id="kecamatan">
                <option value="" disabled selected>{{ $customerName->nama_kecamatan }}</option>
            </select>
        </span>
        
        <label class="ms-3 mt-4" for="kelurahan">Kelurahan <span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <select disabled style="width:100%" class="form-select" name="kelurahan" id="kelurahan">
                <option value="" disabled selected>{{ $customerName->nama_kelurahan }}</option>
            </select>
        </span>

        <label class="ms-3 mt-4" for="address">Alamat Lengkap <span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <input value="{{ $customerName->address }}" style="width:100%; height: 150px;" type="text" name="address" id="address">
        </span>

        <label class="ms-3 mt-4" for="postal_code">Kode Pos</label>
        <span class="d-flex ms-3">
            <input value="{{ $customerName->postal_code }}" style="width:100%;" type="text" name="postal_code" id="postal_code">
        </span>
      @else
        <h1 class="ms-3" style="font-weight: 300; margin-top: 80px;">Tambah Alamat</h1>
          
        <label class="ms-3 mt-4" for="nama-lengkap">Nama Lengkap</span></label>
        <span class="d-flex ms-3">
            <input readonly style="width:100%; background-color: rgb(170, 170, 170,0.5)" value="{{ $customerName->customername }}" type="text" name="customername" id="customername">
        </span>

        <label class="ms-3 mt-4" for="provinsi">Provinsi<span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <select class="form-select" name="provinsi" id="provinsi">
                <option value="" disabled selected>-- PILIH PROVINSI --</option>
                @foreach ( $provinsi as $row )
                  <option value="{{$row->province_id}}">{{$row->province}}</option>
                @endforeach
            </select>
        </span>

        <label class="ms-3 mt-4" for="kota">Kota/Kabupaten <span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <select disabled style="width:100%" class="form-select" name="kota" id="kota">
                <option value="" disabled selected>- - PILIH KOTA/KAB. - -</option>
            </select>
        </span>

        <label class="ms-3 mt-4" for="kecamatan">Kecamatan <span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <select disabled style="width:100%" class="form-select" name="kecamatan" id="kecamatan">
                <option value="" disabled selected>- - PILIH KECAMATAN - -</option>
            </select>
        </span>
        
        <label class="ms-3 mt-4" for="kelurahan">Kelurahan <span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <select disabled style="width:100%" class="form-select" name="kelurahan" id="kelurahan">
                <option value="" disabled selected>- - PILIH KELURAHAN - -</option>
            </select>
        </span>

        <label class="ms-3 mt-4" for="address">Alamat Lengkap <span style="color: red">*</span></label>
        <span class="d-flex ms-3">
            <input style="width:100%; height: 150px;" type="text" name="address" id="address">
        </span>

        <label class="ms-3 mt-4" for="postal_code">Kode Pos</label>
        <span class="d-flex ms-3">
            <input style="width:100%;" type="text" name="postal_code" id="postal_code">
        </span>
      @endif

       

        <div class="ms-3 mt-4" style="color: red">Tanda (*) wajib diisi</div>

        <div class="d-flex ms-3 mt-5">
        <button id="submit-btn" class="btn btn-primary">SIMPAN</button>
        <button class="btn btn-light">Batal</button>
        </div>
    </div>
</div>

@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function(){
    $('#provinsi').select2();
    $('#kota').select2();
    $('#kecamatan').select2();

    $('#provinsi').on('change', function() {
          $('#kota').attr('disabled',true);
          $('#kecamatan').attr('disabled',true);
          $('#kelurahan').attr('disabled',true);

          let idprov = $('#provinsi').val();

          $.ajax({
                    url: "{{ route('area.request') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: 
                    {
                        _token: "{{ csrf_token() }}",
                        idprov: idprov
                    },
                    success: function(response){
                      let cityId = [];

                      $('#kota').attr('disabled',false);
                      $('#kota').html('');
                      $('#kota').append(
                      `
                        <option value="" disabled selected>- - PILIH KOTA/KAB. - -</option>
                      `
                      );
                      $.each(response.city, function(i, val) {
                        cityId.push(val.id_kabupaten);

                        $('#kota').append(
                            `
                              <option value="${val.id_kabupaten}">${val.name}</option>
                            `
                          );
                      });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
          });
    });

    $('#kota').on('change', function() {
          $('#kecamatan').attr('disabled',true);
          $('#kelurahan').attr('disabled',true);

          let idCity = $('#kota').val();

          $.ajax({
                    url: "{{ route('area.request') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: 
                    {
                        _token: "{{ csrf_token() }}",
                        idCity: idCity
                    },
                    success: function(response){

                      $('#kecamatan').attr('disabled',false);
                      $('#kecamatan').html('');
                      $('#kecamatan').append(
                      `
                        <option value="" disabled selected>- - PILIH KECAMATAN - -</option>
                      `
                      );
                      $.each(response.district, function(i, val) {

                        $('#kecamatan').append(
                            `
                              <option value="${val.id}">${val.name}</option>
                            `
                          );
                      });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
          });
    });

    $('#kecamatan').on('change', function() {
          $('#kelurahan').attr('disabled',true);

          let idDistrict = $('#kecamatan').val();

          $.ajax({
                    url: "{{ route('area.request') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: 
                    {
                        _token: "{{ csrf_token() }}",
                        idDistrict: idDistrict
                    },
                    success: function(response){

                      $('#kelurahan').attr('disabled',false);
                      $('#kelurahan').html('');
                      $('#kelurahan').append(
                      `
                        <option value="" disabled selected>- - PILIH KELURAHAN - -</option>
                      `
                      );
                      $.each(response.kelurahan, function(i, val) {

                        $('#kelurahan').append(
                            `
                              <option value="${val.id}">${val.name}</option>
                            `
                          );
                      });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
          });
    });

    $('#submit-btn').on('click', function(e) {
      e.preventDefault();

      let customername = $('#customername').val();
      let idProv = $('#provinsi').val();
      let idKota = $('#kota').val();
      let idKecamatan = $('#kecamatan').val();
      let idKelurahan = $('#kelurahan').val();
      let address = $('#address').val();
      let postal_code = $('#postal_code').val();

        $.ajax({
          url: "{{ route('tambah.alamat') }}",
          type: 'PUT',
          dataType: 'json',
          data: 
          {
            _token: "{{ csrf_token() }}",
            customername: customername,
            idProv: idProv,
            idKota: idKota,
            idKecamatan: idKecamatan,
            idKelurahan: idKelurahan,
            address: address,
            postal_code: postal_code
          },
          success: function(response){
            // console.log(response.message); 
            // console.log(response.customer); 

            console.log(response.status);
            window.location.href='/dashboard/list-alamat';
            /*
            if (response.status === 'success') 
            {
              console.log('User:', response.user);
              console.log('Token:', response.access_token);

              $('#sukses').slideDown(100);
              setTimeout(function() {
                $('#sukses').slideUp(900);
                }, 6000);

              $('input').val('');
              $('#email').attr('readonly', false).css('font-weight', 'normal');
              $('#customername').attr('readonly', false).css('font-weight', 'normal');
            }
            */
          },
          error: function (xhr) {
            var errorMsg = JSON.parse(xhr.responseText);
            console.error(errorMsg);

            /*
            $.each(errorMsg, function(index, error) {
              $.each(error, function(index, val) {  
                  if (val.indexOf('username') !== -1) 
                  {
                      $('#error-username').show();
                      $('#error-username').append(`${val}`);
                  }
                  if (val.indexOf('phone') !== -1) 
                  {
                      $('#error-telp').show();
                      $('#error-telp').append(`${val}`);
                  }
                  if (val.indexOf('password') !== -1) 
                  {
                      $('#error-password').show();
                      $('#error-password').append(`${val}`);
                  }      
              });
                        
            });
            */
          }
        });
    });

    $('#transaksi').on('click', function() {
      window.location.href = '/dashboard/histori-transaksi';
    });
    $('#alamat').on('click', function() {
      window.location.href = '/dashboard/list-alamat';
    });
    $('#profil').on('click', function() {
      window.location.href = '/dashboard/editprofil';
    });
    $('#tracking').on('click', function() {
      window.location.href = '/dashboard/tracking';
    });
   
  });
</script>
  </body>
</html>