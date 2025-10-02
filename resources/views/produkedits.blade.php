<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DUTA SARANA COMPUTER - {{$produk->productname}}</title>

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
</head>
<body>

<div id="sukses" class="fixed-top mt-5 alert alert-success text-center" role="alert">
    Berhasil mengupdate
</div> 

<div id="gagal" class="fixed-top mt-5 alert alert-danger text-center" role="alert">
    Harap cek inputan kembali !
</div> 

<div class="container mt-5 text-center d-block">
    <h2>Edit Produk - {{$produk->productname}}</h2>
    <div id="edit-gambar">
        <img class="d-block mx-auto mt-3" style="width: 200px; height:200px;" src="{{asset($produk->imagepath)}}">

        <label for="file" id="customUploadButton" class="mt-3 btn btn-light" style="border: 1.5px solid rgba(0,0,0,0.5);">
            Ganti Gambar (MAX. 2MB)
        </label>    
        <input type="file" name="file" id="file" style="display: none;">    
    </div>
</div> 

<div class="container mt-70 d-block" style="padding-bottom: 80px">
    <div style="font-size: 25px; font-weight: 600;">*Detail Produk</div>

    <span class="d-flex mt-3">
        <span class="mt-4" style="font-size: 16px; opacity: 0.8;">Kategori Produk :</span>
        <span><button class="mt-3 ms-2 btn btn-primary" style="cursor: auto">{{$produk->catname}}</button></span>
    </span>

    <span class="d-flex">
        <span class="mt-5" style="font-size: 16px; opacity: 0.8;">Pilih Variasi :</span>
        <div class="pilih-variasi" style="font-size: 17px; font-weight: 400; margin-top: 20px;">
            @foreach ($variasi as $row )
            <div class="variasi mt-3 ms-2 btn btn-danger" data-id-produk="{{$row->id}}" data-var-value="{{$row->value}}">{{$row->value}}</div>
            <input type="hidden" class="id_produk" value="{{$row->id}}">
            <input type="hidden" class="var_value" value="{{$row->value}}">
            @endforeach
       </div>
    </span>

    <form>
        <label for="sku-produk" class="mt-5" style="margin-right: auto; opacity: 0.8;">SKU</label>
        <span class="d-flex">
            <input id="sku-produk" class="sku-produk mt-2" type="text" 
            style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); 
            border-radius: 8px; width: 100%; height: 30px;"
            value={{$produk->sku}}>
        </span>

        {{-- @if ($produk->catname === 'CCTV' || $produk->catname === 'PROJECTOR' || $produk->catname === 'PRINTER' || $produk->catname === 'SCANNER' || $produk->catname === 'TABLET' || $produk->catname === 'UPS')
            <label for="harga-sebelum" class="mt-5" style="margin-right: auto; opacity: 0.8;">Harga Sebelum</label>
            <span class="d-flex">
                <input id="harga-sebelum" placeholder="Rp." class="harga-sebelum mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 100%; height: 30px;">
            </span>

            <label for="harga-sesudah" class="mt-5" style="margin-right: auto; opacity: 0.8;">Harga Sesudah</label>
            <span class="d-flex">
                <input id="harga-sesudah" placeholder="Rp." class="harga-sesudah mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 100%; height: 30px;">
            </span>
        @else --}}
        <input hidden id="harga-sebelum" placeholder="Rp." class="harga-sebelum mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 100%; height: 30px;">

            <label for="harga" class="mt-5" style="margin-right: auto; opacity: 0.8;">Harga</label>
            <span class="d-flex">
                <input id="harga" placeholder="Rp." class="harga mt-2" type="text" 
                style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); 
                border-radius: 8px; width: 100%; height: 30px;"
                value={{$produk->priceafter}}>
            </span>
        {{-- @endif --}}

        <label for="stok-produk" class="mt-5" style="margin-right: auto; opacity: 0.8;">Stok</label>
        <span class="d-flex">
            <input id="stok-produk" placeholder="(pcs)" class="stok-produk mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 100%; height: 30px;">
        </span>

        <div class="mt-5 text-center">
            <button class="btn-ubah ms-2 btn btn-primary" style="width: 40%; height: 50px; font-size: 20px;" >UBAH</button>
        </div>
    </form>

    <div class="mt-70 text-center">
        <a href="/admin">
            <button class="btn btn-danger" style="width: 40%; height: 50px; font-size: 20px;">KEMBALI</button>
        </a>
    </div>
</div>     


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    
    $('#sku-produk').attr('readonly', true).css('background-color', 'rgb(128, 128, 128, 0.5)');
    $('#harga-sebelum').attr('readonly', true).css('background-color', 'rgb(128, 128, 128, 0.5)');
    $('#harga-sesudah').attr('readonly', true).css('background-color', 'rgb(128, 128, 128, 0.5)');
    $('#harga').attr('readonly', true).css('background-color', 'rgb(128, 128, 128, 0.5)');
    $('#stok-produk').attr('readonly', true).css('background-color', 'rgb(128, 128, 128, 0.5)');

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

    $(".btn-ubah").attr('disabled', true);

    let selectedVariasi = null;

    $('.variasi').on('click', function(e) {
            e.preventDefault();

            $('#stok-produk').attr('readonly', false).css('background-color', 'white');
            $(".btn-ubah").attr('disabled', false);

            var index = $(".variasi").index($(this));
            var idProduk = $(".id_produk").eq(index).val();
            var variationsVal = $(".var_value").eq(index).val();

            selectedVariasi = {
                idProduk: $(this).data('id-produk'),
                varValue: $(this).data('var-value')
            };

            $('.variasi').css({
                'background-color': 'white',
                'color': 'black'
            });
    
            $(".variasi").eq(index).css({
                'background-color': '#e40013',
                'color': 'white'
            });

            $.ajax({
                    url: "{{ route('variasi.data') }}",
                    type: 'PUT',
                    dataType: 'json',
                    data: 
                    {
                        _token: "{{ csrf_token() }}",
                        id_produk: idProduk,
                    },
                    success: function(response){
                        let sku = response.skuVariasi;
                        let hargaSebelum = response.hargaSebelum;
                        let hargaSesudah = response.hargaSesudah;
                        let stok = response.stokVariasi;

                        let formattedhargaSebelum = parseFloat(hargaSebelum).toLocaleString('id-ID', {
                                                        minimumFractionDigits: 0,
                                                        maximumFractionDigits: 0,
                                                        useGrouping: true
                                                    });

                        let formattedhargaSesudah = parseFloat(hargaSesudah).toLocaleString('id-ID', {
                            minimumFractionDigits: 0,
                            maximumFractionDigits: 0,
                            useGrouping: true
                        });

                        $(".sku-produk").val('');
                        $(".sku-produk").val(sku);

                        $(".harga").val('');
                        $(".harga").val(formattedhargaSesudah);

                        $(".harga-sebelum").val('');
                        $(".harga-sebelum").val(formattedhargaSebelum);

                        $(".harga-sesudah").val('');
                        $(".harga-sesudah").val(formattedhargaSesudah);
                     
                        $(".stok-produk").val('');
                        $(".stok-produk").val(stok);

                    },  
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
            });

            $('.btn-ubah').on('click', function(e) {
            e.preventDefault();

            var skuValue = $(".sku-produk").val();
            var hargasebelumValue = $(".harga-sebelum").is(":hidden") ? 0 : $(".harga-sebelum").val();
            var hargasesudahValue = $(".harga-sesudah").val() || $(".harga").val();
            var stokValue = $(".stok-produk").val();

            $.ajax({
                url: "{{ route('update.join') }}",
                type: 'PUT',
                dataType: 'json',
                data: 
                {
                    _token: "{{ csrf_token() }}",
                    variationsId: selectedVariasi.idProduk,
                    skuValue: skuValue,
                    hargasebelumValue: hargasebelumValue,
                    hargasesudahValue: hargasesudahValue,
                    stokValue: stokValue
                },
                success: function(){
                    
                    // Reload halaman
                    location.reload();

                   // Simpan status ke localStorage sebelum reload
                    localStorage.setItem('showSuccess', true);

                    $(".sku-produk").val('');
                    $(".harga").val('');
                    $(".harga-sebelum").val('');
                    $(".harga-sesudah").val('');
                    $(".stok-produk").val('');

                },
                error: function (xhr, status, error) {
                    console.log(error);
                    $('#gagal').slideDown(150);

                    setTimeout(function() {
                        $('#gagal').slideUp();
                    }, 3000);
                }
            });
            });
        });

        $('#file').change(function () {
            const fileName = $(this).val().split('\\').pop();
            const fileInput = $('#file')[0];
            const formData = new FormData();

            formData.append('file', fileInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}'); 

            $.ajax({
                url: "{{ route('upload.temp') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        $('#edit-gambar').html(`
                            <img class="d-block mx-auto mt-3" style="width: 200px; height:200px;" src="${response.file_url}">

                            <label for="file" id="customUploadButton" class="mt-3 btn btn-light" style="border: 1.5px solid rgba(0,0,0,0.5);">
                                Ganti Gambar (MAX. 2MB)
                            </label>    
                            <input type="file" name="file" id="file" style="display: none;">    

                            <div class="mx-auto">
                                <button id="btn-simpan" type="submit" class="mt-5 btn btn-success" style="width: 20%; height: 50px; font-size: 20px;">UBAH</button>
                            </div>
                        `);
                    } else {
                        alert('Gagal mengupload file.');
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('Terjadi kesalahan saat mengupload file.');
                }
            });

        });
});

</script>
</body>
</html>
