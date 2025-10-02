<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TAMBAH PRODUK BARU</title>

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

<form id="product-form" enctype="multipart/form-data">
    @csrf
    <div class="container mt-5 text-center d-block">
        <h2>Tambah Produk Baru</h2>
        <div id="upload-image">
            <img class="d-block mx-auto mt-3" style="width: 200px; height:200px;" src="{{asset('add-product.png ')}}">
        </div>
            <label for="file" id="customUploadButton" class="mt-3 btn btn-light" style="border: 1.5px solid rgba(0,0,0,0.5);">
                Upload Gambar (MAX. 2MB)
            </label>    
            <input type="file" name="file" id="file" style="display: none;">    
    </div> 

    <div class="container mt-70 d-block" style="padding-bottom: 80px">
        <div style="font-size: 25px; font-weight: 600; margin-top: 50px;">*Detail Produk</div>

        <div class="d-flex mt-5" style="font-size: 16px; opacity: 0.8;">
        <span>Pilih Kategori Produk :&nbsp;&nbsp;</span>
                <select id="list-kategori" name="catname" class="me-2" aria-label="Select kategori">
                    <option value="Semua Kategori" selected>Semua Kategori</option>
                    <option value="LAPTOP">Laptop</option> 
                    <option value="PERSONAL COMPUTER">PC</option>
                    <option value="PRINTER">Printer</option>
                    <option value="CARTRIDGE">Cartridge</option>
                    <option value="TABLET">Tablet</option>
                    <option value="PROJECTOR">Projector</option>
                    <option value="TONER">Toner</option>
                    <option value="SCANNER">Scanner</option>
                    <option value="STORAGE">Storage</option>
                    <option value="CCTV">CCTV</option>
                    <option value="KEYBOARD">Keyboard</option>
                    <option value="PRINTHEAD">Printhead</option>
                    <option value="UPS">UPS</option>
                    <option value="AKSESORIS">Aksesoris</option>
                    <option value="TINTA">Tinta</option>
                    <option value="DOCUMENT READER">Document Reader</option>
                    <option value="SCANNER BARCODE">Scanner Barcode</option>
                    <option value="KABEL">Kabel</option>
                    <option value="KERTAS">Kertas</option>
                    <option value="PRO">Pro</option>
                    <option value="HEADSET">Headset</option>
                    <option value="MOUSE">Mouse</option>
                    <option value="MICROPHONE">Microphone</option>
                </select> 
        </div>

        <label for="nama-produk" class="mt-5" style="margin-right: auto; opacity: 0.8;">Nama Produk :</label>
        <span class="d-flex">
            <input id="nama-produk" name="productname" class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 100%; height: 30px;">
        </span>

        <label for="deskripsi-produk" class="mt-5" style="margin-right: auto; opacity: 0.8;">Deskripsi Produk :</label>
        <span class="d-flex">
            <textarea id="deskripsi-produk" name="productdesc" class="mt-2" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 100%; height: 30px;"></textarea>
        </span>

        <label for="berat-produk" class="mt-5" style="margin-right: auto; opacity: 0.8;">Berat :</label>
        <span class="d-flex">
            <input id="berat-produk" type="number" name="berat" placeholder="(gram)" class="mt-2" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 30%; height: 30px;">
        </span>

        <div class="variasi-list">
            <label for="variasi-produk" class="mt-5" style="margin-right: auto; opacity: 0.8;">Variasi Produk 1</label>
            <span class="d-flex">
                <input class="variasi-produk" name="variations[0][value]" class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 58%; height: 30px;">

                <span style="font-size: 16px; opacity: 0.8; margin-top: 12px;">&nbsp;&nbsp;Kode SKU :</span>
                <input class="sku-variasi" name="variations[0][sku]" class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 32%; height: 30px; margin-left: 5px;">
            </span>

            <span class="d-flex mt-2">
                <span style="font-size: 16px; opacity: 0.8; margin-top: 10px;">Harga Sebelum :</span>
                <input class="harga-sebelum" name="variations[0][pricebefore]" placeholder="Rp. " class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 20%; height: 30px; margin-left: 5px;">

                <span style="font-size: 16px; opacity: 0.8; margin-top: 10px;">&nbsp;&nbsp;Harga Sesudah :</span>
                <input class="harga-sesudah" name="variations[0][priceafter]" placeholder="Rp. " class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 20%; height: 30px; margin-left: 5px;">

                <span style="font-size: 16px; opacity: 0.8; margin-top: 10px;">&nbsp;&nbsp;Stok :</span>
                <input class="stok-variasi" name="variations[0][stok]" placeholder="(pcs)" class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 8%; height: 30px; margin-left: 5px;">
            </span>
            <div class="text-center">
                <button id="tambahVariasi" type="button" class="mt-3 btn" style="font-size: 15px; width: 100%; border:2px solid rgba(11, 94, 215, 0.5);"><i class="fas fa-plus" style="opacity: 0.8;"></i>&nbsp;&nbsp;TAMBAH VARIASI LAIN</button>
            </div>
        </div>

        <div id="spinner" class="text-center mt-2">
            <div style="width:7rem; height:7rem; border-width:0.7em;" class="spinner-border text-primary mt-5" role="status"></div>
        </div>

        <div class="mt-70 text-center">
            <button id="btn-simpan" type="submit" class="mt-5 btn btn-danger" style="width: 40%; height: 50px; font-size: 20px;">SIMPAN</button>
        </div>
    </div>     
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
 $(document).ready(function () {

        $(document).on('click', '#tambahVariasi', function () {
            $('#spinner').show();

            var jumlahVariasi = $(".variasi-item").length;
            var nomorVariasi = jumlahVariasi + 2;
            let index = $('.variasi-list').length;
            
            setTimeout(function() {
                $('#spinner').hide();
                $('.variasi-list').append(
                `
                <div class="variasi-item">
                    <label for="variasi-produk" class="variasi-produk-label mt-5" style="margin-right: auto; opacity: 0.8;">Variasi Produk ${nomorVariasi}</label>
                    <span class="d-flex">
                        <input class="variasi-produk" name="variations[${index}][value]" class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 58%; height: 30px;">

                        <span style="font-size: 16px; opacity: 0.8; margin-top: 12px;">&nbsp;&nbsp;Kode SKU :</span>
                        <input class="sku-variasi" name="variations[${index}][sku]" class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 32%; height: 30px; margin-left: 5px;">
                    </span>

                    <span class="d-flex mt-2">
                        <span style="font-size: 16px; opacity: 0.8; margin-top: 10px;">Harga Sebelum :</span>
                        <input class="harga-sebelum" name="variations[${index}][pricebefore]" placeholder="Rp. " class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 20%; height: 30px; margin-left: 5px;">

                        <span style="font-size: 16px; opacity: 0.8; margin-top: 10px;">&nbsp;&nbsp;Harga Sesudah :</span>
                        <input class="harga-sesudah" name="variations[${index}][priceafter]" placeholder="Rp. " class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 20%; height: 30px; margin-left: 5px;">

                        <span style="font-size: 16px; opacity: 0.8; margin-top: 10px;">&nbsp;&nbsp;Stok :</span>
                        <input class="stok-variasi" name="variations[${index}][stok]" placeholder="(pcs)" class="mt-2" type="text" style="box-shadow: none; outline: none;  border: 1px solid rgba(1,1,1,0.3); border-radius: 8px; width: 8%; height: 30px; margin-left: 5px;">
                    </span>
                    <div class="text-center">
                        <button class="hapus-variasi mt-3 btn" type="button" style="font-size: 15px; width: 20%; border:2px solid rgba(11, 94, 215, 0.5);"><i class="fas fa-trash"></i>&nbsp;&nbsp;HAPUS VARIASI</button>
                    </div>
                </div>
                `);
                    }, 300);
        });


        $(document).on('click', '.hapus-variasi', function () {
            var index = $(".hapus-variasi").index($(this));
            var variasiItem = $(".variasi-item").eq(index);

            variasiItem.remove();

            $(".variasi-item").each(function (i) {
                $(this).find(".variasi-produk-label").text(`Variasi Produk ${i + 2}`);
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
                        $('#upload-image').html(`
                            <img class="d-block mx-auto mt-3" style="width: 300px; height:300px;" src="${response.file_url}">
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

        $('#product-form').on('submit', function(e) {
            e.preventDefault();

            // bersihkan format harga dulu
            $('.harga-sebelum, .harga-sesudah').each(function() {
                let val = $(this).val();
                // hilangkan semua karakter selain angka
                let clean = val.replace(/\D/g, '');
                $(this).val(clean);
            });

            let formData = new FormData(this);

            /* let variasiList = $('.variasi-list').html();

            console.log(variasiList); */

            $.ajax({
                url: "{{ route('products.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan!');
                }
            });
        });


        $(document).on('input', '.harga-sebelum, .harga-sesudah', function(e) {
            var angka = $(this).val().replace(/\D/g, '');

            var format = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            $(this).val(format);
        });

    });
</script>    
</body>
</html>
